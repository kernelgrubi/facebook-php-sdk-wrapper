<?php
namespace Grubi\Facebook\Api\Requests;

use Grubi\Facebook\Api\Requests\EventsRequest;

class EventsRequestTest extends \PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->sdkMock = $this->getMockBuilder('\Facebook')
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = new EventsRequest($this->sdkMock);
    }

    public function testOne() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId"));

        $this->request->id($eventId)->one();
    }

    public function testUsers() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/invited"));

        $this->request->id($eventId)->users()->all();
    }

    public function testAccepted() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/attending"));

        $this->request->id($eventId)->users()->accepted();
    }

    public function testDenied() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/declined"));

        $this->request->id($eventId)->users()->denied();
    }

    public function testMaybe() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/maybe"));

        $this->request->id($eventId)->users()->maybe();
    }

    public function testNoResponse() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/noreply"));

        $this->request->id($eventId)->users()->noResponse();
    }    
}
