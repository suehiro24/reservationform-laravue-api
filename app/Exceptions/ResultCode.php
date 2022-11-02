<?php

namespace App\Exceptions;

interface IResultCode
{
    public function resultMessage(): string;
}

enum ResultCode: int implements IResultCode
{
    case Failed = 0;

    public function resultMessage(): string
    {
        return match ($this) {
            static::Failed => 'エラーです。'
        };
    }
}
