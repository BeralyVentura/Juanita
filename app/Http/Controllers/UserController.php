<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateStoreUserRequest;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); 
    return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Str::random(8); // Le colocamos una contraseña por defecto

        $user = User::create($data);
        
        return response()->json(UserResource::make($user), 201);
    }
    public function show(User $user)
    {

        return response()->json(UserResource::make($user));
    }
    public function update(UpdateStoreUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
 
        return response()->json(UserResource::make($user));
 
    }
}
