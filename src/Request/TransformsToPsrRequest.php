<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use GuzzleHttp\Psr7\Request;

interface TransformsToPsrRequest
{
    /**
     * @param string $applicationId
     * @param string $apiToken
     * @return Request
     */
    public function toPsrRequest(string $applicationId, string $apiToken): Request;

    /**
     * @return string
     */
    public function uri(): string;

    /**
     * @return string
     */
    public function method(): string;

    /**
     * Additional parameters to merge with mandatory ones
     *
     * @return array
     */
    public function queryParameters(): array;
}