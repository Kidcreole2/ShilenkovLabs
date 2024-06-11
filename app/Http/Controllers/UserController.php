<?php

namespace App\Http\Controllers;

use app\DTO\UserCollectionDTO;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersAndRoles;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $users = new UserCollectionDTO();
        return response()->json($users->users);
    }
    public function getRoles(UserRequest $request){
        $user_id = $request->id;

        $roles_id = UsersAndRoles::select('role_id')->where('user_id', $user_id)->get();

    	$roles = $roles_id->map(function($id) {
    		return Role::where('id', $id->role_id)->first();
    	});

    	return response()->json($roles);
    }
    public function give(Request $request){
        $user = UsersAndRoles::where('user_id', $request->id)->first();
		$role = $request->role;

		$user->update([
			'role_id' => $role,
		]);
		return response()->json(['status' => '200']);
    }
    public function delete(Request $request){
        $user_id = $request->id;
		UsersAndRoles::where('user_id', $user_id)->forceDelete();

		$user = User::find($user_id);
		if ($user) {
			$user->forceDelete();
		} else {
			return response()->json(['status' => '404', 'message' => 'User not found'], 404);
		}
		return response()->json(['status' => '200']);
    }
    public function delete_soft(Request $request){
        $user_id = $request->id;
		UsersAndRoles::where('user_id', $user_id)->delete();
		User::find($user_id)->delete();
		return response()->json(['status' => '200']);
    }
    public function restore(Request $request){
        $user_id = $request->id;
		UsersAndRoles::withTrashed()->where('user_id', $user_id)->restore();
		User::withTrashed()->find($user_id)->restore();
		return response()->json(['status' => '200']);
    }
}
