<?php

namespace App\Http\Controllers;

use App\Enums\AttachmentType;
use App\Enums\UserRole;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::where('id', '!=', auth()->user()->id)->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', [
            'customers' => Customer::whereNull('user_id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only(['name', 'email', 'password', 'role']));

        if ($user->role === UserRole::Customer && $request->anyFilled(['customer_identity_number', 'customer_phone_number', 'customer_address'])) {
            $user->customer()->create([
                'name' => $request->input('name'),
                'identity_number' => $request->input('customer_identity_number'),
                'phone_number' => $request->input('customer_phone_number'),
                'address' => $request->input('customer_address'),
            ]);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = $request->file('avatar')->store('user-avatar', 'public');

            $user->avatar()->create([
                'content' => $path,
                'type' => AttachmentType::Image,
            ]);
        }

        return redirect()->route('admin.users.edit', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'role']));

        if ($request->filled('password') && str($request->input('password'))->isNotEmpty()) {
            $user->update($request->only(['password']));
        }

        if ($user->customer && $user->customer->name != $user->name) {
            $user->customer->update(['name' => $user->name]);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $oldPath = $user->avatar ? $user->avatar->content : null;
            $path = $request->file('avatar')->store('user-avatar', 'public');

            $user->avatar()->create([
                'content' => $path,
                'type' => AttachmentType::Image,
            ]);

            if ($oldPath && Storage::disk('public')->fileExists($oldPath)) {
                $user->avatar->delete();

                Storage::disk('public')->delete($oldPath);
            }
        }

        return redirect()->route('admin.users.edit', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $avatarPath = $user->avatar ? $user->avatar->content : null;

        $user->delete();

        if ($avatarPath && Storage::disk('public')->fileExists($avatarPath)) {
            $user->avatar->delete();

            Storage::disk('public')->delete($avatarPath);
        }

        return redirect()->route('admin.users.index');
    }
}
