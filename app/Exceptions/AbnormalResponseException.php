<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class AbnormalResponseException extends Exception
{
    private ResultCode $resultCode;

    /**
     * @param  string  $resultCode 結果コード
     * @param  string  $message ログ用メッセージ
     * @param  int  $code [optional] The Exception code.
     * @param  Throwable|null  $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(
        ResultCode $resultCode,
        string $message,
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->resultCode = $resultCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * 例外を報告
     *
     * @return bool|null
     */
    public function report()
    {
        // 任意のLoggerを利用
    }

    /**
     * 例外をHTTPレスポンスへレンダリング
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function render($request)
    {
        return new JsonResponse(
            [
                'abnormalContents' => [
                    'resultCode' => $this->resultCode->value,
                    'resultMessage' => $this->resultCode->resultMessage(),
                ],
            ],
            Response::HTTP_OK,
        );
    }
}
