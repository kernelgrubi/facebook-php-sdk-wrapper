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

    /**
     * check if the authenticated user has administration/host permissions on the event
     */
    public function hasAdminPermissions()
    {
        $event = $this->one();

        try {
            // edit the description field to test the user admin permissions
            return $this->sdk->api($this->id, 'POST',
                array('description' => $event['description']));
        } catch (\FacebookApiException $e) {
            if ($e->getResult()['error']['code'] !== 200) {
                // any other facebook api error
                throw $e;
            }   
        }

        // no admin permissions facebook api error
        return false;
    }
}