<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'image' => 'required|image|max:4096',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'contact' => 'required|string|max:15',

        ]);

        $imagePath = $request->file('image')->store('users', 'public');


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->profile = $request->file('image')->store('users', 'public');
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->contact = $request->contact;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required|string',
            'profile' => 'nullable|image|max:4096',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'contact' => 'required|string|max:15',

        ]);

        if ($request->has('image')) {
            if ($user->profile) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
            $user->profile = $imagePath;
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        if ($request->hasFile('image')) {
            $user->profile = $request->file('image')->store('users', 'public');
        }
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->contact = $request->contact;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User Updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->profile) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "User Deleted Successfully");
    }


}
