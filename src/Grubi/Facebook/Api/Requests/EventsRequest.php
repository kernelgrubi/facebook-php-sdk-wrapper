<?php
namespace Grubi\Facebook\Api\Requests;

use Grubi\Facebook\Api\Iterator\FacebookIterator;

class EventsRequest extends BaseRequest {
    public function one() {
        return $this->sdk->api("/{$this->id}");
    }

    public function users() {
        return $this;
    }

    public function all() {
        return false;
    }

    public function invited() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/invited"));
    }

    public function accepted() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/attending"));
    }

    public function denied() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/declined"));
    }      

    public function maybe() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/maybe"));
    }

    public function noResponse() {
        return new FacebookIterator($this->sdk, $this->buildRequestUri("{$this->id}/noreply"));
    }
}