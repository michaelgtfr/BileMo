<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacteristicsRepository")
 *
 */
class Characteristics
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="characteristics")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Since("1.0")
     * @Assert\Type("object")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        //Protection against the faults XSS
        $this->designation = filter_var($designation, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = filter_var($value, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }
}
