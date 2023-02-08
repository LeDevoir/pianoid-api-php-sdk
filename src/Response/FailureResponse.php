<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;

final class FailureResponse implements PianoIdResponse
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
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
     * @inheritDoc
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
        return true;
    }
}