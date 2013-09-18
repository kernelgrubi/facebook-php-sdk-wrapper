<?php
namespace Grubi\Facebook\Api\Requests;

abstract class BaseRequest {

    protected $sdk;

    protected $id;

    protected $fields = array();

    public function __construct($sdk)
    {
        $this->sdk = $sdk;
    }


    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    protected function buildRequestUri($prefixPath)
    {
        $requestUri = '/' . $prefixPath;

        if ($this->fields) {
            $requestUri .= '?fields=' . implode(',', $this->fields); 
        }

        return $requestUri;
    }

    abstract function one();
    abstract function all();
}