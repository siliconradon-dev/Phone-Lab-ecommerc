@extends('phone_lab.layouts.app')

@section('content')
    {{-- ============ TOP: PROFILE STRIP + QUICK NAV (full width) ============ --}}
    <div class="acc-hero-wrap">
        <div class="acc-hero">
            <div class="acc-hero-left">
                <div class="acc-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div>
                    <h2 class="acc-hello">Hi, {{ $user->name }}</h2>
                    <p class="acc-sub">{{ $user->email }}</p>
                </div>
            </div>

            <nav class="acc-quicknav" role="tablist">
                <button class="acc-qn-btn active" data-bs-toggle="tab" data-bs-target="#sec-orders" type="button">
                    <i class="icofont-box"></i><span>Orders</span>
                </button>
                <button class="acc-qn-btn" data-bs-toggle="tab" data-bs-target="#sec-addresses" type="button">
                    <i class="icofont-location-pin"></i><span>Addresses</span>
                </button>
                <button class="acc-qn-btn" data-bs-toggle="tab" data-bs-target="#sec-profile" type="button">
                    <i class="icofont-ui-user"></i><span>Profile</span>
                </button>
                <button class="acc-qn-btn" data-bs-toggle="tab" data-bs-target="#sec-security" type="button">
                    <i class="icofont-lock"></i><span>Security</span>
                </button>
                <form action="{{ route('user.logout') }}" method="POST" class="acc-qn-logout-form">
                    @csrf
                    <button type="submit" class="acc-qn-btn acc-qn-logout">
                        <i class="icofont-logout"></i><span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <section class="account_section section_space">
        <div class="container">

            {{-- ============ TAB CONTENT ============ --}}
            <div class="tab-content acc-content">

                {{-- ───────────────────── ORDERS ───────────────────── --}}
                <div class="tab-pane fade show active" id="sec-orders" role="tabpanel">

                    <div class="acc-card">
                        <div class="acc-card-head">
                            <h3>Active Orders</h3>
                        </div>

                        @php
                            $activeStatuses = ['pending', 'processing', 'shipped'];
                            $historyStatuses = ['completed', 'cancelled', 'failed'];
                            $activeOrders = $orders->whereIn('order_status', $activeStatuses);
                            $historyOrders = $orders->whereIn('order_status', $historyStatuses);
                        @endphp

                        @forelse($activeOrders as $index => $order)
                            @php
                                $isOpen = $index === 0;
                                $processes = $order->orderProcesses->sortBy('stage.sort_order');
                                $p1 = $processes->where('order_stage_id', 1)->first();
                                $p2 = $processes->where('order_stage_id', 2)->first();
                                $p3 = $processes->where('order_stage_id', 3)->first();

                                $status1 = $p1 ? $p1->status : 'pending';
                                $status2 = $p2 ? $p2->status : 'pending';
                                $status3 = $p3 ? $p3->status : 'pending';

                                // Steps mapping
                                $cls1 = 'done';
                                $cls2 = ($status1 === 'completed') ? 'done' : (($status1 === 'processing') ? 'active' : 'pending');
                                $cls3 = ($status2 === 'completed') ? 'done' : (($status2 === 'processing') ? 'active' : 'pending');
                                $cls4 = ($status3 === 'completed' || $order->order_status === 'completed') ? 'done' : (($status3 === 'processing') ? 'active' : 'pending');
                            @endphp

                            <div class="ord-card-wrapper">
                                <!-- Card Header -->
                                <div class="ord-card-header {{ $isOpen ? '' : 'collapsed' }}" 
                                     data-bs-toggle="collapse" 
                                     data-bs-target="#ord-details-{{ $order->id }}" 
                                     aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                                     style="cursor: pointer;">
                                    <div class="ord-header-main">
                                        <span class="ord-chevron"><i class="icofont-rounded-down"></i></span>
                                        <div class="ord-header-left">
                                            <span class="ord-code">{{ $order->order_code }}</span>
                                            <span class="ord-date">{{ $order->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="ord-header-right">
                                        <span class="ord-amt">Rs. {{ number_format($order->total, 2) }}</span>
                                        <span class="ord-pill pill-{{ $order->order_status }}">{{ ucfirst($order->order_status) }}</span>
                                    </div>
                                </div>

                                <!-- Collapsible Body -->
                                <div class="collapse {{ $isOpen ? 'show' : '' }}" id="ord-details-{{ $order->id }}">
                                    <div class="ord-card-body">
                                        
                                        <!-- Graphical Timeline -->
                                        <div class="ord-tracking-section">
                                            <h5 class="ord-section-title"><i class="icofont-delivery-time"></i> Delivery Status</h5>
                                            <div class="ord-steps">
                                                <div class="o-step {{ $cls1 }}">
                                                    <div class="o-ico"><i class="icofont-box"></i></div>
                                                    <span class="o-lbl">Order Placed</span>
                                                    <span class="o-sub">{{ $order->created_at->format('d M Y') }}</span>
                                                </div>
                                                <div class="o-step {{ $cls2 }}">
                                                    <div class="o-ico"><i class="icofont-package"></i></div>
                                                    <span class="o-lbl">Ready to Deliver</span>
                                                    @if($p1 && $p1->tracking_number)
                                                        <span class="o-sub">Ref: <code>{{ $p1->tracking_number }}</code></span>
                                                    @endif
                                                </div>
                                                <div class="o-step {{ $cls3 }}">
                                                    <div class="o-ico"><i class="icofont-truck-loaded"></i></div>
                                                    <span class="o-lbl">In Transit</span>
                                                    @if($p2 && $p2->tracking_number)
                                                        <span class="o-sub">Ref: <code>{{ $p2->tracking_number }}</code></span>
                                                    @endif
                                                </div>
                                                <div class="o-step {{ $cls4 }}">
                                                    <div class="o-ico"><i class="icofont-check-circled"></i></div>
                                                    <span class="o-lbl">Delivered</span>
                                                    @if($p3 && $p3->tracking_number)
                                                        <span class="o-sub">Ref: <code>{{ $p3->tracking_number }}</code></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Items List -->
                                        <div class="ord-items-section">
                                            <h5 class="ord-section-title"><i class="icofont-box"></i> Items in this order</h5>
                                            <div class="ord-items-list">
                                                @foreach($order->items as $item)
                                                    <div class="ord-item-row">
                                                        <div class="ord-item-img-wrap">
                                                            <img src="{{ asset($item->product->featured_image) }}" alt="{{ $item->product->name }}">
                                                        </div>
                                                        <div class="ord-item-details">
                                                            <span class="ord-item-name">{{ $item->product->name }}</span>
                                                            @if($item->variant)
                                                                <span class="ord-item-variant">{{ $item->variant->color }} | {{ $item->variant->storage }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="ord-item-qty">Qty: {{ $item->quantity }}</div>
                                                        <div class="ord-item-price">Rs. {{ number_format($item->unit_price, 2) }}</div>
                                                        <div class="ord-item-total">Rs. {{ number_format($item->price, 2) }}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Summary grid -->
                                        <div class="ord-summary-grid">
                                            <div class="ord-summary-col">
                                                <h6><i class="icofont-location-pin"></i> Delivery Address</h6>
                                                <div class="ord-summary-text">
                                                    <strong>{{ $order->full_name }}</strong><br>
                                                    {{ $order->address }}<br>
                                                    {{ $order->city }}, {{ $order->district }} {{ $order->postcode }}<br>
                                                    Phone: {{ $order->phone }}
                                                </div>
                                            </div>
                                            <div class="ord-summary-col">
                                                <h6><i class="icofont-credit-card"></i> Payment & Totals</h6>
                                                <div class="ord-summary-text">
                                                    Payment Method: <span class="ord-badge-method">{{ strtoupper($order->payment_method) }}</span><br>
                                                    Payment Status: <span class="ord-badge-status status-{{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span><br>
                                                    Subtotal: Rs. {{ number_format($order->total, 2) }}<br>
                                                    <strong>Grand Total: Rs. {{ number_format($order->total, 2) }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="acc-empty">
                                <div class="acc-empty-ico">📭</div>
                                <p>No active orders right now.</p>
                                <span>Anything you order will show up here with live tracking.</span>
                            </div>
                        @endforelse

                        @if($historyOrders->count())
                            <div class="acc-card-head" style="margin-top: 30px; border-top: 1px solid var(--acc-border); padding-top: 20px;">
                                <h3>Order History</h3>
                            </div>
                            @foreach($historyOrders as $order)
                                @php
                                    $isOpen = false;
                                    $processes = $order->orderProcesses->sortBy('stage.sort_order');
                                    $p1 = $processes->where('order_stage_id', 1)->first();
                                    $p2 = $processes->where('order_stage_id', 2)->first();
                                    $p3 = $processes->where('order_stage_id', 3)->first();

                                    $status1 = $p1 ? $p1->status : 'pending';
                                    $status2 = $p2 ? $p2->status : 'pending';
                                    $status3 = $p3 ? $p3->status : 'pending';

                                    // Steps mapping
                                    $cls1 = 'done';
                                    $cls2 = ($status1 === 'completed') ? 'done' : (($status1 === 'processing') ? 'active' : 'pending');
                                    $cls3 = ($status2 === 'completed') ? 'done' : (($status2 === 'processing') ? 'active' : 'pending');
                                    $cls4 = ($status3 === 'completed' || $order->order_status === 'completed') ? 'done' : (($status3 === 'processing') ? 'active' : 'pending');
                                @endphp

                                <div class="ord-card-wrapper">
                                    <!-- Card Header -->
                                    <div class="ord-card-header collapsed" 
                                         data-bs-toggle="collapse" 
                                         data-bs-target="#ord-details-{{ $order->id }}" 
                                         aria-expanded="false"
                                         style="cursor: pointer;">
                                        <div class="ord-header-main">
                                            <span class="ord-chevron"><i class="icofont-rounded-down"></i></span>
                                            <div class="ord-header-left">
                                                <span class="ord-code">{{ $order->order_code }}</span>
                                                <span class="ord-date">{{ $order->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="ord-header-right">
                                            <span class="ord-amt">Rs. {{ number_format($order->total, 2) }}</span>
                                            <span class="ord-pill pill-{{ $order->order_status }}">{{ ucfirst($order->order_status) }}</span>
                                        </div>
                                    </div>

                                    <!-- Collapsible Body -->
                                    <div class="collapse" id="ord-details-{{ $order->id }}">
                                        <div class="ord-card-body">
                                            
                                            <!-- Graphical Timeline -->
                                            <div class="ord-tracking-section">
                                                <h5 class="ord-section-title"><i class="icofont-delivery-time"></i> Delivery Status</h5>
                                                <div class="ord-steps">
                                                    <div class="o-step {{ $cls1 }}">
                                                        <div class="o-ico"><i class="icofont-box"></i></div>
                                                        <span class="o-lbl">Order Placed</span>
                                                        <span class="o-sub">{{ $order->created_at->format('d M Y') }}</span>
                                                    </div>
                                                    <div class="o-step {{ $cls2 }}">
                                                        <div class="o-ico"><i class="icofont-package"></i></div>
                                                        <span class="o-lbl">Ready to Deliver</span>
                                                        @if($p1 && $p1->tracking_number)
                                                            <span class="o-sub">Ref: <code>{{ $p1->tracking_number }}</code></span>
                                                        @endif
                                                    </div>
                                                    <div class="o-step {{ $cls3 }}">
                                                        <div class="o-ico"><i class="icofont-truck-loaded"></i></div>
                                                        <span class="o-lbl">In Transit</span>
                                                        @if($p2 && $p2->tracking_number)
                                                            <span class="o-sub">Ref: <code>{{ $p2->tracking_number }}</code></span>
                                                        @endif
                                                    </div>
                                                    <div class="o-step {{ $cls4 }}">
                                                        <div class="o-ico"><i class="icofont-check-circled"></i></div>
                                                        <span class="o-lbl">Delivered</span>
                                                        @if($p3 && $p3->tracking_number)
                                                            <span class="o-sub">Ref: <code>{{ $p3->tracking_number }}</code></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Items List -->
                                            <div class="ord-items-section">
                                                <h5 class="ord-section-title"><i class="icofont-box"></i> Items in this order</h5>
                                                <div class="ord-items-list">
                                                    @foreach($order->items as $item)
                                                        <div class="ord-item-row">
                                                            <div class="ord-item-img-wrap">
                                                                <img src="{{ asset($item->product->featured_image) }}" alt="{{ $item->product->name }}">
                                                            </div>
                                                            <div class="ord-item-details">
                                                                <span class="ord-item-name">{{ $item->product->name }}</span>
                                                                @if($item->variant)
                                                                    <span class="ord-item-variant">{{ $item->variant->color }} | {{ $item->variant->storage }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="ord-item-qty">Qty: {{ $item->quantity }}</div>
                                                            <div class="ord-item-price">Rs. {{ number_format($item->unit_price, 2) }}</div>
                                                            <div class="ord-item-total">Rs. {{ number_format($item->price, 2) }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Summary grid -->
                                            <div class="ord-summary-grid">
                                                <div class="ord-summary-col">
                                                    <h6><i class="icofont-location-pin"></i> Delivery Address</h6>
                                                    <div class="ord-summary-text">
                                                        <strong>{{ $order->full_name }}</strong><br>
                                                        {{ $order->address }}<br>
                                                        {{ $order->city }}, {{ $order->district }} {{ $order->postcode }}<br>
                                                        Phone: {{ $order->phone }}
                                                    </div>
                                                </div>
                                                <div class="ord-summary-col">
                                                    <h6><i class="icofont-credit-card"></i> Payment & Totals</h6>
                                                    <div class="ord-summary-text">
                                                        Payment Method: <span class="ord-badge-method">{{ strtoupper($order->payment_method) }}</span><br>
                                                        Payment Status: <span class="ord-badge-status status-{{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span><br>
                                                        Subtotal: Rs. {{ number_format($order->total, 2) }}<br>
                                                        <strong>Grand Total: Rs. {{ number_format($order->total, 2) }}</strong>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- ───────────────────── ADDRESSES ───────────────────── --}}
                <div class="tab-pane fade" id="sec-addresses" role="tabpanel">
                    <div class="acc-card">
                        <div class="acc-card-head">
                            <h3>Address book</h3>
                            <button type="button" class="btn-pill-primary" data-bs-toggle="modal"
                                data-bs-target="#addAddressModal">
                                <i class="icofont-plus"></i> Add new address
                            </button>
                        </div>

                        <div class="addr-grid">
                            @forelse($addresses as $address)
                                <div class="addr-card">
                                    <div class="addr-card-top">
                                        <span class="addr-title-pill"><i class="icofont-location-pin"></i> {{ $address->title }}</span>
                                        <a href="{{ route('address.delete', $address->id) }}"
                                            onclick="return confirm('Delete this address?')" class="addr-del"
                                            title="Delete address">
                                            <i class="icofont-trash"></i>
                                        </a>
                                    </div>
                                    <div class="addr-name">{{ $address->full_name }}</div>
                                    <div class="addr-line">{{ $address->address }}, {{ $address->city }}</div>
                                    <div class="addr-phone"><i class="icofont-phone"></i> {{ $address->phone }}</div>
                                </div>
                            @empty
                                <div class="acc-empty">
                                    <div class="acc-empty-ico">📍</div>
                                    <p>No addresses saved yet.</p>
                                    <span>Add one so checkout is faster next time.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- ───────────────────── PROFILE ───────────────────── --}}
                <div class="tab-pane fade" id="sec-profile" role="tabpanel">
                    <div class="acc-card acc-card-narrow">
                        <div class="acc-card-head">
                            <h3>Profile</h3>
                            <button type="button" class="acc-edit-btn" id="profileEditBtn" title="Edit profile">
                                <i class="icofont-edit"></i> Edit
                            </button>
                        </div>

                        @if (session('Edit_success'))
                            <div class="acc-alert acc-alert-success">
                                <i class="icofont-check-circled"></i> {{ session('Edit_success') }}
                            </div>
                        @endif

                        {{-- VIEW MODE --}}
                        <div class="acc-view" id="profileView">
                            <div class="acc-view-row">
                                <span class="acc-view-label">Full name</span>
                                <span class="acc-view-value">{{ $user->name }}</span>
                            </div>
                            <div class="acc-view-row">
                                <span class="acc-view-label">Email address</span>
                                <span class="acc-view-value">{{ $user->email }}</span>
                            </div>
                        </div>

                        {{-- EDIT MODE (hidden until "Edit" is clicked) --}}
                        <form action="{{ route('account.update') }}" method="POST" class="acc-form d-none"
                            id="profileForm">
                            @csrf
                            <label class="acc-field">
                                <span>Full name</span>
                                <input type="text" name="name" value="{{ $user->name }}" required>
                            </label>
                            <label class="acc-field">
                                <span>Email address</span>
                                <input type="email" name="email" value="{{ $user->email }}" required>
                            </label>
                            <div class="acc-form-actions">
                                <button type="button" class="btn-pill-ghost" id="profileCancelBtn">Cancel</button>
                                <button type="submit" class="btn-pill-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ───────────────────── SECURITY / PASSWORD ───────────────────── --}}
                <div class="tab-pane fade" id="sec-security" role="tabpanel">
                    <div class="acc-card acc-card-narrow">
                        <div class="acc-card-head">
                            <h3>Change password</h3>
                        </div>

                        @if (session('password_success'))
                            <div class="acc-alert acc-alert-success">
                                <i class="icofont-check-circled"></i> {{ session('password_success') }}
                            </div>
                        @endif
                        @if (session('password_error'))
                            <div class="acc-alert acc-alert-danger">
                                <i class="icofont-close-circled"></i> {{ session('password_error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="acc-alert acc-alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('account.password.update') }}" method="POST" class="acc-form">
                            @csrf
                            <label class="acc-field">
                                <span>Current password</span>
                                <input type="password" name="current_password" required>
                            </label>
                            <label class="acc-field">
                                <span>New password</span>
                                <input type="password" name="new_password" required>
                            </label>
                            <label class="acc-field">
                                <span>Confirm new password</span>
                                <input type="password" name="new_password_confirmation" required>
                            </label>
                            <button type="submit" class="btn-pill-primary btn-block">Update password</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============ ADD ADDRESS MODAL ============ --}}
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('addresses.store') }}" method="POST" class="modal-content acc-modal">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="acc-field">
                        <span>Label</span>
                        <input type="text" name="title" placeholder="e.g. Home, Work" required>
                    </label>
                    <label class="acc-field">
                        <span>Full name</span>
                        <input type="text" name="full_name" placeholder="Full name" required>
                    </label>
                    <label class="acc-field">
                        <span>Phone number</span>
                        <input type="tel" name="phone" placeholder="07XXXXXXXX" maxlength="12"
                            pattern="[0-9]{10,12}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </label>

                    <div class="acc-field-row">
                        <div class="acc-field" id="districtDropdown">
                            <span>District</span>
                            <div class="custom-dropdown">
                                <div class="dropdown-selected">Select district</div>
                                <div class="dropdown-list"></div>
                            </div>
                        </div>
                        <label class="acc-field">
                            <span>City</span>
                            <input type="text" name="city" placeholder="City" required>
                        </label>
                    </div>

                    <label class="acc-field">
                        <span>Detailed address</span>
                        <textarea name="address" placeholder="House no., street, landmark" required></textarea>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-pill-ghost" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-pill-primary">Save address</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        :root {
            --acc-primary: #EB1314;
            --acc-primary-dark: #c20f10;
            --acc-primary-light: #fdebeb;
            --acc-text: #1c2733;
            --acc-muted: #7c8a96;
            --acc-border: #eef1f3;
            --acc-bg: #ffffff;
            --acc-surface: #f7f8f9;
            --acc-danger: #dc3545;
            --acc-radius: 16px;
        }

        .account_section { background: var(--acc-bg); }

        /* ---------- HERO / QUICK NAV ---------- */
        .acc-hero-wrap {
            background: #EB1314;
            width: 100%;
        }
        .acc-hero {
            max-width: 1320px;
            margin: 0 auto;
            padding: 28px 24px 22px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .acc-hero-left { display: flex; align-items: center; gap: 16px; }
        .acc-avatar {
            width: 56px; height: 56px; border-radius: 50%;
            background: rgba(255,255,255,0.22);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 700; flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.35);
        }
        .acc-hello { margin: 0; font-size: 20px; font-weight: 700; }
        .acc-sub { margin: 2px 0 0; font-size: 13px; opacity: 0.85; }

        .acc-quicknav {
            display: flex; gap: 8px; flex-wrap: wrap;
            background: rgba(255,255,255,0.14);
            padding: 6px; border-radius: 14px;
        }
        .acc-qn-btn {
            display: flex; align-items: center; gap: 7px;
            background: transparent; border: none; color: #fff;
            font-size: 13.5px; font-weight: 600; padding: 9px 16px;
            border-radius: 10px; cursor: pointer; transition: 0.2s; opacity: 0.85;
            white-space: nowrap;
        }
        .acc-qn-btn:hover { background: rgba(255,255,255,0.15); opacity: 1; }
        .acc-qn-btn.active { background: #fff; color: var(--acc-primary-dark); opacity: 1; }
        .acc-qn-logout-form { margin-left: auto; }
        .acc-qn-logout { color: #ffe1e1; }
        .acc-qn-logout:hover { background: rgba(220,53,69,0.25); color: #fff; }

        /* ---------- CARDS ---------- */
        .acc-card {
            background: #fff; border-radius: var(--acc-radius);
            padding: 24px 26px; box-shadow: 0 2px 10px rgba(20,30,40,0.06);
            border: 1px solid var(--acc-border);
        }
        .acc-card-narrow { max-width: 520px; }
        .acc-card-head {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 18px; gap: 12px; flex-wrap: wrap;
        }
        .acc-card-head h3 { margin: 0; font-size: 17px; font-weight: 700; color: var(--acc-text); }

        .btn-pill-primary {
            background: var(--acc-primary); color: #fff; border: none;
            font-size: 13px; font-weight: 600; padding: 10px 18px;
            border-radius: 99px; cursor: pointer; transition: 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-pill-primary:hover { background: var(--acc-primary-dark); }
        .btn-pill-ghost {
            background: #fff; color: var(--acc-muted); border: 1.5px solid var(--acc-border);
            font-size: 13px; font-weight: 600; padding: 10px 18px; border-radius: 99px; cursor: pointer;
        }
        .btn-pill-ghost:hover { background: var(--acc-surface); }
        .btn-block { width: 100%; justify-content: center; margin-top: 4px; }

        .acc-edit-btn {
            background: var(--acc-primary-light); color: var(--acc-primary-dark); border: none;
            font-size: 12.5px; font-weight: 700; padding: 8px 14px; border-radius: 99px; cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px; transition: 0.2s;
        }
        .acc-edit-btn:hover { background: var(--acc-primary); color: #fff; }

        .acc-view { display: flex; flex-direction: column; }
        .acc-view-row {
            display: flex; flex-direction: column; gap: 3px; padding: 14px 0;
            border-bottom: 1px solid var(--acc-border);
        }
        .acc-view-row:last-child { border-bottom: none; }
        .acc-view-label { font-size: 12px; font-weight: 600; color: var(--acc-muted); }
        .acc-view-value { font-size: 15px; font-weight: 600; color: var(--acc-text); }

        .acc-form-actions { display: flex; gap: 10px; margin-top: 4px; }
        .acc-form-actions .btn-pill-primary, .acc-form-actions .btn-pill-ghost { flex: 1; justify-content: center; }

        /* ---------- EMPTY STATE ---------- */
        .acc-empty {
            text-align: center; padding: 42px 16px; color: var(--acc-muted);
        }
        .acc-empty-ico { font-size: 30px; margin-bottom: 8px; }
        .acc-empty p { margin: 0 0 4px; font-weight: 600; color: var(--acc-text); }
        .acc-empty span { font-size: 13px; }

        /* ---------- REDESIGNED ORDERS ---------- */
        .ord-card-wrapper {
            background: #fff;
            border: 1px solid var(--acc-border);
            border-radius: 14px;
            margin-bottom: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .ord-card-wrapper:hover {
            border-color: #ffd2d2;
            box-shadow: 0 6px 18px rgba(235, 19, 20, 0.04);
        }
        .ord-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            background: #fff;
            cursor: pointer;
            border-bottom: 1px solid var(--acc-border);
            transition: background-color 0.15s ease;
            user-select: none;
        }
        .ord-card-header.collapsed {
            border-bottom: none;
        }
        .ord-card-header:hover {
            background-color: #fffafb;
        }
        .ord-header-main {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .ord-chevron {
            font-size: 16px;
            color: var(--acc-muted);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ord-card-header:not(.collapsed) .ord-chevron {
            transform: rotate(180deg);
            color: var(--acc-primary);
        }
        .ord-header-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .ord-code {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--acc-text);
        }
        .ord-date {
            font-size: 12px;
            color: var(--acc-muted);
        }
        .ord-header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .ord-amt {
            font-size: 16px;
            font-weight: 700;
            color: var(--acc-text);
        }
        .ord-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 99px;
            text-transform: capitalize;
        }
        .ord-pill.pill-pending    { background: #fff8e6; color: #b7791f; border: 1px solid #ffe8cc; }
        .ord-pill.pill-processing { background: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8; }
        .ord-pill.pill-shipped    { background: #faf5ff; color: #6b46c1; border: 1px solid #e9d8fd; }
        .ord-pill.pill-completed  { background: #f0fff4; color: #276749; border: 1px solid #c6f6d5; }
        .ord-pill.pill-cancelled  { background: #fff5f5; color: #c53030; border: 1px solid #fed7d7; }
        .ord-pill.pill-failed     { background: #fff5f5; color: #c53030; border: 1px solid #fed7d7; }

        .ord-card-body {
            padding: 24px;
            border-top: 1px solid var(--acc-border);
            background: #fafbfc;
        }
        .ord-section-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--acc-text);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .ord-section-title i {
            font-size: 16px;
            color: var(--acc-primary);
        }

        /* --- Graphical Timeline --- */
        .ord-tracking-section {
            background: #fff;
            border: 1px solid var(--acc-border);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
        }
        .ord-steps {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            margin-top: 10px;
        }
        .o-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .o-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% + 20px);
            right: calc(-50% + 20px);
            height: 3px;
            background: #edf2f7;
            z-index: -1;
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .o-step.done:not(:last-child)::after {
            background: #10b981;
        }
        .o-step.active:not(:last-child)::after {
            background: linear-gradient(90deg, #10b981 30%, #edf2f7 100%);
        }
        .o-ico {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            border: 2px solid #edf2f7;
            background: #fff;
            color: #a0aec0;
            z-index: 2;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .o-step.done .o-ico {
            background: #10b981;
            border-color: #10b981;
            color: #fff;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }
        .o-step.active .o-ico {
            background: var(--acc-primary);
            border-color: var(--acc-primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(235, 19, 20, 0.15);
            animation: pulse-border 2s infinite;
        }
        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(235, 19, 20, 0.4); }
            70% { box-shadow: 0 0 0 8px rgba(235, 19, 20, 0); }
            100% { box-shadow: 0 0 0 0 rgba(235, 19, 20, 0); }
        }
        .o-lbl {
            font-size: 12.5px;
            font-weight: 600;
            color: #718096;
            margin-top: 10px;
            transition: color 0.3s ease;
        }
        .o-step.done .o-lbl {
            color: #2d3748;
            font-weight: 700;
        }
        .o-step.active .o-lbl {
            color: var(--acc-primary-dark);
            font-weight: 700;
        }
        .o-sub {
            font-size: 11px;
            color: var(--acc-muted);
            margin-top: 4px;
            display: block;
        }
        .o-sub code {
            font-size: 10.5px;
            background: #f7fafc;
            padding: 1px 4px;
            border-radius: 4px;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }

        /* --- Ordered Items --- */
        .ord-items-section {
            background: #fff;
            border: 1px solid var(--acc-border);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
        }
        .ord-items-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .ord-item-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #f7fafc;
        }
        .ord-item-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .ord-item-row:first-child {
            padding-top: 0;
        }
        .ord-item-img-wrap {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            border: 1px solid #edf2f7;
            background: #fff;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ord-item-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 2px;
        }
        .ord-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .ord-item-name {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--acc-text);
        }
        .ord-item-variant {
            font-size: 11.5px;
            color: var(--acc-muted);
        }
        .ord-item-qty, .ord-item-price, .ord-item-total {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--acc-text);
            text-align: right;
        }
        .ord-item-qty {
            min-width: 80px;
            color: var(--acc-muted);
        }
        .ord-item-price {
            min-width: 100px;
        }
        .ord-item-total {
            min-width: 120px;
            color: var(--acc-text);
            font-weight: 700;
        }

        /* --- Summary Grid --- */
        .ord-summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .ord-summary-col {
            background: #fff;
            border: 1px solid var(--acc-border);
            border-radius: 12px;
            padding: 18px 20px;
        }
        .ord-summary-col h6 {
            font-size: 13px;
            font-weight: 700;
            color: var(--acc-text);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .ord-summary-col h6 i {
            color: var(--acc-primary);
            font-size: 15px;
        }
        .ord-summary-text {
            font-size: 13px;
            line-height: 1.6;
            color: #4a5568;
        }
        .ord-badge-method {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 10.5px;
            color: #4a5568;
        }
        .ord-badge-status {
            display: inline-flex;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
        }
        .ord-badge-status.status-paid {
            background: #e6fffa;
            color: #234e52;
            border: 1px solid #b2f5ea;
        }
        .ord-badge-status.status-unpaid {
            background: #fff5f5;
            color: #9b2c2c;
            border: 1px solid #fed7d7;
        }

        /* ---------- ADDRESSES ---------- */
        .addr-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .addr-card {
            border: 1px solid var(--acc-border); border-radius: 14px; padding: 18px;
            background: #fafbfc; position: relative; transition: 0.2s;
        }
        .addr-card:hover { border-color: var(--acc-primary); box-shadow: 0 4px 14px rgba(235,19,20,0.08); }
        .addr-card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .addr-title-pill {
            display: inline-flex; align-items: center; gap: 6px; background: var(--acc-primary-light);
            color: var(--acc-primary-dark); font-size: 12px; font-weight: 700; padding: 4px 11px; border-radius: 99px;
        }
        .addr-del { color: var(--acc-muted); transition: 0.2s; padding: 4px; }
        .addr-del:hover { color: var(--acc-danger); }
        .addr-name { font-weight: 700; font-size: 14.5px; color: var(--acc-text); margin-bottom: 4px; }
        .addr-line { font-size: 13px; color: var(--acc-muted); line-height: 1.5; margin-bottom: 8px; }
        .addr-phone { font-size: 13px; color: var(--acc-text); display: flex; align-items: center; gap: 6px; }

        /* ---------- FORMS ---------- */
        .acc-form { display: flex; flex-direction: column; gap: 14px; margin-top: 4px; }
        .acc-field { display: flex; flex-direction: column; gap: 6px; flex: 1; }
        .acc-field > span { font-size: 12.5px; font-weight: 600; color: var(--acc-muted); }
        .acc-field input, .acc-field textarea {
            border: 1.5px solid var(--acc-border); border-radius: 10px; padding: 11px 14px;
            font-size: 14px; color: var(--acc-text); background: #fff; transition: 0.2s; width: 100%;
        }
        .acc-field input:focus, .acc-field textarea:focus {
            outline: none; border-color: var(--acc-primary); box-shadow: 0 0 0 3px var(--acc-primary-light);
        }
        .acc-field textarea { resize: vertical; min-height: 80px; }
        .acc-field-row { display: flex; gap: 14px; }
        .acc-field-row .acc-field { flex: 1; }

        .acc-alert {
            border-radius: 10px; padding: 11px 16px; font-size: 13.5px; font-weight: 600;
            display: flex; align-items: center; gap: 8px; margin-bottom: 16px;
        }
        .acc-alert-success { background: #D1E7DD; color: #0a3622; }
        .acc-alert-danger { background: #F8D7DA; color: #842029; }

        .acc-modal { border-radius: var(--acc-radius); overflow: hidden; }
        .acc-modal .modal-header, .acc-modal .modal-footer { border-color: var(--acc-border); }
        .acc-modal .modal-body { display: flex; flex-direction: column; gap: 14px; padding: 20px 24px; }

        /* ---------- CUSTOM DISTRICT DROPDOWN ---------- */
        .custom-dropdown { position: relative; cursor: pointer; }
        .dropdown-selected {
            border: 1.5px solid var(--acc-border); border-radius: 10px; padding: 11px 14px;
            font-size: 14px; color: var(--acc-text); background: #fff;
        }
        .dropdown-list {
            position: absolute; top: calc(100% + 4px); left: 0; right: 0; background: #fff;
            border: 1px solid var(--acc-border); border-radius: 10px; max-height: 200px;
            overflow-y: auto; display: none; z-index: 999; box-shadow: 0 8px 20px rgba(20,30,40,0.1);
        }
        .dropdown-list div { padding: 10px 14px; cursor: pointer; font-size: 13.5px; }
        .dropdown-list div:hover { background: var(--acc-primary-light); color: var(--acc-primary-dark); }

        /* ---------- RESPONSIVE ---------- */
        @media (max-width: 768px) {
            .acc-hero { padding: 22px 16px; }
            .acc-quicknav { overflow-x: auto; flex-wrap: nowrap; }
            .acc-qn-logout-form { margin-left: 0; }
            .acc-card { padding: 18px; }
            .addr-grid { grid-template-columns: 1fr; }
            .acc-field-row { flex-direction: column; gap: 14px; }
            .ord-steps { overflow-x: auto; }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {

            let districts = [
                "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", "Gampaha",
                "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalle", "Kilinochchi", "Kurunegala",
                "Mannar", "Matale", "Matara", "Monaragala", "Mullaitivu", "Nuwara Eliya", "Polonnaruwa",
                "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
            ].sort();

            let $list = $("#districtDropdown .dropdown-list");

            districts.forEach(d => {
                $list.append(`<div class="district-item" data-value="${d}">${d}</div>`);
            });

            $(document).on("click", "#districtDropdown .dropdown-selected", function () {
                $list.toggle();
            });

            $(document).on("click", ".district-item", function () {
                let value = $(this).data("value");
                $("#districtDropdown .dropdown-selected").text(value);
                $list.hide();

                if (!$("#districtInput").length) {
                    $("#districtDropdown").append(`<input type="hidden" name="district" id="districtInput">`);
                }
                $("#districtInput").val(value);
            });

            $(document).on("click", function (e) {
                if (!$(e.target).closest("#districtDropdown").length) {
                    $list.hide();
                }
            });
        });

        // restore + persist active section across reloads
        $(document).ready(function () {
            const activeTab = localStorage.getItem('activeAccTab');
            if (activeTab) {
                const trigger = document.querySelector(`.acc-qn-btn[data-bs-target="${activeTab}"]`);
                if (trigger) new bootstrap.Tab(trigger).show();
            }

            $('.acc-qn-btn[data-bs-toggle="tab"]').on('click', function () {
                $('.acc-qn-btn').removeClass('active');
                $(this).addClass('active');
                localStorage.setItem('activeAccTab', $(this).attr('data-bs-target'));
            });
        });
        // profile: view <-> edit toggle
        $(document).ready(function () {
            const $view = $('#profileView');
            const $form = $('#profileForm');
            const $editBtn = $('#profileEditBtn');
            const $cancelBtn = $('#profileCancelBtn');

            $editBtn.on('click', function () {
                $view.addClass('d-none');
                $form.removeClass('d-none');
                $editBtn.addClass('d-none');
            });

            $cancelBtn.on('click', function () {
                $form.addClass('d-none');
                $view.removeClass('d-none');
                $editBtn.removeClass('d-none');
            });
        });
    </script>
@endpush