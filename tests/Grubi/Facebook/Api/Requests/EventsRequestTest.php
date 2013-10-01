<?php
namespace Grubi\Facebook\Api\Requests;

use Grubi\Facebook\Api\Requests\EventsRequest;

class EventsRequestTest extends \PHPUnit_Framework_TestCase {

    private static $resultErrorBoilerplate = array('error' =>
        array('message' => 'something', 'code' => null));

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

    /**
     * case: user has admin permissions
     */
    public function testHasAdminPermissionsTrue()
    {
        $returnedEvent = array('description' => 'a description');
        $serverResponse = true;
        $this->sdkMock->expects($this->exactly(2))
            ->method('api')
            ->will($this->onConsecutiveCalls($returnedEvent, $serverResponse))
        ;

        $this->assertTrue($this->request->id('aneventid')->hasAdminPermissions());
    }

    /**
     * case: user does not have admin permissions
     */
    public function testHasAdminPermissionsFalse()
    {   
        $execStatus = false;
        $apicalls = function () use(&$execStatus) {
            if ($execStatus) {
                $resultError = self::$resultErrorBoilerplate;
                $resultError['error']['code'] = 200;
                throw new \FacebookApiException($resultError);
            }

            $execStatus = true;

            return array('description' => 'any description');
        };

        $this->sdkMock->expects($this->exactly(2))
            ->method('api')
            ->will($this->returnCallback($apicalls))
        ;

        $this->assertFalse($this->request->id('aneventid')->hasAdminPermissions());
    }

    /**
     * case: unknown api error
     */
    public function testHasAdminPermissionsUnknownError()
    {   
        $execStatus = false;
        $apicalls = function () use(&$execStatus) {
            if ($execStatus) {
                $resultError = self::$resultErrorBoilerplate;
                $resultError['error']['code'] = 290;
                throw new \FacebookApiException($resultError);
            }

            $execStatus = true;

            return array('description' => 'any description');
        };

        $this->sdkMock->expects($this->exactly(2))
            ->method('api')
            ->will($this->returnCallback($apicalls))
        ;

        try {
            $this->request->id('aneventid')->hasAdminPermissions();
            $this->fail();
        } catch (\FacebookApiException $e) {}
    }
}
