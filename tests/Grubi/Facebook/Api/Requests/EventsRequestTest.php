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

    public function testInvited() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/invited"));

        $iterator = $this->request->id($eventId)->users()->invited();
        $iterator->result();
    }

    public function testAccepted() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/attending"));

        $iterator = $this->request->id($eventId)->users()->accepted();
        $iterator->result();
    }

    public function testDenied() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/declined"));

        $iterator = $this->request->id($eventId)->users()->denied();
        $iterator->result();
    }

    public function testMaybe() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/maybe"));

        $iterator = $this->request->id($eventId)->users()->maybe();
        $iterator->result();
    }

    public function testNoResponse() {
        $eventId = 'id do evento';

        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo("/$eventId/noreply"));

        $iterator = $this->request->id($eventId)->users()->noResponse();
        $iterator->result();
    }    
}
