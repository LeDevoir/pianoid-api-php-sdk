<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use GuzzleHttp\Psr7\Request;

abstract class PianoIdRequest implements TransformsToPsrRequest, GeneratesPianoIdResponse
{
    public const HTTP_METHOD_POST = 'POST';
    public const BASE_URL = '/id/api/v1/publisher';

    public function toPsrRequest(string $applicationId, string $apiToken): Request
    {
        return new Request(
            $this->method(),
            $this->uri(),
            array_merge(
                [
                    'aid' => $applicationId,
                    'api_token' => $apiToken,
                ],
                $this->queryParameters()
            )
        );
    }
}