<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        return response()->json(Bill::with('participants', 'payments')->get());
    }

    public function store(Request $request)
    {
        $bill = Bill::create($request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
        ]));
        return response()->json($bill, 201);
    }

    public function show(Bill $bill)
    {
        return response()->json($bill->load('participants', 'payments'));
    }

    public function update(Request $request, Bill $bill)
    {
        $bill->update($request->validate([
            'title' => 'sometimes|string|max:255',
            'total_amount' => 'sometimes|numeric',
            'status' => 'sometimes|in:pending,paid',
        ]));
        return response()->json($bill);
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return response()->json(null, 204);
    }
}

