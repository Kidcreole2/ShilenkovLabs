<?php

namespace App\Http\Controllers;

use app\DTO\PermissionsCollectionDTO;
use App\Http\Requests\Auth;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function getList(Request $request) {
        $permissions = new PermissionsCollectionDTO(Permission::all());
        return response()->json($permissions->permissions);
    }
    public function getById(Request $request) {
        $permission = Permission::find($request->id);
        return response()->json($permission);
    }
    public function create(CreatePermissionRequest $request) {
        $user = Auth::id();
        $permission_data = $request->createDTO();

        $new_permission = Permission::create([
            'name' => $permission_data->name,
            'description' => $permission_data->description,
            'encryption' => $permission_data->encryption,
            'created_by' => $user
        ]);

        return response()->json($new_permission);
    }
    public function update(UpdatePermissionRequest $request){
        $permission = Permission::find($request->id);

        $permission->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($permission);
    }
    public function delete(UpdatePermissionRequest $request) {
        $permission = Permission::withTrashed()->find($request->id);
        $permission->forceDelete();

        return response()->json(['status' => '200']);
    }
    public function deleteSoft(UpdatePermissionRequest $request) {
        $permission = Permission::find($request->id);

        $user = $request->user()->id;

        $permission->deleted_by = $user;
        $permission->delete();
        $permission->save();

        return response()->json(['status' => '200']);
    }
    public function restore(UpdatePermissionRequest $request) {
        $permission = Permission::withTrashed()->find($request->id);

        $permission->restore();
        $permission->deleted_by = null;
        $permission->save();

        return response()->json(['status' => '200']);
    }
}
