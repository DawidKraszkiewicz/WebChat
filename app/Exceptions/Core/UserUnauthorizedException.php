<?php

declare(strict_types=1);

namespace App\Exceptions\Core;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserUnauthorizedException extends \Exception
{
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'error' => __('messages.unauthorized')
        ], Response::HTTP_FORBIDDEN);
    }
}
