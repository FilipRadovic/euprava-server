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

        $page = Registration::paginate($size);
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
        $registration = Registration::where('id', $id)->get();
        return response()->json($registration);
    }

    /**
     * Rejects the registration with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function reject(string $id)
    {
        //
    }

    /**
     * Approves the registration with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function approve(string $id)
    {
        //
    }

    /**
     * Returns the document image of registration identification document with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function getDocumentImage(string $id) {}

}
