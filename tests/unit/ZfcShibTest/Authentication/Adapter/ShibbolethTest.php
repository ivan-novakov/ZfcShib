<?php

namespace ZfcShibTest\Authentication\Adapter;

use Zend\Authentication\Result;
use ZfcShib\Authentication\Adapter\Shibboleth;


class ShibbolethTest extends \PHPUnit_Framework_TestCase
{


    public function testAuthenticateWithNoUserId()
    {
        $adapter = new Shibboleth();
        $result = $adapter->authenticate();
        
        $this->assertInstanceOf('Zend\Authentication\Result', $result);
        $this->assertFalse($result->isValid());
        $this->assertSame(Result::FAILURE_IDENTITY_NOT_FOUND, $result->getCode());
    }


    public function testAuthenticate()
    {
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_ID_ATTR_NAME => 'id', 
            Shibboleth::OPT_SYSTEM_ATTR_NAMES => array(
                'systemAttr'
            ), 
            Shibboleth::OPT_USER_ATTR_NAMES => array(
                'userAttr'
            )
        ), array(
            'id' => 'testuser', 
            'systemAttr' => 'systemValue', 
            'userAttr' => 'userValue', 
            'foo' => 'bar'
        ));
        
        $result = $adapter->authenticate();
        
        $this->assertInstanceOf('Zend\Authentication\Result', $result);
        $this->assertTrue($result->isValid());
        $this->assertSame(array(
            'system' => Array(
                'systemAttr' => 'systemValue'
            ), 
            'user' => Array(
                'userAttr' => 'userValue'
            )
        ), $result->getIdentity());
    }


    public function testGetUserId()
    {
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_ID_ATTR_NAME => 'id'
        ), array(
            'id' => 'testuser'
        ));
        
        $this->assertSame('testuser', $adapter->getUserId());
    }


    public function testGetIdAttributeName()
    {
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_ID_ATTR_NAME => 'id'
        ));
        
        $this->assertSame('id', $adapter->getIdAttributeName());
    }


    public function testGetUserAttributeNames()
    {
        $attrNames = array(
            'foo', 
            'bar'
        );
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_USER_ATTR_NAMES => $attrNames
        ));
        
        $this->assertSame($attrNames, $adapter->getUserAttributeNames());
    }


    public function testGetSystemAttributeNames()
    {
        $attrNames = array(
            'foo', 
            'bar'
        );
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_SYSTEM_ATTR_NAMES => $attrNames
        ));
        
        $this->assertSame($attrNames, $adapter->getSystemAttributeNames());
    }


    public function testGetUserAttributeValues()
    {
        $attrNames = array(
            'attr1', 
            'attr2'
        );
        $values = array(
            'attr1' => 'value1', 
            'attr3' => 'value3'
        );
        
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_USER_ATTR_NAMES => $attrNames
        ), $values);
        
        $this->assertSame(array(
            'attr1' => 'value1'
        ), $adapter->getUserAttributeValues());
    }
    
    public function testGetSystemAttributeValues()
    {
        $attrNames = array(
            'attr1',
            'attr2'
        );
        $values = array(
            'attr1' => 'value1',
            'attr3' => 'value3'
        );
    
        $adapter = new Shibboleth(array(
            Shibboleth::OPT_SYSTEM_ATTR_NAMES => $attrNames
        ), $values);
    
        $this->assertSame(array(
            'attr1' => 'value1'
        ), $adapter->getSystemAttributeValues());
    }
}