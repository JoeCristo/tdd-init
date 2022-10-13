<?php

namespace App\Controller\User;

use App\Http\DTO\RegisterRequest;
use App\Service\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController
{
    public function __construct (
        private RegisterService $registerService
    ) {}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = ($this->registerService)($request);

        return new JsonResponse([
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]
        ], Response::HTTP_CREATED);
    }
}