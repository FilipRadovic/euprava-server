<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\IdentificationDocument;
use App\Models\IdentificationDocumentType;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        error_log('validating');
        $request->validate([
            'firstname' => ['required', 'max:30'],
            'lastname' => ['required', 'max:30'],
            'email' => ['required', 'email'],
            'jmbg' => ['required', 'digits:13'],

            'username' => ['required', 'max:30'],
            'password' => [
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'city_id' => ['required', 'integer'],
            'document.type_id' => ['required', 'integer'],
            'document.number' => ['required', 'max:255']
        ]);

        error_log('validated');

        $registrationData = $this->createRegistrationData($request);
        $documentData = $request->get('document');

        error_log('asdasdasd');

        var_dump($registrationData);
        var_dump($documentData);

        $res = $this->findCity($request);
        if ($res) return $res;

        $res = $this->findIdentificationDocumentType($request);
        if ($res) return $res;

        $registration = Registration::create($registrationData);
        $documentData->registration_id = $registration->id;
        $document = IdentificationDocument::create($documentData);

        $registration->document = $document;

        return response()->json($registration);
    }

    private function createRegistrationData(Request $request): array
    {
        $registrationData = $request->only(['firstname','lastname','email', 'username','jmbg', 'city_id']);
        $password = $request->get('password');
        $hashedPassword = Hash::make($password);
        $registrationData->password = $hashedPassword;

        return $registrationData;
    }

    private function findCity(Request $request)
    {
        $city_id = $request->get('city');
        $city = City::find($city_id);

        // check if city exists
        if (!$city) {
            $message = 'City with id='.$city_id.' doesn\'t exist';
            return response()->setStatusCode(404)->json([
                'error' => $message
            ]);
        }
    }

    private function findIdentificationDocumentType(Request $request)
    {
        $document_type_id = $request->get('document.type_id');
        $documentType = IdentificationDocumentType::find($document_type_id);

        // check if document type exists
        if (!$documentType) {
            $message = 'Identification document type with id='.$document_type_id.' doesn\'t exist';
            return response()->setStatusCode(404)->json([
                'error' => $message
            ]);
        }
    }
}
