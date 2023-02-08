<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;

interface WrapsHttpResponse
{
    /**
     * Get the underlying http Psr response
     *
     * @return Response
     */
    public function getHttpResponse(): Response;
}