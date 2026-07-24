<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // validate email
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        // save email
        Newsletter::create([
            'email' => $request->email,
        ]);

         return redirect()->back()->with('success_newsletter', 'Subscribed successfully!');
    }
}