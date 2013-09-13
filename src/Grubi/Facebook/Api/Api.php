<?php
namespace Grubi\Facebook\Api;

use Grubi\Facebook\Api\Requests\EventsRequest;
use Grubi\Facebook\Api\Requests\UsersRequest;

class Api {
    public function __construct($sdk = null, $appId = null, $appSecret = null) {
        if(!empty($appId) && !empty($appSecret)) {
            $this->sdk = new \Facebook(array(
                'appId' => $appId,
                'secret' => $appSecret
            ));
        } else {
            $this->sdk = $sdk;
        }
    }

    public function events() {
        return new EventsRequest($this->sdk);
    }

    public function users() {
        return new UsersRequest($this->sdk);
    }
}