<?php
/**
 * User: michaelgt
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PicturesRepository")
 */
class Pictures
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
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $extension;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Since("1.0")
     * @Assert\Type("object")
     */
    private $product;

    /**
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $src;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        //Protection against the faults XSS
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = filter_var($extension, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);

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

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }
}
