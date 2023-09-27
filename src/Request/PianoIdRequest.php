<?php

namespace LeDevoir\PianoIdApiSDK\Request;

abstract class PianoIdRequest implements HttpRequest, ProducesResponse
{
    public const BASE_URL = '/id/api/v1/publisher';

    /**
     * @return string
     */
    public function url(): string
    {
        return sprintf(
            '%s%s',
            PianoIdRequest::BASE_URL,
            $this->path()
        );
    }
}