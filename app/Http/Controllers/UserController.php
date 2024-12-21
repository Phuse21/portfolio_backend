<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'service' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $data = [
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'service' => $validatedData['service'],
            'message' => $validatedData['message'],
        ];

        try {
            defer(fn() => Mail::to('phusedallas@gmail.com') // The recipient email
                ->send(new ContactMail($data)));

            return response()->json(['message' => 'Question successfully sent.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send question.'], 500);
        }
    }
}