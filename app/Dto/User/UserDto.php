<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Dto\FactoryMethod;
use App\Dto\Interfaces\BasicDtoInterface;

class UserDto implements BasicDtoInterface
{
    use FactoryMethod;

    public string $firstName;

    public string $lastName;

    public string $phone;

    public string $email;

    public ?int $roleId = null;

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }
}
