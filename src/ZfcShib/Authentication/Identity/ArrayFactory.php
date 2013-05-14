<?php

namespace ZfcShib\Authentication\Identity;


/**
 * Simply returns the user identity as an array.
 *
 */
class ArrayFactory implements IdentityFactoryInterface
{


    /**
     * {@inheritdoc}
     * @see \ZfcShib\Authentication\Identity\IdentityFactoryInterface::createIdentity()
     */
    public function createIdentity(array $userData)
    {
        return $userData;
    }
}