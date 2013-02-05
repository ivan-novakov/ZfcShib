<?php

namespace ZfcShib\Authentication\Identity;


interface IdentityFactoryInterface
{


    /**
     * Creates and return a user identity based on the provided user data.
     * 
     * @param unknown_type $identity
     * @return mixed
     */
    public function createIdentity(array $userData);
}