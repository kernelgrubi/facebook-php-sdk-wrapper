<?php
namespace Grubi\Facebook\Api\Requests;

use Grubi\Facebook\Api\Iterator\FacebookIterator;

class UsersRequest extends BaseRequest {

    public function one() {
        return $this->sdk->api($this->buildRequestUri($this->id));
    }

    public function me() {
        return $this->sdk->api($this->buildRequestUri('me'));
    }

    public function all() {
        throw new Exception("U mad bro?");
    }

    public function relatives() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/family"));
    }
}