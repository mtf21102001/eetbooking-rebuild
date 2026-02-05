<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        return view('flights.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
            'class_preference' => 'required|string|in:economy,business,first',
            'notes' => 'nullable|string',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();
        $booking = FlightBooking::create($data);

        return redirect()->route('flights.success', $booking->booking_reference);
    }

    public function success($reference)
    {
        if (\Illuminate\Support\Str::startsWith($reference, 'TRF-')) {
            $booking = \App\Models\TransferBooking::where('booking_reference', $reference)->firstOrFail();
            $isTransfer = true;
        } else {
            $booking = FlightBooking::where('booking_reference', $reference)->firstOrFail();
            $isTransfer = false;
        }

        return view('flights.success', compact('booking', 'isTransfer'));
    }

    public function transfers()
    {
        return view('transfers.index');
    }

    public function storeTransfer(Request $request)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_date' => 'required|date|after_or_equal:today',
            'passengers' => 'required|integer|min:1',
            'vehicle_type' => 'nullable|string',
            // Simple guest info for now
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();
        $booking = \App\Models\TransferBooking::create($data);

        // Redirect to a success page or back with message
        // For now using the same flight success page or a generic one
        // Ideally we should have a transfer specific success page
        return redirect()->route('flights.success', $booking->booking_reference)->with('success', 'Transfer request submitted successfully!');
    }
}
