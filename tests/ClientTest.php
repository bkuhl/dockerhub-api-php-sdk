<?php

namespace DockerHub;

use Mockery;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var Client */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->username = uniqid();
        $this->password = uniqid();
        $this->client = new Client($this->username, $this->password);
    }

    /** @test */
    public function defaultsAreSet()
    {
        $this->client = Mockery::mock(Client::class.'[setHeader, getAuthToken]', [$this->username, $this->password]);
        $token = uniqid();
        $this->client->shouldReceive('getAuthToken')->with($this->username, $this->password)->andReturn($token);
        $this->client->shouldReceive('setHeader')->with('Accept', 'application/json')->once();
        $this->client->shouldReceive('setHeader')->with('Content-Type', 'application/json')->once();
        $this->client->shouldReceive('setHeader')->with('Authorization', 'JWT '.$token)->once();

        $this->assertTrue($this->client->initialize());
    }

    /** @test */
    public function suppliesAuthToken()
    {
        $this->client = Mockery::mock(Client::class.'[post]', [$this->username, $this->password]);
        $response = new class {};
        $response->token = uniqid();
        $this->client->shouldReceive('post')->with('/users/login', [
            'username' => $this->username,
            'password' => $this->password
        ]);
        $this->client->response = $response;

        $this->assertEquals($response->token, $this->client->getAuthToken($this->username, $this->password));
    }
}