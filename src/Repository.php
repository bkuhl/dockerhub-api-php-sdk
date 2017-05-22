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

    public function create(string $shortDescription = '', ?string $longDescription = null, bool $private = false) : Repository
    {
        $repositoryName = explode('/', $this->name);

        $response = $this->client->post('/repositories', [
            'namespace'         => $repositoryName[0],
            'name'              => $repositoryName[1],
            'description'       => $shortDescription,
            'full_description'  => (is_null($longDescription) ? $shortDescription : $longDescription),
            'is_private'        => $private
        ]);

        return $response;
    }

    public function tags()
    {
        return $this->client->get('/repositories/'.$this->name.'/tags');
    }

    public function name() : string
    {
        return $this->name;
    }
}