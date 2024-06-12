<?php

namespace App\Http\Controllers;

use app\DTO\RolesCollectionDTO;
use App\Http\Requests\Auth;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getList(Request $request){
        $roles = new RolesCollectionDTO(Role::all());
        return response()->json($roles->roles);
    }
    public function getById(Request $request) {
        $role = Role::find($request->id);
        return response()->json($role);
    }
    public function create(CreateRoleRequest $request) {
        $user = Auth::id();
        $role_data = $request->createDTO();

        $new_role = Role::create([
            'name' => $role_data->name,
            'description' => $role_data->description,
            'encryption' => $role_data->encryption,
            'created_by' => $user
        ]);

        return response()->json($new_role);
    }
    public function update(UpdateRoleRequest $request){
        $role = Role::find($request->id);

        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($role);
    }
    public function delete(UpdateRoleRequest $request) {
        $role_id = $request->id;
        if($role_id == 1) {
            return response()->json(['error' => "You can't remove the admin"]);
        }
        
        $role = Role::withTrashed()->find($role_id);
        $role->forceDelete();

        return response()->json(['status' => '200']);
    }
    public function deleteSoft(UpdateRoleRequest $request) {
        $role_id = $request->id;
        if($role_id == 1) {
            return response()->json(['error' => "You can't remove the admin"]);
        }

        $role = Role::find($role_id);
        if(!$role) {
            return response()->json(['error' => "The role with this id was not found"]);
        }

        $user = $request->user()->id;

        $role->deleted_by = $user;
        $role->delete();
        $role->save();

        return response()->json(['status' => '200']);
    }
    public function restore(UpdateRoleRequest $request) {
        $role = Role::withTrashed()->find($request->id);

        $role->restore();
        $role->deleted_by = null;
        $role->save();

        return response()->json(['status' => '200']);
    }
}
