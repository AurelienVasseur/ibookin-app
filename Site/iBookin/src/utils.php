<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;

abstract class IntegrationTest extends TestCase {

    private static $process;

    public static function setUpBeforeClass()
    {
        self::$process = new Process("php -S localhost:8080 -t .");
        self::$process->start();
        usleep(100000); //wait for server to get going
    }

    public static function tearDownAfterClass()
    {
        self::$process->stop();
    }

    public function get_client()
    {
        return new Client(['http_errors' => false]);
    }

    public function build_url($url)
    {
        return "localhost:8080" . $url;
    }

    public function make_request($method, $url)
    {
        $client =  $this->get_client();
        return $client->request($method, $this->build_url($url));
    }
}