<?php

class IndexTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => getenv('DOMAIN')
        ]);
    }

    public function testIndexRoute()
    {
        $response = $this->client->request('GET', '/');

        $this->assertEquals('200', $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals(
            'RESTful API for Retail PIP',
            $data['description']
        );
    }
}
