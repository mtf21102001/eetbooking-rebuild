<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use App\Models\Nationality;
use App\Models\VisaRequirement;
use App\Models\VisaApplication;
use App\Models\Destination;
use Illuminate\Http\Request;

class VisaController extends Controller
{
    public function index(Request $request)
    {
        $query = Visa::where('active', true);

        if ($request->has('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        $visas = $query->with('destination')->get();
        $destinations = Destination::whereHas('visas')->get();
        $nationalities = Nationality::where('active', true)->orderBy('name')->get();

        return view('visas.index', compact('visas', 'destinations', 'nationalities'));
    }

    public function show(Visa $visa, Request $request)
    {
        $nationalityId = $request->query('nationality_id');
        $requirement = null;

        if ($nationalityId) {
            $requirement = VisaRequirement::where('visa_id', $visa->id)
                ->where('nationality_id', $nationalityId)
                ->first();
        }

        return view('visas.show', compact('visa', 'requirement'));
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'visa_id' => 'required|exists:visas,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255',
            'passport_expiry' => 'required|date',
            'occupation' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|integer',
        ]);

        $data = $validated;
        $data['user_id'] = \Illuminate\Support\Facades\Auth::id();
        $application = VisaApplication::create($data);

        return redirect()->back()->with('success', 'Your visa application has been submitted successfully. Reference: ' . $application->application_reference);
    }
}
