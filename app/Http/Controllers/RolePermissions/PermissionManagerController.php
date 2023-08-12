<?php

namespace App\Http\Controllers\RolePermissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachPermissionToRoleRequest;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PermissionManagerController extends Controller
{
    public function attach(AttachPermissionToRoleRequest $request)
    {
        $role = Role::find($request['role_id']);
        $permissions = $request['permission_ids'];
        $role->givePermissionTo($permissions);

        return response()->json($role, Response::HTTP_OK);
    }
}
