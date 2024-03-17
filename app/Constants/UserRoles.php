<?php

declare(strict_types=1);

namespace App\Constants;

final class UserRoles
{
    public const USER = 1;
    public const ADMIN = 2;

    public const USER_ROLES = [
        self::USER,
        self::ADMIN
    ];
}
