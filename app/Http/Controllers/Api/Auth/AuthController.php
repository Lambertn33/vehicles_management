<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
        /**
     * Api login 
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function login(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required',
            'password'  => 'required',
        ]);

        $email = $request->get('email');
        $password = $request->get('password');

        $auth = $user->findForPassport($email, $this->email());

        if ($auth) {
            if ($auth->validateForPassportPasswordGrant($password)) {
                $token = $auth->createToken(env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'))->accessToken;
                return Response::json([
                    'status'  => 200,
                    'message' => 'Login successfully',
                    'token'   => $token,
                    'authenticated_user' => [
                        'id'=>$auth->id,
                        'names'=>$auth->names,
                        'email'=>$auth->email
                    ],
                ], 200);
            }
        }
        return Response::json([
            'status'  => '401',
            'message' => 'Invalid email or password!',
        ], 401);
    }
    /**
     * User logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return Response::json([
            'status'  => 200,
            'message' => 'User logged out successfully.',
            'data'    => [],
        ], 200);
    }
    public function email()
    {
        return 'email';
    }
    public function profile(Request $request)
    {
        $user = $request->user();
        return Response::json([
            'status'  => 200,
            'message' => 'User profile',
            'data'    => $user->profile(),
        ], 200);
    }
}
