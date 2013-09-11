<?php
namespace Grubi\Facebook\Api\Requests;

class EventsRequest extends BaseRequest {
    public function one() {
        return $this->sdk->api("/{$this->id}");
    }

    public function users() {
        return $this;
    }

    public function all() {
        return $this->sdk->api("/{$this->id}/invited");
    }

    public function accepted() {
        return $this->sdk->api("/{$this->id}/attending");
    }

    public function denied() {
        return $this->sdk->api("/{$this->id}/declined");
    }      

    public function maybe() {
        return $this->sdk->api("/{$this->id}/maybe");
    }

    public function noResponse() {
        return $this->sdk->api("/{$this->id}/noreply");
    }  
}