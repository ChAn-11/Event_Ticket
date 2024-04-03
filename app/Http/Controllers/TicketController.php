<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Http\Requests\StoreticketRequest;
use App\Http\Requests\UpdateticketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = ticket::all();

        return view('ticket.index')
        ->with('ticket_objects', $ticket);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreticketRequest $request)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $event_id = $request->input('event_id');
        $venue_id = $request->input('venue_id');

        // DB::insert('insert into students (name,college_id) values (?,?)', [$name, $college_id]);

        // Create / Insert new student
        $ticket = new ticket;
        $ticket->name = $name;
        $ticket->category = $category;
        $ticket->event_id = $event_id;
        $ticket->venue_id = $venue_id;
        $ticket->save();


        return redirect()->route('ticket.index');
    }

    public function show(string $id)
    {
         $ticket_raw = ticket::where('id', $id)
            ->get();

        if (count($ticket_raw) > 0 && isset($ticket_raw[0])) {
            $ticket_obj = $ticket_raw[0];
            return view('ticket.show', ['ticket' => $ticket_obj]);
        } else {
            abort(404);
        }
    }

    public function edit(string $id)
    {
         $ticket_raw = ticket::where('id', $id)->get();

        if (count($ticket_raw) > 0 && isset($ticket_raw[0])) {
            $ticket_obj = $ticket_raw[0];
            return view('ticket.edit', ['ticket' => $ticket_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateticketRequest $request, string $id)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $event_id = $request->input('event_id');
        $venue_id = $request->input('venue_id');

        // DB::update('update students set name = ? where id = ?', [$name, $id]);

        // Update existing student
        $ticket = ticket::find($id);
        $ticket->name = $name;
        $ticket->category = $category;
        $ticket->event_id = $event_id;
        $ticket->venue_id = $venue_id;
        $ticket->save();

        // echo "Record updated succiessfully.<br/>";
        // echo '<a href="/student">Click Here</a> to go back.';
        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $ticket = ticket::find($id);
        $ticket->delete();

        // echo "Record deleted successfully.<br/>";
        // echo '<a href="/student">Click Here</a> to go back.';
        return redirect()->route('ticket.index');
    }
}
