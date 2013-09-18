<?php
namespace Grubi\Facebook\Api\Requests;

use Grubi\Facebook\Api\Requests\UsersRequest;

class UsersRequestTest extends \PHPUnit_Framework_TestCase {
     public function setUp() {
        $this->sdkMock = $this->getMockBuilder('\Facebook')
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = new UsersRequest($this->sdkMock);
    }

    public function testOne() {
        $userId = 'id do usuario';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$userId"));

        $this->request->id($userId)->one();
    }

    public function testMe() {
        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/me"));

        $this->request->me();
    }

    public function testOneFieldsSelection($value='')
    {
        $userId = 'id do usuario';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo(sprintf('/%s?fields=id,picture,name', $userId)));

        $this->request->id($userId)->fields(array('id', 'picture', 'name'))->one();
    }

    public function testMeFieldsSelection($value='')
    {
        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo('/me?fields=id,picture,name'));

        $this->request->fields(array('id', 'picture', 'name'))->me();
    }
}