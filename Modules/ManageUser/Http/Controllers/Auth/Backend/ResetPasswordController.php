<?php

namespace Modules\ManageUser\Http\Controllers\Auth\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    protected $redirectPath = RouteServiceProvider::HOME;

    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    /**
     * Display a listing of the resource.
     * @param String $token
     * @return Renderable
     */
    public function showResetPasswordForm($token)
    {
        return view('manageuser::auth.reset_password')
            ->with('token', $token);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function resetPassword(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $request->input('password')
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response_json(true, null, __($status), redirect($this->redirectPath)->getTargetUrl());
        }
        return response_json(false, 'ResetPasswordException', __($status));
    }

    /**
     *
     * Validation Rules for Login
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'bail|required',
            'password' => 'bail|required|min:8|confirmed',
        ]);
    }
}
