<?php

namespace ZfcShib\Authentication\Identity;


/**
 * Identity factory interface.
 */
interface IdentityFactoryInterface
{


    /**
     * Creates and return a user identity based on the provided user data.
     * 
     * @param array $userData
     * @return mixed
     */
    public function createIdentity(Data $identityData);
}