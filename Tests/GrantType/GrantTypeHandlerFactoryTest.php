<?php

/**
 * This file is part of the pantarei/oauth2-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pantarei\Bundle\OAuth2Bundle\Tests\GrantType;

use Pantarei\OAuth2\GrantType\GrantTypeHandlerFactory;
use Pantarei\OAuth2\GrantType\GrantTypeHandlerInterface;
use Pantarei\OAuth2\Model\ModelManagerFactoryInterface;
use Pantarei\OAuth2\TokenType\TokenTypeHandlerFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FooGrantTypeHandler
{
}

class BarGrantTypeHandler implements GrantTypeHandlerInterface
{
    public function handle(
        SecurityContextInterface $securityContext,
        UserCheckerInterface $userChecker,
        EncoderFactoryInterface $encoderFactory,
        Request $request,
        ModelManagerFactoryInterface $modelManagerFactory,
        TokenTypeHandlerFactoryInterface $tokenTypeHandlerFactory,
        UserProviderInterface $userProvider = null
    )
    {
    }
}

class GrantTypeHandlerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Pantarei\OAuth2\Exception\UnsupportedGrantTypeException
     */
    public function testBadAddGrantTypeHandler()
    {
        $grantTypeHandlerFactory = new GrantTypeHandlerFactory(array(
            'foo' => 'Pantarei\\Bundle\\OAuth2Bundle\\Tests\\GrantType\\FooGrantTypeHandler',
        ));
        $grantTypeHandlerFactory->addGrantTypeHandler('foo', $grantTypeHandler);
    }

    /**
     * @expectedException \Pantarei\OAuth2\Exception\UnsupportedGrantTypeException
     */
    public function testBadGetGrantTypeHandler()
    {
        $grantTypeHandlerFactory = new GrantTypeHandlerFactory(array(
            'bar' => 'Pantarei\\Bundle\\OAuth2Bundle\\Tests\\GrantType\\BarGrantTypeHandler',
        ));
        $grantTypeHandlerFactory->getGrantTypeHandler('foo');
    }

    public function testGoodGetGrantTypeHandler()
    {
        $grantTypeHandlerFactory = new GrantTypeHandlerFactory(array(
            'bar' => 'Pantarei\\Bundle\\OAuth2Bundle\\Tests\\GrantType\\BarGrantTypeHandler',
        ));
        $grantTypeHandlerFactory->getGrantTypeHandler('bar');
    }
}
