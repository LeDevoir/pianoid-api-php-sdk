<?php

namespace LeDevoir\PianoIdApiSDK\Request;

abstract class PianoIdRequest implements TransformsToPsrRequest, TransformsResponse
{
    public const HTTP_METHOD_POST = 'POST';
    public const BASE_URL = '/id/api/v1/publisher';

    /**
     * Returns specific request resource path
     *
     * @return string
     */
    abstract protected function path(): string;

    /**
     * @return string
     */
    public function uri(): string
    {
        return sprintf(
            '%s%s',
            PianoIdRequest::BASE_URL,
            $this->path()
        );
    }
}