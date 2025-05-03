<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarType;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $cars = Car::with(['brand', 'carType'])
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('model', 'like', "%$search%")
                      ->orWhere('license_plate', 'like', "%$search%")
                      ->orWhereHas('brand', fn($q) => $q->where('name', 'like', "%$search%"));
                });
            })
            ->when($status, fn($query) => $query->where('available', $status === 'available'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create', [
            'brands' => Brand::orderBy('name')->get(),
            'carTypes' => CarType::orderBy('name')->get()
        ]);
    }

    public function store(CarRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()->route('cars.index')
            ->with('success', 'Car added successfully.');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', [
            'car' => $car,
            'brands' => Brand::orderBy('name')->get(),
            'carTypes' => CarType::orderBy('name')->get()
        ]);
    }

    public function update(CarRequest $request, Car $car)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}