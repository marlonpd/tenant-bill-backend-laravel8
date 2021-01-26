<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;
use JWTAuth;

class AuthController extends Controller
{
    private $userRepository;
  
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Return the user's access token.
     */
    public function authenticate(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function register(RegisterRequest $request) 
    {
        
        $payload = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ];

        $user = $this->userRepository->create($payload);

        error_log($user);

        if ($user) {
            return response()->json(['message' => 'Successfully created an account']);
        } else {
            return response()->json(['message' => 'Encountered an error'], 401);
        }
    }

}