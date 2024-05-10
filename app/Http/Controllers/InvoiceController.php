<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10); 
        return response()->json($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->json($invoice);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'subtotal' => 'required|numeric',
            'discount' => 'numeric',
            'total' => 'required|numeric',
            'paid' => 'boolean',
            'due' => 'required|numeric',
            'barcode' => 'required|string',
            'reference' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        try {
            $invoice = Invoice::create($request->all());

            $tests = $request->input('tests', []);
            $invoice->tests()->attach($tests);

            DB::commit();

            return response()->json($invoice, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to create invoice.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'branch_id' => 'exists:branches,id',
            'patient_id' => 'exists:patients,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'subtotal' => 'numeric',
            'discount' => 'numeric',
            'total' => 'numeric',
            'paid' => 'boolean',
            'due' => 'numeric',
            'barcode' => 'string',
            'reference' => 'nullable|string',
            'date' => 'date',
            'status' => 'in:pending,paid,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $invoice = Invoice::findOrFail($id);

        $invoice->update($request->all());

        return response()->json($invoice);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }

}
