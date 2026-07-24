@extends('phone_lab.layouts.app')

@section('title', 'Checkout - Getyootech - Gadgets Ecommerce Site Template')

@section('content')
    <main>



        <style>
            .custom-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.6);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .modal-box {
                background: #fff;
                padding: 25px;
                border-radius: 10px;
                text-align: center;
                width: 300px;
            }

            .modal-box button {
                margin-top: 15px;
                padding: 8px 20px;
                border: none;
                background: green;
                color: #fff;
                cursor: pointer;
                border-radius: 5px;
            }





            .suggestions-list {
                list-style: none;
                margin: 0;
                padding: 0;
                border: none;
                max-height: 200px;
                overflow-y: auto;
                position: absolute;
                background: #fff;
                width: 100%;
                z-index: 999;


            }

            .suggestions-list li {
                padding: 10px;
                cursor: pointer;
            }

            .suggestions-list li:hover {
                background: #f2f2f2;
            }

            .nice-select .list {
    max-height: 220px;
    overflow-y: auto;
    scrollbar-width: thin;
}
        </style>


        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Check Out</li>
                </ul>
            </div>
        </div>





        <section class="checkout_section section_space">
            <div class="container">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    @if (session()->has('buy_now_item.is_buy_now'))
                        @php
                            $buyNowItem = session('buy_now_item.items')->first();                        
                        @endphp

                        <input type="hidden" name="buy_now" value="1">
                        <input type="hidden" name="product_id" value="{{ $buyNowItem->product->id }}">
                        <input type="hidden" name="variant_id" value="{{ $buyNowItem->variant_id }}">
                        <input type="hidden" name="quantity" value="{{ $buyNowItem->quantity }}">
                    @endif

                    <div class="checkout_widget bg-light">
                        <h3 class="checkout_widget_title">Billing Details</h3>

                        @if (count($addresses) > 0)
                            <div class="row">
                                <div class="col col-md-12 select_option clearfix">
                                    <div class="form_item mb-4">
                                        <h4 class="input_title">Select Saved Address</h4>
                                        <select id="savedAddressSelect" class="form-select">
                                            <option value="">-- Choose an address --</option>
                                            @foreach ($addresses as $addr)
                                                <option value="{{ $addr->id }}" data-fullname="{{ $addr->full_name }}"
                                                    data-email="{{ $addr->email }}" data-phone="{{ $addr->phone }}"
                                                    data-address="{{ $addr->address }}"
                                                    data-district="{{ $addr->district }}" data-city="{{ $addr->city }}">
                                                    {{ $addr->title }} - {{ $addr->address }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form_item">
                                    <h4 class="input_title">Full Name</h4>
                                    <input type="text" id="check_fullname" name="full_name" placeholder="Full Name *"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-6 select_option clearfix">
                                <div class="form_item">
                                    <h4 class="input_title">District *</h4>
                                    <select id="districtSelect" name="district" required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                            </div>





                            <div class="col col-md-6 select_option clearfix">
                                <div class="form_item">
                                    <h4 class="input_title">City *</h4>
                                    <input id="cityInput" type="text" name="city" placeholder="Enter or search city"
                                        autocomplete="off" />

                                    <ul id="citySuggestions" class="suggestions-list"></ul>
                                </div>
                            </div>




                        </div>

                        <div class="row">
                            <div class="col col-md-9 col-sm-6">
                                <div class="form_item">
                                    <h4 class="input_title">Address *</h4>
                                    <input type="text"id="check_address" name="address"
                                        placeholder="Street Address required" required>
                                </div>
                            </div>
                            <div class="col col-md-3 col-sm-6">
                                <div class="form_item">
                                    <h4 class="input_title">Postcode / Zip *</h4>
                                    <input type="text" name="postcode" placeholder="Postcode / Zip" required>
                                </div>
                            </div>
                        </div>

                        <div class="form_item mb-5">
                            <h4 class="input_title">Contact Info *</h4>
                            <input type="email" id="check_email" name="email"class="form-control"placeholder="Email Address" required>
                            <small id="emailMsg"></small>
                            <p class="text-danger" id="emailError" style="display: none;">Please enter a valid email
                                address.</p>
                            <input type="tel"
       id="check_phone"
       name="phone"
       placeholder="07XXXXXXXX"
       pattern="[0-9]{10}"
       maxlength="15"
       minlength="10"
       oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15)"
       required>
                        </div>

                        <div class="checkout_widget_title">
                            <h3>Ship to a different address?</h3>
                        </div>
                        <div class="form_item note_textarea mb-0">
                            <h4 class="input_title">Other Note</h4>
                            <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>

                    <div class="checkout_widget">
                        <h3 class="checkout_widget_title">Your Order</h3>
                        <div class="cart_table checkout_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th>PRICE</th>
                                        <th>QUANTITY</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $grandTotal = 0; @endphp
                                    @foreach ($checkoutItems as $item)
                                        @php
                                            $price = $item->variant ? $item->variant->active_price : $item->product->active_price;
                                            $lineTotal = $price * $item->quantity;
                                            $grandTotal += $lineTotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="cart_product">
                                                    <img src="{{ asset($item->product->featured_image) }}"
                                                        alt="{{ $item->product->name }}">
                                                    <h3>{{ $item->product->name }} <br>
                                                        <small>{{ $item->variant->ram ?? '' }}
                                                            {{ $item->variant->storage ?? '' }}
                                                            {{ $item->variant->color ?? '' }}</small>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td>Rs. {{ number_format($price, 2) }}</td>
                                            <td><strong class="quantity_count">{{ $item->quantity }}</strong></td>
                                            <td>Rs. {{ number_format($lineTotal, 2) }}</td>

                                            <input type="hidden" name="items[{{ $loop->index }}][product_id]"
                                                value="{{ $item->product->id }}">
                                            <input type="hidden" name="items[{{ $loop->index }}][variant_id]"
                                                value="{{ $item->variant_id }}">
                                            <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                                value="{{ $item->quantity }}">
                                            <input type="hidden" name="items[{{ $loop->index }}][price]"
                                                value="{{ $price }}">
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong>Order Total</strong></td>
                                        <td><strong class="total_text">Rs. {{ number_format($grandTotal, 2) }}</strong>
                                        </td>
                                        <input type="hidden" name="total_amount" value="{{ $grandTotal }}">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="checkout_payment_method">
                        <ul class="ul_li_block">
                            <li>
                                <div class="radio_item d-flex align-items-center">
                                    <input id="cod" type="radio" name="payment_method" value="cash" checked>
                                    <label for="cod">Cash on Delivery (COD)</label>
                                    <img src="{{ asset('assets/images/paylogos/cod.png') }}" class="ms-3"
                                        style="height: 30px;" alt="payment_icon">
                                </div>
                            </li>
                            <li>
                                <div class="radio_item d-flex align-items-center">
                                    <input id="card" type="radio" name="payment_method" value="card">
                                    <label for="card">Card Payment</label>
                                    <img src="{{ asset('assets/images/paylogos/payhere.png') }}" class="ms-3"
                                        style="height: 30px;" alt="payment_icon">
                                </div>
                            </li>
                            <li>
                                <div class="radio_item d-flex align-items-center">
                                    <input id="koko" type="radio" name="payment_method" value="koko">
                                    <label for="koko">Koko (Pay in 3 installments)</label>
                                    <img src="{{ asset('assets/images/paylogos/koko.png') }}" class="ms-3"
                                        style="height: 30px;" alt="payment_icon">
                                </div>
                                <div id="koko-details"
                                    style="display:none; padding:10px; background:#f9f9f9; border-radius:5px;">
                                    <p><strong>3 X </strong> <span id="koko-installment-amount"></span></p>
                                    <small>* 12% service fee added.</small>
                                </div>
                            </li>
                        </ul>
                        <button type="submit" class="btn btn_primary w-100">Place Order</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- checkout_section - end
                                                                                                                                                                ================================================== -->

       
                                                                                                                                                                

    </main>
    <!-- main body - end

                                                                                                                                                              ================================================== -->
@endsection

@push('scripts')
<script>
const locationData = {
    "Colombo": ["Colombo 1-15","Dehiwala","Mount Lavinia","Moratuwa","Kaduwela","Maharagama","Hanwella","Homagama"],
    "Gampaha": ["Gampaha","Negombo","Katunayake","Kadawatha","Kiribathgoda","Wattala","Ja-Ela","Nittambuwa"],
    "Kalutara": ["Kalutara","Panadura","Horana","Beruwala","Matugama","Aluthgama","Paiyagala"],
    "Kandy": ["Kandy","Peradeniya","Gampola","Nawalapitiya","Katugastota","Kundasale"],
    "Matale": ["Matale","Dambulla","Sigiriya","Ukuwela"],
    "Nuwara Eliya": ["Nuwara Eliya","Hatton","Talawakele","Hanguranketha"],
    "Galle": ["Galle","Hikkaduwa","Karapitiya","Ambalangoda","Baddegama"],
    "Matara": ["Matara","Weligama","Dikwella","Akuressa","Deniyaya"],
    "Hambantota": ["Hambantota","Tangalle","Beliatta","Tissamaharama"],
    "Jaffna": ["Jaffna Town","Chavakachcheri","Point Pedro","Nallur"],
    "Kilinochchi": ["Kilinochchi","Pooneryn"],
    "Mannar": ["Mannar","Madhu"],
    "Vavuniya": ["Vavuniya","Cheddikulam"],
    "Mullaitivu": ["Mullaitivu","Puthukkudiyiruppu"],
    "Batticaloa": ["Batticaloa","Eravur","Kalkudah"],
    "Ampara": ["Ampara","Akkaraipattu","Kalmunai","Sainthamaruthu"],
    "Trincomalee": ["Trincomalee","Kinniya","Mutur"],
    "Kurunegala": ["Kurunegala","Kuliyapitiya","Narammala","Pannala","Wariyapola"],
    "Puttalam": ["Puttalam","Chilaw","Marawila","Dankotuwa","Anamaduwa"],
    "Anuradhapura": ["Anuradhapura","Eppawala","Kekirawa","Medawachchiya"],
    "Polonnaruwa": ["Polonnaruwa","Kaduruwela","Medirigiriya"],
    "Badulla": ["Badulla","Bandarawela","Hali-Ela","Mahiyanganaya","Welimada"],
    "Moneragala": ["Moneragala","Wellawaya","Buttala"],
    "Ratnapura": ["Ratnapura","Balangoda","Eheliyagoda","Pelmadulla"],
    "Kegalle": ["Kegalle","Mawanella","Warakapola","Rambukkana"]
};

// ─── City autocomplete ────────────────────────────────────────────────────────
let allCities = [...new Set(Object.values(locationData).flat())];

const cityInput      = document.getElementById('cityInput');
const suggestionBox  = document.getElementById('citySuggestions');

if (cityInput) {
    cityInput.addEventListener('input', function () {
        const value = this.value.toLowerCase();
        suggestionBox.innerHTML = '';
        if (!value) return;

        allCities
            .filter(city => city.toLowerCase().includes(value))
            .forEach(city => {
                const li = document.createElement('li');
                li.textContent = city;
                li.addEventListener('click', () => {
                    cityInput.value = city;
                    suggestionBox.innerHTML = '';
                });
                suggestionBox.appendChild(li);
            });
    });

    document.addEventListener('click', e => {
        if (e.target !== cityInput) suggestionBox.innerHTML = '';
    });
}

// ─── DOM ready ────────────────────────────────────────────────────────────────
$(document).ready(function () {

    // 1. Populate district <select> before NiceSelect initialises
    const districtSelect = document.getElementById('districtSelect');
    if (districtSelect) {
        Object.keys(locationData).sort().forEach(dist => {
            const opt = document.createElement('option');
            opt.value       = dist;
            opt.textContent = dist;
            districtSelect.appendChild(opt);
        });
    }

    // 2. Init/Update NiceSelect on both dropdowns
    $('#districtSelect').niceSelect('update');
    if (!$('#districtSelect').next('.nice-select').length) {
        $('#districtSelect').niceSelect();
    }
    $('#savedAddressSelect').niceSelect();

    // ─── Saved address auto-fill ─────────────────────────────────────────────
    // NiceSelect replaces the native <select> with its own UI and fires change
    // only through jQuery — so we MUST use $('#...').on('change', ...) here.
    $('#savedAddressSelect').on('change', function () {
        const selectedId = $(this).val();
        if (!selectedId) return;

        // Read data attributes from the matching <option>
        const opt = document.querySelector(
            '#savedAddressSelect option[value="' + selectedId + '"]'
        );
        if (!opt) return;

        // Fill text fields
        document.getElementById('check_fullname').value = opt.dataset.fullname || '';
        document.getElementById('check_email').value    = opt.dataset.email    || '';
        document.getElementById('check_phone').value    = opt.dataset.phone    || '';
        document.getElementById('check_address').value  = opt.dataset.address  || '';

        // Set district on the native select, then tell NiceSelect to reflect it
        const district = opt.dataset.district || '';
        $('#districtSelect').val(district).niceSelect('update');

        // Set city text input
        if (cityInput) {
            cityInput.value = opt.dataset.city || '';
        }
    });

    // ─── Koko installment display ─────────────────────────────────────────────
    const grandTotal = {{ $grandTotal }};

    $('input[name="payment_method"]').on('change', function () {
        if ($(this).val() === 'koko') {
            const installment = ((grandTotal * 1.12) / 3).toFixed(2);
            $('#koko-installment-amount').text('Rs. ' + installment);
            $('#koko-details').show();
        } else {
            $('#koko-details').hide();
        }
    });

    // ─── Email validation ─────────────────────────────────────────────────────
    const emailInput = document.getElementById('check_email');
    const emailMsg   = document.getElementById('emailMsg');
    const emailPatt  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    emailInput.addEventListener('input', function () {
        const val = emailInput.value;
        if (!val) {
            emailInput.classList.remove('is-valid', 'is-invalid');
            emailMsg.textContent = '';
            return;
        }
        if (emailPatt.test(val)) {
            emailInput.classList.add('is-valid');
            emailInput.classList.remove('is-invalid');
            emailMsg.textContent  = 'Looks good';
            emailMsg.style.color  = 'green';
        } else {
            emailInput.classList.add('is-invalid');
            emailInput.classList.remove('is-valid');
            emailMsg.textContent  = 'Invalid email format ❌';
            emailMsg.style.color  = 'red';
        }
    });

});
</script>
@endpush