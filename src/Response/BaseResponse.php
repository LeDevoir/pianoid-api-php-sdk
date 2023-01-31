<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Utils;

abstract class BaseResponse implements ResponseContract
{
    /**
     * @var Response
     */
    protected $httpResponse;

    /**
     * @var array
     */
    protected $errors = [];

    public function __construct(Response $response)
    {
        $this->httpResponse = $response;

        $this->isSuccess()
            ? $this->mapResponseToAttributes()
            : $this->setErrors();
    }

    public function isSuccess(): bool
    {
        return $this->httpResponse->getStatusCode() < 400;
    }

    /**
     * @return Response
     */
    public function getHttpResponse(): Response
    {
        return $this->httpResponse;
    }

    /**
     * Returns the first error message
     * Arbitrary business logic decision, might be a problem down the road.
     * Might need to be reworked
     *
     * @return string|null
     */
    public function errorMessage(): string
    {
        return $this->errors[0] ?? '';
    }

    private function mapResponseToAttributes()
    {
        $body = json_decode(
            (string) $this->httpResponse->getBody()
        );

        foreach($body as $key => $value) {
            $property = Utils::snakeToCamelCase($key);
            if (property_exists(static::class, $property)) {
                $this->{$property} = $body->{$key};
            }
        }
    }

    private function setErrors()
    {
        $body = json_decode(
            (string) $this->httpResponse->getBody()
        );

        $this->errors = array_map(
            function($item) {
                return $item->{'message'};
            },
            $body->{'error_code_list'}
        );
    }
}