<?php

namespace Hazaveh\VerifyDomain\Handler;

/**
 * Created for Testing intentions.
 */
class MockLookupHandler extends LookupHandler
{
    private $response;
    public function __construct($response)
    {
        $this->response = $response;
    }

    public function dns_get_record(...$arguments)
    {
        return $this->response;
    }

    public function file_get_contents(...$arguments)
    {
        return $this->response;
    }
}
