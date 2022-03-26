<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{




    public function loginPGCT(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            return $this->generatePGCT($request);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }


    private function generatePGCT(Request $request)
    {
        try {
            // $response = Http::asForm()->post('http://medical.mr-dev.tech/oauth/token', [
            $response = Http::asForm()->post('http://127.0.0.1:81/oauth/token', [

                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'NfyQNTrcF3zcEouMwY5ETy7kLebkRydhVM1hByQB',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '*'
            ]);
            $decodedResponse = json_decode($response);
            $user = User::where('email', '=', $request->input('email'))->first();
            $user->setAttribute('token', $decodedResponse->access_token);
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully',
                'data' => $user,
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => json_decode($response)->message,
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [

            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3'
        ]);

        if (!$validator->fails()) {

            $user = User::where('email', '=', $request->input('email'))->first();
            // $user = User::with('city')->where('email', '=', $request->input('email'))->first();

            if (Hash::check($request->input('password'), $user->password)) {

                $token = $user->createToken('User-API');
                $user->setAttribute('token', $token->accessToken);

                $user = $user->load('city');


                return response()->json(
                    [
                        'message' => 'Logged in successfully',
                        'data' => $user,
                    ],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    ['message' => 'Login Failed,Error Password'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function logout(Request $request)
    {


        // $guard = auth('user-api')->check() ? 'user-api' : 'admin';
        // $token = $request->user($guard)->token();

        $token = $request->user('user-api')->token();
        $revoked = $token->revoke();
        return response()->json(
            ['message' => $revoked ? 'Logged out successfully' : 'Logged out Failed'],
            $revoked
                ? Response::HTTP_OK
                : Response::HTTP_BAD_REQUEST
        );
    }
}
