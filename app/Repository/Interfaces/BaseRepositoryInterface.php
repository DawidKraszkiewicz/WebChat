<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function save(Model $model): void;

    public function delete(Model $model): void;
}
