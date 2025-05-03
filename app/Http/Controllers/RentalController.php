<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $rentals = Rental::with(['car', 'customer', 'user'])
            ->when($request->search, function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->whereHas('car', fn($q) => $q->where('model', 'like', "%{$request->search}%")
                        ->orWhere('license_plate', 'like', "%{$request->search}%"))
                    ->orWhereHas('customer', fn($q) => $q->where('first_name', 'like', "%{$request->search}%")
                        ->orWhere('last_name', 'like', "%{$request->search}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        return view('rentals.create', [
            'cars' => Car::available()->get(),
            'customers' => Customer::orderBy('last_name')->get()
        ]);
    }

    public function store(RentalRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        $car = Car::findOrFail($data['car_id']);
        $data['total_amount'] = $this->calculateRentalCost(
            $data['start_date'],
            $data['end_date'],
            $car->daily_rate
        );

        $rental = Rental::create($data);
        $car->update(['available' => false]);

        return redirect()->route('rentals.index')
            ->with('success', 'Rental created successfully.');
    }

    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        return view('rentals.edit', [
            'rental' => $rental,
            'cars' => Car::all(),
            'customers' => Customer::orderBy('last_name')->get()
        ]);
    }

    public function update(RentalRequest $request, Rental $rental)
    {
        $data = $request->validated();
        
        $car = Car::findOrFail($data['car_id']);
        $data['total_amount'] = $this->calculateRentalCost(
            $data['start_date'],
            $data['end_date'],
            $car->daily_rate
        );

        $rental->update($data);

        return redirect()->route('rentals.index')
            ->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        $rental->car()->update(['available' => true]);
        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Rental deleted successfully.');
    }

    public function return(Rental $rental)
    {
        $rental->update([
            'status' => 'completed',
            'end_date' => now(),
            'actual_return_date' => now()
        ]);

        $rental->car()->update(['available' => true]);

        return redirect()->route('rentals.index')
            ->with('success', 'Car returned successfully.');
    }

    protected function calculateRentalCost($startDate, $endDate, $dailyRate)
    {
        $days = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
        return $days * $dailyRate;
    }
}