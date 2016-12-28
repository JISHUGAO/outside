<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 14:39
 */

namespace console\models;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class BaseCrawler
{
    public static function getClient()
    {
        $client = new Client();
        $guzzleClient = new GuzzleClient([
            'timeout' => 30
        ]);
        $client->setClient($guzzleClient);
        return $client;
    }
}