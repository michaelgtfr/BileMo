<?php
/**
 * User: michaelgt
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\Unique
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Json()
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Type("string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="client")
     * @Serializer\Since("1.0")
     * @Assert\Type("object")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $business;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"detail", "list", "listUsers", "detailUser", "deleteUser"})
     * @Serializer\Since("1.0")
     * @Assert\Type("string")
     */
    private $country;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles[] = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setClient($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getClient() === $this) {
                $user->setClient(null);
            }
        }

        return $this;
    }

    public function getBusiness(): ?string
    {
        return $this->business;
    }

    public function setBusiness(?string $business): self
    {
        //Protection against the faults XSS
        $this->business = filter_var($business, FILTER_SANITIZE_STRING);

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = filter_var($address, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = filter_var($country, FILTER_SANITIZE_STRING);

        return $this;
    }
}
