<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    function searchUser($name)
    {
        return User::where("name", $name)->get();
    }
}
