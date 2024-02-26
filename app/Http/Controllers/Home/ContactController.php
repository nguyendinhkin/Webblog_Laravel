<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Contact()
    {
        return view('fontend/contact');
    }

    public function StoreContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Not Correct Email Format',
            'subject.required' => 'Subject is required',
            'phone.required' => 'Phone is required',
            'message.required' => 'Message is required'
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Send Message Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function ContactAll()
    {
        $contactall = Contact::latest()->get();
        return view('admin.contact.contactall', compact('contactall'));
    }

    public function DeleteContact($id)
    {
        Contact::findOrFail($id)->delete();

        $notification = [
            'message' => 'Delete Contact Message Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
