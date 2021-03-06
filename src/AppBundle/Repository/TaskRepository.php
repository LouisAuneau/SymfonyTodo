<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
    /**
     * To get all tasks that aren't done, for a given user or for all.
     * @param null $user User that has created those tasks. Null if you want all users' tasks.
     *
     * @return array Array of not done tasks.
     */
    public function getOnGoingTasks($user = null){
        $queryBuilder = $this->createQueryBuilder('t');

        // Tasks that end date is not passed yet.
        $queryBuilder->where("t.endDate >= :today")
            ->setParameter("today", new \DateTime());

        // Tasks that aren't done yet.
        $queryBuilder->andWhere("t.done = :done")
            ->setParameter("done", false);

        // If user is set, getting only specified user's tasks.
        if(!is_null($user)) {
            $queryBuilder->andWhere("t.user = :user")
                ->setParameter("user", $user);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * To get all tasks that aren't done at the end date, for a given user or for all.
     * @param null $user User that has created those tasks. Null if you want all users' tasks.
     *
     * @return array Array of not done tasks at the deadline.
     */
    public function getMissedTasks($user = null){
        $queryBuilder = $this->createQueryBuilder('t');

        // Tasks that end date is passed.
        $queryBuilder->where("t.endDate < :today")
            ->setParameter("today", new \DateTime("now"));

        // Tasks that aren't done.
        $queryBuilder->andWhere("t.done = :done")
            ->setParameter("done", false);

        // If user is set, getting only specified user's tasks.
        if(!is_null($user)) {
            $queryBuilder->andWhere("t.user = :user")
                ->setParameter("user", $user);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
