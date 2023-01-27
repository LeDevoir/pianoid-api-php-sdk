<?php

namespace LeDevoir\PianoIdApiSDK\Response;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Utils;

abstract class BaseResponse
{
    /**
     * @param Response $response
     * @return static
     */
    public static function fromResponse(Response $response): self
    {
        $body = json_decode(
            $response->getBody()->getContents()
        );

        $template = new \ReflectionClass(static::class);
        $properties = $template->getProperties();
        $instance = new static();

        array_walk($properties, function (\ReflectionProperty $property) use ($template, $body, $instance) {
            $name = Utils::snakeToCamelCase($property->getName());

            $instance->{$name} = $body->{$name};
        });

        return $instance;
    }
}