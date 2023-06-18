<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Return a listing of the registrations using pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        //
    }

    /**
     * Return the registration with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function get(string $id)
    {
        //
    }

    /**
     * Reject the registration with specified id.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function reject(string $id)
    {
        //
    }

    /**
     * Approve the registration with specified id.
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
