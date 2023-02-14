<?php

namespace LeDevoir\PianoIdApiSDK\Request;

abstract class PianoIdRequest implements TransformsToPsrRequest, TransformsResponse
{
    public const HTTP_METHOD_POST = 'POST';
    public const BASE_URL = '/id/api/v1/publisher';
}