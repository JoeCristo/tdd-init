<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RequestBodyTransformer
{
    public function transform(Request $request): void
    {
        switch ($request->headers->get('Content-Type')) {
            case 'application/json':
                $data = json_decode($request->getContent(), true);
                $request->request = new ParameterBag($data);
                break;
            default:
                throw new BadRequestHttpException('Invalid Content-Type');
        }
    }
}