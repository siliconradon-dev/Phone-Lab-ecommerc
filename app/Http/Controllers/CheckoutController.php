<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderProcess;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::guard('public_user')->id();
        $sessionId = $request->cookie('cart_session_id');

        // Prioritize 'Buy Now' session if present
        if (session()->has('buy_now_item')) {
            $checkoutItems = session()->get('buy_now_item.items');
        } else {
            $cartItems = Cart::with(['product.hotDeal', 'variant'])
                ->where(function ($query) use ($userId, $sessionId) {
                    $userId ? $query->where('public_user_id', $userId) : $query->where('session_id', $sessionId);
                })->get();
            $checkoutItems = $cartItems;
        }

        if (!$checkoutItems || (is_array($checkoutItems) && count($checkoutItems) === 0) || (is_object($checkoutItems) && $checkoutItems->isEmpty())) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $addresses = [];
        if ($userId) {
            $addresses = Address::where('public_user_id', $userId)->get();
        }

        return view('phone_lab.pages.checkout', compact('checkoutItems', 'addresses'));
    }






 public function buyNowCheckout(Request $request)
 {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'variant_id' => 'nullable|exists:product_variants,id'
    ]);

    $product = Product::findOrFail($request->product_id);

    // SAME LOGIC AS ADD TO CART
    if ($product->has_variants) {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
        ], [
            'variant_id.required' => 'Please select your preferred Memory and Color variant before proceeding to checkout.'
        ]);
    }

    $variant = $request->variant_id
        ? ProductVariant::find($request->variant_id)
        : null;

    $item = (object)[
        'product' => $product,
        'variant' => $variant,
        'variant_id' => $request->variant_id,
        'quantity' => (int) $request->quantity,
    ];

    $checkoutItems = collect([$item]);

    // Store in session so checkout page has it and places it in hidden form inputs
    session([
        'buy_now_item' => [
            'items' => $checkoutItems,
            'is_buy_now' => true
        ]
    ]);

    return redirect()->route('phone_lab.checkout');
 }




    

    /**
     * Handle 'Buy Now' request.
     */
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Same validation logic for variants
        if ($product->has_variants) {
            $request->validate([
                'variant_id' => 'required|exists:product_variants,id',
            ], [
                'variant_id.required' => 'Please select your preferred Memory and Color variant before proceeding to checkout.'
            ]);
        }

        session()->forget('buy_now_item');

        $variant = $request->variant_id ? ProductVariant::find($request->variant_id) : null;

        $item = (object) [
            'product' => $product,
            'variant' => $variant,
            'variant_id' => $request->variant_id,
            'quantity' => (int) $request->quantity,
        ];

        session([
            'buy_now_item' => [
                'items' => collect([$item]),
                'is_buy_now' => true
            ]
        ]);

        return redirect()->route('phone_lab.checkout');
    }





    public function store(Request $request)
    {
       
        // 1. Validation
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string|max:10',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);
        
      
        // 2. Identify Cart Items (Buy Now OR Cart)
        $isBuyNow = $request->has('buy_now') && $request->buy_now == 1;
        Log::info('Checkout initiated. Buy Now: ' . ($isBuyNow ? 'Yes' : 'No'));
        if ($isBuyNow) {
            Log::info('Processing Buy Now checkout for Product ID: ' . $request->product_id);
            $product = Product::find($request->product_id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            $cartItems = collect([
                (object) [
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id ?? null,
                    'quantity' => $request->quantity,
                    'product' => $product,
                    'variant' => $request->variant_id ? ProductVariant::find($request->variant_id) : null
                ]
            ]);
            Log::info('Buy Now Items Count: ' . $cartItems->count());
        } else {
            Log::info('Processing regular cart checkout.');
            $identifier = $this->getCartIdentifier();
            $cartItems = Cart::with(['product.hotDeal', 'variant'])->where($identifier)->get();
            Log::info('Cart Items Count: ' . $cartItems->count());
        }

       

        if ($cartItems->isEmpty()) {
            Log::warning('Checkout attempted with empty cart.');
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // 3. Calculate Totals
        $baseTotal = $cartItems->sum(function ($item) {
            $price = $item->variant ? $item->variant->active_price : $item->product->active_price;
            return $price * $item->quantity;
        });

        $finalTotal = ($request->payment_method === 'koko') ? ($baseTotal * 1.12) : $baseTotal;

        DB::beginTransaction();
        try {
            // 4. Create Order
            $latestOrder = Order::latest('id')->first();
            $nextId = $latestOrder ? $latestOrder->id + 1 : 1;
            $orderCode = 'YIO' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

            $userId = Auth::guard('public_user')->id();

            $order = Order::create([
                'order_code' => $orderCode,
                'public_user_id' => $userId,
                'guest_email' => $userId ? null : $request->email,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'district' => $request->district,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'total' => $finalTotal,
                'note' => $request->note ?? '',
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            $stages = [
                ['order_stage_id' => 1],
                ['order_stage_id' => 2],
                ['order_stage_id' => 3],
            ];

            foreach ($stages as $stage) {
                OrderProcess::create([
                    'order_id' => $order->id,
                    'order_stage_id' => $stage['order_stage_id'],
                    'status' => 'pending',
                ]);
            }

            // 5. Save Order Items & Stock Management
            foreach ($cartItems as $item) {
                $price = $item->variant ? $item->variant->active_price : $item->product->active_price;
                $unitPrice = ($request->payment_method === 'koko') ? ($price * 1.12) : $price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                    'price' => $unitPrice * $item->quantity,
                ]);

            }

            // 6. Clear Cart (Only if NOT Buy Now)
            if (!$isBuyNow) {
                $identifier = $this->getCartIdentifier();
                Cart::where($identifier)->delete();
            } else {
                session()->forget('buy_now_item');
            }

            DB::commit();

            // 7. Payment Redirection
            if ($request->payment_method === 'card') {
                Log::info('Redirecting to PayHere for Order: ' . $order->order_code);
                return $this->processPayHere($order, $request, $finalTotal);
            }

            if ($request->payment_method === 'koko') {
                Log::info('Redirecting to Koko for Order: ' . $order->order_code);
                return $this->processKoko($order, $request, $finalTotal);
            }

            // Send confirmation email for Cash/COD orders
            $order->load(['items.product', 'items.variant']);
            try {
                Mail::to($order->email)->send(new OrderConfirmationMail($order));
            } catch (\Exception $mailEx) {
                Log::error("Failed to send order confirmation email for Order {$order->order_code}: " . $mailEx->getMessage());
            }

           return redirect()->route('phone_lab.index')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkout Error: " . $e->getMessage());
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    /**
     * Identify the current user's cart (Auth user or Guest session)
     */
    protected function getCartIdentifier()
    {
        $userId = Auth::guard('public_user')->id();

        if ($userId) {
            return ['public_user_id' => $userId];
        }

        // Guest users have a session cookie
        $sessionId = request()->cookie('cart_session_id');
        return ['session_id' => $sessionId];
    }

    private function processPayHere($order, $request, $total)
    {
        $merchant_id = config('payhere.merchant_id', env('PAYHERE_MERCHANT_ID'));
        $merchant_secret = config('payhere.merchant_secret', env('PAYHERE_MERCHANT_SECRET'));
        $currency = 'LKR';
        $amount = number_format($total, 2, '.', '');
        $order_id = $order->order_code;

        // Generate PayHere MD5 Hash
        $hash = strtoupper(md5(
            $merchant_id . $order_id . $amount . $currency . strtoupper(md5($merchant_secret))
        ));

        $payment = [
            "merchant_id" => $merchant_id,
            "return_url" => route('payment.success'),
            "cancel_url" => route('payment.cancel'),
            "notify_url" => route('payment.notify'),
            "order_id" => $order_id,
            "items" => 'Order #' . $order_id,
            "currency" => $currency,
            "amount" => $amount,
            "first_name" => $request->full_name,
            "last_name" => '',
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "city" => $request->city,
            "country" => "Sri Lanka",
            "hash" => $hash,
        ];
        Log::info('PayHere Payment Data', $payment);
        return view('payhere.redirect', compact('payment'));
    }

    private function processKoko($order, $request, $total)
    {
        $finalAmount = number_format($total, 2, '.', '');

        $mId = config('paykoko.merchant_id', env('PAYKOKO_MERCHANT_ID'));
        $apiKey = config('paykoko.api_key', env('PAYKOKO_API_KEY'));
        $gatewayUrl = config('paykoko.gateway_url', env('PAYKOKO_GATEWAY_URL'));

        $currency = 'LKR';
        $orderId = $order->order_code;
        $reference = $mId . '-' . $orderId . '-' . time();
        $pluginName = config('paykoko.plugin_name', env('PAYKOKO_PLUGIN_NAME', 'customapi'));
        $pluginVersion = config('paykoko.plugin_version', env('PAYKOKO_PLUGIN_VERSION', '1'));

        $firstName = trim($request->full_name);
        $lastName = trim($request->last_name ?? '');
        $email = trim($request->email);
        $phone = trim($request->phone);
        $description = trim('Order #' . $orderId);

        $dataString = $mId .
            $finalAmount .
            $currency .
            $pluginName .
            $pluginVersion .
            route('payment.success') .
            route('payment.cancel') .
            $orderId .
            $reference .
            $firstName .
            $lastName .
            $email .
            $phone .
            $description .
            $apiKey .
            route('koko.payment.response');

        Log::info('Koko Signature Data String: ' . $dataString);

        // RSA Signing
        $privateKeyContent = file_get_contents(storage_path('app/koko/private.pem'));
        $pkeyId = openssl_get_privatekey($privateKeyContent);
        openssl_sign($dataString, $signature, $pkeyId, OPENSSL_ALGO_SHA256);
        openssl_free_key($pkeyId);
        $signatureEncoded = base64_encode($signature);

        // Update order reference only (as amount has no markup)
        $order->update([
            'payment_reference' => $reference,
        ]);

        $fields = [
            '_mId' => $mId,
            'api_key' => $apiKey,
            '_returnUrl' => route('payment.success'),
            '_responseUrl' => route('koko.payment.response'),
            '_currency' => $currency,
            '_amount' => $finalAmount,
            '_reference' => $reference,
            '_pluginName' => $pluginName,
            '_pluginVersion' => $pluginVersion,
            '_cancelUrl' => route('payment.cancel'),
            '_orderId' => $orderId,
            '_firstName' => $firstName,
            '_lastName' => $lastName,
            '_email' => $email,
            '_mobileNo' => $phone,
            '_description' => $description,
            'signature' => $signatureEncoded,
        ];

        Log::info('Koko Payment Initiated for Order: ' . $orderId);

        return view('koko.redirect', [
            'data' => $fields,
            'url' => $gatewayUrl,
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        return redirect()->route('phone_lab.index')->with('success', 'Payment completed successfully!');
    }

    public function paymentCancel(Request $request)
    {
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
}
