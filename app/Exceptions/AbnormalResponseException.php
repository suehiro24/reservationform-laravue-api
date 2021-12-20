<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class AbnormalResponseException extends Exception
{
    private string $resultCode;

    /**
     * @param string $resultCode 結果コード
     * @param string $message ログ用メッセージ
     * @param integer $code [optional] The Exception code.
     * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(
        string $resultCode,
        string $message,
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->resultCode = $resultCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string $resultCode 結果コード
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * @return string $resultCode 結果コード
     */
    private function resolveResultCode()
    {
        // TODO: 結果コード定数ファイル作成
        // $this->resultCode;
        return "[temp] Abnormal response messageeeeeeeeeeeee";
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
                    'resultMessage' => $this->resolveResultCode(),
                    'resultCode' => $this->getResultCode()
                ]
            ],
            Response::HTTP_OK,
        );
    }
}
