<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface as UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="Login using registered email and password.",
     *      @OA\Parameter(
     *          required=true,
     *          name="email",
     *          in="query",
     *          description="Enter the registered email.",
     *          @OA\Schema(
     *              type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *          required=true,
     *          name="password",
     *          in="query",
     *          description="Enter the password",
     *          @OA\Schema(
     *              type="string",
     *        )
     *      ),
     *      @OA\Parameter(
     *          required=true,
     *          name="timezone",
     *          in="query",
     *          description="Enter TimeZone ('UTC', 'Asia/Kuwait', 'Asia/Dubai', 'Asia/Kolkata')",
     *          @OA\Schema(
     *             type="string"
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *   )
     * )
     *
     * Login using registered email and password
     *
     * @param UserRepo $userRepo
     * @param LoginRequest $request
     * @return array
     * 
     */

    public function login(UserRepo $userRepo, Request $request)
    {
        $user = $userRepo->getUserByEmail($request->email);
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('loginToken')->plainTextToken;
                Auth::login($user);
                $data['User'] = new UserResource($user);
                $data['token'] = $token;
                $data['guard'] = 'User';
                $response = ['status' => true, 'message' => 'Logged in Successfully.', 'data' => $data];
                return response()->json($response, 200);
            } else {
                $response = ['status' => false, 'message' => 'Incorrect password.', 'data' => []];
                return response()->json($response, 200);
            }
        } else {
            $response = ['status' => false, 'message' => 'Email Not Registered With Us.', 'data' => []];
            return response()->json($response, 200);
        }
    }
}
