<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function searchUser($query)
    {
        return User::where(function ($q) use ($query) {
            $q->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($query) . '%'])
                ->orWhere("nisn", 'LIKE', '%' . $query . '%')
                ->orWhere("email", 'LIKE', '%' . $query . '%');
        })->get();
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

    public function getAllUser()
    {
        $user = User::where('role', 'user')->get();

        return response()->json([
            'success' => true,
            'msg' => 'Data user',
            'data' => $user,
        ]);
    }
}
