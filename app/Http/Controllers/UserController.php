<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\UserRequest;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Dispatch welcome email job
        SendWelcomeEmail::dispatch($user);

        // return response()->json([
        //     'message' => 'User created successfully',
        //     'user' => $user
        // ], 201);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        // return response()->json([
        //     'message' => 'User updated successfully',
        //     'user' => $user
        // ]);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        // return response()->json([
        //     'message' => 'User deleted successfully'
        // ]);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
