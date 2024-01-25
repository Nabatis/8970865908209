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

    function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'msg' => 'User not found!']);
        }

        try {
            $user->delete();
            return response()->json(['success' => true, 'msg' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
