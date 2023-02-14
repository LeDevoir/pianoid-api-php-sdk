<?php

namespace LeDevoir\PianoIdApiSDK\Request;

interface TransformsToPsrRequest
{
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