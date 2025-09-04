<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
     public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Supprimer le fichier du storage
        if (Storage::exists($document->path)) {
            Storage::delete($document->path);
        }

        // Supprimer en base
        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }

    
}
