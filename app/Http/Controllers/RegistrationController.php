<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    private int $DEFAULT_PAGE_SIZE = 10;

    /**
     * Returns a listing of the registrations using pagination.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $size = $request->query('size', $this->DEFAULT_PAGE_SIZE);

        $page = Registration::with(['city', 'document'])->paginate($size);
        return response()->json($page);
    }

    /**
     * Returns the registration with specified id.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id)
    {
        $registration = Registration::with(['city', 'document'])->where('id', $id)->get();
        return response()->json($registration);
    }

    /**
     * Rejects the registration with specified id.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function reject(string $id)
    {
        $registration = Registration::with(['city', 'document'])->where('id', $id)->firstOrFail();

        if ($registration->status !== 'PENDING') {
            return response()->json([
                'error' => 'Only pending registrations can be rejected'
            ], 409);
        }

        $registration->status = "REJECTED";
        $registration->save();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Approves the registration with specified id.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function approve(string $id): JsonResponse
    {
        $registration = Registration::with(['city', 'document'])->where('id', $id)->firstOrFail();

        if ($registration["status"] != 'PENDING') {
            return response()->json([
                'error' => 'Only pending registrations can be approved'
            ], 409);
        }

        DB::transaction(function() use ($registration) {
            $registration->status = "APPROVED";
            $registration->save();

            return User::create([
                'firstname' => $registration->firstname,
                'lastname' => $registration->lastname,
                'email' => $registration->email,
                'jmbg' => $registration->jmbg,
                'username' => $registration->username,
                'password' => $registration->password,
                'role' => 'USER'
            ]);
        });

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Returns the document image of registration identification document with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function getDocumentImage(string $id) {}

}
