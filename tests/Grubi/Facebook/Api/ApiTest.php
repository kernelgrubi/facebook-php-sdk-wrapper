<?php
namespace Grubi\Facebook\Api;

use Grubi\Facebook\Api\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->sdkMock = $this->getMockBuilder('\Facebook')
            ->disableOriginalConstructor()
            ->getMock();

        $this->api = new Api($this->sdkMock);
    }

    public function testEvents() {
        $result = $this->api->events();
        $this->assertInstanceOf('Grubi\Facebook\Api\Requests\EventsRequest', $result);
    }

    public function testUsers() {
        $result = $this->api->users();
        $this->assertInstanceOf('Grubi\Facebook\Api\Requests\UsersRequest', $result);
    }
}