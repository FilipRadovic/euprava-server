<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns a listing of the users using pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {}

    /**
     * Returns the user with specified id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) {}
}
