<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Plat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nomPlat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cout;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrCalories;

    /**
     * @ORM\Column(type="string")
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="Regime", inversedBy="plats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $regime;

    // add getters and setters for all properties
}
