<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InTouch;
use App\Models\TableBooking;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class InTouchController extends Controller
{
    public function inTouchcreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'message' => 'required|string|max:500',
        ]);
        try {
            InTouch::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'contact_no' => $request->contact_no,
                'message' => $request->message,
            ]);
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Throwable $th) {
            Log::error('Error ::  ' . $th->getMessage());
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        }
    }

    public function bookings(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'contact_no' => 'required|string|max:15',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ]);
        try {
            TableBooking::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'number_of_people' => $request->number_of_people,
            ]);
            return redirect()->back()->with('success', 'Your booking has been made successfully!');
        } catch (\Throwable $th) {
            Log::error('Error ::  ' . $th->getMessage());
            return redirect()->back()->with('error', 'There was an error processing your booking. Please try again later.');
        }
    }

    // in touch list
    public function intouchList()
    {
        $intouch = InTouch::paginate(10);
        return Inertia::render('Admin/GetInTouch/List', ['data' => $intouch]);
    }
}
