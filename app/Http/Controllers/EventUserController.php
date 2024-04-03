<?php

namespace App\Http\Controllers;

use App\Models\event_user;
use App\Http\Requests\Storeevent_userRequest;
use App\Http\Requests\Updateevent_userRequest;

class EventUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event_user = event_user::all();

        return view('event_user.index')
        ->with('event_user_objects', $event_user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event_user.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeevent_userRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $role = $request->input('role');

        $event_user = new event_user;
        $event_user->name = $name;
        $event_user->email = $email;
        $event_user->username = $username;
        $event_user->password = $password;
        $event_user->role = $role;
        $event_user->save();

        return redirect()->route('event_user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $event_user_raw = event_user::where('id', $id)
            ->get();

        if (count($event_user_raw) > 0 && isset($event_user_raw[0])) {
            $event_user_obj = $event_user_raw[0];
            return view('event_user.show', ['event_user' => $event_user_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $event_user_raw = event_user::where('id', $id)
            ->get();

        if (count($event_user_raw) > 0 && isset($event_user_raw[0])) {
            $event_user_obj = $event_user_raw[0];
            return view('event_user.edit', ['event_user' => $event_user_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateevent_userRequest $request, string $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $role = $request->input('role');

        $event_user = event_user::find($id);
        $event_user->name = $name;
        $event_user->email = $email;
        $event_user->username = $username;
        $event_user->password = $password;
        $event_user->role = $role;
        $event_user->save();

        return redirect()->route('event_user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $event_user = event_user::find($id);
            $event_user->delete();

            return redirect()->route('event_user.index');
    }



}
