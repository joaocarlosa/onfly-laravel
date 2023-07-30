<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Middleware\CheckUserToken;


class UserController extends Controller
{

    public function index()
    {
        return new UserCollection(User::all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUpdateUserRequest $request)
    {
        $validated = $request->validated();

        if (User::where('email', $validated['email'])->exists()) {
            return response()->json(['error' => 'User already exists'], 422);
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function verify(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $token = $user->tokens->first();

            return response()->json([
                'user' => new UserResource($user),
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'unauthenticated'], 401);

    }


    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    
}
