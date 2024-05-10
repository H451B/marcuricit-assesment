<?php

namespace App\Http\Controllers;

use App\Models\Culture\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function priceList()
    {
        $priceList = Culture::select('name', 'price')->get();

        return response()->json($priceList);
    }

    public function index(Request $request)
    {
        $cultures = Culture::query();

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $cultures->where('name', 'like', "%$search%")
                     ->orWhere('sample_type', 'like', "%$search%")
                     ->orWhere('price', 'like', "%$search%");
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $cultures = $cultures->paginate($perPage);

        return response()->json($cultures);
    }

    public function show($id)
    {
        $culture = Culture::findOrFail($id);
        return response()->json($culture);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'shortcut' => 'required|string',
            'sample_type' => 'required|string',
            'price' => 'required|numeric',
            'comments' => 'nullable|string',
        ]);

        $culture = Culture::create($validatedData);
        return response()->json($culture, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'shortcut' => 'string',
            'sample_type' => 'string',
            'price' => 'numeric',
            'comments' => 'nullable|string',
        ]);

        $culture = Culture::findOrFail($id);
        $culture->update($validatedData);

        return response()->json($culture, 200);
    }

    public function destroy($id)
    {
        $culture = Culture::findOrFail($id);
        $culture->delete();

        return response()->json(null, 204);
    }
}
