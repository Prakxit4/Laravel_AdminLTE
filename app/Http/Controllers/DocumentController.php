<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Validator;

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
        return view('dcreate')->withErrors(session('errors'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill out all required fields.');
        }
        // Create a new document type
        $documentType = new DocumentType();
        $documentType->name = $request->input('name');
        $documentType->status = $request->input('status');
        $documentType->save();

        return redirect()->route('document.index')->with('success', 'Document type created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentType $documentType)
    {
        $errorMessage = session('error');
        return view('dedit', compact('documentType', 'errorMessage'));
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentType $documentType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill out all required fields.');
        }
    
        // Update the document type
        $documentType->name = $request->input('name');
        $documentType->status = $request->input('status');
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
