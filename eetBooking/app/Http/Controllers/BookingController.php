<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $package = null;
        if ($request->has('package_id')) {
            $package = Package::findOrFail($request->package_id);
        }

        return view('bookings.create', compact('package'));
    }

    public function store(Request $request)
    {
        Log::info('Booking attempt started', $request->all());

        try {
            $validated = $request->validate([
                'package_id' => 'required|exists:packages_refactored,id',
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|string|max:20',
                'travel_date' => 'required|date|after:today',
                'number_of_travelers' => 'required|integer|min:1',
                'notes' => 'nullable|string',
            ]);

            $package = Package::findOrFail($validated['package_id']);

            // Calculate total (simple version: price * travelers)
            $totalPrice = $package->price * $validated['number_of_travelers'];

            $booking = DB::transaction(function () use ($validated, $totalPrice) {
                return Booking::create([
                    'user_id' => Auth::id(), // Nullable if guest
                    'package_id' => $validated['package_id'],
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'travel_date' => $validated['travel_date'],
                    'number_of_travelers' => $validated['number_of_travelers'],
                    'total_price' => $totalPrice,
                    'status' => 'pending',
                    'notes' => $validated['notes'],
                ]);
            });

            Log::info('Booking created successfully', ['id' => $booking->id]);
            return redirect()->route('bookings.success', $booking->id);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Booking validation failed', $e->errors());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Booking failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Something went wrong! Please try again later. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.success', compact('booking'));
    }
}
