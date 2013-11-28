<?php

namespace ZfcShib\Authentication\Identity;

use ZfcShib\Authentication\Identity\ArrayFactory;


class ArrayFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateIdentity()
    {
        $userData = array(
            'username' => 'foo'
        );
        $systemData = array(
            'session' => 'bar'
        );
        
        $identityData = $this->getMockBuilder('ZfcShib\Authentication\Identity\Data')
            ->disableOriginalConstructor()
            ->getMock();
        $identityData->expects($this->once())
            ->method('getUserData')
            ->will($this->returnValue($userData));
        $identityData->expects($this->once())
            ->method('getSystemData')
            ->will($this->returnValue($systemData));
        
        $factory = new ArrayFactory();
        $identity = $factory->createIdentity($identityData);
        
        $this->assertSame($userData, $identity['user']);
        $this->assertSame($systemData, $identity['system']);
    }
}