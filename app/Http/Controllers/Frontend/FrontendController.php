<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\TableBookingMail;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;
use App\Models\TableBooking;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class FrontendController extends Controller
{
    public function index(Request $req)
    {
        $testimonial = Testimonial::get();
        $menus = Menu::get();
        $events = Event::getEvents();
        return Inertia::render('layout', [
            'canLogin' => Route::has('login'),
            'testimonials' => $testimonial,
            'menus' => $menus,
            'events' => $events,
            // 'canRegister' => Route::has('register'),
            // 'laravelVersion' => Application::VERSION,
            // 'phpVersion' => PHP_VERSION,
        ]);
    }

    public function saveBookingDtls(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
            'number_of_people' => 'required|numeric',
            'booking_datetime' => 'required',
            'event_name' => 'required',
            'special_request' => 'nullable|string',
        ]);
        $data['event_id'] = $req->event_name;
        unset($data['event_name']);
        try {
            $data = TableBooking::create($data);
            Mail::to($data->email)->send(new TableBookingMail($data));
            return redirect()->back()->with('success', 'Booking Request Sent Successfully');
        } catch (\Exception $e) {
            Log::error('Error saving booking details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function bookingRequestList()
    {
        $data = TableBooking::with('event')->orderBy('id', 'desc')->paginate(10);
        return Inertia::render('Booking/BookingRequestList', [
            'data' => $data
        ]);
    }

    public function deleteBookingreq($id){
        $booking = TableBooking::find($id);
        $booking->delete($id);
        return response()->json(['status' => 1, 'msg' => 'Deleted Successfully.']);
    }
}
