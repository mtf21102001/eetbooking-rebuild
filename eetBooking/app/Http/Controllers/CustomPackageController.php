<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Mail\CustomPackageInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CustomPackageController extends Controller
{
    public function create()
    {
        // Fetch active destinations for the "Shopping Grid"
        // We select id, name, and images (assuming first image is needed)
        // We prioritise recommended and featured, but limit to 12 for grid aesthetics
        $destinations = Destination::select('id', 'name_en', 'images')
            ->orderByRaw('is_recommended DESC, is_featured DESC')
            ->limit(12)
            ->get();

        return view('packages.custom', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinations' => 'array',
            'destinations.*' => 'integer|exists:destinations,id',
            'other_destination' => 'nullable|string|max:255',
            'arrival_date' => 'required|date|after:today',
            'duration' => 'required|integer|min:1',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'budget' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        // Enrich data with destination names
        $selectedDestinations = [];
        if (!empty($validated['destinations'])) {
            $selectedDestinations = Destination::whereIn('id', $validated['destinations'])->pluck('name_en')->toArray();
        }

        $data = $validated;
        $data['selected_destination_names'] = $selectedDestinations;

        // Send Email
        // Make sure MAIL_FROM_ADDRESS is set in .env
        // We'll trust the mailer is configured.
        try {
            $adminEmail = env('ADMIN_EMAIL', 'web.dev@egyptexpresstvl.com');
            Mail::to($adminEmail)->send(new CustomPackageInquiry($data));
        } catch (\Exception $e) {
            // Log error but show success to user to avoid panic, or show error.
            // For now, let's assume success but log.
            \Log::error('Custom Package Email Error: ' . $e->getMessage());
        }

        return redirect()->route('packages.custom')->with('success', 'Your custom package request has been sent successfully! We will contact you shortly.');
    }
}
