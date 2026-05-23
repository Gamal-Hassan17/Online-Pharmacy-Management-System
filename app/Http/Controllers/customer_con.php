<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use Illuminate\Http\Request;

class customer_con extends Controller
{
    public function create_customer(){

        return view('customers.create_customer');
    }
    public function show_customer(){
        $show_customers = Customer::all();
        return view('customers.show_customer',compact('show_customers'));
    }
    public function store_customer(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|numeric|min:11',
        'address' => 'required',
        'email'    => 'required|email|unique:customers,email',
        'password' => 'nullable|min:6|confirmed',
    ]);

    Customer::create([
        'username' => $validated['name'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'password' => $validated['password'], // يفضل تعمل تشفير
        'address' => $validated['address'],
    ]);

    return to_route('show_customer');
}

public function edit_customer($id) {
    $customer = Customer::findOrFail($id);
    return view('customers.edit_customer', ['customer' => $customer]);
}


public function update_customer(Request $request) {
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'phone' => 'required|numeric|min:11',
        'address' => 'required',
        'email'    => 'required|email|unique:customers,email,' ,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $customer = Customer::findOrFail($request->id);

    $customer->update($validated);





    return redirect()->route('show_customer')->with('success', 'customer updated successfully!');
}
public function delete_customer($id) {
    $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect()->route('show_customer')->with('success', 'customer deleted successfully!');
}

}
