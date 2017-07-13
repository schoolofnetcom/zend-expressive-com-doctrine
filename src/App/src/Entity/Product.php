<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product extends EntityAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @orm\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @orm\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @orm\Column(type="text")
     */
    protected $description;
}