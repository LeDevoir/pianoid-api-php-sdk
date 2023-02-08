<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Response\FailureResponse;
use LeDevoir\PianoIdApiSDK\Response\SuccessResponse;

interface GeneratesPianoIdResponse
{
    /**
     * @param Response $response
     * @return SuccessResponse
     */
    public function success(Response $response): SuccessResponse;

    /**
     * @param Response $response
     * @return FailureResponse
     */
    public function failure(Response $response): FailureResponse;
}