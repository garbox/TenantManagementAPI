<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\User\UserStoreRequest;
use App\Http\Requests\API\User\UserUpdateRequest;
use App\Http\Requests\API\User\UserRoleUpdateRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Maintenance;

class UserController extends Controller
{
    // show all users (user:admin)
    public function index()
    {
        return User::with(['role'])->get()->toJson();
    }

    // show single user (Role: user:admin, user:owner, user:tenant, user:maintence)
    public function show(int $user_id)
    {
        $user = new User($user_id);
        return $user;
    }

    // create user
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->input());
        $user->role_id = 3; //default role id of tenate
        $user->save();
        $user->token = $user->createToken('user')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $user->token,
        ]);
    }

    // update single user (Role: user:admin, user:owner, user:tenant, user:maintence)
    public function update(UserUpdateRequest $request, int $user_id)
    {
        $user = new User($user_id);

        if ($user) {
            if ($user->update($request->input())) {
                return $user->toJson();
            } else {
                return response()->json(['message' => "User could not be updated"]);
            }
        }

        return response()->json(['message' => 'User could not be found.'], 404);
    }

    public function updateRole(UserRoleUpdateRequest $request, int $user_id)
    {
        // Find the user by ID
        $user = User::findOrFail($user_id);

        // Update only the role_id field
        if ($user->update(['role_id' => $request->input('role_id')])) {
            return $user->toJson();
        } else {
            return response()->json(['message' => "User role could not be updated"], 500);
        }
    }

    // delete single types (Role: user:admin)
    public function destroy(int $user_id)
    {

        if ($user = new User($user_id)) {
            $user->delete();
            return response()->json(['message' => "User deleted successfuly"], 200);
        } else {
            return response()->json(['message' => "User not found"], 404);
        };
    }

    //user login
    public function login(LoginRequest $request)
    {
        // Extract credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->load('latestAgreement');
            $user->token = $user->createToken('user')->plainTextToken; // Generate a token
            return response()->json($user, 200);
        }

        // If authentication fails
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function getMaintenanceRequests(int $user_id)
    {
        return Maintenance::with('assignedTo', 'property', 'user', 'type', 'status')
            ->where('user_id', $user_id)
            ->where('maintenance_status_id', "<", 11)->get();
    }
}
