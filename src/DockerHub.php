<?php

namespace DockerHub;

class DockerHub
{
    /** @var Client */
    protected $client;

    public function __construct(string $username, string $password, ?Client $client)
    {
        if ($client == null) {
            $this->client = new Client($username, $password);
            $this->client->initialize();
        } else {
            $this->client = $client;
        }
    }

    public function currentUser()
    {
        return $this->client->get('user');
    }

    public function repository(string $name) : Repository
    {
        return new Repository($this->client, $name);
    }
}