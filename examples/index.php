<?php
require 'vendor/autoload.php';

use Bitskins\BitskinsApi;
use GuzzleHttp\Client;
use ParagonIE\ConstantTime\Base32;
use OTPHP\TOTP;

$secret_key = 'XKU4EM4KYRJDT4XF';
$api_key = 'c7b372ec-72be-4bfd-adeb-c9361d43fcd0';

$code = TOTP::create($secret_key)->now();

$api = new BitskinsApi(new Client, $api_key);

$response = $api->getAllItemPrices($code, 730);

$options = [
    'market_hash_name' => 'AK-47 | Bloodsport',
    'sort_by'          => 'price',
    'order'            => 'desc'
];

$response1 = $api->getInventoryOnSale($code, 730, $options);