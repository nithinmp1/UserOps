<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends EntityRepository
{
    private $entityManager;

    public function __construct(EntityManager  $entityManager) {
        parent::__construct($entityManager, $entityManager->getClassMetadata(User::class));
        $this->entityManager = $entityManager;
    }

    public function findUsersByName(string $name)
    {
        return $this->createQueryBuilder('u')
            ->where('u.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }

    function insert($data) {

        $user = new User();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['hashedPassword']);
        $user->setCreatedAt();
        $user->setUpdatedAt();

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
