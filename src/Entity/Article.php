<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="AuthorID", columns={"AuthorID"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="ArticlesID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $articlesid;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var \Authors
     *
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AuthorID", referencedColumnName="AuthorsID")
     * })
     */
    private $authorid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="articleid")
     */
    private $tagid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tagid = new ArrayCollection();
    }

    public function getArticlesid(): ?int
    {
        return $this->articlesid;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAuthorid(): ?Author
    {
        return $this->authorid;
    }

    public function setAuthorid(?Author $authorid): self
    {
        $this->authorid = $authorid;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTagid(): Collection
    {
        return $this->tagid;
    }

    public function addTagid(Tag $tagid): self
    {
        if (!$this->tagid->contains($tagid)) {
            $this->tagid[] = $tagid;
            $tagid->addArticleid($this);
        }

        return $this;
    }

    public function removeTagid(Tag $tagid): self
    {
        if ($this->tagid->contains($tagid)) {
            $this->tagid->removeElement($tagid);
            $tagid->removeArticleid($this);
        }

        return $this;
    }

}
