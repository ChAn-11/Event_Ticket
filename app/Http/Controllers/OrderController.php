<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $order = order::all();
         $order = DB::select('select O.*, T.name As name, T.category As category
                                from orders As O
                                Join tickets as T
                                ON O.ticket_id = T.id;');

        return view('order.index')
        ->with('order_objects', $order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreorderRequest $request)
    {
        $order_date = $request->input('order_date');
        $payment_id = $request->input('payment_id');
        $ticket_id = $request->input('ticket_id');
        $ticket_qty = $request->input('ticket_qty');

        $order = new order;
        $order->order_date = $order_date;
        $order->payment_id = $payment_id;
        $order->ticket_id = $ticket_id;
        $order->ticket_qty = $ticket_qty;
        $order->save();

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $order_raw = order::where('id', $id)
            ->get();

        if (count($order_raw) > 0 && isset($order_raw[0])) {
            $order_obj = $order_raw[0];
            return view('order.show', ['order' => $order_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $order_raw = order::where('id', $id)
            ->get();

        if (count($order_raw) > 0 && isset($order_raw[0])) {
            $order_obj = $order_raw[0];
            return view('order.edit', ['order' => $order_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateorderRequest $request, string $id)
    {
        $order_date = $request->input('order_date');
        $payment_id = $request->input('payment_id');
        $ticket_id = $request->input('ticket_id');
        $ticket_qty = $request->input('ticket_qty');

        $order = order::find($id);
        $order->order_date = $order_date;
        $order->payment_id = $payment_id;
        $order->ticket_id = $ticket_id;
        $order->ticket_qty = $ticket_qty;
        $order->save();

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = order::find($id);
        $order->delete();

        return redirect()->route('order.index');
    }
}
