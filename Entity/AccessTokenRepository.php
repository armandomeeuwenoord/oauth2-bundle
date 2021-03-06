<?php

/**
 * This file is part of the pantarei/oauth2-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pantarei\Bundle\OAuth2Bundle\Entity;

use Doctrine\ORM\EntityRepository;
use Pantarei\OAuth2\Model\AccessTokenInterface;
use Pantarei\OAuth2\Model\AccessTokenManagerInterface;

/**
 * AccessTokenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccessTokenRepository extends EntityRepository implements AccessTokenManagerInterface
{
    public function getClass()
    {
        return $this->getClassName();
    }

    public function createAccessToken()
    {
        $class = $this->getClass();
        return new $class();
    }

    public function deleteAccessToken(AccessTokenInterface $access_token)
    {
        $this->getEntityManager()->remove($access_token);
        $this->getEntityManager()->flush();
    }

    public function reloadAccessToken(AccessTokenInterface $access_token)
    {
        $this->getEntityManager()->refresh($access_token);
    }

    public function updateAccessToken(AccessTokenInterface $access_token)
    {
        $this->getEntityManager()->persist($access_token);
        $this->getEntityManager()->flush();
    }

    public function findAccessTokenByAccessToken($access_token)
    {
        return $this->findOneBy(array(
            'access_token' => $access_token,
        ));
    }
}
