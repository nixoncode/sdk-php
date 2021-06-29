<?php
/**
 * Created by PhpStorm.
 * User: nixon
 * Date: 29/06/2021
 * Time: 05:28
 */

use Advanta\Advanta;

require_once __DIR__ . '/../vendor/autoload.php';

$appKey = '<YOUR_APP_KEY>';
$appToken = '<YOUR_APP_TOKEN>';

$advanta = new Advanta($appKey, $appToken);

$airtime = $advanta->airtime();

$result = $airtime->addRecipient('254719XXXXXX', 100)->send();

var_dump($result);
