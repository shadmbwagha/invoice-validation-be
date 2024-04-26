<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class InvoiceUploadController extends Controller
{
    /**
     * Handle invoice file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Maximum file size is 10MB (adjust as needed)
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate a unique filename
            $filename = uniqid() . '_' . $file->getClientOriginalName();

            // Store the file in the frontend storage
            $file->move(public_path('storage'), $filename);

            // Create a new record in the invoices table
            $uploadedInvoice = File::create([
                'filename' => $filename,
                'path' => 'storage/' . $filename, // Assuming storage directory is in the public directory
                'user_id' => 1, // Assuming user is authenticated
            ]);

            return response()->json(['message' => 'Invoice file uploaded successfully', 'invoice' => $uploadedInvoice], 201);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }
    public function getInvoices()
    {
        $invoices = File::where('user_id', 1)->get();
        return response()->json(['invoices' => $invoices], 200);
    }
}
