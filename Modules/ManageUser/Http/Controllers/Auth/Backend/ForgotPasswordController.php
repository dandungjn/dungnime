<?php

namespace Modules\ManageUser\Http\Controllers\Auth\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
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
     * @return Renderable
     */
    public function showForgotPasswordForm()
    {
        return view('manageuser::auth.forgot_password');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function forgotPassword(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response_json(true, null, __($status), redirect($this->redirectPath)->getTargetUrl());
        }
        return response_json(false, 'ForgotPasswordException', __($status));
    }

    /**
     *
     * Validation Rules for Login
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'email' => 'bail|required'
        ]);
    }
}
