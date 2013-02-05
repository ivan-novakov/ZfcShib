<?php

namespace ZfcShib\Authentication\Adapter;

use ZfcShib\Authentication\Identity\IdentityFactoryInterface;
use Zend\Authentication\Adapter\AdapterInterface as ZendAuthAdapterInterface;


interface AdapterInterface extends ZendAuthAdapterInterface
{


    public function setIdentityFactory(IdentityFactoryInterface $identityFactory);
}