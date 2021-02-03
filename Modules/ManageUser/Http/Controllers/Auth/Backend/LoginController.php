<?php

namespace Modules\ManageUser\Http\Controllers\Auth\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
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
        $this->middleware(['guest'])->except(['logout']);
        $this->middleware(['auth'])->only(['logout']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showLoginForm()
    {
        return view('manageuser::auth.login');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function login(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
            
            // Auth::logoutOtherDevices($request->input('password'));

            return response_json(true, null, 'Login Berhasil.', redirect()->intended($this->redirectPath)->getTargetUrl());            
        }

        return response_json(false, 'UserNotFoundException', 'Identitas tersebut tidak cocok dengan data kami.');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function logout(Request $request)
    {
        Auth::logout();
        if (! $request->expectsJson()) {
            return redirect($this->redirectPath);
        }
        return response_json(true, null, 'Login Berhasil.', redirect($this->redirectPath)->getTargetUrl());
    }

    /**
     *
     * Validation Rules for Login
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'email' => 'bail|required',
            'password' => 'bail|required'
        ]);
    }
}
