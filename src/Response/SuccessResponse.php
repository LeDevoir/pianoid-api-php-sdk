<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Utils;

abstract class SuccessResponse implements PianoIdResponse
{
    protected Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->mapResponseToAttributes();
    }

    /**
     * Maps response body properties into self attributes
     *
     * TODO: only works on one dimension properties most likely; to be reworked or changed
     *
     * @return void
     */
    private function mapResponseToAttributes(): void
    {
        $body = json_decode(
            (string) $this->response->getBody()
        );

        foreach($body as $key => $value) {
            $property = Utils::snakeToCamelCase($key);
            if (property_exists(static::class, $property)) {
                $this->{$property} = $body->{$key};
            }
        }
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return false;
    }
}