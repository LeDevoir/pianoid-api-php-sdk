<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Utils;

abstract class PianoIdResponse implements WrapsHttpResponse
{
    protected Response $response;
    public array $errorCodeList;

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
     * @return bool
     */
    public function isFailure(): bool
    {
        return $this->response->getStatusCode() >= 400;
    }

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return implode(', ', $this->errors());
    }

    /**
     * @return array|string[]
     */
    public function errors(): array
    {
        $body = json_decode(
            (string) $this->response->getBody()
        );

        return array_map(
            function($item) {
                return $item->{'message'};
            },
            $body->{'error_code_list'}
        );
    }

    /**
     * @return Response
     */
    public function getHttpResponse(): Response
    {
        return $this->response;
    }
}