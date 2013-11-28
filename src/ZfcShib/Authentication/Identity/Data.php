<?php

namespace ZfcShib\Authentication\Identity;


/**
 * Value object holding identity data.
 */
class Data
{

    /**
     * @var array
     */
    protected $userData = array();

    /**
     * @var array
     */
    protected $systemData = array();


    /**
     * Constructor.
     * 
     * @param array $userData
     * @param array $systemData
     */
    public function __construct(array $userData, array $systemData = array())
    {
        $this->setUserData($userData);
        $this->setSystemData($systemData);
    }


    /**
     * @return array
     */
    public function getUserData()
    {
        return $this->userData;
    }


    /**
     * @return array
     */
    public function getSystemData()
    {
        return $this->systemData;
    }


    /**
     * @param array $userData
     */
    protected function setUserData(array $userData)
    {
        $this->userData = $userData;
    }


    /**
     * @param array $systemData
     */
    protected function setSystemData(array $systemData)
    {
        $this->systemData = $systemData;
    }
}