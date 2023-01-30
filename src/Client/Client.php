<?php

namespace LeDevoir\PianoIdApiSDK\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use LeDevoir\PianoIdApiSDK\Response\LoginResponse;

final class Client
{
    private const BASE_URI = '/id/api/v1/publisher';

    /** @var string  */
    private $baseUrl;

    /** @var string  */
    private $applicationId;

    /** @var string  */
    private $apiKey;

    /** @var Client */
    private static $instance;

    /** @var GuzzleClient  */
    private $client;

    private function __construct(
        string $baseUrl,
        string $applicationId,
        string $apiToken
    ){
        $this->baseUrl = $baseUrl;
        $this->applicationId = $applicationId;
        $this->apiKey = $apiToken;
        $this->client = new GuzzleClient(['base_uri' => $this->baseUrl]);
    }

    /**
     * @return Client
     */
    public static function getInstance(): self
    {
        if (empty($_ENV['PIANO_ID_API_BASE_URL'])) {
            throw new \RuntimeException('Base url is required to create client instance.');
        }

        if (empty($_ENV['PIANO_APPLICATION_ID'])) {
            throw new \RuntimeException('Application id is required to create client instance.');
        }

        if (empty($_ENV['PIANO_API_TOKEN'])) {
            throw new \RuntimeException('Api token is required to create client instance.');
        }

        if (self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self(
            $_ENV['PIANO_ID_API_BASE_URL'],
            $_ENV['PIANO_APPLICATION_ID'],
            $_ENV['PIANO_API_TOKEN']
        );
    }

    /**
     * @param string $token
     * @return Response
     * @throws GuzzleException
     */
    public function verifyUserToken(string $token): Response
    {
        return $this->client->request(
            'POST',
            sprintf('%s/token/verify', self::BASE_URI),
            [
                RequestOptions::QUERY => [
                    'aid' => $this->applicationId,
                    'api_token' => $this->apiKey,
                    'token' => $token,
                ]
            ]
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @return LoginResponse
     *
     * @throws GuzzleException
     */
    public function login(string $email, string $password): LoginResponse
    {
        $response = $this->client->request(
            'POST',
            sprintf('%s/login', self::BASE_URI),
            [
                RequestOptions::QUERY => [
                    'aid' => $this->applicationId,
                    'api_token' => $this->apiKey,
                    'email' => $email,
                    'password' => $password
                ],
            ]
        );

        return LoginResponse::fromResponse($response);
    }

    public function logout()
    {

    }
}