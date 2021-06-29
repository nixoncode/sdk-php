<?php
/**
 * Created by PhpStorm.
 * User: nixon
 * Date: 28/06/2021
 * Time: 22:37
 */


namespace Advanta;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

use function json_decode;

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
                RequestOptions::HEADERS => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'App-Key'      => $this->appKey,
                    'App-Token'    => $this->appToken,
                ],
            ]
        );
        
        $this->client = $client;
    }
    
    
    protected function sendRequest(string $path, array $payload)
    {
        try {
            $response = $this->client->post(
                $path,
                [
                    RequestOptions::JSON => $payload,
                ]
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $body = $e->getResponse()->getBody()->getContents();
            $code = $e->getResponse()->getStatusCode();
            
            
            $data = json_decode($body, true);
            $message = $body;
            
            if ($data) {
                $message = $data['message'];
            }
            
            return ['code' => $code, 'message' => $message];
        } catch (GuzzleException $e) {
            return ['code' => 500, 'message' => $e->getMessage()];
        } catch (Exception $e) {
            return ['code' => 500, 'message' => $e->getMessage()];
        }
    }
}
