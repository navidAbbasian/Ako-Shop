<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] = $user->createToken('MyApp')->accessToken;
        $data['name'] = $user->name;

        $response = [
            'data' => $data,
            'message' => 'success'
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Login api
     *
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $data['token'] = $user->createToken('MyApp')->accessToken;
                $data['name'] = $user->name;

//                $http = new Client();
//                $response = $http->request('POST', '127.0.0.1:8000/oauth/token', [
//                    'form_params' => [
//                        'grant_type' => 'password',
//                        'client_id' => 2,
//                        'client_secret' => 'Z1xaAaKwg0LIQiVDPW9DRKrdmlzEycEXzxeOhaC1',
//                        'username' => 'navid@navid.com',
//                        'password' => 12345678,
//                        'scope' => '*',
//                    ],
//                ]);

                $response = [
                    'data' => $data,
                    'message' => 'success'
                ];

                return response()->json($response, Response::HTTP_OK);
            }
        }

        $response = [
            'message' => 'error'
        ];

        return response()->json($response, Response::HTTP_UNAUTHORIZED);

    }
}
