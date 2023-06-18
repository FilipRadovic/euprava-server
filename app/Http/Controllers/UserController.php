<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private int $DEFAULT_PAGE_SIZE = 10;

    /**
     * Returns a listing of the users using pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $size = $request->query('size', $this->DEFAULT_PAGE_SIZE);

        $page = User::paginate($size);
        return response()->json($page);
    }

    /**
     * Returns the user with specified id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) {
        $user = User::where('id', $id)->get();
        return response()->json($user);
    }
}
