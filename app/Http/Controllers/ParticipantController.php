<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function store(Request $request)
    {
        $participant = Participant::create($request->validate([
            'bill_id' => 'required|exists:bills,id',
            'email' => 'required|email',
            'amount_due' => 'required|numeric',
        ]));
        return response()->json($participant, 201);
    }
}
