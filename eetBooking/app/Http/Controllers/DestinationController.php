<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of all countries/destinations.
     */
    public function index()
    {
        $countries = Country::with('cities.destinations')->where('is_active', true)->get();
        $featured_destinations = Destination::where('is_featured', true)->take(6)->get();

        return view('destinations.index', compact('countries', 'featured_destinations'));
    }

    /**
     * Display packages for a specific destination.
     */
    public function show(Destination $destination)
    {
        $packages = Package::where('is_active', true)
            ->whereHas('destinations', function ($query) use ($destination) {
                $query->where('destinations.id', $destination->id);
            })
            ->latest()
            ->paginate(9);

        return view('destinations.show', compact('destination', 'packages'));
    }

    /**
     * Display packages for a specific city.
     */
    public function city(City $city)
    {
        $packages = Package::where('is_active', true)
            ->where('city_id', $city->id)
            ->latest()
            ->paginate(9);

        return view('destinations.city', compact('city', 'packages'));
    }
}
