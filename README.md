# DockerHub-API-PHP-SDK [![Latest Stable Version](https://poser.pugx.org/bkuhl/dockerhub-api-php-sdk/v/stable.png)](https://packagist.org/packages/bkuhl/dockerhub-api-php-sdk) [![Total Downloads](https://poser.pugx.org/bkuhl/dockerhub-api-php-sdk/downloads.png)](https://packagist.org/packages/bkuhl/dockerhub-api-php-sdk) [![Coverage Status](https://coveralls.io/repos/github/bkuhl/dockerhub-api-php-sdk/badge.svg)](https://coveralls.io/github/bkuhl/dockerhub-api-php-sdk)

A PHP SDK for integrating with DockerHub's API v2.  

* [Installation](#installation)
* [Usage](#usage)
  * [Organizations](#organizations)
  * [Repositories](#repositories)

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

<a name='organizations'></a>

## Organizations

List all repositories in an organization

```
$dockerhub->repositories($organization);
```

<a name='repositories'></a>

## Repositories

Delete a repository.

```
$dockerhub->repository('[namespace]/[name]')->delete(); // bool
```

List the tags associated with a repository.

```
$dockerhub->repository('[namespace]/[name]')->tags();
```