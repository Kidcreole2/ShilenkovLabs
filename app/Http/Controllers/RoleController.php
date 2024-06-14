<?php

namespace App\Http\Controllers;

use App\DTO\RolesCollectionDTO;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function getList(Request $request){
        $roles = new RolesCollectionDTO(Roles::all());
        return response()->json($roles->roles);
    }
    public function getById(Request $request) {
        $role = Roles::find($request->id);
        return response()->json($role);
    }
    public function create(CreateRoleRequest $request)  {
        try {
            DB::beginTransaction();
            
            $user = Auth::id();
            $role_data = $request->createDTO();

            $new_role = Roles::create([
                'name' => $role_data->name,
                'description' => $role_data->description,
                'encryption' => $role_data->encryption,
                'created_by' => $user
            ]);

            $Log = new LogsController;
            $Log->createLogs('roles', 'create', $new_role->id, null, $new_role, $user);

            DB::commit();

            return response()->json($new_role);
        }
        catch (\Exception $err) {
            DB::rollback();
            throw $err;
        }
    }
    public function update(UpdateRoleRequest $request){
        try {
            DB::beginTransaction();

            $user = $request->user();
            $role = Roles::find($request->id);
            $role_before = clone $role;

            $role->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            $Log = new LogsController;
            $Log->createLogs('roles', 'update', $role->id, $role_before, $role, $user->id);

            DB::commit();

            return response()->json($role);
        }
        catch (\Exception $err) {
            DB::rollback();
            throw $err;
        }
    }
    public function delete(UpdateRoleRequest $request){
        try {
            DB::beginTransaction();

            $user = $request->user();
            $role_id = $request->id;
            if($role_id == 1) {
                return response()->json(['error' => "You can't remove the admin"]);
            }
            
            $role = Roles::withTrashed()->find($role_id);

            $Log = new LogsController;
            $Log->createLogs('roles', 'hardDelete', $role->id, $role, null, $user->id);

            $role->forceDelete();

            DB::commit();

            return response()->json(['status' => '200']);
        }
        catch (\Exception $err) {
            DB::rollback();
            throw $err;
        }
    }
    public function deleteSoft(UpdateRoleRequest $request) {

        try {
            DB::beginTransaction();

            $role_id = $request->id;
            if($role_id == 1) {
                return response()->json(['error' => "You can't remove the admin"]);
            }

            $role = Roles::find($role_id);
            if(!$role) {
                return response()->json(['error' => "The role with this id was not found"]);
            }

            $user = $request->user()->id;

            $role->deleted_by = $user;

            $Log = new LogsController;
            $Log->createLogs('roles', 'softDelete', $role->id, $role, null, $user->id);

            $role->delete();
            $role->save();

            DB::commit();

            return response()->json(['status' => '200']);
        }
        catch (\Exception $err) {
            DB::rollback();
            throw $err;
        }
    }
    public function restore(UpdateRoleRequest $request) {

        try {
            DB::beginTransaction();

            $user = $request->user()->id;
            $role = Roles::withTrashed()->find($request->id);

            $Log = new LogsController();
			$Log->createLogs('roles', 'restore', $role->id, null, $role, $user);

            $role->restore();
            $role->deleted_by = null;
            $role->save();

            DB::commit();

            return response()->json(['status' => '200']);
        }
        catch (\Exception $err) {
            DB::rollback();
            throw $err;
        }
    }

}
