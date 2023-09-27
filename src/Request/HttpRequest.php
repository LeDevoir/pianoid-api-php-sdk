<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;

interface HttpRequest
{
    /**
     * Returns HTTP method
     *
     * @return HTTPMethod
     */
    public function method(): HTTPMethod;

    /**
     * Returns request path
     *
     * @return string
     */
    public function path(): string;

    /**
     * Returns request url
     *
     * @return string
     */
    public function url(): string;

    /**
     * Parameters specific to the request object
     * To be merged with required parameters
     *
     * @return array
     */
    public function queryParameters(): array;
}