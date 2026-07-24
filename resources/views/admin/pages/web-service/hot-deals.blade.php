@extends('admin.layouts.app')

@push('title')
    <title>Manage Hot Deals</title>
@endpush

@section('index_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<div class="main-content-wrap">

    <!-- Page header -->
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <div>
            <h3 class="d-flex align-items-center gap-2 mb-1" style="font-size:19px;font-weight:700">
                <i class="fas fa-fire" style="color:#093cb4"></i> Manage Hot Deals
            </h3>
            <p class="text-tiny text-muted mb-0" style="color:#7b8299">Turn products into time-limited hot deals and track when they expire.</p>
        </div>

    </div>

    @if (session('status'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: @json(session('status')),
                    confirmButtonColor: '#2275fc',
                    timer: 2500,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" action="{{ route('admin.web-service.hot-deals') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" name="search" placeholder="Search products by name or SKU..." value="{{ request('search') }}" aria-required="true">
                    </fieldset>
                    <div class="button-submit">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="wg-table table-all-user table-hot-deals">
            <ul class="table-title flex gap20 mb-14">
                <li class="col-image"><div class="body-title">Image</div></li>
                <li class="col-name"><div class="body-title">Product Name</div></li>
                <li class="col-sku"><div class="body-title">SKU</div></li>
                <li class="col-category"><div class="body-title">Category</div></li>
                <li class="col-status text-end"><div class="body-title">Hot Deal Status</div></li>
            </ul>

            <ul class="flex flex-column">
                @forelse ($products as $product)
                    <li class="user-item gap20 {{ $product->is_hot_deal ? 'hd-row-active' : '' }}">
                        <div class="image col-image">
                            <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-name name">
                            <a href="#" class="body-title-2">{{ $product->name }}</a>
                            @if($product->is_hot_deal)
                                <div class="flex items-center gap10 mt-3 flex-wrap">
                                    <span class="badge-status featured" style="background:#ff3838; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; color: #fff; border-radius: 20px;">
                                        <i class="fas fa-fire"></i> Hot Deal
                                    </span>
                                    @if($product->hot_deal_end_date)
                                        <span class="hd-countdown text-tiny" data-ends-at="{{ \Carbon\Carbon::parse($product->hot_deal_end_date)->toIso8601String() }}" style="margin: 0; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fas fa-clock"></i> <span class="hd-countdown-text text-muted">calculating…</span>
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="col-sku body-text">{{ $product->sku ?? '#' . $product->id }}</div>

                        <div class="col-category body-text">{{ $product->category->name }}</div>

                        <div class="col-status flex items-center justify-end">
                            <label class="switch" title="{{ $product->is_hot_deal ? 'Deactivate hot deal' : 'Activate hot deal' }}">
                                <input type="checkbox" class="hot-deal-switch"
                                       data-id="{{ $product->id }}"
                                       data-name="{{ $product->name }}"
                                       data-price="{{ $product->base_price }}"
                                       data-discount-price="{{ $product->hot_deal_discount_price ?? $product->discount_price }}"
                                       data-ends-at="{{ $product->hot_deal_end_date ? \Carbon\Carbon::parse($product->hot_deal_end_date)->format('Y-m-d\TH:i') : '' }}"
                                       {{ $product->is_hot_deal ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </li>
                @empty
                    <li class="user-item gap20 justify-center">
                        <div class="body-text w-full text-center">No products found.</div>
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} entries</div>
            <div class="wg-pagination">{{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>


<!-- Hot Deal Modal -->
<div class="modal fade" id="hotDealModal" tabindex="-1" aria-labelledby="hotDealModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hotDealForm" action="{{ route('admin.web-service.hot-deals.toggle') }}" method="POST">
            @csrf

            <div class="modal-content border-0 shadow-lg">

                <!-- Header -->
                <div class="modal-header hd-modal-header text-white border-0 py-3">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="hotDealModalLabel">
                        <i class="fas fa-fire"></i> Configure Hot Deal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4 bg-white">

                    <input type="hidden" name="product_id" id="modal_product_id">
                    <input type="hidden" name="is_hot_deal" value="1">

                    <!-- Product -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-box me-1"></i> Product Name
                        </label>
                        <input type="text" id="modal_product_name" class="form-control bg-light" readonly>
                    </div>

                    <!-- Prices -->
                    <div class="row g-3 mb-2">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-tag me-1"></i> Base Price (LKR)
                            </label>
                            <input type="text" id="modal_base_price" class="form-control bg-light" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-fire me-1"></i> Hot Deal Price (LKR)
                            </label>
                            <input type="number" step="0.01" name="hot_deal_discount_price" id="modal_discount_price"
                                   class="form-control" placeholder="Enter hot deal price" required>
                        </div>
                    </div>

                    <!-- Live savings feedback -->
                    <div class="mb-4">
                        <div id="hd_savings_hint" class="hd-savings-hint hd-savings-hint-muted">
                            <i class="fas fa-circle-info"></i>
                            <span id="hd_savings_text">Enter a hot deal price to see the discount.</span>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-3">
                        <label class="form-label mb-3">
                            <i class="fas fa-calendar-days me-1"></i> Select Duration
                        </label>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary duration-btn flex-fill" onclick="setDuration(this,1)">
                                <i class="fas fa-sun d-block mb-1"></i> 1 Day
                            </button>
                            <button type="button" class="btn btn-outline-secondary duration-btn flex-fill" onclick="setDuration(this,7)">
                                <i class="fas fa-calendar-week d-block mb-1"></i> 7 Days
                            </button>
                            <button type="button" class="btn btn-outline-secondary duration-btn flex-fill" onclick="setDuration(this,'custom')">
                                <i class="fas fa-sliders d-block mb-1"></i> Custom
                            </button>
                        </div>

                        <div id="customDateContainer" class="mt-3 d-none">
                            <label class="form-label">
                                <i class="fas fa-clock me-1"></i> End Date & Time
                            </label>
                            <input type="datetime-local" name="hot_deal_end_date" id="modal_ends_at" class="form-control">
                        </div>

                        <input type="hidden" name="duration_days" id="modal_duration_days">
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light border px-4" style="border-radius:7px" data-bs-dismiss="modal">
                        <i class="fas fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn px-4" style="border-radius:7px;background:#2275fc;border-color:#2275fc;color:#fff;">
                        <i class="fas fa-save me-1"></i> Save Hot Deal
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    /* Prevent table children from forcing a 1515px width and causing horizontal scroll */
    .table-hot-deals.table-all-user>* {
        min-width: auto !important;
    }

    /* Table layout and alignments matching columns */
    .table-hot-deals .table-title,
    .table-hot-deals .user-item {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .table-hot-deals .col-image {
        flex: 0 0 50px;
        width: 50px;
    }

    .table-hot-deals .col-name {
        flex: 2 1 300px;
    }

    .table-hot-deals .col-sku {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-hot-deals .col-category {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-hot-deals .col-status {
        flex: 0 0 150px;
        width: 150px;
    }

    .table-hot-deals .user-item .image {
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
        background: #f8f9fc;
        border: 1px solid #eceef2;
    }
    .table-hot-deals .user-item .image img {
        width: 100%; height: 100%; object-fit: contain;
    }

    .badge-status.featured {
        display: inline-block;
        padding: 2px 10px;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        border-radius: 20px;
    }

    /* Toggle switch, matching Remos-style status switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
        flex: 0 0 auto;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #d7dbe0;
        transition: .3s;
        border-radius: 34px;
    }
    .switch .slider:before {
        position: absolute;
        content: "";
        height: 16px; width: 16px;
        left: 3px; bottom: 3px;
        background-color: #fff;
        transition: .3s;
        border-radius: 50%;
    }
    .switch input:checked + .slider { background-color: #28a745; }
    .switch input:checked + .slider:before { transform: translateX(18px); }

    .hd-row-active { background-color: rgba(9, 86, 180, 0.04) !important; }

    .hd-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 600;
        color: #094db4;
        background: #e5f4ff;
        padding: 3px 10px;
        border-radius: 20px;
        margin-top: 3px;
        white-space: nowrap;
    }

    .hd-countdown {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #7b8299;
        margin-top: 4px;
        margin-left: 6px;
    }
    .hd-countdown.hd-countdown-urgent { color: #c0392b; font-weight: 600; }

    /* ---------- Empty state ---------- */
    .hd-empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #9aa5b1;
    }
    .hd-empty-state i {
        font-size: 32px;
        display: block;
        margin-bottom: 10px;
        opacity: .4;
    }

    /* ---------- Switch ---------- */
    .hd-switch {
        display: inline-flex;
        cursor: pointer;
        margin: 0 auto;
    }
    .hd-switch input { display: none; }
    .hd-switch-track {
        width: 44px;
        height: 24px;
        border-radius: 999px;
        background: #d9dee5;
        position: relative;
        transition: background-color .2s ease;
    }
    .hd-switch input:checked + .hd-switch-track {
        background: #2275fc;
    }
    .hd-switch-thumb {
        position: absolute;
        top: 2px; left: 2px;
        width: 20px; height: 20px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,.2);
        display: flex; align-items: center; justify-content: center;
        transition: left .2s ease;
        font-size: 10px;
    }
    .hd-switch input:checked + .hd-switch-track .hd-switch-thumb { left: 22px; }
    .hd-switch-icon-on { display: none; color: #2275fc; }
    .hd-switch-icon-off { display: inline; color: #9aa5b1; }
    .hd-switch input:checked + .hd-switch-track .hd-switch-icon-on { display: inline; }
    .hd-switch input:checked + .hd-switch-track .hd-switch-icon-off { display: none; }

    /* ---------- Pagination row ---------- */
    .pag-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 16px; background: #eceef6; border-top: 1px solid #e4e7ef; flex-wrap: wrap; gap: 8px;
    }
    .pag-row .pag-info { font-size: 12px; color: #7b8299; }

    /* ---------- Modal ---------- */
    #hotDealModal .form-control {
        border-radius: 7px;
        padding: 9px 12px;
        border: 1px solid #e4e7ef;
        font-size: 13px;
        transition: all .2s ease;
    }
    #hotDealModal .form-control:focus {
        border-color: #2275fc;
        box-shadow: 0 0 0 .15rem rgba(34,117,252,.15);
    }
    #hotDealModal .form-label {
        font-size: 12px; font-weight: 600; color: #7b8299;
        text-transform: uppercase; letter-spacing: .04em;
    }
    #hotDealModal .duration-btn {
        border-radius: 7px;
        font-weight: 600;
        transition: .2s;
        font-size: 13px;
        border-color: #e4e7ef;
        color: #7b8299;
    }
    #hotDealModal .duration-btn i { font-size: 14px; }
    #hotDealModal .duration-btn.active {
        background: #2275fc;
        color: #fff;
        border-color: #2275fc;
    }
    #hotDealModal .modal-content { border-radius: 12px; overflow: hidden; }
    .hd-modal-header { background: #2275fc; }

    .hd-savings-hint {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12.5px;
        padding: 10px 12px;
        border-radius: 8px;
        transition: all .2s ease;
    }
    .hd-savings-hint-muted { background: #f4f6f9; color: #8a93a1; }
    .hd-savings-hint-good { background: #e6f9f0; color: #0d7a4e; }
    .hd-savings-hint-bad { background: #fdeaea; color: #c0392b; }

    @media (max-width: 575.98px) {
        .hd-search-form { flex-direction: column; }
        .pag-row { justify-content: center; }
        .pag-row .pag-info { width: 100%; text-align: center; }
    }
</style>
@endpush


@push('scripts')
<script>
    $(document).ready(function() {

        $('.hot-deal-switch').on('change', function(e) {
            let checkbox = $(this);
            let id = checkbox.data('id');
            let name = checkbox.data('name');
            let price = checkbox.data('price');
            let discountPrice = checkbox.data('discount-price');
            let endsAt = checkbox.data('ends-at');
            let isChecked = checkbox.is(':checked');

            if (isChecked) {
                // Revert check state until modal is actually saved/submitted
                checkbox.prop('checked', false);

                $('#modal_product_id').val(id);
                $('#modal_product_name').val(name);
                $('#modal_base_price').val(parseFloat(price).toLocaleString('en-US', { minimumFractionDigits: 2 }));
                $('#modal_discount_price').val(discountPrice || '');
                $('#modal_discount_price').data('base-price', price);

                // Reset duration buttons
                $('.duration-btn').removeClass('active');
                $('#modal_duration_days').val('');
                $('#modal_ends_at').val('').prop('required', false);
                $('#customDateContainer').addClass('d-none');

                if (endsAt) {
                    $('#modal_ends_at').val(endsAt);
                    let customBtn = $('.duration-btn').filter(function() { return $(this).text().trim() === 'Custom'; });
                    if (customBtn.length) {
                        setDuration(customBtn[0], 'custom');
                    }
                }

                updateSavingsHint();

                let myModal = new bootstrap.Modal(document.getElementById('hotDealModal'));
                myModal.show();
            } else {
                checkbox.prop('checked', true); // Keep it checked during confirm prompt
                Swal.fire({
                    title: 'Deactivate Hot Deal?',
                    text: "Are you sure you want to deactivate the Hot Deal status for this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c0392b',
                    cancelButtonColor: '#2275fc',
                    confirmButtonText: 'Yes, deactivate!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = $('<form>', {
                            'method': 'POST',
                            'action': "{{ route('admin.web-service.hot-deals.toggle') }}"
                        }).append($('<input>', {
                            'name': '_token',
                            'value': $('meta[name="csrf-token"]').attr('content'),
                            'type': 'hidden'
                        })).append($('<input>', {
                            'name': 'product_id',
                            'value': id,
                            'type': 'hidden'
                        })).append($('<input>', {
                            'name': 'is_hot_deal',
                            'value': '0',
                            'type': 'hidden'
                        }));
                        $('body').append(form);
                        form.submit();
                    } else {
                        checkbox.prop('checked', true);
                    }
                });
            }
        });

        // Live discount / savings feedback
        $('#modal_discount_price').on('input', updateSavingsHint);

        function updateSavingsHint() {
            let base = parseFloat($('#modal_discount_price').data('base-price'));
            let deal = parseFloat($('#modal_discount_price').val());
            let $hint = $('#hd_savings_hint');
            let $text = $('#hd_savings_text');

            $hint.removeClass('hd-savings-hint-muted hd-savings-hint-good hd-savings-hint-bad');

            if (!deal || isNaN(deal)) {
                $hint.addClass('hd-savings-hint-muted');
                $text.html('Enter a hot deal price to see the discount.');
                return;
            }

            if (deal >= base) {
                $hint.addClass('hd-savings-hint-bad');
                $text.html('Hot deal price should be lower than the base price (LKR ' + base.toLocaleString('en-US', {minimumFractionDigits: 2}) + ').');
                return;
            }

            let savings = base - deal;
            let pct = ((savings / base) * 100).toFixed(0);
            $hint.addClass('hd-savings-hint-good');
            $text.html('Customers save <strong>LKR ' + savings.toLocaleString('en-US', {minimumFractionDigits: 2}) + '</strong> (' + pct + '% off).');
        }

        // Countdown badges in the table
        function renderCountdowns() {
            $('.hd-countdown').each(function() {
                let $el = $(this);
                let endsAt = new Date($el.data('ends-at'));
                let now = new Date();
                let diffMs = endsAt - now;

                if (diffMs <= 0) {
                    $el.find('.hd-countdown-text').text('Expired');
                    $el.addClass('hd-countdown-urgent');
                    return;
                }

                let diffHrs = diffMs / (1000 * 60 * 60);
                let text;
                if (diffHrs < 24) {
                    text = 'Ends in ' + Math.max(1, Math.round(diffHrs)) + 'h';
                    $el.addClass('hd-countdown-urgent');
                } else {
                    text = 'Ends in ' + Math.round(diffHrs / 24) + 'd';
                }
                $el.find('.hd-countdown-text').text(text);
            });
        }
        renderCountdowns();
    });

    function setDuration(btn, days) {
        $('.duration-btn').removeClass('active');
        $(btn).addClass('active');

        if (days === 'custom') {
            $('#modal_duration_days').val('');
            $('#customDateContainer').removeClass('d-none');
            $('#modal_ends_at').prop('required', true);
        } else {
            $('#modal_duration_days').val(days);
            $('#customDateContainer').addClass('d-none');
            $('#modal_ends_at').prop('required', false).val('');
        }
    }
</script>
@endpush
@endsection