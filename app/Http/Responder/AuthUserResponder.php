<?php

namespace App\Http\Responder;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;

class AuthUserResponder implements LoginResponse
{
    /**
     * Create an HTTP response that represents the object.
     * 認証ユーザを返却するように Laravel\Fortify\Http\Responses\LoginResponseを書き換え(要コンテナ登録)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        if ($request->wantsJson()) {
            return new JsonResponse(
                [
                    'two_factor' => false,
                    'authUser' => Auth::user(),
                ],
                Response::HTTP_OK
            );
        } else {
            return redirect()->intended(Fortify::redirects('login'));
        }
    }
}
