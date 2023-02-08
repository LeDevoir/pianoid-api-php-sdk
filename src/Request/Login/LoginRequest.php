<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;

final class LoginRequest extends PianoIdRequest
{
    public const EMAIL_KEY = 'email';
    public const PASSWORD_KEY = 'password';

    private string $email;
    private string $password;


    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        return sprintf('%s/login', self::BASE_URL);
    }

    /**
     * @return string
     */
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

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): LoginResponse
    {
        return new LoginResponse($response);
    }
}