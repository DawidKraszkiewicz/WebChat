<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\Core\UserUnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Request\User\LoginUserRequest;
use App\Service\User\AuthorizationManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(private readonly AuthorizationManager $authorizationManager)
    {
    }

    public function index(): View
    {
        return \view('auth.login');
    }

    public function login(LoginUserRequest $request): RedirectResponse
    {
        try {
            $this->authorizationManager->authorize($request->getUserLoginDto());

            return $this->redirectResponse('dashboard.index');
        } catch (UserUnauthorizedException) {
            return $this->redirectResponse('login', [
                'error' => __('login.incorrect')
            ]);
        }
    }
}
