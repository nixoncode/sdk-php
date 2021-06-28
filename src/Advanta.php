<?php

/**
 * This file is part of the nixoncode/sdk-php library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Nixon Kosgei <nkosgey6@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Advanta;

/**
 * Send Sms Messages, buy airtime, kplc prepaid tokens, pay kplc postpaid bills, tv and nairobi water
 */
class Advanta
{
    /**
     * @var string
     */
    private $appKey;
    /**
     * @var string
     */
    private $appToken;
    
    /**
     * Advanta constructor.
     * Initialize and pass in your application credentials, this will be used to authenticate the application
     * @link https://docs.advantasms.com/guides/auth/getting-credentials to get your credentials
     * @param $appKey string your app key
     * @param $appToken string your app token
     */
    public function __construct(string $appKey, string $appToken)
    {
        $this->appKey = $appKey;
        $this->appToken = $appToken;
    }
    
    /**
     * Returns a simple and friendly message.
     *
     * @return string
     */
    public function getHello() : string
    {
        return 'Hello, World!';
    }
    
    public function airtime() : Airtime
    {
        return new Airtime($this);
    }
    
    public function getKey() : string
    {
        return $this->appKey;
    }
    
    public function getToken() : string
    {
        return $this->appToken;
    }
}
