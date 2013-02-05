<?php

namespace ZfcShib\Authentication\Adapter;

use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;


class Shibboleth extends AbstractAdapter
{

    const OPT_ID_ATTR_NAME = 'id_attr_name';

    const OPT_USER_ATTR_NAMES = 'user_attr_names';

    const OPT_SYSTEM_ATTR_NAMES = 'system_attr_names';

    /**
     * Default user ID attribute name.
     * 
     * @var string
     */
    protected $idAttributeName = 'eppn';

    /**
     * User attribute names to be extracted from the server environment.
     * 
     * @var array
     */
    protected $userAttributeNames = array(
        'eppn', 
        'peristent-id', 
        'affiliation', 
        'entitlement', 
        'cn', 
        'sn', 
        'givenName', 
        'displayName', 
        'mail', 
        'telephoneNumber', 
        'employeeNumber', 
        'employeeType', 
        'preferredLanguage', 
        'o', 
        'ou'
    );

    /**
     * System attribute names to be extracted from the server environment.
     * 
     * @var array
     */
    protected $systemAttributeNames = array(
        'Shib-Application-ID', 
        'Shib-Identity-Provider', 
        'Shib-Authentication-Instant', 
        'Shib-Authentication-Method', 
        'Shib-AuthnContext-Class', 
        'Shib-Session-Index'
    );


    /**
     * {@inheritdoc}
     * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $userId = $this->getUserId();
        if (null === $userId) {
            return $this->createFailureAuthenticationResult(Result::FAILURE_IDENTITY_NOT_FOUND, sprintf("User identity attribute '%s' not found", $this->getIdAttributeName()));
        }
        
        $userData = array(
            'system' => $this->extractAttributeValues($this->getSystemAttributeNames(), $this->getServerVars()), 
            'user' => $this->extractAttributeValues($this->getUserAttributeNames(), $this->getServerVars())
        );
        
        return $this->createSuccessfulAuthenticationResult($userData);
    }


    /**
     * Returns the user ID.
     * @return string 
     */
    public function getUserId()
    {
        return $this->getServerVar($this->getIdAttributeName());
    }


    /**
     * Returns the name of the attribute holding the user's identity.
     * 
     * @return string
     */
    public function getIdAttributeName()
    {
        $idAttributeName = $this->getConfigVar(self::OPT_ID_ATTR_NAME);
        if (null === $idAttributeName) {
            $idAttributeName = $this->idAttributeName;
        }
        
        return $idAttributeName;
    }


    public function getUserAttributeValues()
    {
        return $this->extractAttributeValues($this->getUserAttributeNames(), $this->getServerVars());
    }


    public function getSystemAttributeValues()
    {
        return $this->extractAttributeValues($this->getSystemAttributeNames(), $this->getServerVars());
    }


    /**
     * Returns the list of user attribute names to be extracted from the environment.
     * 
     * @return array
     */
    public function getUserAttributeNames()
    {
        return $this->getAttributeNames(self::OPT_USER_ATTR_NAMES, $this->userAttributeNames);
    }


    /**
     * Returns the list of system attributes to be extracted from the environment.
     * 
     * @return array
     */
    public function getSystemAttributeNames()
    {
        return $this->getAttributeNames(self::OPT_SYSTEM_ATTR_NAMES, $this->systemAttributeNames);
    }


    /**
     * Generic method, which returns a list of attribute names. If the corresponding config field is set 
     * ($configVarName) with relevant data, returns those data. Otherwise returns the provided default values.
     * 
     * @param string $configVarName
     * @param array $defaultValue
     * @return array
     */
    protected function getAttributeNames($configVarName, array $defaultValue)
    {
        $attributeNames = $this->getConfigVar($configVarName);
        if (null !== $attributeNames && is_array($attributeNames)) {
            return $attributeNames;
        }
        
        return $defaultValue;
    }


    /**
     * Extracts and returns array members from $allValues which has keys contained in the $names array.
     * 
     * @param array $names
     * @param array $allValues
     * @return array
     */
    protected function extractAttributeValues(array $names, array $allValues)
    {
        $values = array();
        foreach ($names as $name) {
            if (isset($allValues[$name])) {
                $values[$name] = $allValues[$name];
            }
        }
        
        return $values;
    }
}