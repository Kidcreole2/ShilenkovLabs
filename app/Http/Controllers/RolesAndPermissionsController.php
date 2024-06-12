<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRolesAndPermissionsRequest;
use App\Http\Requests\UpdateRolesAndPermissionsRequest;
use App\Models\Permission;
use App\Models\RoleAndPermission;
use Illuminate\Http\Request;

class RolesAndPermissionsController extends Controller
{
    public function get(Request $request) {
        $role_id = $request->id;
        
        $permissions_id = RoleAndPermission::select('permission_id')->where('role_id', $role_id)->get();

        $permissions = $permissions_id->map(function ($id) {
            return Permission::where('id', $id->permission_id)->first();
        });

        return response()->json($permissions);
    }
    public function assign(CreateRolesAndPermissionsRequest $request) {
        $role_id = $request->id;

        $permission_id = $request->permission_id;

        $have_permission = RoleAndPermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        if($have_permission) {
            return response()->json(['error' => 'The role already has such a permission']);
        }

        RoleAndPermission::create([
            'role_id' => $role_id,
            'permission_id' => $permission_id,
            'created_by' => $request->user()->id
        ]);

        return response()->json(['status' => '200']);
    }
    public function delete(UpdateRolesAndPermissionsRequest $request) {
        $role_id = $request->id;
        $permission_id = $request->permission_id;

        $user_role = RoleAndPermission::withTrashed()->where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        $user_role->forceDelete();

        return response()->json(['status' => '200']);
    }
    public function deleteSoft(UpdateRolesAndPermissionsRequest $request) {
        $role_id = $request->id;
        $permission_id = $request->permission_id;

        $role_permission = RoleAndPermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        $role_permission->deleted_by = $request->user()->id;
        $role_permission->delete();
        $role_permission->save();

        return response()->json(['status' => '200']);
    }
    public function restore(UpdateRolesAndPermissionsRequest $request) {
        $role_id = $request->id;
        $permission_id = $request->permission_id;

        $role_permission = RoleAndPermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first();

        $role_permission->restore();
        $role_permission->deleted_by = null;
        $role_permission->save();

        return response()->json(['status' => '200']);
    }
}
