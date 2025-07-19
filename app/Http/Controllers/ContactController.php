<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;

class ContactController extends Controller
{

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        Mail::raw("الاسم: {$validated['name']}\nالبريد: {$validated['email']}\n\nالرسالة:\n{$validated['message']}", function ($msg) use ($validated) {
            $msg->to('you@example.com')->subject('رسالة جديدة من صفحة التواصل');
        });

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح');
    }
}
