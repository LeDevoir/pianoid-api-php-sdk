<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Response\ResponseContract;

interface RequestContract
{
    /**
     * @param Response $response
     * @return ResponseContract
     */
    public function toResponse(Response $response): ResponseContract;

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