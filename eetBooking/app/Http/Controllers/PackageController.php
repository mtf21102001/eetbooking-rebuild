<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query()->where('is_active', true)->with(['translations', 'media', 'destination.city.country']);

        // Keyword Search (Title/Description in Translation)
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by Country
        if ($request->has('country_id') && $request->filled('country_id')) {
            $query->whereHas('destination.city', function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
        }

        // Filter by City
        if ($request->has('city_id') && $request->filled('city_id')) {
            $query->whereHas('destination', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }

        // Filter by Price Range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by Duration (Checkboxes)
        if ($request->has('duration') && is_array($request->duration)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->duration as $duration) {
                    if ($duration === 'short') { // 1-3 Days
                        $q->orWhereBetween('duration_days', [1, 3]);
                    } elseif ($duration === 'medium') { // 4-7 Days
                        $q->orWhereBetween('duration_days', [4, 7]);
                    } elseif ($duration === 'long') { // 8+ Days
                        $q->orWhere('duration_days', '>=', 8);
                    }
                }
            });
        } elseif ($request->has('nights') && $request->filled('nights')) {
            // Fallback for old single select filter
            $nights = (int) $request->nights;
            if ($nights >= 10) {
                $query->where('duration_days', '>=', 10);
            } else {
                $query->where('duration_days', $nights);
            }
        }

        // Filter by Type (Searching in Title/Description as fallback)
        if ($request->has('type') && $request->filled('type')) {
            $type = $request->type;
            $query->whereHas('translations', function ($q) use ($type) {
                $q->where('title', 'like', "%{$type}%")
                    ->orWhere('description', 'like', "%{$type}%");
            });
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest(); // Default recommended/newest
            }
        } else {
            $query->latest();
        }

        $packages = $query->paginate(9)->withQueryString();

        if ($request->ajax()) {
            return view('packages.partials.list', compact('packages'))->render();
        }

        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        $package->load(['translations', 'media', 'destination.city.country']);
        return view('packages.show', compact('package'));
    }
}
