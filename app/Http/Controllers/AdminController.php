<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with statistics
     */
    public function dashboard()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('available', true)->count(),
            'active_rentals' => Rental::where('status', 'active')->count(),
            'total_customers' => Customer::count(),
            'revenue' => Rental::where('status', 'completed')->sum('total_amount')
        ];

        $recentRentals = Rental::with(['car', 'customer'])
            ->latest()
            ->take(5)
            ->get();

        $carStatus = Car::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRentals', 'carStatus'));
    }

    /**
     * Display system settings form
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Update system settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'daily_rate_default' => 'required|numeric|min:0',
            'rental_tax_rate' => 'required|numeric|min:0|max:100',
            'min_rental_days' => 'required|integer|min:1'
        ]);

        // Update settings in database or config
        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return back()->with('success', 'Settings updated successfully');
    }

    /**
     * Display user management
     */
    public function users()
    {
        $users = User::withCount(['rentals'])
            ->orderBy('name')
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    /**
     * Generate reports
     */
    public function reports()
    {
        $startDate = now()->subMonth();
        $endDate = now();

        $reportData = [
            'monthlyRevenue' => Rental::completed()
                ->whereBetween('end_date', [$startDate, $endDate])
                ->sum('total_amount'),
            'popularCars' => Rental::select('car_id', DB::raw('count(*) as rentals_count'))
                ->with('car')
                ->groupBy('car_id')
                ->orderByDesc('rentals_count')
                ->take(5)
                ->get()
        ];

        return view('admin.reports', compact('reportData', 'startDate', 'endDate'));
    }
}