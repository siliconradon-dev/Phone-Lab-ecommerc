@extends('admin.layouts.app')

@section('index_content')
    <div class="p-3 main-content-wrap">
       
        <form class="form-add-product" action="{{ route('stocks.store') }}" method="POST">
            @csrf
            <div class="wg-box custom-scroll">
                <div class="gap22">
                    <fieldset class="product">
                        <div class="body-title mb-5">Select Product <span class="tf-color-1">*</span></div>
                        <div>
                            {{-- Added a specific class 'select2-product' to identify it --}}
                            <select name="product_id" id="product_selector" class="styled-select" required>
                                <option value="">Choose product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-has-variants="{{ $product->has_variants }}">
                                        {{ $product->name }} (SKU: {{ $product->sku }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="variant mt-5" id="variant-wrapper" style="display:none;">
                        <div class="body-title mb-5">Select Variant <span class="tf-color-1">*</span></div>
                        <div class="select">
                            <select name="product_variant_id" id="variant_selector">
                                <option value="">Choose variant</option>
                            </select>
                        </div>
                    </fieldset>
                </div>

                <div class="divider"></div>

                <div class="flex items-center gap20 mb-20">
                    <div class="body-title">Stock Tracking Method:</div>
                    <div class="flex items-center gap10">
                        <input type="checkbox" id="use_imei" name="use_imei" value="1"
                            style="width:20px; height:20px;">
                        <label for="use_imei" class="text-tiny">Track by IMEI Numbers</label>
                    </div>
                </div>

                <div class="gap22 cols">
                    <fieldset class="quantity">
                        <div class="body-title mb-10">Quantity To Add <span class="tf-color-1">*</span></div>
                        <input type="number" name="quantity" id="qty_input" placeholder="0" min="1" required>
                    </fieldset>

                    <fieldset class="note">
                        <div class="body-title mb-10">Entry Note</div>
                        <input type="text" name="note" placeholder="Ex: Stock from Supplier A">
                    </fieldset>
                </div>

                <div id="imei-section" style="display:none;" class="mt-20">
                    <fieldset class="imeis">
                        <div class="body-title mb-10">Scan/Enter IMEI Numbers</div>
                        <input type="text" id="imei_input" placeholder="Scan or type IMEI and press Enter..."
                            class="styled-input mb-10">

                        <div id="imei_list_container" class="flex flex-wrap gap10 mt-10">
                        </div>

                        <input type="hidden" name="imeis" id="imei_hidden_input">

                        <div class="text-tiny mt-10 text-primary" id="imei-count">Total IMEIs detected: 0</div>
                    </fieldset>
                </div>

                <div class="cols gap10 mt-20">
                    <button class="tf-button w-full" type="submit">Update Stock Inventory</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/pos.css') }}">

    <style>
        .custom-scroll {
    max-height: 80vh;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.custom-scroll::-webkit-scrollbar {
    display: none;
}
    </style>
@endpush

@push('scripts')
    <script>
        $('#product_selector').select2();

        $(document).ready(function() {
            $('.select2-product').select2({
                placeholder: "Choose product",
                allowClear: true,
                width: '100%'
            });

            // 1. Load Variants via AJAX
            $('#product_selector').change(function() {
                let productId = $(this).val();
                let hasVariants = $(this).find(':selected').data('has-variants');
                let variantWrapper = $('#variant-wrapper');
                let variantSelect = $('#variant_selector');

                if (hasVariants == 1) {
                    variantWrapper.show();
                    variantSelect.attr('required', 'required');

                    $.get("{{ route('stocks.get_variants', '') }}/" + productId, function(data) {
                        variantSelect.html('<option value="">Choose variant</option>');
                        $.each(data, function(i, v) {
                            variantSelect.append(
                                `<option value="${v.id}">${v.color} | ${v.storage} | ${v.ram}</option>`
                            );
                        });
                    });
                } else {
                    variantWrapper.hide();
                    // Remove the 'required' attribute so the form can be submitted
                    variantSelect.removeAttr('required');
                    variantSelect.html('<option value="">Choose variant</option>');
                }
            });

            // 2. Toggle IMEI Section
            $('#use_imei').change(function() {
                if ($(this).is(':checked')) {
                    $('#imei-section').slideDown(function() {
                        $('#imei_input').focus();
                    });
                    $('#qty_input').val('').attr('readonly', true);
                } else {
                    $('#imei-section').slideUp();
                    $('#qty_input').val('').attr('readonly', false);
                }
            });

            // 3. Handle IMEI Input
            let imeiSet = new Set();

            $('#imei_input').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    let imei = $(this).val().trim();
                    if (imei !== "") {
                        if (imeiSet.has(imei)) {
                            Swal.fire({
                                icon: 'warning',
                                text: 'IMEI already added!'
                            });
                        } else {
                            imeiSet.add(imei);
                            renderImeiList();
                        }
                        $(this).val('');
                    }
                }
            });

            // Use global scope for remove function to ensure it works in onclick
            window.removeImei = function(imei) {
                imeiSet.delete(imei);
                renderImeiList();
            };

            function renderImeiList() {
                let container = $('#imei_list_container');
                container.empty();

                imeiSet.forEach(imei => {
                    container.append(`
                    <div style="
    background: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    margin: 4px;
    border: 1px solid #dee2e6;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    transition: all 0.2s ease;
    font-size: 13px;
    gap: 8px;
"
onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 3px 8px rgba(0,0,0,0.1)';"
onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)';"
>
    <span style="flex:1; color:#212529; font-weight:500;">
        ${imei}
    </span>

    <button type="button"
        onclick="removeImei('${imei}')"
        style="
            border: none;
            background: #f8d7da;
            color: #dc3545;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        "
        onmouseover="this.style.background='#dc3545'; this.style.color='#fff';"
        onmouseout="this.style.background='#f8d7da'; this.style.color='#dc3545';"
    >
        &times;
    </button>
</div>
                `);
                });

                $('#imei_hidden_input').val(Array.from(imeiSet).join(','));
                $('#qty_input').val(imeiSet.size);
                $('#imei-count').text("Total IMEIs detected: " + imeiSet.size);
            }
        });
    </script>
@endpush
