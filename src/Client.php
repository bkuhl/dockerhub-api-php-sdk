<?php

namespace DockerHub;

use Curl\Curl;

class Client extends Curl
{
    const API_VERSION = 'v2';

    const API_URL = 'https://hub.docker.com';

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    public function __construct(string $username, string $password)
    {
        parent::__construct();

        $this->username = $username;
        $this->password = $password;
    }

    public function initialize() : bool
    {
        $this->setHeader('Accept', 'application/json');
        $this->setHeader('Content-Type', 'application/json');
        $this->setHeader('Authorization', 'JWT '.$this->getAuthToken($this->username, $this->password));
        $this->setOpt(CURLOPT_FOLLOWLOCATION, true);

        return true;
    }

    public function getAuthToken(string $username, string $password) : string
    {
        $this->post('/users/login', [
            'username' => $username,
            'password' => $password
        ]);

        return $this->response->token;
    }

    public function post($url, $data = array(), $follow_303_with_post = false)
    {
        return parent::post($this->makeUrl($url), $data, $follow_303_with_post);
    }

    public function get($url, $data = array())
    {
        return parent::get($this->makeUrl($url), $data);
    }

    private function makeUrl(string $url)
    {
        if ($url[0] != '/') {
            $url = '/'.$url;
        }

        return self::API_URL.'/'.self::API_VERSION.$url;
    }

}