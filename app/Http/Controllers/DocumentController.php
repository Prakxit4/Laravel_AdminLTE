<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentType;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentTypes = DocumentType::all();

        return view('document', compact('documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        // Create a new document type
        $documentType = new DocumentType();
        $documentType->name = $validatedData['name'];
        $documentType->status = $validatedData['status'];
        $documentType->save();

        return redirect()->route('document.index')->with('success', 'Document type created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentType $documentType)
    {
        return view('dedit', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentType $documentType)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        // Update the document type
        $documentType->name = $validatedData['name'];
        $documentType->status = $validatedData['status'];
        $documentType->save();

        return redirect()->route('document.index')->with('success', 'Document type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentType $documentType)
    {
        // Delete the document type
        $documentType->delete();

        return redirect()->route('document.index')->with('success', 'Document type deleted successfully.');
    }
}
