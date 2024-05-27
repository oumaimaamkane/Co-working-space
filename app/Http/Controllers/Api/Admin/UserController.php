<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update(['is_banned' => true]);

        return response()->json($user, 200);
    }

    public function cancelBanUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update(['is_banned' => false]);

        return response()->json($user, 200);
    }
}
