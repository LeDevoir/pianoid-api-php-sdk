<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Utils;

abstract class PianoIdResponse
{
    private Response $response;

    protected function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Maps response data into the actual SDK response object (DTO)
     *
     * @param Response $response
     * @return static
     */
    public static function fromResponse(Response $response): static {
        $body = json_decode(
            (string) $response->getBody()
        ) ?? [];

        $instance = new static($response);

        foreach($body as $key => $value) {
            $targetProperty = Utils::snakeToCamelCase($key);

            if (property_exists(static::class, $targetProperty)) {
                $setter = 'set' . ucwords($targetProperty);
                $instance->$setter($body->{$key});
            }
        }

        return $instance;
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
}