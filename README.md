<p align="center">  
  <img src="https://hazaveh.net/wp-content/uploads/verify-domain.jpeg" />  
</p>  

# VERIFY DOMAIN
PHP Verify Domain lets you verify the ownership of a domain by validating uploaded file contents and TXT DNS records. You might have seen similar behaviour when verifying your domain on sites like "Google Search Console" and ...

This library is compatible with php > 5 and has almost zero runtime dependency.

## Installation
Simply run via composer:

    composer require hazaveh/verify-domain

## Usage
Simply instantiate the VerifyDomain Class or inject it using your DI container.
```php
use Hazaveh\VerifyDomain\VerifyDomain;  
    
$verify = new VerifyDomain();  

/**
* Verifies if a TXT record with the value of "php-is-awesome" exists.
 */
$byDNS = $verify->verifyByDNS('hazaveh.net', 'php-is-awesome');

/**
* Verifies "https://hazaveh.net/verification.txt" with the content of "php-is-awesome" exists.
 */
$byFile = $verify->verifyByFile("hazaveh.net", 'verification.txt', "php-is-awesome");

```

## Contribution
Add something cool or fix a broken cup, run the tests and create a PR ❤️🚀