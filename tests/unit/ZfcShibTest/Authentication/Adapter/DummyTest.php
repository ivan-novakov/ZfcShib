<?php

namespace ZfcShibTest\Authentication\Adapter;

use ZfcShib\Authentication\Adapter\Dummy;


class DummyTest extends \PHPUnit_Framework_TestCase
{


    public function testAuthenticateWithNoConfig()
    {
        $this->setExpectedException('ZfcShib\Authentication\Adapter\Exception\MissingConfigurationException');
        $adapter = new Dummy();
        $adapter->authenticate();
    }


    public function testAuthenticate()
    {
        $userData = array(
            'username' => 'foo'
        );
        $config = array(
            Dummy::CONFIG_USER_DATA => $userData
        );
        
        $adapter = new Dummy($config);
        $result = $adapter->authenticate();
        
        $this->assertTrue($result->isValid());
        $this->assertSame($userData, $result->getIdentity());
    }
}