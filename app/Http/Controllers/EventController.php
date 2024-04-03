<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $event = event::all();

        return view('event.index')
        ->with('event_objects', $event);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeventRequest $request)
    {
        $name = $request->input('name');
        // $payment_id = $request->input('payment_id');

        $event = new event;
        $event->name = $name;
        // $event->payment_id = $payment_id;
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
           $event_raw = event::where('id', $id)
            ->get();

        if (count($event_raw) > 0 && isset($event_raw[0])) {
            $event_obj = $event_raw[0];
            return view('event.show', ['event' => $event_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $event_raw = event::where('id', $id)
            ->get();

        if (count($event_raw) > 0 && isset($event_raw[0])) {
            $event_obj = $event_raw[0];
            return view('event.edit', ['event' => $event_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeventRequest $request, string $id)
    {
        $name = $request->input('name');
        // $payment_id = $request->input('payment_id');

        $event = event::find($id);
        $event->name = $name;
        // $event->payment_id = $payment_id;
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $event = event::find($id);
        $event->delete();

        return redirect()->route('event.index');
    }
}
