<?php

declare(strict_types=1);

namespace App\Constants\Validation;

final class Email
{
    public const RULE = ['required', 'email:dns,rfc'];
}
