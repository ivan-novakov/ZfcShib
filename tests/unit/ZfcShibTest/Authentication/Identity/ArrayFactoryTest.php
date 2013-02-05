<?php

namespace ZfcShib\Authentication\Identity;

use ZfcShib\Authentication\Identity\ArrayFactory;


class ArrayFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateIdentity()
    {
        $factory = new ArrayFactory();
        $userData = array(
            'username' => 'foo'
        );
        
        $this->assertSame($userData, $factory->createIdentity($userData));
    }
}