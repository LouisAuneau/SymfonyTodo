<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @param AuthorizationCheckerInterface $authorization
     *
     * @return bool
     */
    public static function isLogged(AuthorizationCheckerInterface $authorization){
        return $authorization->isGranted('IS_AUTHENTICATED_REMEMBERED');
    }
}