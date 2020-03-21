<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_product_detail",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detail"})
 * )
 *
 * @Hateoas\Relation(
 *     "self",
 *     href= @Hateoas\Route(
 *     "app_products_list",
 *     absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"list"})
 * )
 *
 * @Hateoas\Relation(
 *     "list of products",
 *     href= @Hateoas\Route(
 *     "app_products_list",
 *     absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detail"})
 * )
 *
 * @Hateoas\Relation(
 *      "detail product",
 *      href = @Hateoas\Route(
 *          "app_product_detail",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"list"})
 * )
 *
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"detail", "list"})
     * @Serializer\Since("1.0")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Serializer\Groups({"detail", "list"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"detail", "list"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pictures", mappedBy="product", cascade={"persist"})
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("object")
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Characteristics", mappedBy="product", cascade={"persist"})
     * @Serializer\Groups({"detail"})
     * @Serializer\Since("1.0")
     * @Assert\Type("object")
     */
    private $characteristics;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->characteristics = new ArrayCollection();
    }

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
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Characteristics[]
     */
    public function getCharacteristics(): Collection
    {
        return $this->characteristics;
    }

    public function addCharacteristic(Characteristics $characteristic): self
    {
        if (!$this->characteristics->contains($characteristic)) {
            $this->characteristics[] = $characteristic;
            $characteristic->setProduct($this);
        }

        return $this;
    }

    public function removeCharacteristic(Characteristics $characteristic): self
    {
        if ($this->characteristics->contains($characteristic)) {
            $this->characteristics->removeElement($characteristic);
            // set the owning side to null (unless already changed)
            if ($characteristic->getProduct() === $this) {
                $characteristic->setProduct(null);
            }
        }

        return $this;
    }
}
