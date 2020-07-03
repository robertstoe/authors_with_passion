<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="TagsID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagsid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TagName", type="string", length=255, nullable=true)
     */
    private $tagname;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
     */
    private $articles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getTagsid(): ?int
    {
        return $this->tagsid;
    }

    public function getTagname(): ?string
    {
        return $this->tagname;
    }

    public function setTagname(?string $tagname): self
    {
        $this->tagname = $tagname;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
        }

        return $this;
    }

}
