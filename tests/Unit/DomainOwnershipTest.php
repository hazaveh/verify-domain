<?php

namespace Test;

use Hazaveh\VerifyDomain\VerifyDomain;
use Hazaveh\VerifyDomain\Handler\MockLookupHandler;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

test('it can verify if a domain has required TXT verification records', function () {

    $expected = [
        ['txt' => 'expected-value', 'hostname' => 'hazaveh.net']
    ];

    $domainOwnership = new VerifyDomain(new MockLookupHandler($expected));

    assertTrue($domainOwnership->verifyByDNS('hazaveh.net', 'expected-value'));

});

test('it can verify if the required TXT record does not exist', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler([['txt' => 'txt-value']]));
    assertFalse($domainOwnership->verifyByDNS('hazaveh.net', 'verification-value'));
});

test('it can verify if the file content exists', function () {
    $expectedContent = 'verification-code-123';
    $domainOwnership = new VerifyDomain(new MockLookupHandler($expectedContent));
    assertTrue($domainOwnership->verifyByFile('hazaveh.net', 'verification.txt', $expectedContent));
});

test('it can verify if the file content is missing', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler('verification-code-123'));
    assertFalse($domainOwnership->verifyByFile('hazaveh.net', 'verification.txt', false));
});
