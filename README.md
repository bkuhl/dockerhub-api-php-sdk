# DockerHub-API-PHP-SDK [![Latest Stable Version](https://poser.pugx.org/bkuhl/dockerhub-api-php-sdk/v/stable.png)](https://packagist.org/packages/bkuhl/dockerhub-api-php-sdk) [![Total Downloads](https://poser.pugx.org/bkuhl/dockerhub-api-php-sdk/downloads.png)](https://packagist.org/packages/bkuhl/dockerhub-api-php-sdk) [![Coverage Status](https://coveralls.io/repos/github/bkuhl/dockerhub-api-php-sdk/badge.svg)](https://coveralls.io/github/bkuhl/dockerhub-api-php-sdk)

A PHP SDK for integrating with DockerHub's API v2.  

* [Installation](#installation)
* [Usage](#usage)
  * [Repositories](#repositories)
    * [List Tags](#list-tags)


<a name='installation'></a>

# Installation

```
composer require bkuhl/dockerhub-api-php-sdk
```

<a name='usage'></a>

# Usage

```
$dockerhub = new \DockerHub\DockerHub($username, $password);
```

<a name='repositories'></a>

## Repositories

 > When accessing library repositories such as https://hub.docker.com/_/mysql/ you

<a name='list-tags'></a>

### List Tags

List the tags associated with a repository.

```
$dockerhub->repository('[namespace]/[name]')->tags();
```