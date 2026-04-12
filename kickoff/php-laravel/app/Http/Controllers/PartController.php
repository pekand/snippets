<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Car;
use App\Models\Part;


class PartController extends Controller
{
    public function index()
    {
        $parts = Part::with('car')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Parts', [
            'parts' => $parts
        ]);
    }

    public function edit($id)
    {
        $part = Part::findOrFail($id);

        return Inertia::render('Part', [
            'part' => $part
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:100',
            'car_id' => 'required|exists:cars,id'
        ]);

        $part = part::create($data);

        return response()->json([
            'success' => true,
            'part_id' => $part->id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $part = Part::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:100',
            'car_id' => 'required|exists:cars,id'
        ]);

        $part->update($data);
        $part->refresh();

        $car = Car::with('parts')->find($part->car_id);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($id)
    {
        $part = Part::findOrFail($id);
        $car_id = $part->car_id;        
        $part->delete();
        $car = Car::with('parts')->find($car_id);

        return response()->json([
            'success' => true,
        ]);
    }
}
