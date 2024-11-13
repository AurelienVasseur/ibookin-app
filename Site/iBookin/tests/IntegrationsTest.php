<?php
require_once 'vendor/autoload.php';

class PagesIntegrationTest extends IntegrationTest{

    public function test_index()
    {
        $response = $this->make_request("GET", "/");
        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertEquals("Hello World!", $response->getBody()->getContents());
        $this->assertContains("text/html", $response->getHeader('Content-Type')[0]);
    }
}