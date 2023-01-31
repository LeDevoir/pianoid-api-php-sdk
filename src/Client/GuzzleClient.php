<?php

namespace LeDevoir\PianoIdApiSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use LeDevoir\PianoIdApiSDK\Environment;
use LeDevoir\PianoIdApiSDK\Request\RequestContract;

final class GuzzleClient
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(
        Environment $environment,
        ?ClientInterface $client = null
    ){
        $this->environment = $environment;
        $this->client = $client ?? new Client(['base_uri' => $environment->getBaseUrl()]);
    }

    public function send(RequestContract $request): Response
    {
        try {
            $response = $this->client->request(
                $request->method(),
                $request->uri(),
                [
                    RequestOptions::QUERY => $this->queryParameters($request)
                ]
            );
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
        } catch (ServerException|TransferException $exception) {
            /**
             * In case of error 500 or any other unexpected error
             */
            throw $exception;
        }

        return $response;
    }

    private function queryParameters(RequestContract $request): array
    {
        return array_merge(
            [
                'aid' => $this->environment->getApplicationId(),
                'api_token' => $this->environment->getApiToken(),
            ],
            $request->queryParameters()
        );
    }
}