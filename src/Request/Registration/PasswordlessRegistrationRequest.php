<?php

namespace LeDevoir\PianoIdApiSDK\Request\Registration;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Registration\PasswordlessRegistrationResponse;

class PasswordlessRegistrationRequest extends PianoIdRequest
{
    public const PATH = '/register';

    private string $email;
    private string $firstName;
    private string $lastName;

    public function __construct(
        string $email,
        string $firstName,
        string $lastName
    ){
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return self::PATH;
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): PasswordlessRegistrationResponse
    {
        return PasswordlessRegistrationResponse::fromResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function method(): HTTPMethod
    {
        return HTTPMethod::POST;
    }

    /**
     * @inheritDoc
     */
    public function queryParameters(): array
    {
        return [
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'password' => '',
            'is_passwordless' => 'true',
            'consents' => $_ENV['PIANO_CONSENTS'] ?? ''
        ];
    }
}

