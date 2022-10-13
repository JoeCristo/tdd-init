<?php

namespace App\Tests\Functional\Controller\User;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RegisterControllerTest extends WebTestCase
{
    private const ENDPOINT = '/api/v1/users/register';
    private static ?KernelBrowser $client = null;

    public function setUp(): void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameter('CONTENT_TYPE', 'application/json');
        }

        parent::setUp();
    }

    public function testRegisterUserWithNoData(): void
    {
        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], json_encode([]));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testRegisterUser(): void
    {
        $payload = [
            'name' => 'cristo',
            'email' => 'cristo@mail.com',
            'password' => 'pass123'
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testRegisterUserWithNoName(): void
    {
        $payload = [
          'email' => 'cristo@mail.com',
          'password' => 'pass123'
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testRegisterUserWithNoEmail(): void
    {
        $payload = [
            'name' => 'cristo',
            'password' => 'pass123'
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testRegisterUserWithNoPassword(): void
    {
        $payload = [
            'name' => 'cristo',
            'email' => 'cristo@mail.com'
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], json_encode($payload));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}