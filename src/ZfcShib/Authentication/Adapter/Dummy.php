<?php

namespace ZfcShib\Authentication\Adapter;


/**
 * A dummy adapter for testing purposes. It always returns the same user identity, created from the user data
 * set in the configuration under the 'user_data' field.
 *
 */
class Dummy extends AbstractAdapter
{

    const CONFIG_USER_DATA = 'user_data';


    /**
     * {@inheritdoc}
     * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $userData = $this->getConfigVar(self::CONFIG_USER_DATA);
        if (null === $userData) {
            throw new Exception\MissingConfigurationException(self::CONFIG_USER_DATA);
        }
        
        return $this->createSuccessfulAuthenticationResult($userData);
    }
}