<?php
/**
 * Created by PhpStorm.
 * User: nixon
 * Date: 28/06/2021
 * Time: 21:51
 */


namespace Advanta;

class Airtime extends AdvClient
{
    /**
     * Maximum recipients per request
     */
    public const MAX_RECIPIENTS = 1000;
    
    /**
     * Maximum amount per recipient
     */
    public const MAX_AMOUNT = 1000;
    /**
     * Minimum allowed amount per recipient
     */
    public const MIN_AMOUNT = 10;
    /**
     * URI path to resource
     */
    private const URI_PATH = 'airtime/buy';
    
    
    /**
     * @var array of recipients
     */
    private $recipients = [];
    
    public function __construct(Advanta $advanta)
    {
        parent::__construct($advanta->getKey(), $advanta->getToken());
    }
    
    /**
     * Add recipients to send airtime to
     * @note This will not send airtime until you call send()
     * @param $phoneNumber int|string|mixed airtime recipient
     * @param $amount int amount to send airtime to
     * @return $this
     */
    public function addRecipient($phoneNumber, int $amount) : Airtime
    {
        $this->recipients[] = ['recipient' => $phoneNumber, 'amount' => $amount];
        return $this;
    }
    
    public function send() : array
    {
        $this->sendRequest(self::URI_PATH, $this->recipients);
        return $this->recipients;
    }
}
