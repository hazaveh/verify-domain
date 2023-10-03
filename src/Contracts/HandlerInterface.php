<?php

namespace Hazaveh\VerifyDomain\Contracts;

interface HandlerInterface
{
    public function dns_get_record();

    public function file_get_contents();

    public function get_meta_tags();
}
