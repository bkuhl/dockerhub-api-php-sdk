<?php

namespace DockerHub;

class DockerHub
{
    /** @var Client */
    protected $client;

    public function __construct(string $username, string $password)
    {
        $this->client = new Client($username, $password);
        $this->client->initialize();
    }

    public function currentUser()
    {
        return $this->client->get('user');
    }

    public function repository(string $name) : Repository
    {
        return new Repository($this->client, $name);
    }

    /**
     * Allow overriding of the client for testing purposes
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

}