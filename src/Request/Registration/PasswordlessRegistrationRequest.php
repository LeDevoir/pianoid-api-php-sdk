<?php

namespace LeDevoir\PianoIdApiSDK\Request\Registration;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;
use LeDevoir\PianoIdApiSDK\Response\Registration\PasswordlessRegistrationResponse;

class PasswordlessRegistrationRequest extends PianoIdRequest
{
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

    public const PATH = '/register';

    /**
     * @inheritDoc
     */
    protected function path(): string
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
    public function method(): string
    {
        return self::HTTP_METHOD_POST;
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

