<?php

namespace DockerHub;

class DockerHub
{
    /** @var Client */
    protected $client;

    public function __construct(string $username, string $password, ?Client $client = null)
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

    /**
     * The repositories for a given namespace
     */
    public function repositories(string $namespace)
    {
        return $this->client->get('/repositories/'.$namespace);
    }
}