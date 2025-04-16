<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;


class MailController extends Controller
{
  public function sendWelcomeEmail(Request $request)
  {
      $user = User::find($request->user_id); // Assuming you're passing `user_id` in the request
  
      if (!$user) {
          return response()->json(['error' => 'User not found'], 404);
      }
  
      Mail::to($user->email)->send(new WelcomeEmail($user));
  
      return response()->json(['message' => 'Welcome email sent!']);
  }
}
