<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;

interface ResponseContract
{
    /**
     * Get the underlying http response
     *
     * @return Response
     */
    public function getHttpResponse(): Response;

    /**
     * Returns the first error message
     * Arbitrary business logic decision, might be a problem down the road.
     * Might need to be reworked
     *
     * @return string|null
     */
    public function errorMessage(): string;
}