<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::orderBy('created_at', 'DESC')->get();

        return response()->json($user, Response::HTTP_OK);
    }

    public function create()
    {
        //
    }

    public function store(User $user, CreateUserRequest $request): JsonResponse
    {
        $new_request = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_admin' => $request->role
        ];

        $user->create($new_request);
        return response()->json('Created Successfully', Response::HTTP_OK);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user, Response::HTTP_OK);
    }

    public function edit($id): JsonResponse
    {
        //
    }

    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        if ($user->username !== $request->username || $user->email !== $request->email) {
            $validator = $request->validate([
                'username' => 'unique:users',
            ]);

            $validator = $request->validate([
                'email' => 'unique:users',
            ]);
        }
        
        $new_request = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_admin' => $request->role
        ];
       
        $user->update($new_request);
        return response()->json('Updated Successfully', Response::HTTP_OK);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json('Deleted Sucessfully', Response::HTTP_OK);
    }
}