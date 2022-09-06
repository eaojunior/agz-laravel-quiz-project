<?php

namespace App\Packages\Student\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student
{
    use TimestampableEntity;

    public function __construct(
        /** @ORM\Column(type="uuid", unique=true) */
        private string $id,
        /**
         * @ORM\Id
         * @ORM\Column(type="string")
         */
        private string $name,
        /**
         * @ORM\Id
         * @ORM\Column(type="string")
         */
        private string $lastname
    ) {}
}
