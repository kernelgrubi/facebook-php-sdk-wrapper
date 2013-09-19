<?php
namespace Grubi\Facebook\Api\Iterator;

class FacebookIterator {
    public function __construct($sdk, $baseUrl) {
        $this->sdk = $sdk;
        $this->url = $baseUrl;
    }

    public function next() {
        if(isset($this->paginationUrl)) {
            $paginationUrl = str_replace('https://graph.facebook.com', '', $this->paginationUrl);
            $this->url = $paginationUrl;
            $this->paginationUrl = null;
        }
    }

    public function result() {
        $result = $this->sdk->api($this->url);

        if(!isset($result['data']))
            return false;

        if(isset($result['paging']))
            if(isset($result['paging']['next']))
                $this->paginationUrl = $result['paging']['next'];
        
        return (count($result['data']) > 0) ? $result['data'] : false;
    }
}