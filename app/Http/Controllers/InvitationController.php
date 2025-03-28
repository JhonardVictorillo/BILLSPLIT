<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        $invitation = Invitation::create($request->validate([
            'bill_id' => 'required|exists:bills,id',
            'email' => 'required|email',
            'token' => 'required|unique:invitations,token',
        ]));
        return response()->json($invitation, 201);
    }
}
