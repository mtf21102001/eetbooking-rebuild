<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        $settings = \App\Models\AboutSetting::all()->pluck('value', 'key');
        $partners = \App\Models\Partner::all();
        $teamMembers = \App\Models\TeamMember::orderBy('display_order')->get();

        return view('about', compact('settings', 'partners', 'teamMembers'));
    }

    public function index()
    {
        // 1. Recommended Destinations (is_recommended = true)
        $recommendedDestinations = Destination::where('is_recommended', true)
            ->with(['city.country'])
            ->latest()
            ->take(8)
            ->get();

        // 2. Trends (offer_tag = 'Trending' or is_offer = true)
        // Grouping the OR condition to ensure is_active applies to both
        $trends = Package::where('is_active', true)
            ->where(function ($query) {
                $query->where('offer_tag', 'Trending')
                    ->orWhere('is_offer', true);
            })
            ->with(['translations', 'media', 'destination.city'])
            ->latest()
            ->take(3)
            ->get();

        // 3. Popular (is_popular = true)
        $popularPackages = Package::where('is_active', true)
            ->where('is_popular', true)
            ->with(['translations', 'media', 'destination.city'])
            ->latest()
            ->take(3)
            ->get();

        // 4. Features (featured = true)
        $featuredPackages = Package::where('is_active', true)
            ->where('featured', true)
            ->with(['translations', 'media', 'destination.city'])
            ->latest()
            ->take(3)
            ->get();

        // 5. Special Offers (for the "Special Upcoming Offers" section)
        $offers = Package::where('is_active', true)
            ->where('is_offer', true)
            ->with(['translations', 'media', 'destination.city'])
            ->latest()
            ->take(4)
            ->get();

        // Dynamic Filtering Data
        $types = Package::whereNotNull('type')->distinct()->pluck('type');
        $durations = Package::select('duration_days')->distinct()->orderBy('duration_days')->pluck('duration_days');

        return view('welcome', compact(
            'recommendedDestinations',
            'trends',
            'popularPackages',
            'featuredPackages',
            'offers',
            'types',
            'durations'
        ));
    }
}
