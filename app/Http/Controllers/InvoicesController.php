<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all invoices (you could also use pagination here, e.g., Invoice::paginate(10))
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.partial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming form data
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'issue_date'  => 'required|date',
            'due_date'    => 'required|date|after_or_equal:issue_date',
            'balance_due' => 'required|numeric|min:0'
        ]);

        // Create a new invoice using mass assignment
        Invoice::create($validatedData);

        // Redirect back to the index with a success message
        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.partial.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.partial.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Validate the incoming form data
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'issue_date'  => 'required|date',
            'due_date'    => 'required|date|after_or_equal:issue_date',
            'balance_due' => 'required|numeric|min:0'
        ]);

        // Find the specific invoice and update it
        $invoice->update($validatedData);

        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice deleted successfully.');
    }
}
