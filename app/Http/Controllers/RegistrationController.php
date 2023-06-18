<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{
    public function getRegistrations() {}

    public function getRegistration(string $id) {}

    public function getRegistrationDocumentImage() {}

    public function activateRegistration(string $id) {}

    public function deleteRegistration(string $id) {}
}
