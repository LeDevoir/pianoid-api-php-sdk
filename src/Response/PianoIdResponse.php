<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;

interface PianoIdResponse
{
    /**
     * Get the underlying http Psr response
     *
     * @return Response
     */
    public function getResponse(): Response;

    /**
     * @return bool
     */
    public function isError(): bool;
}