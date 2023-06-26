<?php

namespace App\Http\Controllers;

use App\Models\IdentificationDocumentType;

class IdentificationDocumentTypeController extends Controller
{
    public function index() {
        $types = IdentificationDocumentType::all();
        return response()->json($types);
    }
}
