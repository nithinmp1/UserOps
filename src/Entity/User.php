<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    // Getters and setters for properties

    function setUsername($username)  {
        $this->username = $username;
    }

    function setEmail($email)  {
        $this->email = $email;
    }

    function setPassword($password)  {
        $this->password = $password;
    }

    public function setCreatedAt($createdAt = null)
    {
        if ($createdAt === null) {
            $createdAt = new \DateTime();
        }
        $this->created_at = $createdAt;
    }

    // Set updated_at to current datetime when not set
    public function setUpdatedAt($updatedAt = null)
    {
        if ($updatedAt === null) {
            $updatedAt = new \DateTime();
        }
        $this->updated_at = $updatedAt;
    }

}
