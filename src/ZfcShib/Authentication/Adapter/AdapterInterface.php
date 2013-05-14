<?php

namespace ZfcShib\Authentication\Adapter;

use ZfcShib\Authentication\Identity\IdentityFactoryInterface;
use Zend\Authentication\Adapter\AdapterInterface as ZendAuthAdapterInterface;


/**
 * The interface extends the standard Zend authentication adapter interface.
 */
interface AdapterInterface extends ZendAuthAdapterInterface
{


    /**
     * Sets a custom identity factory.
     * 
     * @param IdentityFactoryInterface $identityFactory
     */
    public function setIdentityFactory(IdentityFactoryInterface $identityFactory);
}