<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    
    public function index()
    {   
        return UserResource::collection(User::all());

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    // Atualizar usuário
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8',
        ]);

        $user->update($request->all());

        return response()->json($user, 200);
    }

    // Deletar usuário
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
