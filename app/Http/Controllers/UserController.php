<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = user::all();

        return view('user.index')
        ->with('user_objects', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreuserRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        // $role = $request->input('role');

        $user = new user;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        // $user->role = $role;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $user_raw = user::where('id', $id)
            ->get();

        if (count($user_raw) > 0 && isset($user_raw[0])) {
            $user_obj = $user_raw[0];
            return view('user.show', ['user' => $user_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $user_raw = user::where('id', $id)
            ->get();

        if (count($user_raw) > 0 && isset($user_raw[0])) {
            $user_obj = $user_raw[0];
            return view('user.edit', ['user' => $user_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateuserRequest $request, string $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        // $role = $request->input('role');

        $user = user::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        // $user->role = $role;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $user = user::find($id);
            $user->delete();

            return redirect()->route('user.index');
    }



}
