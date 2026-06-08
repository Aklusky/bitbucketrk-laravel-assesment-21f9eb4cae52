<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // Uncomment this to use the database
        //$data = Destination::all();
        // $data = $this->getHardcodedDestinations();

        // Improved query/ filtering ability
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'sort' => ['nullable', Rule::in([
                'name',
                'country',
                'region',
                'cost_level',
                'average_daily_budget',
                'annual_visitors',
            ])],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        $query = Destination::query();

        if (! empty($validated['search'])) {
            $search = $validated['search'];
            $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%")
                    ->orWhere('cost_level', 'like', "%{$search}%");
            });
        }
        $sort = $validated['sort'] ?? 'name';
        $direction = $validated['direction'] ?? 'asc';
        $perPage = $validated['per_page'] ?? 15;
        return response()->json(
            $query->orderBy($sort, $direction)->paginate($perPage)
        );
        // return response()->json(['data' => $data]);
    }
    public function show(Destination $destination): JsonResponse
    {
        return response()->json([
            'data' => $destination,
        ]);
    }
    // private function getHardcodedDestinations()
    // {
    //     return [
    //         [
    //             'name' => 'Machu Picchu',
    //             'country' => 'Peru',
    //             'region' => 'South America',
    //             'costLevel' => 'Moderate',
    //             'activities' => ['Hiking & Trekking', 'Cultural Tours', 'Photography', 'Historical Sightseeing'],
    //             'averageDailyBudget' => 150,
    //             'annualVisitors' => 1500000,
    //         ],
    //         [
    //             'name' => 'Santorini',
    //             'country' => 'Greece',
    //             'region' => 'Europe',
    //             'costLevel' => 'Premium',
    //             'activities' => ['Beach & Relaxation', 'Food & Wine Tasting', 'Photography', 'Sailing & Boating'],
    //             'averageDailyBudget' => 250,
    //             'annualVisitors' => 2000000,
    //         ],
    //         [
    //             'name' => 'Kyoto',
    //             'country' => 'Japan',
    //             'region' => 'Asia',
    //             'costLevel' => 'Moderate',
    //             'activities' => ['Cultural Tours', 'Historical Sightseeing', 'Food & Wine Tasting', 'Photography'],
    //             'averageDailyBudget' => 180,
    //             'annualVisitors' => 5300000,
    //         ],
    //         [
    //             'name' => 'Serengeti National Park',
    //             'country' => 'Tanzania',
    //             'region' => 'Africa',
    //             'costLevel' => 'Premium',
    //             'activities' => ['Wildlife Safari', 'Photography', 'Hot Air Ballooning', 'Camping'],
    //             'averageDailyBudget' => 300,
    //             'annualVisitors' => 350000,
    //         ],
    //         [
    //             'name' => 'Queenstown',
    //             'country' => 'New Zealand',
    //             'region' => 'Oceania',
    //             'costLevel' => 'Premium',
    //             'activities' => ['Adventure Sports', 'Skiing & Snowboarding', 'Hiking & Trekking', 'Paragliding'],
    //             'averageDailyBudget' => 200,
    //             'annualVisitors' => 3000000,
    //         ],
    //         [
    //             'name' => 'Reykjavik',
    //             'country' => 'Iceland',
    //             'region' => 'Europe',
    //             'costLevel' => 'Premium',
    //             'activities' => ['Hiking & Trekking', 'Hot Air Ballooning', 'Photography', 'Volcano Tours'],
    //             'averageDailyBudget' => 280,
    //             'annualVisitors' => 2300000,
    //         ],
    //         [
    //             'name' => 'Cusco',
    //             'country' => 'Peru',
    //             'region' => 'South America',
    //             'costLevel' => 'Budget',
    //             'activities' => ['Hiking & Trekking', 'Cultural Tours', 'Historical Sightseeing', 'Food & Wine Tasting'],
    //             'averageDailyBudget' => 60,
    //             'annualVisitors' => 2700000,
    //         ],
    //         [
    //             'name' => 'Bali',
    //             'country' => 'Indonesia',
    //             'region' => 'Asia',
    //             'costLevel' => 'Budget',
    //             'activities' => ['Beach & Relaxation', 'Surfing', 'Yoga & Wellness Retreats', 'Cultural Tours'],
    //             'averageDailyBudget' => 70,
    //             'annualVisitors' => 6200000,
    //         ],
    //         [
    //             'name' => 'Banff National Park',
    //             'country' => 'Canada',
    //             'region' => 'North America',
    //             'costLevel' => 'Moderate',
    //             'activities' => ['Hiking & Trekking', 'Skiing & Snowboarding', 'Kayaking & Canoeing', 'Wildlife Safari'],
    //             'averageDailyBudget' => 180,
    //             'annualVisitors' => 4000000,
    //         ],
    //         [
    //             'name' => 'Patagonia',
    //             'country' => 'Argentina',
    //             'region' => 'South America',
    //             'costLevel' => 'Premium',
    //             'activities' => ['Hiking & Trekking', 'Rock Climbing', 'Photography', 'Camping'],
    //             'averageDailyBudget' => 220,
    //             'annualVisitors' => 400000,
    //         ],
    //         [
    //             'name' => 'Marrakech',
    //             'country' => 'Morocco',
    //             'region' => 'Africa',
    //             'costLevel' => 'Budget',
    //             'activities' => ['Cultural Tours', 'Food & Wine Tasting', 'Historical Sightseeing', 'Nightlife & Entertainment'],
    //             'averageDailyBudget' => 55,
    //             'annualVisitors' => 3000000,
    //         ],
    //         [
    //             'name' => 'Dubrovnik',
    //             'country' => 'Croatia',
    //             'region' => 'Europe',
    //             'costLevel' => 'Moderate',
    //             'activities' => ['Historical Sightseeing', 'Beach & Relaxation', 'Kayaking & Canoeing', 'Food & Wine Tasting'],
    //             'averageDailyBudget' => 160,
    //             'annualVisitors' => 1400000,
    //         ],
    //         [
    //             'name' => 'Cancun',
    //             'country' => 'Mexico',
    //             'region' => 'North America',
    //             'costLevel' => 'Moderate',
    //             'activities' => ['Beach & Relaxation', 'Scuba Diving & Snorkeling', 'Nightlife & Entertainment', 'Cultural Tours'],
    //             'averageDailyBudget' => 140,
    //             'annualVisitors' => 8000000,
    //         ],
    //         [
    //             'name' => 'Phuket',
    //             'country' => 'Thailand',
    //             'region' => 'Asia',
    //             'costLevel' => 'Budget',
    //             'activities' => ['Beach & Relaxation', 'Scuba Diving & Snorkeling', 'Food & Wine Tasting', 'Nightlife & Entertainment'],
    //             'averageDailyBudget' => 80,
    //             'annualVisitors' => 9500000,
    //         ],
    //         [
    //             'name' => 'Swiss Alps',
    //             'country' => 'Switzerland',
    //             'region' => 'Europe',
    //             'costLevel' => 'Luxury',
    //             'activities' => ['Skiing & Snowboarding', 'Hiking & Trekking', 'Rock Climbing', 'Photography'],
    //             'averageDailyBudget' => 400,
    //             'annualVisitors' => 1200000,
    //         ],
    //     ];
    // }
}
