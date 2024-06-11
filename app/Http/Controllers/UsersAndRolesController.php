<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth;
use App\Http\Requests\CreateUsersAndRolesRequest;
use App\Http\Requests\Registration;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\UpdateUsersAndRolesRequest;
use App\Models\User;
use App\Models\UsersAndRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Sanctum;
use Laravel\Passport\Token;
use App\DTO\UserDTO;
use Carbon\Carbon;

class UsersAndRolesController extends Controller
{
    
    public function assign(CreateUsersAndRolesRequest $request) {
        $user_id = $request->id;

        $role_id = $request->input('role_id');

        $have_role = UsersAndRoles::where('user_id', $user_id)->where('role_id', $role_id)->first();

        if($have_role) {
            return response()->json(['error' => 'The user already has such a role']);
        }

        UsersAndRoles::create([
            'user_id' => $user_id,
            'role_id' => $role_id,
            'created_by' => $request->user()->id
        ]);

        return response()->json(['status' => '200']);
    }
    public function delete(UpdateUsersAndRolesRequest $request) {
        $user_id = $request->id;
        $role_id = $request->role_id;

        $user_role = UsersAndRoles::withTrashed()->where('user_id', $user_id)->where('role_id', $role_id);
        $user_role->forceDelete();

        return response()->json(['status' => '200']);
    }
    public function delete_soft(UpdateRoleRequest $request) {
        $user_id = $request->id;
        $role_id = $request->role_id;

        $user_role = UsersAndRoles::where('user_id', $user_id)->where('role_id', $role_id);
        $user_role->deleted_by = $request->user()->id;
        $user_role->delete();
        $user_role->save();

        return response()->json(['status' => '200']);
    }
    public function restore(UpdateRoleRequest $request) {
        $user_id = $request->id;
        $role_id = $request->role_id;

        $user_role = UsersAndRoles::withTrashed()->where('user_id', $user_id)->where('role_id', $role_id);

        $user_role->restore();
        $user_role->deleted_by = null;
        $user_role->save();

        return response()->json(['status' => '200']);
    }
}
