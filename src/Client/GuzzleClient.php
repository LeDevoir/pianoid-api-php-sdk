<?php

namespace LeDevoir\PianoIdApiSDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use LeDevoir\PianoIdApiSDK\Environment;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;

final class GuzzleClient
{
    private ClientInterface $client;
    private Environment $environment;

    public function __construct(
        ?Environment $environment = null,
        ?ClientInterface $client = null
    ){
        $this->environment = $environment ?? new Environment();
        $this->client = $client ?? new Client(['base_uri' => $this->environment->getBaseUrl()]);
    }

    /**
     * @param PianoIdRequest $request
     * @return Response
     * @throws GuzzleException
     */
    public function send(PianoIdRequest $request): Response
    {
        try {
            return $this->client->request(
                $request->method()->value,
                $request->url(),
                [
                    RequestOptions::QUERY => array_merge(
                        [
                            'aid' => $this->environment->getApplicationId(),
                            'api_token' => $this->environment->getApiToken()
                        ],
                        $request->queryParameters(),
                    )
                ]
            );
        } catch (ClientException $exception) {
            return $exception->getResponse();
        } catch (ServerException|TransferException $exception) {
            /**
             * In case of error 500 or any other unexpected error
             */
            throw $exception;
        }
    }
}