<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\BaseRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;
use LeDevoir\PianoIdApiSDK\Response\ResponseContract;

class LoginRequest extends BaseRequest
{
    public const EMAIL_KEY = 'email';
    public const PASSWORD_KEY = 'password';

    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->email = $username;
        $this->password = $password;
    }

    /**
     * @param Response $response
     * @return LoginResponse
     */
    public function toResponse(Response $response): ResponseContract
    {
        return new LoginResponse($response);
    }

    public function uri(): string
    {
        return sprintf('%s/login', self::BASE_URL);
    }

    public function method(): string
    {
        return self::HTTP_METHOD_POST;
    }

    /**
     * @return array
     */
    public function queryParameters(): array
    {
        return [
            self::EMAIL_KEY => $this->email,
            self::PASSWORD_KEY => $this->password
        ];
    }
}