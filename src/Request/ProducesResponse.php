<?php

namespace LeDevoir\PianoIdApiSDK\Request;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

interface ProducesResponse
{
    /**
     * @param Response $response
     * @return LoginResponse
     */
    public function toPianoIdResponse(Response $response): PianoIdResponse;
}