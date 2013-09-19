<?php
namespace Grubi\Facebook\Api\Iterator;

use Grubi\Facebook\Api\Iterator\FacebookIterator;

class FacebookIteratorTest extends \PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->sdkMock = $this->getMockBuilder('\Facebook')
            ->disableOriginalConstructor()
            ->getMock();

        $this->baseUrl = 'base url';
        $this->nextUrl = 'proxima pagina';
        $this->iter = new FacebookIterator($this->sdkMock, $this->baseUrl);
    }

    public function testResult() {
        $this->sdkMock->expects($this->once())
            ->method('api')
            ->with($this->equalTo($this->baseUrl))
            ->will(
                $this->returnValue(
                    $this->mockResponse()
                )
            );

        $this->iter->result();
    }

    public function testNext() {
        $this->sdkMock->expects($this->at(0))
            ->method('api')
            ->with($this->equalTo($this->baseUrl))
            ->will(
                $this->returnValue(
                    $this->mockResponse()
                )
            );

        $this->sdkMock->expects($this->at(1))
            ->method('api')
            ->with($this->equalTo($this->nextUrl))
            ->will(
                $this->returnValue(
                    $this->mockEmptyResponse()
                )
            );

        $this->iter->result();
        $this->iter->next();
        $this->iter->result();
    }

    public function testIteratorEnd() {
        $this->sdkMock->expects($this->at(0))
            ->method('api')
            ->with($this->equalTo($this->baseUrl))
            ->will(
                $this->returnValue(
                    $this->mockResponse()
                )
            );

        $this->sdkMock->expects($this->at(1))
            ->method('api')
            ->with($this->equalTo($this->nextUrl))
            ->will(
                $this->returnValue(
                    $this->mockEmptyResponse()
                )
            );

        $this->iter->result();
        $this->iter->next();
        $result = $this->iter->result();

        $this->assertFalse($result);
    }

    private function mockResponse() {
        return array(
            'data' => array(
                array(
                    'name' => 'Teste teste',
                    'rsvp_status' => 'attending',
                    'id' => '1301780770197'
                ),
                array(
                    'name' => 'Teste teste2',
                    'rsvp_status' => 'denied',
                    'id' => '13017807706764'
                ),
            ),

            'paging' => array(
                'next' => $this->nextUrl
            )
        );
    }

    private function mockEmptyResponse() {
        return array(
            'data' => array(
            ),

            'paging' => array(
                'next' => $this->nextUrl
            )
        );    
    }
}
