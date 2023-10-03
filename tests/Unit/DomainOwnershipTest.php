<?php

namespace Test;

use Hazaveh\VerifyDomain\VerifyDomain;
use Hazaveh\VerifyDomain\Handler\MockLookupHandler;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

test('it returns TRUE if txt record exists and matches', function () {

    $expected = [
        ['txt' => 'expected-value', 'host' => 'hazaveh.net']
    ];

    $domainOwnership = new VerifyDomain(new MockLookupHandler($expected));

    assertTrue($domainOwnership->verifyByDNS('hazaveh.net', 'expected-value'));

});

test('it returns FALSE if txt record is missing', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler([['txt' => 'txt-value']]));
    assertFalse($domainOwnership->verifyByDNS('hazaveh.net', 'verification-value'));
});

test('it returns TRUE if file content matches', function () {
    $expectedContent = 'verification-code-123';
    $domainOwnership = new VerifyDomain(new MockLookupHandler($expectedContent));
    assertTrue($domainOwnership->verifyByFile('hazaveh.net', 'verification.txt', $expectedContent));
});

test('it returns FALSE if file content is mismatched', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler('verification-code-123'));
    assertFalse($domainOwnership->verifyByFile('hazaveh.net', 'verification.txt', false));
});

test('it returns TRUE if meta and value match', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler([]));
    var_dump($domainOwnership);
    assertTrue($domainOwnership->verifyByMeta("hazaveh.net", 'verification', 'verification-code-123'));
});

test('it returns FALSE if meta tag is missing', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler([]));
    var_dump($domainOwnership);
    assertFalse($domainOwnership->verifyByMeta("hazaveh.net", 'missing', 'verification-code-123'));
});

test('it returns FALSE if meta value is mismatched', function () {
    $domainOwnership = new VerifyDomain(new MockLookupHandler([]));
    var_dump($domainOwnership);
    assertFalse($domainOwnership->verifyByMeta("hazaveh.net", 'verification', 'mistmatched-value'));
});
