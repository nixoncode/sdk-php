<?php
/**
 * Created by PhpStorm.
 * User: nixon
 * Date: 28/06/2021
 * Time: 22:37
 */


namespace Advanta;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

abstract class AdvClient
{
    /**
     * Package version
     */
    public const VERSION = '1.0.0';
    
    /**
     * Resource base url
     */
    
    private const BASE_URI = 'https://quicksms.advantasms.com/api/v3/';
    
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $appKey;
    /**
     * @var string
     */
    private $appToken;
    
    public function __construct(string $appKey, string $appToken)
    {
        $this->appKey = $appKey;
        $this->appToken = $appToken;
        $client = new Client(
            [
                'base_uri'              => self::BASE_URI,
                RequestOptions::TIMEOUT => 15,
                RequestOptions::DEBUG   => false,
            ]
        );
        
        $this->client = $client;
    }
    
    /**
     * @throws GuzzleException
     */
    protected function sendRequest(string $path, array $payload)
    {
        try {
            $this->client->post(
                $path,
                [
                    RequestOptions::JSON    => $payload,
                    RequestOptions::HEADERS => [
                        'Accept'       => 'application/json',
                        'Content-Type' => 'application/json',
                        'App-Key'      => $this->appKey,
                        'App-Token'    => $this->appToken,
                    ],
                ]
            );
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
