<?php
namespace Grubi\Facebook\Api\Requests;

class UsersRequest extends BaseRequest {
    public function one() {
        return $this->sdk->api("/{$this->id}");
    }

    public function me() {
        return $this->sdk->api('/me');
    }

    public function all() {
        throw new Exception("U mad bro?");
    }
}