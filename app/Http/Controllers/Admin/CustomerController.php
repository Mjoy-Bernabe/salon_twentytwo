<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('active')) {
            if ($request->active === 'active') {
                $query->where('active', true);
            } elseif ($request->active === 'inactive') {
                $query->where('active', false);
            }
        }

        $customers = $query->withCount('appointments')->paginate(10)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['appointments.stylist', 'appointments.services']);

        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_num' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', Rule::unique('customers')->ignore($customer->id)],
            'active' => ['required', 'boolean'],
        ]);

        $customer->update($data);

        return redirect()->route('admin.customers.edit', $customer)->with('success', 'Customer updated successfully.');
    }

    public function toggleActive(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'active' => ['required', 'boolean'],
        ]);

        $customer->update(['active' => $data['active']]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer status updated.');
    }
}
