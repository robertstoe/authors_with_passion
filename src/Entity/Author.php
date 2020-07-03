<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="authors", uniqueConstraints={@ORM\UniqueConstraint(name="Nickname", columns={"Nickname"}), @ORM\UniqueConstraint(name="Email", columns={"Email"})})
 * @ORM\Entity
 */
class Author
{
    /**
     * @var int
     *
     * @ORM\Column(name="AuthorsID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $authorid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Surname", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=320, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_score", type="integer", nullable=true)
     */
    private $total_score = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_votes", type="integer", nullable=true)
     */
    private $total_votes = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="Nickname", type="string", length=255, nullable=false)
     */
    private $nickname;

    public function getAuthorid(): ?int
    {
        return $this->authorid;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

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

    public function getRating(): ?float
    {
        if($this->total_votes == 0)
            return 0;

        return number_format((float)$this->total_score / $this->total_votes, 2, '.', '');
    }

    public function setTotalscore(?int $score): self
    {
        $this->total_score = $this->total_score + $score;

        return $this;
    }

    public function setTotalvotes(): self
    {
        $this->total_votes = $this->total_votes + 1;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }


}
