<?php

namespace Hazaveh\VerifyDomain;

use Hazaveh\VerifyDomain\Contracts\HandlerInterface;
use Hazaveh\VerifyDomain\Handler\LookupHandler;

class VerifyDomain
{
    /**
     * @var HandlerInterface $handler
     */
    private $handler;
    public function __construct($handler = null)
    {
        $this->handler = $handler ?: new LookupHandler();
    }

    /**
     * @param string $domain
     * @param string $value
     * @return bool
     */
    public function verifyByDNS($domain, $value)
    {
        try {
            $records = $this->handler->dns_get_record($domain, DNS_TXT);
        } catch (\Exception $e) {
            $records = [];
        }

        $filteredRecords = [];
        foreach ($records as $record) {
            if ($record['txt'] === $value && $record['host']) {
                $filteredRecords[] = $record;
            }
        }
        return !empty($filteredRecords);
    }

    /**
     * @param $domain
     * @param $file
     * @param $value
     * @return bool
     */
    public function verifyByFile($domain, $file, $value)
    {
        $url = "http://$domain/$file";

        return trim($this->handler->file_get_contents($url)) == $value;
    }
}
