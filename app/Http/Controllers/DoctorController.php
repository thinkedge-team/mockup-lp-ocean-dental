<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        // Create a cache key based on all query parameters
        $cacheKey = 'doctors.index.' . md5(serialize($request->query()));
        
        // Cache for 1 hour (3600 seconds)
        $cacheDuration = 3600;

        $data = Cache::remember($cacheKey, $cacheDuration, function () use ($request) {
            $query = TeamMember::where('is_active', true);

            // Search by name
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where('name', 'like', '%' . $search . '%');
            }

            // Filter by badge
            if ($request->filled('badge') && $request->badge !== 'all') {
                $query->where('badge', $request->badge);
            }

            // Filter by position
            if ($request->filled('position')) {
                $query->where('position', $request->position);
            }

            // Sorting
            $sort = $request->input('sort', 'default_order');
            switch ($sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'experience_desc':
                    $query->orderBy('years_of_experience', 'desc');
                    break;
                default:
                    $query->orderBy('order', 'asc');
                    break;
            }

            // Get all unique positions for filter dropdown
            $positions = TeamMember::where('is_active', true)
                ->select('position')
                ->distinct()
                ->orderBy('position')
                ->pluck('position');

            // Paginate (8 per page)
            $doctors = $query->paginate(8)->withQueryString();

            return compact('doctors', 'positions');
        });

        return view('doctors.index', $data);
    }
}
