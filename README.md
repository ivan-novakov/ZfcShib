# Shibboleth authentication for ZF2

The module provides Shibboleth authentication as a standard [Zend Framework 2](http://framework.zend.com/) authentication adapter.

## Requirements

* [Shibboleth SP](http://shibboleth.net/) instance - configured and running to provide user's attributes as environment variables to the target application

## Installation

Add the following requirement requirement to your composer.json file:

    "ivan-novakov/zfc-shib": "dev-master"

And run `composer update`.

You can use this as a ZF2 module in a ZF2 MVC application or just as a library in any other type of application.

## Basic usage

Generally you have to specify a list of attributes corresponding to the environment variable names to be extracted - the `user_attr_names` option. You must also specify the attribute which contains the user's identity - the `id_attr_name` option.

    $adapter = new \ZfcShib\Authentication\Adapter\Shibboleth(array(
        'id_attr_name' => 'eppn', 
        'user_attr_names' => array(
            'eppn', 
            'cn', 
            'mail'
        )
    ));
    
    $result = $adapter->authenticate();
    
    if ($result->isValid()) {
        $identity = $result->getIdentity();
    }

The `$identity` array then contains two sub-arrays:

* `system` - contains system attributes
* `user` - contains the required user attributes `eppn`, `cn` and `mail`.

For example:

    Array
    (
        [system] => Array
        (
            [Shib-Application-ID] => default
            [Shib-Identity-Provider] => https://idp.exampl.org/idp/shibboleth
            [Shib-Authentication-Instant] => 2013-05-13T13:40:45.687Z
            [Shib-Authentication-Method] => urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport
            [Shib-AuthnContext-Class] => urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport
            [Shib-Session-Index] => cfe418967cd195e568ac000f57234bc287ecb5532365aa46c893d6e7f34300f0
        )
    
        [user] => Array
        (
            [eppn] => test@example.org
            [cn] => Test User
            [mail] => test.user@example.org
        )
    
    )


## Alternative identity container

By default, the identity is returned as an array. But you can make the adapter return the identity in a format that suits you best. If you pass an identity factory object as a third parameter of the adapter's contructor, it will be used to create the identity. The factory must implement the `ZfcShib\Authentication\Identity\IdentityFactoryInterface` with the `createIdentity()` method, which receives the identity array (see above) as an argument and should return the result identity object or array.

    class MyIdentityFactory implements IdentityFactoryInterface
    {
    
        public function createIdentity(array $userData)
        {
            return new MyUser($userData['user']);
        }
    }
    
    $identityFactory = new MyIdentityFactory();
    $adapter = new \ZfcShib\Authentication\Adapter\Shibboleth($options, null, $identityFactory);
    
## License

* [FreeBSD](http://debug.cz/license/freebsd)
  

## Links

* [GitHub](https://github.com/ivan-novakov/zf2-shibboleth-authentication)
    
