<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = payment::all();

        return view('payment.index')
        ->with('payment_objects', $payment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentRequest $request)
    {
        $paymenttype = $request->input('paymenttype');
        $paymentamount = $request->input('paymentamount');
        $order_no = $request->input('order_no');

        $payment = new payment;
        $payment->paymenttype = $paymenttype;
        $payment->paymentamount = $paymentamount;
        $payment->order_no = $order_no;
        $payment->save();

        return redirect()->route('payment.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $payment_raw = payment::where('id', $id)
            ->get();

        if (count($payment_raw) > 0 && isset($payment_raw[0])) {
            $payment_obj = $payment_raw[0];
            return view('payment.show', ['payment' => $payment_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $payment_raw = payment::where('id', $id)
            ->get();

        if (count($payment_raw) > 0 && isset($payment_raw[0])) {
            $payment_obj = $payment_raw[0];
            return view('payment.edit', ['payment' => $payment_obj]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentRequest $request, string $id)
    {
        $paymenttype = $request->input('paymenttype');
        $paymentamount = $request->input('paymentamount');
        $order_no = $request->input('order_no');

        $payment = payment::find($id);
        $payment->paymenttype = $paymenttype;
        $payment->paymentamount = $paymentamount;
        $payment->order_no = $order_no;
        $payment->save();

        return redirect()->route('payment.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = payment::find($id);
        $payment->delete();

        return redirect()->route('payment.index');

    }
}
