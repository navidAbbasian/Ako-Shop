<?php

namespace App\Http\Controllers\RolePermissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use http\Client\Curl\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleManagerController extends Controller
{
    public function create(CreateRoleRequest $request): JsonResponse
    {
        $data = $request->all();
        $role = Role::create($data);
        return response()->json($role, Response::HTTP_CREATED);
    }

    public function getAll()
    {
        $role = Role::all();
        return response()->json($role, Response::HTTP_OK);
    }

    public function assign(Request $request)
    {
        $user = \App\Models\User::find($request['user_id']);
        $user->assignRole($request['role_ids']);

        return response()->json($user, Response::HTTP_OK);
    }
}
