@extends('phone_lab.layouts.app')

@section('title', 'Order Tracking - Getyootech - Gadgets Ecommerce Site Template')

@section('content')
<main>

        <!-- sidebar cart - start
        ================================================== -->
        <div class="sidebar-menu-wrapper">
          <div class="cart_sidebar">
            <button type="button" class="close_btn"><i class="fal fa-times"></i></button>

            <ul class="cart_items_list ul_li_block mb_30 clearfix">
              <li>
                <div class="item_image">
                  <img src="{{ asset('assets/images/cart/cart_img_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
                <div class="item_content">
                  <h4 class="item_title">Yellow Blouse</h4>
                  <span class="item_price">$30.00</span>
                </div>
                <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
              </li>
              <li>
                <div class="item_image">
                  <img src="{{ asset('assets/images/cart/cart_img_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
                <div class="item_content">
                  <h4 class="item_title">Yellow Blouse</h4>
                  <span class="item_price">$30.00</span>
                </div>
                <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
              </li>
              <li>
                <div class="item_image">
                  <img src="{{ asset('assets/images/cart/cart_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
                <div class="item_content">
                  <h4 class="item_title">Yellow Blouse</h4>
                  <span class="item_price">$30.00</span>
                </div>
                <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
              </li>
            </ul>

            <ul class="total_price ul_li_block mb_30 clearfix">
              <li>
                <span>Subtotal:</span>
                <span>$90</span>
              </li>
              <li>
                <span>Vat 5%:</span>
                <span>$4.5</span>
              </li>
              <li>
                <span>Discount 20%:</span>
                <span>- $18.9</span>
              </li>
              <li>
                <span>Total:</span>
                <span>$75.6</span>
              </li>
            </ul>

            <ul class="btns_group ul_li_block clearfix">
              <li><a class="btn btn_primary" href="{{ route('phone_lab.cart') }}">View Cart</a></li>
              <li><a class="btn btn_secondary" href="{{ route('phone_lab.checkout') }}">Checkout</a></li>
            </ul>
          </div>

          <div class="cart_overlay"></div>
        </div>
        <!-- sidebar cart - end
        ================================================== -->

        <!-- breadcrumb_section - start
        ================================================== -->
        <div class="breadcrumb_section">
          <div class="container">
            <ul class="breadcrumb_nav ul_li">
              <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
              <li>Order Tracking</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- order_tracking_section - start
        ================================================== -->
        <section class="order_tracking_section section_space">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col col-lg-10">
                <div class="order_tracking_form text-center">
                  <h2 class="title_text mb-3">Track Your Order</h2>
                  <p>
                    Keep an eye on your tech! Please enter your Order ID and email address below to check the real-time delivery status of your smartphone or accessories. 
                  </p>
                  <form action="{{ route('phone_lab.order_tracking') }}" method="GET">
                    <div class="row">
                      <div class="col col-md-6">
                        <div class="form_item">
                          <h3 class="form_title">Order ID</h3>
                          <input type="text" name="order_id" value="{{ request('order_id') }}" placeholder="Found your order confirmation email" required>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="form_item">
                          <h3 class="form_title">Billing Email</h3>
                          <input type="email" name="billing_email" value="{{ request('billing_email') }}" placeholder="Found your order confirmation email" required>
                        </div>
                      </div>
                    </div>

                    <div class="submit_btn_wrap">
                      <button type="submit" class="btn btn_secondary">Track Order</button>
                    </div>
                  </form>

                  @if ($searched && !$order)
                    <div class="alert alert-danger mt-5 text-center" role="alert" style="border-radius: 8px; border: none; background-color: #fef2f2; color: #991b1b; padding: 15px 20px;">
                      <i class="fal fa-exclamation-triangle mr-2" style="font-size: 16px;"></i> No order found with Order ID <strong>{{ request('order_id') }}</strong> and email <strong>{{ request('billing_email') }}</strong>. Please check your details and try again.
                    </div>
                  @endif
                </div>

                @if ($order)
                  @php
                    $completedCount = $order->orderProcesses->where('status', 'completed')->count();
                    $progressWidth = 0;
                    if ($completedCount == 1) {
                        $progressWidth = 50;
                    } elseif ($completedCount >= 2) {
                        $progressWidth = 100;
                    }
                  @endphp

                  <!-- Tracking Timeline -->
                  <div class="card border-0 shadow-sm p-4 mt-5 mb-5" style="border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
                    <div class="card-body">
                      <h4 class="text-left font-weight-bold mb-4" style="color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                        <i class="fal fa-map-marker-alt text-primary mr-2"></i> Shipment Progress for #{{ $order->order_code }}
                      </h4>

                      <ul class="tracking-stepper">
                        <div class="stepper-progress" style="width: {{ $progressWidth }}%;"></div>
                        @foreach ($order->orderProcesses as $process)
                          @php
                            $stepClass = 'pending';
                            if ($process->status === 'completed') {
                                $stepClass = 'completed';
                            } elseif ($process->status === 'processing') {
                                $stepClass = 'processing';
                            }
                            
                            $iconClass = 'fa-box';
                            if ($process->order_stage_id == 2) {
                                $iconClass = 'fa-truck';
                            } elseif ($process->order_stage_id == 3) {
                                $iconClass = 'fa-check-double';
                            }
                          @endphp
                          <li class="stepper-step {{ $stepClass }}">
                            <div class="step-icon">
                              <i class="fal {{ $iconClass }}"></i>
                            </div>
                            <div class="step-details">
                              <div class="step-status">{{ ucfirst($process->status) }}</div>
                              <div class="step-name">{{ $process->stage->name ?? 'N/A' }}</div>
                              @if ($process->status === 'completed' && $process->end_date)
                                <div class="step-date">{{ \Carbon\Carbon::parse($process->end_date)->format('M d, Y h:i A') }}</div>
                              @endif
                              @if ($process->tracking_number)
                                <div class="mt-2 text-primary small font-weight-bold">
                                  Courier Tracking No: <span style="background: #e0f2fe; padding: 2px 8px; border-radius: 4px; color: #0369a1;">{{ $process->tracking_number }}</span>
                                </div>
                              @endif
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>

                  <!-- Order Information Details -->
                  <div class="row text-left">
                    <div class="col col-lg-5 col-md-6 col-12 mb-4">
                      <!-- Order details card -->
                      <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0 !important; height: 100%;">
                        <div class="card-body p-4">
                          <h4 class="card-title mb-4" style="font-weight: 700; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                            <i class="fal fa-info-circle mr-2 text-primary"></i> Order Details
                          </h4>
                          <div class="d-flex justify-content-between mb-3" style="font-size: 14px;">
                            <span style="color: #64748b;">Order Status:</span>
                            <span class="badge" style="border-radius: 20px; font-weight: 600; padding: 5px 12px; {{ $order->order_status === 'completed' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fef3c7; color: #92400e;' }}">
                              {{ ucfirst($order->order_status) }}
                            </span>
                          </div>
                          <div class="d-flex justify-content-between mb-3" style="font-size: 14px;">
                            <span style="color: #64748b;">Payment Method:</span>
                            <span class="font-weight-bold text-uppercase" style="color: #1e293b;">{{ $order->payment_method }}</span>
                          </div>
                          <div class="d-flex justify-content-between mb-3" style="font-size: 14px;">
                            <span style="color: #64748b;">Payment Status:</span>
                            <span class="badge" style="border-radius: 20px; font-weight: 600; padding: 5px 12px; {{ $order->payment_status === 'paid' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;' }}">
                              {{ ucfirst($order->payment_status) }}
                            </span>
                          </div>
                          <div class="d-flex justify-content-between" style="font-size: 14px;">
                            <span style="color: #64748b;">Order Date:</span>
                            <span class="font-weight-bold" style="color: #1e293b;">{{ $order->created_at->format('M d, Y') }}</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col col-lg-7 col-md-6 col-12 mb-4">
                      <!-- Shipping address card -->
                      <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0 !important; height: 100%;">
                        <div class="card-body p-4">
                          <h4 class="card-title mb-4" style="font-weight: 700; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                            <i class="fal fa-map-marker-alt mr-2 text-primary"></i> Shipping Address
                          </h4>
                          <p class="mb-0" style="color: #475569; line-height: 1.6; font-size: 14px;">
                            <strong>{{ $order->full_name }}</strong><br>
                            {{ $order->address }},<br>
                            {{ $order->city }}, {{ $order->district }} {{ $order->postcode }}<br>
                            <span class="d-inline-block mt-3" style="font-weight: 600;">
                              <i class="fal fa-phone-alt mr-2 text-primary"></i> {{ $order->phone }}
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Items Table Card -->
                  <div class="card border-0 shadow-sm mt-4 text-left" style="border-radius: 12px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
                    <div class="card-body p-4">
                      <h4 class="card-title mb-4" style="font-weight: 700; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                        <i class="fal fa-shopping-bag mr-2 text-primary"></i> Items Ordered
                      </h4>
                      <div class="table-responsive">
                        <table class="table table-borderless align-middle" style="margin-bottom: 0;">
                          <thead>
                            <tr style="border-bottom: 2px solid #f1f5f9; font-size: 13px; color: #64748b;">
                              <th class="pl-0">Product</th>
                              <th class="text-center">Qty</th>
                              <th class="text-right pr-0">Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->items as $item)
                              <tr style="border-bottom: 1px solid #f8fafc;">
                                <td class="pl-0 py-3">
                                  <div style="font-weight: 600; color: #1e293b;">{{ $item->product->name }}</div>
                                  @if ($item->variant)
                                    <div class="small mt-1" style="color: #94a3b8; background-color: #f8fafc; display: inline-block; padding: 2px 8px; border-radius: 12px; border: 1px solid #edf2f7;">
                                      {{ $item->variant->color }} · {{ $item->variant->storage }}
                                    </div>
                                  @endif
                                </td>
                                <td class="text-center py-3" style="color: #475569;">{{ $item->quantity }}</td>
                                <td class="text-right pr-0 py-3 font-weight-bold" style="color: #1e293b;">
                                  Rs. {{ number_format($item->price, 2) }}
                                </td>
                              </tr>
                            @endforeach
                            <tr style="font-size: 16px;">
                              <td colspan="2" class="pl-0 pt-4 font-weight-bold" style="color: #1e293b;">Grand Total:</td>
                              <td class="text-right pr-0 pt-4 font-weight-bold text-primary" style="font-size: 18px;">
                                Rs. {{ number_format($order->total, 2) }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </section>
        <!-- order_tracking_section - end
        ================================================== -->

      </main>
      <!-- main body - end
      ================================================== -->
@endsection