<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->has('status') && $request->status !== '') {
            $isActive = $request->status === 'active' ? true : false;
            $query->where('is_active', $isActive);
        }

        $customers = $query->paginate(10);
        
        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load('appointments');
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'contact_num' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $customer->update($data);

        return redirect()->route('admin.customers.show', $customer)->with('success', 'Customer updated successfully.');
    }

    public function toggleActive(Customer $customer)
    {
        $customer->update(['is_active' => !$customer->is_active]);
        
        return response()->json(['is_active' => $customer->is_active]);
    }
}
