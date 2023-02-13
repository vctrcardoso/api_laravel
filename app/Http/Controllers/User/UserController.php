<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'users' => User::all()
        ]);
    }

    public function show(): JsonResponse
    {
        $user = User::all()->find(Auth::user()->getAuthIdentifier());
        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $user = User::all()->find($id);
        $user = $request->name;
        $user->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Info updated successfuly.'
        ]);
    }
}
