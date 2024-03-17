<?php

declare(strict_types=1);

namespace App\Dto\Interfaces;

use App\Dto\Contracts\MakeDtoContract;

interface BasicDtoInterface extends MakeDtoContract
{
    public function __set(string $key, mixed $value): void;

    public function __get(string $key): mixed;

    public function toArray(): array;
}
