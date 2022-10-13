<?php

namespace App\Service;

use App\Entity\User;
use App\Http\DTO\RegisterRequest;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordEncoderInterface $userPasswordEncoder
    ) {}

    public function __invoke(RegisterRequest $registerRequest): User
    {
        $user = new User($registerRequest->getName(), $registerRequest->getEmail());
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $registerRequest->getPassword()));

        $this->userRepository->save($user);
        $test = 0;
        return $user;
    }


}