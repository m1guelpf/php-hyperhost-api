<?php

namespace M1guelpf\HyperHostAPI\Test;

use GuzzleHttp\Client;
use M1guelpf\HyperHostAPI\HyperHost;

class HyperHostTest extends \PHPUnit\Framework\TestCase
{
    /** @var \M1guelpf\HyperHostAPI\HyperHost */
    protected $hyperhost;

    public function setUp()
    {
      parent::setUp();

      $this->hyperhost = new HyperHost();
    }

    /** @test */
    public function it_does_not_have_token()
    {
        $this->assertNull($this->hyperhost->apiToken);
    }

    /** @test */
    public function you_can_set_api_token()
    {
        $this->hyperhost->connect('API_TOKEN');
        $this->assertEquals('API_TOKEN', $this->hyperhost->apiToken);
    }

    /** @test */
    public function you_can_get_client()
    {
        $this->assertInstanceOf(Client::class, $this->hyperhost->getClient());
    }

    /** @test */
    public function you_can_set_client()
    {
        $newClient = new Client(['base_uri' => 'http://foo.bar']);
        $this->assertInstanceOf(Client::class, $newClient);
        $this->assertNotEquals($this->hyperhost->getClient(), $newClient);
        $this->hyperhost->setClient($newClient);
        $this->assertEquals($newClient, $this->hyperhost->getClient());
    }
}
