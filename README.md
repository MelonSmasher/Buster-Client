# Buster Client - PHP

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/MelonSmasher/Buster-Client/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/MelonSmasher/Buster-Client.svg)](https://github.com/MelonSmasher/Buster-Client/issues)

## Install

Install with [composer](https://packagist.org/packages/open-resource-manager/client-php).

```shell
composer require melonsmasher/buster-client ~1.0
```

## Usage

#### Example:

```php
<?php

use Buster\Client;

class SomeClass
{
    function someFunction () {
    
        // API environment variables
        $apiKey = '123456789';
        $apiHost = 'buster.example.com';
        $apiPort = 443;
        $useHttps = true;
        
        $pathToPuge = '/about';
        $schemeId = 1;
        $clientUserName = 'WordPressAdmin';
        
        // Create the client
        $buster = new Client($apiKey, $apiHost, $apiPort, $useHttps);
        // Purge a page from the cache(s)
        $buster->bust($pathToPuge, $schemeId, $clientUserName);
        
    }
}
```