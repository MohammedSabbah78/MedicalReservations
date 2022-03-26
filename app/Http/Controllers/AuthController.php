<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function showLoginView(Request $request)
    {


        $request->merge(['guard' => $request->guard]);


        $validator = Validator(['guard' => $request->guard], [
            'guard' => 'required|string|in:admin,user'
        ]);
        $request->session()->put('guard', $request->input('guard'));


        if (!$validator->fails()) {
            return response()->view('auth.login');
        } else {
            abort(Response::HTTP_NOT_FOUND, 'The Page Not Found');
        }
    }
    public function login(Request $request)
    {

        $validator = Validator([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean'
        ]);

        $guard = session()->get('guard');
        if (!$validator->fails()) {

            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password'),];
            if (Auth::guard($guard)->attempt($credentials, $request->input('remember'))) {
                return response()->json(
                    ['message' => 'Login Success'],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    ['message' => 'Login Failed,Check login credentials'],
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
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);
    }
}
