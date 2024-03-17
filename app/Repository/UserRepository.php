<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\Core\EntityNotFoundException;
use App\Models\User;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use App\Repository\Interfaces\User\UserSearchRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface, UserSearchRepositoryInterface
{
    use RepositoryTrait;

    /**
     * @returns User
     * @throws EntityNotFoundException
     */
    public function findOneBy(array $criteria): Model
    {
        try {
            return User::query()->where($criteria)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw new EntityNotFoundException();
        }
    }

    public function search(?string $query = null, ?int $itemsPerPage = null): LengthAwarePaginator
    {
        return User::search($query)->paginate($itemsPerPage);
    }
}
