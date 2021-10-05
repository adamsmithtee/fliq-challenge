<?php


namespace Vanguard\Support\Enum;


class TransactionStatus
{
    const SUCCESS = 'Success';
    const FAILURE = 'Failure';

    public static function status()
    {
        return [
            self::SUCCESS => self::SUCCESS,
            self::FAILURE => self::FAILURE,
        ];
    }
}
