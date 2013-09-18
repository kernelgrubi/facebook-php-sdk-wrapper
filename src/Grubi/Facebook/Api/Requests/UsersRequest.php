<?php
namespace Grubi\Facebook\Api\Requests;

class UsersRequest extends BaseRequest {

    private $fields = array();

    public function fields(array $fields) {
        $this->fields = $fields;

        return $this;
    }
    
    public function one() {
        return $this->sdk->api($this->buildRequestUri($this->id));
    }

    public function me() {
        return $this->sdk->api($this->buildRequestUri('me'));
    }

    public function all() {
        throw new Exception("U mad bro?");
    }

    private function buildRequestUri($prefixPath)
    {
        $requestUri = '/' . $prefixPath;

        if ($this->fields) {
            $requestUri .= '?fields=' . implode(',', $this->fields); 
        }

        return $requestUri;
    }
}