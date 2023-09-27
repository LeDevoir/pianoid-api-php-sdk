<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;

final class LoginRequest extends PianoIdRequest
{
    public const PATH = '/login';
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
     * @return HTTPMethod
     */
    public function method(): HTTPMethod
    {
        return HTTPMethod::POST;
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
        return LoginResponse::fromResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return self::PATH;
    }
}