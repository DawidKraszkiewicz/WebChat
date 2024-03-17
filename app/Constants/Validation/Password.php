<?php

declare(strict_types=1);

namespace App\Constants\Validation;

final class Password
{
    public const RULE = ['required', 'min:8', 'confirmed'];
}

