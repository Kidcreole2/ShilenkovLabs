<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleAndPermission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (Auth::user()) {
            $user_roles = User::find(Auth::id())->roles();

            $permission_id = Permission::where('name', $permission)->first()->id;
            $permission_roles = RoleAndPermission::where('permission_id', $permission_id)->get();

            foreach ($user_roles as $role) {
                if ($role->id == 1) {
                    return $next($request);
                }
                else {
                    foreach($permission_roles as $permission_role) {
                        if($permission_role->role_id == $role->id) {
                            return $next($request);
                        }
                    }
                }
            }
            return response()->json(['error' => "the required role is missing"], 403);
        }

        return response()->json(['error' => 'Forbidden'], 403);
    }
}