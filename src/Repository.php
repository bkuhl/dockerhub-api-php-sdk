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

    /**
     * Get the tags for a given repository.  Tags are in the same
     * order they are on DockerHub (most recent first) and are
     * paginated.
     */
    public function tags()
    {
        return $this->client->get('/repositories/'.$this->name().'/tags');
    }

    /**
     * Delete the repository
     */
    public function delete() : bool
    {
        $this->client->delete('/repositories/'.$this->name());

        return $this->client->httpStatusCode == 202;
    }

    public function name() : string
    {
        return $this->name;
    }
}