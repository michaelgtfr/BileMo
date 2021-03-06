<?php
/**
 * User: michaelgt
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @Hateoas\Relation(
 *     "authenticated_user",
 *     embedded = @Hateoas\Embedded("expr(service('security.token_storage').getToken().getUser())"),
 *     exclusion = @Hateoas\Exclusion(groups={"listUsers", "detailUser", "deleteUser"})
 * )
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_users_list",
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"listUsers"})
 * )
 * @Hateoas\Relation(
 *      "detail of user",
 *      href = @Hateoas\Route(
 *          "app_user_detail",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"listUsers"})
 * )
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_user_detail",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detailUser"})
 * )
 * @Hateoas\Relation(
 *      "list of users",
 *      href = @Hateoas\Route(
 *          "app_users_list",
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detailUser", "deleteUser"})
 * )
 * @Hateoas\Relation(
 *      "create new user",
 *      href = @Hateoas\Route(
 *          "app_user_create",
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detailUser", "listUsers", "deleteUser"})
 * )
 * @Hateoas\Relation(
 *      "delete a user",
 *      href = @Hateoas\Route(
 *          "app_user_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"detailUser", "listUsers"})
 * )
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     * @Serializer\Groups({"listUsers", "detailUser"})
     * @Serializer\Since("1.0")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Type("string")
     * @Serializer\Groups({"detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Serializer\Groups({"detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Type("string")
     * @Serializer\Groups({"listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Type("string")
     * @Serializer\Groups({"listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $firstname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("object")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\NotBlank
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Groups({"listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Groups({"detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\DateTime
     */
    private $dateCreate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        //Protection against the faults XSS
        $this->country = filter_var($country, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = filter_var($address, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = filter_var($firstname, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }
}
