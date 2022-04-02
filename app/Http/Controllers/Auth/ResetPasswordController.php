<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    //



    public function showForgotPassword()
    {
        return response()->view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
        ]);

        if (!$validator->fails()) {
            $status = Password::sendResetLink(['email' => $request->input('email')]);
            return response()->json(
                ["message" => __($status)],

                $status  === Password::RESET_LINK_SENT
                    ? Response::HTTP_OK
                    : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function showResetPassword(Request $request, $token)
    {
        return response()->view('auth.reset-password', ['token' => $token, 'email' => $request->input('email')]);
    }
    public function resetPassword(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|confirmed',

        ]);

        if (!$validator->fails()) {

            $status = Password::reset($request->only(
                'email',
                'token',
                'password',
                'password_confirmation'
            ), function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            });
            return response()->json(
                ["message" => __($status)],

                $status  === Password::PASSWORD_RESET
                    ? Response::HTTP_OK
                    : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
