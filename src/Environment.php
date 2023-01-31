<?php

namespace LeDevoir\PianoIdApiSDK;

class Environment
{
    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var string
     */
    private $applicationId;
    /**
     * @var string
     */
    private $apiToken;

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
     * @return mixed|string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return mixed|string
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * @return mixed|string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }
}