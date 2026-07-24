<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('mobile', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%");
        }

        $customers = $query->latest()->paginate(25);
        return view('admin.pages.customers.index', compact('customers'));
    }

    public function addCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:customers,mobile',
            'email' => 'nullable|email',
            'nic' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::create($request->all());
        return response()->json(['success' => true, 'customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'nic' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json(['success' => true]);
    }
}
