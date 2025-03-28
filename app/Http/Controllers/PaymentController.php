<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $payment = Payment::create($request->validate([
            'bill_id' => 'required|exists:bills,id',
            'user_id' => 'required|exists:users,id',
            'amount_paid' => 'required|numeric',
        ]));
        return response()->json($payment, 201);
    }
}
