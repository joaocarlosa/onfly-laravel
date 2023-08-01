<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\UpdateUserRequest;



class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
    }
    
    public function index()
    {   
        $user = auth()->user();
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);
        $token = $user->createToken('api-token')->plainTextToken;
        
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function update(UpdateUserRequest $request)
    {   
        $user = auth()->user();
        $user->name = $request->validated()['name'];
        $user->password = Hash::make($request->validated()['password']);
        $user->save();

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user = auth()->user();
        $user->delete();
        return response()->json(null, 204);
    }
}
