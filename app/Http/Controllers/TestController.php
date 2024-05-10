<?php

namespace App\Http\Controllers;

use App\Models\Test\Test;
use App\Models\Test\TestComponent;
use App\Models\Test\TestComponentTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function priceList()
    {
        $priceList = Test::select('name', 'price')->get();

        return response()->json($priceList);
    }
    
    public function index(Request $request)
    {
        // $tests = Test::all();
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');

        $tests = Test::query();

        if ($search) {
            $tests->where('name', 'like', "%$search%")
                  ->orWhere('shortcut', 'like', "%$search%")
                  ->orWhere('sample_type', 'like', "%$search%")
                  ->orWhere('price', 'like', "%$search%");
        }

        $tests = $tests->paginate($perPage);

        return response()->json($tests);
    }

    public function show($id)
    {
        $test = Test::with('testComponents', 'testComponentTitles')->findOrFail($id);
        return response()->json($test);
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'shortcut' => 'required|string',
            'sample_type' => 'required|string',
            'price' => 'required|numeric',
            'precautions' => 'nullable|string',
            'components' => 'required|array',
            'titles' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create Test
        $test = Test::create([
            'name' => $request->input('name'),
            'shortcut' => $request->input('shortcut'),
            'sample_type' => $request->input('sample_type'),
            'price' => $request->input('price'),
            'precautions' => $request->input('precautions'),
        ]);

        // Create Test Component Titles
        foreach ($request->input('titles') as $title) {
            TestComponentTitle::create([
                'test_id' => $test->id,
                'title' => $title['title'],
            ]);
        }

        // Create Test Component
        foreach ($request->input('components') as $component) {
            TestComponent::create([
                'test_id' => $test->id,
                'name' => $component['name'],
                'unit' => $component['unit'],
                'result' => $component['result'],
                'reference_range' => $component['reference_range'],
                'separated' => $component['separated'],
                'price' => $component['price'],
                'status' => $component['status'],
            ]);
        }

        return response()->json($test, 201);
    }

    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'shortcut' => 'string',
            'sample_type' => 'string',
            'price' => 'numeric',
            'precautions' => 'nullable|string',
            'components' => 'array',
            'titles' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update Test
        $test = Test::findOrFail($id);
        $test->update($request->only(['name', 'shortcut', 'sample_type', 'price', 'precautions']));

        // Update Test Components
        if ($request->has('components')) {
            TestComponent::where('test_id', $test->id)->delete();
            foreach ($request->input('components') as $component) {
                TestComponent::create([
                    'test_id' => $test->id,
                    'title' => $component['title'],
                ]);
            }
        }

        // Update Test Component Titles
        if ($request->has('titles')) {
            TestComponentTitle::where('test_id', $test->id)->delete();
            foreach ($request->input('titles') as $title) {
                TestComponentTitle::create([
                    'test_id' => $test->id,
                    'name' => $title['name'],
                    'unit' => $title['unit'],
                    'result' => $title['result'],
                    'reference_range' => $title['reference_range'],
                    'separated' => $title['separated'],
                    'price' => $title['price'],
                    'status' => $title['status'],
                ]);
            }
        }

        return response()->json($test, 200);
    }

    public function destroy($id)
    {
        TestComponent::where('test_id', $id)->delete();
        TestComponentTitle::where('test_id', $id)->delete();
        $test = Test::findOrFail($id);
        $test->delete();
        return response()->json(null, 204);
    }
}
