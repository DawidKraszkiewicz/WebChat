<?php

declare(strict_types=1);

namespace App\Dto\Contracts;

interface MakeDtoContract
{
    public const EXCLUDED_FIELDS = [
        '_token'
    ];
}
