<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\IdentificationDocument;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Handle the user registration.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $registrationData = $this->createRegistrationData($request);
        $documentData = $this->createDocumentData($request);

        $registration = DB::transaction(function() use ($registrationData, $documentData) {
            $registration = Registration::create($registrationData);

            $documentData["registration_id"] = $registration->id;
            $document = IdentificationDocument::create($documentData);

            $registration["document"] = $document;

            return $registration;
        });

        return response()->json($registration);
    }

    private function createRegistrationData(Request $request): array
    {
        $registrationData = $request->only(['firstname','lastname','email', 'username','jmbg', 'city_id']);

        $password = $request->get('password');
        $hashedPassword = Hash::make($password);

        $registrationData["password"] = $hashedPassword;

        return $registrationData;
    }

    private function createDocumentData(Request $request)
    {
        $doc = $request->get("document");
        $document_type_id = $doc["type_id"];
        $document_number = $doc["number"];

        $document["document_number"] = $document_number;
        $document["type_id"] = $document_type_id;

        return $document;
    }

//    private function findCity(Request $request)
//    {
//        $city_id = $request->get('city_id');
//        $city = City::find($city_id);
//
//        // check if city exists
//        if (!$city) {
//            $message = 'City with id='.$city_id.' doesn\'t exist';
//            return response()->json([
//                'error' => $message
//            ], 404);
//        }
//    }

//    private function findIdentificationDocumentType(Request $request)
//    {
//        $document_type_id = $request->get('document.type_id');
//        $documentType = IdentificationDocumentType::find($document_type_id);
//
//        // check if document type exists
//        if (!$documentType) {
//            $message = 'Identification document type with id='.$document_type_id.' doesn\'t exist';
//            return response()->json([
//                'error' => $message
//            ], 404);
//        }
//    }
}
