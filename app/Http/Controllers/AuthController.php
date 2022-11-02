<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    /**
     * 認証ユーザの取得
     *
     * @param  ApptSlotIndex  $usecase
     * @return JsonResponse
     */
    public function showAuthUser(): JsonResponse
    {
        return new JsonResponse(
            [
                'authUser' => Auth::user(),
            ],
            Response::HTTP_OK
        );
    }
}
