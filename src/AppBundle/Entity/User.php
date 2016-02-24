<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Task", mappedBy="user")
     */
    private $tasks;

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

    /**
     * Add tasks
     *
     * @param \AppBundle\Entity\Task $tasks
     * @return User
     */
    public function addTask(\AppBundle\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;
        $tasks->setUser($this);

        return $this;
    }

    /**
     * Remove tasks
     *
     * @param \AppBundle\Entity\Task $tasks
     */
    public function removeTask(\AppBundle\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
