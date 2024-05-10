<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return response()->json($branches);
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return response()->json($branch);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $branch = Branch::create($validatedData);
        return response()->json($branch, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($validatedData);

        return response()->json($branch, 200);
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return response()->json(null, 204);
    }
}
