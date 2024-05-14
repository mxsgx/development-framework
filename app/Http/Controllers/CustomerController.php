<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customer.index', [
            'customers' => Customer::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create', [
            'users' => User::whereRole(UserRole::Customer)->doesntHave('customer')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $user = User::find($request->input('user_id'));

        if (!$request->boolean('create_user') && $user && $user->role !== UserRole::Customer) {
            throw ValidationException::withMessages([
                'user_id' => ['User must have customer role'],
            ]);
        }

        if (!$request->boolean('create_user') && $user && $user->customer) {
            throw ValidationException::withMessages([
                'user_id' => ['User already have customer data'],
            ]);
        }

        if ($request->boolean('create_user')) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('user_email'),
                'password' => $request->input('user_password'),
                'role' => UserRole::Customer,
            ]);
        }

        $customer = Customer::create($request->only(['name', 'phone_number', 'identity_number', 'address']));

        if ($user) {
            $customer->user()->associate($user);

            $customer->save();
        }

        return redirect()->route('admin.customers.edit', ['customer' => $customer]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', [
            'customer' => $customer,
            'users' => User::whereRole(UserRole::Customer)->doesntHave('customer')->orWhereHas('customer', function (Builder $query) use ($customer) {
                $query->where('id', '=', $customer->id);
            })->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        if ($customer->phone_number != $request->input('phone_number') && Customer::wherePhoneNumber($request->input('phone_number'))->exists()) {
            throw ValidationException::withMessages([
                'phone_number' => [__('The phone number has already been taken.')],
            ]);
        }

        $customer->update($request->validated());

        $customer->user()->associate($request->input('user_id'));

        $customer->save();

        if ($customer->user() && $customer->user->name != $request->input('name')) {
            $customer->user()->update([
                'name' => $request->input('name'),
            ]);
        }

        return redirect()->route('admin.customers.edit', ['customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index');
    }
}
