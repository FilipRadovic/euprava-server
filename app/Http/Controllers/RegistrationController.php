<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $registration = Registration::with(['city', 'document'])->where('id', $id)->get();

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
    public function approve(string $id)
    {
        $registration = Registration::with(['city', 'document'])->where('id', $id)->get();

        if ($registration->status !== 'PENDING') {
            return response()->json([
                'error' => 'Only pending registrations can be approved'
            ], 409);
        }

        $registration->status = "APPROVED";
        $registration->save();

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
