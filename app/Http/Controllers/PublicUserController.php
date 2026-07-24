<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccountMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\PublicUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class PublicUserController extends Controller
{
  public function publicLoginPage()
{
    if (Auth::guard('public_user')->check()) {
        return redirect()->route('user.dashboard');
    }

    return response()
        ->view('phone_lab.pages.user.login')
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
}



    public function goToDashboard()
    {
        $user = Auth::guard('public_user')->user();

        if (!$user) {
            return redirect()->route('user.login');
        }

        $user->load(['addresses', 'orders.items.product', 'orders.items.variant', 'orders.orderProcesses.stage']);

        $addresses = $user->addresses;
        $defaultAddress = $addresses->where('title', 'Default')->first();
        $orders = $user->orders()->latest()->get();

        return view('phone_lab.pages.user.account', compact('user', 'addresses', 'defaultAddress', 'orders'));
    }





    public function deleteAddress($id)
{
    $user = Auth::guard('public_user')->user();

    if (!$user) {
        return redirect()->route('user.login');
    }

    // Find address that belongs to this user
    $address = Address::where('id', $id)
        ->where('public_user_id', $user->id)
        ->first();

    if (!$address) {
        return redirect()->back()->with('error', 'Address not found.');
    }

    $address->delete();

    return redirect()->back()->with('success', 'Address deleted successfully.');
}





    public function AuthLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = ['email' => $request->username, 'password' => $request->password, 'status' => 'active'];

        if (Auth::guard('public_user')->attempt($credentials, $request->has('remember_user'))) {
            $request->session()->regenerate();

            $sessionId = $request->cookie('cart_session_id');
            if ($sessionId) {
                $userId = Auth::guard('public_user')->id();

                Cart::where('session_id', $sessionId)->update([
                    'public_user_id' => $userId,
                    'session_id' => null
                ]);

                Cookie::queue(Cookie::forget('cart_session_id'));
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials or your account is not verified.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:public_users,email',
            'password' => 'required|string|min:6',
            'mobile' => 'required|string|max:15',
        ]);

        $verificationToken = Str::random(64);

        $tempUser = new PublicUser([
            'name' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'verification_token' => $verificationToken,
            'status' => 'inactive',
        ]);

        $url = route('user.verify', ['token' => $verificationToken]);

        try {
            Mail::to($tempUser->email)->send(new VerifyAccountMail($tempUser, $url));
            $tempUser->save();

            return redirect()->back()->with('success', 'Registration successful! Please check your email to verify your account.');
        } catch (TransportExceptionInterface $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send verification email. Please try again later.');
        }
    }

    public function verify($token)
    {
        $user = PublicUser::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Invalid or expired verification link.');
        }

        $user->status = 'active';
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null;
        $user->save();

        return redirect()->route('user.login')->with('success', 'Your account has been verified successfully. You can now log in.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = PublicUser::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = PublicUser::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)),
                    'status' => 'active',
                    'email_verified_at' => Carbon::now(),
                ]);
            }

            Auth::guard('public_user')->login($user);
            return redirect()->route('user.dashboard');

        } catch (\Exception $e) {
            Log::error('Google Auth Failed: ' . $e->getMessage());
            return redirect()->route('user.login')->with('error', 'Something went wrong with Google Sign In.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('public_user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'full_name' => 'required|string',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        Address::create([
            'public_user_id' => Auth::guard('public_user')->id(),
            'title' => $request->title,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'district' => $request->district,
            'city' => $request->city,
            'address' => $request->address,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Address added successfully!');
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:public_users,email,' . Auth::guard('public_user')->id(),
        ]);

        $user = Auth::guard('public_user')->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.dashboard')->with('Edit_success', 'Profile updated successfully!');
    }

   public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::guard('public_user')->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('password_error', 'Current password does not match.');
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('password_success', 'Password updated successfully!');
}
}
