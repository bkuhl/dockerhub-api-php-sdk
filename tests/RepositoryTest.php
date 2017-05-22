<?php

namespace DockerHub;

use Mockery;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    /** @var Mockery\MockInterface */
    protected $client;

    /** @var string */
    protected $namespace;

    /** @var string */
    protected $repositoryName;

    /** @var Repository */
    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->namespace = uniqid();
        $this->repositoryName = uniqid();
        $this->client = Mockery::mock(Client::class);
        $this->repository = new Repository($this->client, $this->namespace.'/'.$this->repositoryName);
    }

    /** @test */
    public function canListTags()
    {
        $return = uniqid();
        $this->client->shouldReceive('get')->with('/repositories/'.$this->namespace.'/'.$this->repositoryName.'/tags')->andReturn($return);

        $this->assertEquals($return, $this->repository->tags());
    }

    /** @test */
    public function canDeleteRepository()
    {
        $this->client->shouldReceive('delete')->with('/repositories/'.$this->namespace.'/'.$this->repositoryName);
        $this->client->httpStatusCode = 202;

        $this->assertTrue($this->repository->delete());
    }

    /** @test */
    public function replacesUnderscoreWithLibraryInName()
    {
        $this->repository = new Repository($this->client, '_/mysql');
        $this->assertEquals('library/mysql', $this->repository->name());
    }

    /** @test */
    public function suppliesUntouchedNames()
    {
        $this->repository = new Repository($this->client, 'my-namespace/my-project');
        $this->assertEquals('my-namespace/my-project', $this->repository->name());
    }
}