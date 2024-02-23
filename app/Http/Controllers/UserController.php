<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->model = app()->make(User::class);
        $this->relation = [];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['id'];
    }


    public function show($id)
    {
        $data = $this->model::findOrFail($id);
        $formattedData = [
            'id' => $data->id,
            'email' => $data->email,
            'name' => $data->name,
            'status' => $data->status_id,
            'token' => $data->token,
            'updated_at' => $data->updated_at,
            'created_at' => $data->created_at,
            'userType' => $data->userType,
            'image' => $data->getFirstMediaUrl('img')
        ];

        return $formattedData;
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'userType' => 'required|string|in:SUPER_USER,JOURNALIST,EDITIOR', // Validate against the enum
        ]);

        $userType = UserType::from($request->userType);

        $user = User::create([
            'name' => $request->name,
            'type' => $userType,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userType' => $userType->value,
        ]);

        $role = Role::firstOrCreate(['name' => $userType->value])
            ->givePermissionTo(Permission::all());

        $userRole = UserRole::fromName($userType->value);
        $user->assignRole($userRole);

        $user->addMediaFromRequest('img')->toMediaCollection('img');

        return $user;
    }

    public function disableUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Disable the user by setting the 'status' to false
        $user->update(['status' => false]);

        return response()->json(['message' => 'User disabled successfully']);
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect('login')->with('error', 'User not registered');
        }

        if (!$user || !$user->status) {
            // User not registered or user is disabled
            return redirect('login')->with('error', 'Invalid credentials');
        }


        $user->token = $user->createToken('token')->plainTextToken;
        $user->save();

        Auth::login($user);

        $redirectUrl = env('REDIRECT_URL');

        return redirect()->away($redirectUrl);
    }

    public function user()
    {
        $user = Auth::user();
        // dd($user);
        return response()->json($user);
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect('/');
    }

    public function me()
    {
        $user = Auth::user();
        $permissions = $user->getAllPermissions();
        $user = collect($user)->merge(['permissions' => $permissions->pluck('name')]);

        return response()->json($user);
    }
}
