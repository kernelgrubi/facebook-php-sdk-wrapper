<?php
namespace Grubi\Facebook\Api\Requests;

abstract class BaseRequest {

    protected $sdk;

    protected $id;

    public function __construct($sdk) {
        $this->sdk = $sdk;
    }

    public function id($id) {
        $this->id = $id;

        return $this;
    }

    abstract function one();
    abstract function all();
}