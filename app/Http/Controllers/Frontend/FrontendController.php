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
use App\Http\Controllers\Payment\PaymentController;
use App\Models\Resturant;

class FrontendController extends Controller
{
    public $payment = '';
    public function __construct()
    {
        $this->payment = new PaymentController();
    }
    public function index(Request $req)
    {
        $testimonial = Testimonial::get();
        $resturant = Resturant::where('resturant_id',1)->with(['images','user'])->get();
        $menus = Menu::get();
        $events = Event::getEvents();
        return Inertia::render('layout', [
            'canLogin' => Route::has('login'),
            'testimonials' => $testimonial,
            'menus' => $menus,
            'resturant' => $resturant,
            'events' => $events,
            // 'canRegister' => Route::has('register'),
            // 'laravelVersion' => Application::VERSION,
            // 'phpVersion' => PHP_VERSION,
        ]);
    }

public function saveBookingDtls(Request $req)
{

    $validated = $req->validate([
        'name' => 'required',
        'email' => 'required|email',
        'contact_no' => 'required',
        'number_of_people' => 'required|numeric',
        'booking_datetime' => 'required',
        'event_name' => 'required',
        'special_request' => 'nullable|string',
    ]);

    $validated['event_id'] = $req->event_name;
    unset($validated['event_name']);

    try {
        $booking = TableBooking::create($validated);
        $res = $this->payment->order($booking);
        $booking->update([
            'session_id' => $res['session_id'],
        ]);

        $booking->payment_url = $res['url'];
        Mail::to($booking->email)->send(new TableBookingMail($booking));

        return redirect()->back()->with('success', 'Booking Request Sent Successfully');
    } catch (\Exception $e) {
        Log::error('Error saving booking details: ' . $e);
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


    public function bookingRequestList(Request $req){

        $query = TableBooking::with('event')->orderBy('id', 'desc');
        if($req->has('search') && !empty($req->search)){
            $search = $req->search;
            $query->where(function($q) use ($search){
                $q->where('name','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%")
                  ->orWhere('contact_no','like',"%{$search}%");
            });
        }
        $data = $query->paginate(10);
        return Inertia::render('Booking/BookingRequestList', [
            'data' => $data
        ]);
    }

    public function deleteBookingreq($id){
        $booking = TableBooking::find($id);
        $booking->delete($id);
        return response()->json(['status' => 1, 'msg' => 'Deleted Successfully.']);
    }

    public function bookingpayment_statuschange($booking_id){
        $data=TableBooking::find($booking_id);
        $data->payment_status='paid';
        $data->save();
        return response()->json(['status'=>1]);
    }
}
