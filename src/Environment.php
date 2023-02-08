<?php

namespace LeDevoir\PianoIdApiSDK;

final class Environment
{
    private string $baseUrl;
    private string $applicationId;
    private string $apiToken;

    public function __construct(
        string $baseUrl = '',
        string $applicationId = '',
        string $apiToken = ''
    )
    {
        if (empty($baseUrl) && empty($_ENV['PIANO_ID_API_BASE_URL'])) {
            throw new \RuntimeException('base url is mandatory');
        }

        if (empty($applicationId) && empty($_ENV['PIANO_APPLICATION_ID'])) {
            throw new \RuntimeException('application id is mandatory');
        }

        if (empty($apiToken) && empty($_ENV['PIANO_API_TOKEN'])) {
            throw new \RuntimeException('api token is mandatory');
        }

        $this->baseUrl = $baseUrl ?: $_ENV['PIANO_ID_API_BASE_URL'];
        $this->applicationId = $applicationId ?: $_ENV['PIANO_APPLICATION_ID'];
        $this->apiToken = $apiToken ?: $_ENV['PIANO_API_TOKEN'];
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }
}