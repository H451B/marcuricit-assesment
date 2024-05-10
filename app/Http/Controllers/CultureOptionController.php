<?php

namespace App\Http\Controllers;

use App\Models\Culture\CultureOption;
use Illuminate\Http\Request;

class CultureOptionController extends Controller
{
    public function index()
    {
        $cultureOptions = CultureOption::all();
        return response()->json($cultureOptions);
    }

    public function show($id)
    {
        $cultureOption = CultureOption::findOrFail($id);
        return response()->json($cultureOption);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'options' => 'nullable|array',
        ]);

        $cultureOption = CultureOption::create($validatedData);
        return response()->json($cultureOption, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'options' => 'nullable|array',
        ]);

        $cultureOption = CultureOption::findOrFail($id);
        $cultureOption->update($validatedData);

        return response()->json($cultureOption, 200);
    }

    public function destroy($id)
    {
        $cultureOption = CultureOption::findOrFail($id);
        $cultureOption->delete();

        return response()->json(null, 204);
    }
}
