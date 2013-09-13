<?php
namespace Grubi\Facebook\Api\Iterator;

class FacebookIterator {
    public function __construct($sdk, $baseUrl) {
        $this->sdk = $sdk;
        $this->url = $baseUrl;
    }

    public function next() {
        $this->url = $this->paginationUrl;
        $this->paginationUrl = null;
    }

    public function result() {
        $result = $this->sdk->api($this->url);
        $this->paginationUrl = $result['paging']['next'];
        return (count($result['data']) > 0) ? $result['data'] : false;
    }
}