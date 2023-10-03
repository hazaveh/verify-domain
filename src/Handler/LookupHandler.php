<?php

namespace Hazaveh\VerifyDomain\Handler;

use Hazaveh\VerifyDomain\Contracts\HandlerInterface;

class LookupHandler implements HandlerInterface
{
    public function dns_get_record(...$arguments)
    {
        return dns_get_record(...$arguments);
    }

    public function file_get_contents(...$arguments)
    {
        return file_get_contents(...$arguments);
    }

    public function get_meta_tags(...$arguments)
    {
        return get_meta_tags($arguments);
    }
}
