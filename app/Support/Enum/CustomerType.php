<?php


namespace Vanguard\Support\Enum;


class CustomerType
{
    const NORMAL = 'Normal';
    const PREMIUM = 'Premium';

    public static function type()
    {
        return [
            self::NORMAL => self::NORMAL,
            self::PREMIUM => self::PREMIUM,
        ];
    }
}
