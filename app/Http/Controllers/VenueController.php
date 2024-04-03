<?php

namespace App\Http\Controllers;

use App\Models\venue;
use App\Http\Requests\StorevenueRequest;
use App\Http\Requests\UpdatevenueRequest;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $venue = venue::all();

        return view('venue.index')
        ->with('venue_objects', $venue);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorevenueRequest $request)
    {
         $name = $request->input('name');

        $venue = new venue;
        $venue->name = $name;
        $venue->save();

        return redirect()->route('venue.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venue_raw = venue::where('id', $id)
            ->get();

        if (count($venue_raw) > 0 && isset($venue_raw[0])) {
            $venue_obj = $venue_raw[0];
            return view('venue.show', ['venue' => $venue_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $venue_raw = venue::where('id', $id)
            ->get();

        if (count($venue_raw) > 0 && isset($venue_raw[0])) {
            $venue_obj = $venue_raw[0];
            return view('venue.edit', ['venue' => $venue_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevenueRequest $request, string $id)
    {
        $name = $request->input('name');

        $venue = venue::find($id);
        $venue->name = $name;
        $venue->save();

        return redirect()->route('venue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $venue = venue::find($id);
        $venue->delete();

        return redirect()->route('venue.index');
    }
}
