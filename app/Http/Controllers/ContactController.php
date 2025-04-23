<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('user.contactus');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);
       return back()->with('success', 'Message sent successfully!');
    }

    // public function index()
    // {
    //     $contacts = Contact::latest()->get();
    //     return view('admin.contacts', compact('contacts'));
    // }
}

