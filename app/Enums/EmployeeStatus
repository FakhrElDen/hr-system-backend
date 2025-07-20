<?php

namespace App\Enums;

class EmployeeStatus
{
    public const ACTIVE = 0;
    public const IN_ACTIVE = 1;

    public static function getStringValue(int $value): string
    {
        switch ($value) {
            case self::ACTIVE:
                return 'Active';
            case self::IN_ACTIVE:
                return 'In Active';
            default:
                return 'Unknown';
        }
    }
}
