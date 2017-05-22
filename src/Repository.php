<?php

namespace DockerHub;

class Repository
{
    /** @var string */
    protected $name;

    /** @var Client */
    protected $client;

    public function __construct(Client $client, string $name)
    {
        $this->client = $client;

        // for official libraries, we need to use "library" as the namespace
        $this->name = str_replace('_/', 'library/', $name);
    }

    public function tags()
    {
        return $this->client->get('/repositories/'.$this->name.'/tags');
    }

    public function delete() : bool
    {
        $this->client->delete('/repositories/'.$this->name);

        return $this->client->httpStatusCode == 202;
    }

    public function name() : string
    {
        return $this->name;
    }
}