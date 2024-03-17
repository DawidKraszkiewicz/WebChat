<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Constants\ModelActions;
use App\Http\Controllers\Controller;
use App\Http\Request\User\CreateUserRequest;
use App\Http\Request\User\SearchUserRequest;
use App\Http\Request\User\UpdateUserRequest;
use App\Models\User;
use App\Service\User\UserManager;
use App\Service\User\UserSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private readonly UserSearchService $userSearchService,
        private readonly UserManager $userManager
    )
    {
    }

    /**
     * @throws \App\Exceptions\Core\UserUnauthorizedException
     */
    public function index(SearchUserRequest $request): View
    {
        $this->checkPolicy(ModelActions::SEARCH, [$this->getCurrentUser()]);

        $itemsPerPage = $request->getItemsPerPage();
        $currentPage = $request->getPage();

        $users = $this->userSearchService->searchUsers(
            $itemsPerPage,
            $request->getQuery()
        );

        $startIndex = ($currentPage - 1) * $itemsPerPage;

        return \view('user.list', [
            'users' => $users,
            'startIndex' => $startIndex
        ]);
    }

    /**
     * @throws \App\Exceptions\Core\UserUnauthorizedException
     * @throws \App\Exceptions\Security\PropertyNotFoundException
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        $this->checkPolicy(ModelActions::CREATE, [$this->getCurrentUser()]);

        $this->userManager->createUser($request->toDto());

        return $this->sendResponse([
            'message' => __('user.created-successfully')
        ]);
    }

    /**
     * @throws \App\Exceptions\Core\UserUnauthorizedException
     * @throws \App\Exceptions\Security\PropertyNotFoundException
     */
    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        $this->checkPolicy(ModelActions::UPDATE, [$user, $this->getCurrentUser()]);

        $this->userManager->updateUser($user, $request->toDto());

        return $this->sendResponse([
            'message' => __('core.update-successful')
        ]);
    }

    /**
     * @throws \App\Exceptions\Core\UserUnauthorizedException
     */
    public function delete(User $user): JsonResponse
    {
        $this->checkPolicy(ModelActions::DELETE, [$this->getCurrentUser()]);

        $this->userManager->deleteUser($user);

        return $this->sendResponse([
            'message' => __('core.deleted-successful')
        ]);
    }
}
