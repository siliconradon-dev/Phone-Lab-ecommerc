@extends('admin.layouts.app')
@push('title')
    <title>Dashboard</title>
@endpush

@push('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            /* ── Ink & paper ── */
            --ink: #12141c;
            --ink-soft: #454a5c;
            --muted: #7d8296;
            --paper: #f4f6fb;
            --surface: #ffffff;
            --border: #e7eaf3;

            /* ── Channel colors (this dashboard is built around two channels) ── */
            --pos: #1D70FF;
            --pos-dark: #a0bcff;
            --pos-tint: #eaf3ff;
            --web: #06b6a8;
            --web-dark: #048c82;
            --web-tint: #e6faf7;

            /* ── Supporting accents ── */
            --violet: #7c5cff;
            --violet-tint: #f1eeff;
            --danger: #ef4444;
            --danger-tint: #fdecec;

            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-soft: 0 10px 30px rgba(18, 20, 28, .05);
        }

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            background: var(--paper) !important;
        }

        .num,
        .stat-value,
        .gradient-panel-value,
        .order-amount,
        .sales-pill,
        .split-pct {
            font-family: 'Space Grotesk', 'Inter', sans-serif;
            font-variant-numeric: tabular-nums;
        }

        .main-content-wrap {
            height: auto !important;
            overflow-y: visible !important;
            padding: 40px 36px 56px;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* ── Page header ── */
        .dash-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dash-header h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            letter-spacing: -.02em;
        }

        .dash-header .sub-text {
            font-size: 1rem;
            color: var(--muted);
            margin-top: 6px;
        }

        .badge-date {
        
            color: #000000;
            font-size: .85rem;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 10px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Signature element: channel-split bar ──
               A single bar that always shows the real POS vs Web
               revenue split -- the one number every other card here
               is a breakdown of. */
        .split-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px 26px;
            margin-bottom: 32px;
            box-shadow: var(--shadow-soft);
        }

        .split-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 14px;
        }

        .split-title {
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .split-total {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ink);
        }

        .split-track {
            display: flex;
            width: 100%;
            height: 14px;
            border-radius: 999px;
            overflow: hidden;
            background: var(--border);
        }

        .split-seg {
            height: 100%;
            transition: width .5s ease;
        }

        .split-seg.pos {
            background: linear-gradient(90deg, var(--pos-dark), var(--pos));
        }

        .split-seg.web {
            background: linear-gradient(90deg, var(--web), var(--web-dark));
        }

        .split-legend {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .split-legend .item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .88rem;
            font-weight: 600;
            color: var(--ink-soft);
        }

        .split-legend .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .split-legend .dot.pos {
            background: var(--pos);
        }

        .split-legend .dot.web {
            background: var(--web);
        }

        .split-pct {
            font-weight: 700;
            color: var(--ink);
        }

        /* ── Section labels ── */
        .section-heading {
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-heading::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── Stat cards ── */
        .stat-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            border-left: 4px solid transparent;
            padding: 26px 26px 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            transition: box-shadow .2s, transform .2s;
            height: 100%;
            box-shadow: var(--shadow-soft);
        }

        .stat-card:hover {
            box-shadow: 0 16px 36px rgba(18, 20, 28, .09);
            transform: translateY(-3px);
        }

        .stat-card--revenue {
            border-left-color: var(--pos);
        }

        .stat-card--orders {
            border-left-color: var(--web);
        }

        .stat-card--customers {
            border-left-color: var(--violet);
        }

        .stat-card--stock {
            border-left-color: var(--danger);
        }

        .stat-card .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .stat-card .stat-label {
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .stat-card .stat-value {
            font-size: 2.05rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
            letter-spacing: -.01em;
        }

        .stat-card .stat-sub {
            font-size: .85rem;
            color: var(--muted);
            margin-top: 8px;
        }

        .icon-pos {
            background: var(--pos-tint);
            color: var(--pos-dark);
        }

        .icon-web {
            background: var(--web-tint);
            color: var(--web-dark);
        }

        .icon-violet {
            background: var(--violet-tint);
            color: var(--violet);
        }

        .icon-danger {
            background: var(--danger-tint);
            color: var(--danger);
        }

        /* ── Box panels ── */
        .dash-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            height: 100%;
            box-shadow: var(--shadow-soft);
        }

        .dash-panel .panel-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .dash-panel .panel-sub {
            font-size: .88rem;
            color: var(--muted);
            margin-bottom: 24px;
        }

        /* ── Gradient panels (POS / Web breakdown) ── */
        .panel-gradient-pos {
            background: linear-gradient(135deg, var(--pos-dark) 0%, var(--pos) 100%) !important;
            color: #fff !important;
            border: none !important;
        }

        .panel-gradient-web {
            background: linear-gradient(135deg, var(--web-dark) 0%, var(--web) 100%) !important;
            color: #fff !important;
            border: none !important;
        }

        .gradient-accent-bar {
            height: 4px;
            width: 40px;
            border-radius: 4px;
            background: rgba(255, 255, 255, .55);
            margin-bottom: 22px;
        }

        .gradient-panel-value {
            font-size: 2.35rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.01em;
            margin-bottom: 8px;
            line-height: 1.1;
        }

        .gradient-panel-meta {
            font-size: .88rem;
            color: rgba(255, 255, 255, .82);
        }

        /* ── Period toggle ── */
        .period-toggle {
            display: flex;
            gap: 4px;
            align-items: center;
            background: var(--paper);
            padding: 4px;
            border-radius: 12px;
        }

        .period-btn {
            padding: 6px 16px;
            border-radius: 9px;
            border: none;
            background: transparent;
            color: var(--muted);
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s, color .15s;
            font-family: 'Inter', sans-serif;
        }

        .period-btn:hover {
            color: var(--ink);
        }

        .period-btn.active {
            background: var(--ink);
            color: #fff;
        }

        /* ── Chart head ── */
        .chart-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .chart-legend {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .chart-legend .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            font-weight: 600;
            color: var(--ink-soft);
        }

        .chart-legend .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .chart-canvas-wrap {
            position: relative;
            width: 100%;
            height: 320px;
        }

        .chart-canvas-wrap.chart-bar {
            height: 300px;
        }

        /* ── Product / order rows ── */
        .product-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            gap: 16px;
        }

        .product-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .product-row .prod-name {
            flex: 1;
            font-size: .96rem;
            font-weight: 500;
            color: var(--ink);
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .order-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            gap: 16px;
        }

        .order-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .order-row .order-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--pos);
            flex-shrink: 0;
        }

        .order-row .order-code {
            flex: 1;
            font-size: .95rem;
            font-weight: 600;
            color: var(--ink);
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .order-row .order-amount {
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            flex-shrink: 0;
        }

        /* ── Low stock blink ── */
        .blink-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--danger);
            display: inline-block;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .25;
            }
        }

        /* ── View all link ── */
        .view-all-link {
            font-size: .85rem;
            color: var(--ink);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);

            .product-list {
                max-height: 220px;
                overflow-y: auto;
                padding-right: 6px;
            }

            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }

            /* ── Extra metrics & AOV ── */
            .stat-card--aov {
                border-left-color: var(--violet);
            }

            .icon-aov {
                background: var(--violet-tint);
                color: var(--violet);
            }

            .panel-gradient-aov-pos {
                background: linear-gradient(135deg, #e85d2d 0%, var(--pos) 100%) !important;
                color: #fff !important;
                border: none !important;
            }

            .panel-gradient-aov-web {
                background: linear-gradient(135deg, #059a8e 0%, var(--web) 100%) !important;
                color: #fff !important;
                border: none !important;
            }

            /* ── Custom table styling ── */
            .table {
                border-collapse: separate;
                border-spacing: 0 8px;
            }

            .table tbody tr {
                box-shadow: 0 2px 6px rgba(18, 20, 28, 0.02);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .table tbody tr:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(18, 20, 28, 0.05);
                background-color: var(--surface) !important;
            }

            /* ── Responsive ── */
            @media (max-width: 992px) {
                .chart-canvas-wrap {
                    height: 280px;
                }

                .chart-canvas-wrap.chart-bar {
                    height: 260px;
                }
            }

            @media (max-width: 768px) {
                .main-content-wrap {
                    padding: 24px 18px;
                }

                .dash-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .dash-header h4 {
                    font-size: 1.6rem;
                }

                .section-heading {
                    font-size: .78rem;
                    margin-bottom: 16px;
                }

                .stat-card {
                    padding: 22px 20px;
                    border-radius: 16px;
                }

                .stat-card .stat-icon {
                    width: 44px;
                    height: 44px;
                    font-size: 1.15rem;
                }

                .stat-card .stat-value {
                    font-size: 1.6rem;
                }

                .dash-panel {
                    padding: 20px;
                    border-radius: 16px;
                }

                .gradient-panel-value {
                    font-size: 1.9rem;
                }

                .chart-canvas-wrap {
                    height: 240px;
                }

                .chart-canvas-wrap.chart-bar {
                    height: 240px;
                }

                .chart-panel-head {
                    flex-direction: column;
                    gap: 10px;
                }

                .split-legend {
                    flex-direction: column;
                }
            }

            @media (max-width: 480px) {
                .main-content-wrap {
                    padding: 18px 14px;
                }

                .dash-header h4 {
                    font-size: 1.4rem;
                }

                .stat-card .stat-value {
                    font-size: 1.4rem;
                }

                .chart-canvas-wrap {
                    height: 200px;
                }

                .chart-canvas-wrap.chart-bar {
                    height: 220px;
                }

                .period-btn {
                    padding: 6px 12px;
                    font-size: .76rem;
                }
            }
    </style>
@endpush

@section('index_content')
    <div class="main-content-wrap">

        @php
            if (!function_exists('formatCurrencyShort')) {
                function formatCurrencyShort($number)
                {
                    if ($number >= 1000000000) {
                        return round($number / 1000000000, 1) . 'B';
                    } elseif ($number >= 1000000) {
                        return round($number / 1000000, 1) . 'M';
                    } elseif ($number >= 1000) {
                        return round($number / 1000, 1) . 'K';
                    }
                    return number_format($number, 2);
                }
            }

            $totalRevenue = ($posSales ?? 0) + ($webSales ?? 0);
            $posPct = $totalRevenue > 0 ? round((($posSales ?? 0) / $totalRevenue) * 100) : 50;
            $webPct = 100 - $posPct;

            $posAov = ($posOrders ?? 0) > 0 ? ($posSales ?? 0) / $posOrders : 0;
            $webAov = ($webOrders ?? 0) > 0 ? ($webSales ?? 0) / $webOrders : 0;
            $totalOrders = ($posOrders ?? 0) + ($webOrders ?? 0);
            $combinedAov = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        @endphp

     
   

        {{-- ── Key Metrics ── --}}
        <div class="row g-4 mb-5">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card stat-card--revenue">
                    <div>
                        <div class="stat-label">Total Revenue</div>
                        <div class="stat-value">Rs. {{ formatCurrencyShort($totalRevenue) }}</div>
                        <div class="stat-sub">POS: Rs. {{ formatCurrencyShort($posSales ?? 0) }} | Web: Rs.
                            {{ formatCurrencyShort($webSales ?? 0) }}</div>
                    </div>
                    <div class="stat-icon icon-pos"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card stat-card--orders">
                    <div>
                        <div class="stat-label">Total Orders</div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-sub">POS: {{ $posOrders ?? 0 }} | Web: {{ $webOrders ?? 0 }}</div>
                    </div>
                    <div class="stat-icon icon-web"><i class="bi bi-cart-check"></i></div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card stat-card--customers">
                    <div>
                        <div class="stat-label">Total Customers</div>
                        <div class="stat-value">{{ $totalCustomers ?? 0 }}</div>
                        <div class="stat-sub">Registered accounts</div>
                    </div>
                    <div class="stat-icon icon-violet"><i class="bi bi-people"></i></div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card stat-card--aov">
                    <div>
                        <div class="stat-label">Average Order Value</div>
                        <div class="stat-value">Rs. {{ formatCurrencyShort($combinedAov) }}</div>
                        <div class="stat-sub">POS: Rs. {{ formatCurrencyShort($posAov) }} | Web: Rs.
                            {{ formatCurrencyShort($webAov) }}</div>
                    </div>
                    <div class="stat-icon icon-aov"><i class="bi bi-calculator"></i></div>
                </div>
            </div>

        </div>

        {{-- ── Analytics ── --}}
        <div class="section-heading">Analytics & Channels</div>
        <div class="row g-4 mb-5">

            {{-- Sales Trend Line Chart --}}
            <div class="col-12 col-xl-8">
                <div class="dash-panel">
                    <div class="chart-panel-head">
                        <div>
                            <div class="panel-title" style="margin-bottom:4px;">Sales Trend</div>
                            <div class="panel-sub" style="margin-bottom:0;" id="trendSubLabel">POS vs Web — last 7 days
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end gap-2">
                            <div class="period-toggle" id="trendToggle">
                                <button class="period-btn active" data-period="week">Week</button>
                                <button class="period-btn" data-period="month">Month</button>
                                <button class="period-btn" data-period="year">Year</button>
                            </div>
                            <div class="chart-legend">
                                <span class="legend-item">
                                    <span class="legend-dot" style="background:#2474FF;"></span> POS
                                </span>
                                <span class="legend-item">
                                    <span class="legend-dot" style="background:#06b6a8; border-radius:2px;"></span> Web
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-canvas-wrap">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Channel Share Circle Graph --}}
            <div class="col-12 col-xl-4">
                <div class="dash-panel d-flex flex-column justify-content-between" style="min-height: 410px;">
                    <div>
                        <div class="panel-title" style="margin-bottom:4px;">Sales Channel Share</div>
                        <div class="panel-sub" style="margin-bottom:0;">POS vs Web Sales Distribution</div>
                    </div>
                    <div
                        style="position: relative; height: 210px; display: flex; align-items: center; justify-content: center; margin: 15px 0;">
                        <canvas id="channelShareChart"></canvas>
                        <div style="position: absolute; text-align: center; pointer-events: none;">
                            <div
                                style="font-size: 0.75rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; line-height: 1;">
                                Total</div>
                            <div
                                style="font-size: 1.25rem; font-weight: 800; color: var(--ink); margin-top: 4px; font-family: 'Space Grotesk', sans-serif;">
                                Rs. {{ formatCurrencyShort($totalRevenue) }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around border-top pt-3"
                        style="border-color: var(--border) !important;">
                        <div class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2 font-weight-600"
                                style="font-size:0.82rem; color:var(--ink-soft); font-weight:600;">
                                <span class="rounded-circle"
                                    style="width: 8px; height: 8px; background: var(--pos); display: inline-block;"></span>
                                <span>POS ({{ $posPct }}%)</span>
                            </div>
                            <div class="font-weight-700 mt-1"
                                style="font-family: 'Space Grotesk', sans-serif; font-size: 0.95rem; color: var(--ink); font-weight: 700;">
                                Rs. {{ formatCurrencyShort($posSales ?? 0) }}</div>
                        </div>
                        <div class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2 font-weight-600"
                                style="font-size:0.82rem; color:var(--ink-soft); font-weight:600;">
                                <span class="rounded-circle"
                                    style="width: 8px; height: 8px; background: var(--web); display: inline-block;"></span>
                                <span>Web ({{ $webPct }}%)</span>
                            </div>
                            <div class="font-weight-700 mt-1"
                                style="font-family: 'Space Grotesk', sans-serif; font-size: 0.95rem; color: var(--ink); font-weight: 700;">
                                Rs. {{ formatCurrencyShort($webSales ?? 0) }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Categories and Stock alerts ── --}}
        <div class="row g-4 mb-5">

            {{-- Top Categories Bar Chart --}}
            <div class="col-12 col-xl-5">
                <div class="dash-panel">
                    <div class="chart-panel-head">
                        <div>
                            <div class="panel-title" style="margin-bottom:4px;">Top Categories</div>
                            <div class="panel-sub" style="margin-bottom:0;" id="prodSubLabel">Best sellers this week
                            </div>
                        </div>
                        <div class="period-toggle" id="prodToggle">
                            <button class="period-btn active" data-period="week">Week</button>
                            <button class="period-btn" data-period="month">Month</button>
                            <button class="period-btn" data-period="year">Year</button>
                        </div>
                    </div>
                    <div class="chart-canvas-wrap chart-bar">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Minimum Stock Alert List --}}
            <div class="col-12 col-xl-7">
                <div class="dash-panel :">
                    <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-2">
                        <div>
                            <div class="panel-title" style="color:var(--danger);">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Minimum Stock Alert
                            </div>
                            <div class="panel-sub" style="margin-bottom: 12px;">Products running low on inventory
                                (Threshold < 5)</div>
                            </div>
                            <a href="{{ route('stocks.index') }}" class="view-all-link">Manage Inventory →</a>
                        </div>

                        <div class="product-list hide-scrollbar"
                            style="max-height: 290px; overflow-y: auto; padding-right: 4px;">
                            @if (isset($lowStockProducts) && $lowStockProducts->count())
                                @foreach ($lowStockProducts as $product)
                                    @php
                                        $isCritical = $product->available_qty < 2;
                                    @endphp
                                    <div class="product-row">
                                        <div class="d-flex align-items-center gap-2.5" style="min-width: 0; flex: 1;">
                                            <div class="rounded-circle"
                                                style="width: 8px; margin: 5px; height: 8px; background: {{ $isCritical ? 'var(--danger)' : '#d97706' }}; flex-shrink: 0;">
                                            </div>
                                            <div
                                                style="min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <span class="font-weight-600 text-dark"
                                                    style="font-size: 1.0rem; font-weight: 600;">
                                                    {{ $product->name }}
                                                </span>
                                                <div class="text-muted d-flex align-items-center gap-2"
                                                    style="font-size: 0.92rem; margin-top: 2px;">
                                                    <span>SKU: {{ $product->sku ?? 'N/A' }}</span>
                                                    <span style="color: var(--border);">|</span>
                                                    <span class="badge py-0.5 px-2 bg-light text-secondary"
                                                        style="font-size: 0.68rem; border-radius: 4px; border: 1px solid var(--border);">{{ $product->category->name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-3" style="flex-shrink: 0;">
                                            <div class="text-end">
                                                <div
                                                    style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.25rem; color: {{ $isCritical ? 'var(--danger)' : '#d97706' }};">
                                                    {{ $product->available_qty }} in stock
                                                </div>
                                                <div
                                                    style="font-size: 0.875rem; font-weight: 600; color: {{ $isCritical ? 'var(--danger)' : '#d97706' }}; margin-top: 1px;">
                                                    {{ $isCritical ? 'Critical' : 'Low Stock' }}
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2">

    <!-- Edit Button -->
    <a href="{{ route('products.edit', $product->id) }}"
        class="btn btn-light"
        title="Edit Product"
        style="width:30px;height:30px;border-radius:10px;border:1px solid #dee2e6;display:flex;align-items:center;justify-content:center;background:#fff;box-shadow:0 2px 6px rgba(0,0,0,.06);transition:.2s;">
        <i class="bi bi-pencil-fill" style="font-size:10px;color:#3D84FF;"></i>
    </a>

    <!-- Restock Button -->
    <a href="{{ route('stocks.create') }}?product_id={{ $product->id }}"
        class="btn"
        title="Restock"
        style="height:30px; padding:0 16px;border-radius:10px;background:#13BAAD;color:#fff;font-size:10px;font-weight:400;border:none;display:flex;align-items:center;gap:6px;box-shadow:0 2px 6px rgba(19,186,173,.25);">
        <i class="bi bi-plus-circle-fill" style="font-size:16px;"></i>
        Restock
    </a>

</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5 d-flex flex-column align-items-center justify-content-center gap-2"
                                    style="color: var(--muted);">
                                    <i class="bi bi-check-circle text-success" style="font-size: 3.2rem;"></i>
                                    <div class="mt-2"
                                        style="color: var(--web-dark); font-weight: 600; font-size: 0.95rem;">Inventory
                                        fully stocked</div>
                                    <div class="text-muted" style="font-size: 0.8rem;">No products are currently below the
                                        minimum stock limit of 5.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── Breakdown ── --}}
            <div class="section-heading">Sales & AOV Breakdown</div>
            <div class="row g-4 mb-5">

                {{-- POS Summary --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="dash-panel panel-gradient-pos">
                        <div class="gradient-accent-bar"></div>
                        <div class="panel-title" style="color:#fff; font-size:1.1rem;">POS Sales</div>
                        <div class="panel-sub" style="color:rgba(255,255,255,.75); margin-bottom:24px;">In-store point of
                            sale</div>
                        <div class="gradient-panel-value">Rs. {{ formatCurrencyShort($posSales ?? 0) }}</div>
                        <div class="gradient-panel-meta"><i class="bi bi-receipt me-1"></i>{{ $posOrders ?? 0 }} orders
                            placed</div>
                    </div>
                </div>

                {{-- Web Summary --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="dash-panel panel-gradient-web">
                        <div class="gradient-accent-bar"></div>
                        <div class="panel-title" style="color:#fff; font-size:1.1rem;">Web Sales</div>
                        <div class="panel-sub" style="color:rgba(255,255,255,.75); margin-bottom:24px;">Online store
                            orders</div>
                        <div class="gradient-panel-value">Rs. {{ formatCurrencyShort($webSales ?? 0) }}</div>
                        <div class="gradient-panel-meta"><i class="bi bi-globe me-1"></i>{{ $webOrders ?? 0 }} orders
                            placed</div>
                    </div>
                </div>

                {{-- POS AOV --}}

                {{-- <div class="col-12 col-md-6 col-xl-3">
                    <div class="dash-panel panel-gradient-aov-pos">
                        <div class="gradient-accent-bar"></div>
                        <div class="panel-title" style="color:#fff; font-size:1.1rem;">POS AOV</div>
                        <div class="panel-sub" style="color:rgba(255,255,255,.75); margin-bottom:24px;">In-store avg
                            ticket size</div>
                        <div class="gradient-panel-value">Rs. {{ formatCurrencyShort($posAov) }}</div>
                        <div class="gradient-panel-meta"><i class="bi bi-calculator me-1"></i>Based on all POS sales</div>
                    </div>
                </div> --}}

                {{-- Web AOV --}}

                {{-- <div class="col-12 col-md-6 col-xl-3">
                    <div class="dash-panel panel-gradient-aov-web">
                        <div class="gradient-accent-bar"></div>
                        <div class="panel-title" style="color:#fff; font-size:1.1rem;">Web AOV</div>
                        <div class="panel-sub" style="color:rgba(255,255,255,.75); margin-bottom:24px;">Online avg ticket
                            size</div>
                        <div class="gradient-panel-value">Rs. {{ formatCurrencyShort($webAov) }}</div>
                        <div class="gradient-panel-meta"><i class="bi bi-calculator me-1"></i>Based on all completed web
                            orders</div>
                    </div>
                </div> --}}

            </div>

            {{-- ── Recent Activity ── --}}
            <div class="section-heading">Recent Activity</div>
            <div class="row g-4">

                <div class="col-12 col-md-6">
                    <div class="dash-panel">
                        <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-2">
                            <div class="panel-title">Recent POS Orders</div>
                            <a href="{{ route('pos-orders.index') }}" class="view-all-link">View all →</a>
                        </div>
                        <div class="panel-sub">Last 5 in-store transactions</div>
                        @forelse (\App\Models\PosOrder::latest()->take(5)->get() as $pOrder)
                            <div class="order-row">
                                <div class="order-dot" style="background:var(--pos);"></div>
                                <div class="order-code">{{ $pOrder->order_code }}</div>
                                <div class="order-amount">Rs. {{ number_format($pOrder->total_amount, 2) }}</div>
                            </div>
                        @empty
                            @foreach ([['POS-10041', '12,500.00'], ['POS-10040', '8,200.00'], ['POS-10039', '3,750.00'], ['POS-10038', '21,000.00'], ['POS-10037', '6,900.00']] as [$code, $amt])
                                <div class="order-row">
                                    <div class="order-dot" style="background:var(--pos);"></div>
                                    <div class="order-code">{{ $code }}</div>
                                    <div class="order-amount">Rs. {{ $amt }}</div>
                                </div>
                            @endforeach
                        @endforelse
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="dash-panel">
                        <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-2">
                            <div class="panel-title">Recent Web Orders</div>
                            <a href="{{ route('orders.index') }}" class="view-all-link">View all →</a>
                        </div>
                        <div class="panel-sub">Last 5 online transactions</div>
                        @forelse (\App\Models\Order::latest()->take(5)->get() as $wOrder)
                            <div class="order-row">
                                <div class="order-dot" style="background:var(--web);"></div>
                                <div class="order-code">{{ $wOrder->order_code }}</div>
                                <div class="order-amount">Rs. {{ number_format($wOrder->total, 2) }}</div>
                            </div>
                        @empty
                            @foreach ([['WEB-20088', '9,400.00'], ['WEB-20087', '14,800.00'], ['WEB-20086', '5,300.00'], ['WEB-20085', '31,200.00'], ['WEB-20084', '7,650.00']] as [$code, $amt])
                                <div class="order-row">
                                    <div class="order-dot" style="background:var(--web);"></div>
                                    <div class="order-code">{{ $code }}</div>
                                    <div class="order-amount">Rs. {{ $amt }}</div>
                                </div>
                            @endforeach
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                Chart.defaults.color = '#7d8296';
                Chart.defaults.font.family = "'Inter', sans-serif";

                /* ─────────────────────────────────────────────
                   1.  BACKEND DATA  (injected by Laravel)
                   ───────────────────────────────────────────── */
                const backendWeek = {
                    labels: @json($salesTrendLabels ?? []),
                    pos: @json($salesTrendPos ?? []),
                    web: @json($salesTrendWeb ?? []),
                    prodNames: @json(isset($topCategoriesWeek) ? $topCategoriesWeek->pluck('name')->map(fn($name) => explode(' ', $name)[0]) : []),
                    prodCounts: @json(isset($topCategoriesWeek) ? $topCategoriesWeek->pluck('total_qty') : []),
                    trendSub: 'POS vs Web — last 7 days',
                    prodSub: 'Best sellers this week',
                };
                const backendMonth = {
                    labels: @json($salesTrendLabelsMonth ?? []),
                    pos: @json($salesTrendPosMonth ?? []),
                    web: @json($salesTrendWebMonth ?? []),
                    prodNames: @json(isset($topCategoriesMonth) ? $topCategoriesMonth->pluck('name')->map(fn($name) => explode(' ', $name)[0]) : []),
                    prodCounts: @json(isset($topCategoriesMonth) ? $topCategoriesMonth->pluck('total_qty') : []),
                    trendSub: 'POS vs Web — this month by week',
                    prodSub: 'Best sellers this month',
                };
                const backendYear = {
                    labels: @json($salesTrendLabelsYear ?? []),
                    pos: @json($salesTrendPosYear ?? []),
                    web: @json($salesTrendWebYear ?? []),
                    prodNames: @json(isset($topCategoriesYear) ? $topCategoriesYear->pluck('name')->map(fn($name) => explode(' ', $name)[0]) : []),
                    prodCounts: @json(isset($topCategoriesYear) ? $topCategoriesYear->pluck('total_qty') : []),
                    trendSub: 'POS vs Web — full year',
                    prodSub: 'Best sellers this year',
                };

                const DATA = {
                    week: backendWeek,
                    month: backendMonth,
                    year: backendYear,
                };

                /* ─────────────────────────────────────────────
                   2.  HELPERS
                   ───────────────────────────────────────────── */
                function fmtRs(value) {
                    if (value >= 1000000) return 'Rs. ' + (value / 1000000).toFixed(1) + 'M';
                    if (value >= 1000) return 'Rs. ' + Math.round(value / 1000) + 'K';
                    return 'Rs. ' + Number(value).toLocaleString();
                }

                /* ─────────────────────────────────────────────
                   3.  SALES TREND CHART  (Line — POS orange, Web teal)
                   ───────────────────────────────────────────── */
                let trendChart = null;

                function buildTrendChart(period) {
                    const d = DATA[period];
                    const trendCtx = document.getElementById('salesTrendChart');
                    if (!trendCtx) return;

                    if (trendChart) trendChart.destroy();

                    const ctx2d = trendCtx.getContext('2d');
                    const posGradient = ctx2d.createLinearGradient(0, 0, 0, 300);
                    posGradient.addColorStop(0, '#1D70FF');
                    posGradient.addColorStop(1, '#FFFFFF');

                    const webGradient = ctx2d.createLinearGradient(0, 0, 0, 300);
                    webGradient.addColorStop(0, 'rgba(6,182,168,0.20)');
                    webGradient.addColorStop(1, 'rgba(6,182,168,0)');

                    trendChart = new Chart(trendCtx, {
                        type: 'line',
                        data: {
                            labels: d.labels,
                            datasets: [{
                                    label: 'POS',
                                    data: d.pos,
                                    borderColor: '#1D70FF',
                                    backgroundColor: posGradient,
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointRadius: 4,
                                    pointBackgroundColor: '#1D70FF',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointHoverRadius: 6,
                                },
                                {
                                    label: 'Web',
                                    data: d.web,
                                    borderColor: '#06b6a8',
                                    backgroundColor: webGradient,
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointRadius: 4,
                                    pointBackgroundColor: '#06b6a8',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointHoverRadius: 6,
                                    pointStyle: 'rectRounded',
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#12141c',
                                    padding: 12,
                                    cornerRadius: 10,
                                    titleFont: {
                                        weight: '700'
                                    },
                                    callbacks: {
                                        label: function(item) {
                                            return ' ' + item.dataset.label + ': Rs. ' + Number(item.raw)
                                                .toLocaleString();
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                y: {
                                    grid: {
                                        color: '#eef1f8'
                                    },
                                    ticks: {
                                        font: {
                                            size: 12
                                        },
                                        callback: v => fmtRs(v)
                                    }
                                }
                            },
                            animation: {
                                duration: 400
                            }
                        }
                    });

                    const sub = document.getElementById('trendSubLabel');
                    if (sub) sub.textContent = d.trendSub;
                }

                /* ─────────────────────────────────────────────
                   4.  TOP CATEGORIES CHART  (Horizontal Bar — violet scale)
                   ───────────────────────────────────────────── */
                let barChart = null;

                function buildBarChart(period) {
                    const d = DATA[period];
                    const barCtx = document.getElementById('topProductsChart');
                    if (!barCtx) return;

                    if (barChart) barChart.destroy();

                    barChart = new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: d.prodNames,
                            datasets: [{
                                label: 'Sales',
                                data: d.prodCounts,
                                backgroundColor: [
                                    '#13BAAD', // Primary teal
                                    '#2AC5B9',
                                    '#55D3C9',
                                    '#3D84FF', // Primary blue
                                    '#74A7FF'
                                ],
                                hoverBackgroundColor: [
                                    '#0FA397',
                                    '#1FB8AB',
                                    '#46CDBF',
                                    '#2D73F2',
                                    '#5E98FF'
                                ],
                                borderRadius: 8,
                                maxBarThickness: 32,
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#12141c',
                                    padding: 12,
                                    cornerRadius: 10,
                                    callbacks: {
                                        label: item => ' ' + Number(item.raw).toLocaleString() + ' sales'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        color: '#eef1f8'
                                    },
                                    ticks: {
                                        font: {
                                            size: 12
                                        },
                                        precision: 0
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 400
                            }
                        }
                    });

                    const sub = document.getElementById('prodSubLabel');
                    if (sub) sub.textContent = d.prodSub;
                }

                /* ─────────────────────────────────────────────
                   5.  CHANNEL SHARE DOUGHNUT CHART (Circular Graph)
                   ───────────────────────────────────────────── */
                const channelCtx = document.getElementById('channelShareChart');
                if (channelCtx) {
                    new Chart(channelCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['POS Sales', 'Web Sales'],
                            datasets: [{
                                data: [{{ $posSales ?? 0 }}, {{ $webSales ?? 0 }}],
                                backgroundColor: ['#3d84ff', '#7C5CFF'],
                                borderColor: '#ffffff',
                                borderWidth: 2,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#12141c',
                                    padding: 12,
                                    cornerRadius: 10,
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            const val = context.raw;
                                            const pct = Math.round(val /
                                                {{ $totalRevenue > 0 ? $totalRevenue : 1 }} * 100);
                                            label += 'Rs. ' + Number(val).toLocaleString() + ' (' + pct +
                                                '%)';
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                /* ─────────────────────────────────────────────
                   6.  TOGGLE WIRING
                   ───────────────────────────────────────────── */
                function wireToggle(groupId, onSelect) {
                    const group = document.getElementById(groupId);
                    if (!group) return;
                    group.querySelectorAll('.period-btn').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            group.querySelectorAll('.period-btn').forEach(b => b.classList.remove(
                                'active'));
                            btn.classList.add('active');
                            onSelect(btn.dataset.period);
                        });
                    });
                }

                wireToggle('trendToggle', buildTrendChart);
                wireToggle('prodToggle', buildBarChart);

                /* ─────────────────────────────────────────────
                   7.  INITIAL RENDER
                   ───────────────────────────────────────────── */
                buildTrendChart('week');
                buildBarChart('week');

            });
        </script>
    @endpush
