<?php

namespace App\Http\Controllers;

use App\Models\Antibiotic;
use Illuminate\Http\Request;

class AntibioticController extends Controller
{
    public function index()
    {
        $antibiotics = Antibiotic::all();
        return response()->json($antibiotics);
    }

    public function show($id)
    {
        $antibiotic = Antibiotic::findOrFail($id);
        return response()->json($antibiotic);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'shortcut' => 'required|string',
            'commercial_name' => 'nullable|string',
        ]);

        $antibiotic = Antibiotic::create($validatedData);
        return response()->json($antibiotic, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'shortcut' => 'string',
            'commercial_name' => 'nullable|string',
        ]);

        $antibiotic = Antibiotic::findOrFail($id);
        $antibiotic->update($validatedData);

        return response()->json($antibiotic, 200);
    }

    public function destroy($id)
    {
        $antibiotic = Antibiotic::findOrFail($id);
        $antibiotic->delete();

        return response()->json(null, 204);
    }
}
