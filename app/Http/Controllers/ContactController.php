<?php
namespace App\Http\Controllers;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, Log};

class ContactController extends Controller {
    public function index() { return view('contact.index'); }
    public function send(Request $request) {
        $validated = $request->validate([
            'first_name'=>'required|string|min:2|max:50',
            'last_name' =>'required|string|min:2|max:50',
            'email'     =>'required|email|max:255',
            'subject'   =>'required|string|max:255',
            'message'   =>'required|string|min:10|max:2000',
        ],[
            'first_name.required'=>'First name is required.',
            'first_name.min'=>'First name must be at least 2 characters.',
            'last_name.required'=>'Last name is required.',
            'email.required'=>'Email is required.',
            'email.email'=>'Enter a valid email address.',
            'subject.required'=>'Subject is required.',
            'message.required'=>'Message is required.',
            'message.min'=>'Message must be at least 10 characters.',
        ]);
        try {
            Mail::to('umerahsan696@gmail.com')->send(new ContactMail($validated));
            return back()->with('success',"Your message has been sent! We'll reply within 24 hours.");
        } catch(\Exception $e) {
            Log::error('Contact email failed: '.$e->getMessage());
            return back()->withInput()->with('error','Failed to send. Please email us directly at umerahsan696@gmail.com');
        }
    }
}
