<?php

namespace App\Http\Controllers;

use App\Exceptions\Core\UserUnauthorizedException;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sendResponse(array $array = [], int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($array, $code);
    }

    protected function redirectResponse(string $routeName, array $errors = [], ?string $message = null, array $parameters = []): RedirectResponse
    {
        if (!empty($errors)) {
            return redirect(
                route($routeName, $parameters)
            )->withErrors($errors);
        }

        return redirect(
            route($routeName, $parameters)
        )->with('success', $message);
    }

    protected function getCurrentUser(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }

    /**
     * @throws UserUnauthorizedException
     */
    protected function checkPolicy(string $action, array $arguments = []): void
    {
        try {
            $this->authorize($action, $arguments);
        } catch (AuthorizationException $e) {
            throw new UserUnauthorizedException();
        }

    }
}
