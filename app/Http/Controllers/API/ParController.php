<?php 
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ParController extends Controller
{
    public function index()
    {
        $participants = Participant::all();
        return response()->json([
            'data' => $participants,
            'message' => 'Participants retrieved successfully',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
            'tenth_offering' => 'required',
            'document_type_id' => 'required|exists:document_types,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document_file' => 'required|file',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads', 'public');
        }
    
        // Handle file upload
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filePath = $file->store('uploads', 'public');
        }
    
        // Create a new participant
        $participant = new Participant();
        $participant->name = $validatedData['name'];
        $participant->dob = $validatedData['dob'];
        $participant->tenth_offering = $validatedData['tenth_offering'];
        $participant->image = $imagePath ?? null; // Save the image path if it exists
        $participant->document_type_id = $validatedData['document_type_id'];
        $participant->document_file = $filePath ?? null; // Save the file path if it exists
        $participant->save();
    
        return response()->json([
            'data' => $participant,
            'message' => 'Participant created successfully',
        ], 201);
    }
    
    
    public function show($id)
    {
        $participant = Participant::findOrFail($id);
        return response()->json([
            'data' => $participant,
            'message' => 'Participant retrieved successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
            'tenth_offering' => 'required',
            'image' => 'nullable|image',
            'document_type_id' => 'required|exists:document_types,id',
            'document_file' => 'nullable|mimes:pdf,doc,docx',
        ]);
    
        $participant = Participant::findOrFail($id);
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
    
            // Delete the previous image if it exists
            if ($participant->image) {
                $previousImagePath = public_path('storage/' . $participant->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $participant->image = $imagePath;
        }
    
        // Handle document file upload if provided
        if ($request->hasFile('document_file')) {
            $documentFile = $request->file('document_file');
            $documentFilePath = $documentFile->store('documents', 'public');
            $validatedData['document_file'] = $documentFilePath;
    
            // Delete the previous document file if it exists
            if ($participant->document_file) {
                $previousDocumentFilePath = public_path('storage/' . $participant->document_file);
                if (file_exists($previousDocumentFilePath)) {
                    unlink($previousDocumentFilePath);
                }
            }
    
            $participant->document_file = $documentFilePath;
        }
    
        $participant->name = $validatedData['name'];
        $participant->dob = $validatedData['dob'];
        $participant->tenth_offering = $validatedData['tenth_offering'];
        $participant->document_type_id = $validatedData['document_type_id'];
        $participant->save();
    
        return response()->json([
            'data' => $participant,
            'message' => 'Participant updated successfully',
        ]);
 }    

    public function destroy($id)
    
    {
        $participant = Participant::findOrFail($id);
    
        // Delete the image if it exists
        if ($participant->image) {
            $imagePath = public_path('storage/' . $participant->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        } 
        // Delete the file if it exists
        if ($participant->document_file) {
            $filePath = public_path('storage/' . $participant->document_file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    
        $participant->delete();

        return response()->json([
            'message' => 'Participant deleted successfully',
        ], 204);
    }    
}


