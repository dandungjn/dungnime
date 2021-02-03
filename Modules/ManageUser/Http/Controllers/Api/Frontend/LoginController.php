<?php

namespace Modules\ManageUser\Http\Controllers\Api\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        // 
    }

    /**
     * Validate incoming request for login
     *
     * @return \Illuminate\Http\Response
     */
    public function loginValidation(Request $request)
    {
        return Validator::make($request->all(), [
            "email" => [
                "bail", "required", "email", "exists:Modules\ManageUser\Entities\User,email"
            ],
            "password" => "bail|required"
        ], [
            "email.required" => __('validation.required', ['attribute' => 'alamat e-mail']),
            "email.email" => __('validation.email.string', ['attribute' => 'alamat e-mail']),
            "email.exists" => __('validation.exists', ['attribute' => 'alamat e-mail']),
            "email.required_without" => __('validation.required_without', ['attribute' => 'alamat e-mail', 'values' => 'nomor telepon']),
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $validator = $this->loginValidation($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $user = User::isUserFrontend()->where('email', $request->input('email'))->first();

        if (!$user) {
            return response_json(false, 'User Not Found', 'Kami tidak dapat menemukan pengguna dengan identitas tersebut.');
        }

        $tokenResult = $user->createToken($user->slug);
        $token = [
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken,
            'expires_at' => \Carbon\Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'full_name' => $user->nama,
            'email' => $user->email,
        ];
        return response_json(true, null, 'Login berhasil.', $token);
    }

}
