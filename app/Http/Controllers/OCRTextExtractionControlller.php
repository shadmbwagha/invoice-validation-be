<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\File;

class OCRTextExtractionControlller extends Controller
{   /**
     * Extract text from invoice image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function extractText($id)
    {
        // Find the invoice by ID
        $invoice = File::findOrFail($id);

        // Get the path to the image file
        $imagePath = public_path('storage/' . $invoice->filename);

        // Perform OCR on the image file
        $text = (new TesseractOCR($imagePath))->run();

        // Return the extracted text as JSON response
        return response()->json(['text' => $text], 200);
    }
}
