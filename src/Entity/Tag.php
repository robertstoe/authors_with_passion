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
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="tagid")
     * @ORM\JoinTable(name="articlestags",
     *   joinColumns={
     *     @ORM\JoinColumn(name="TagID", referencedColumnName="TagsID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ArticleID", referencedColumnName="ArticlesID")
     *   }
     * )
     */
    private $articleid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articleid = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getArticleid(): Collection
    {
        return $this->articleid;
    }

    public function addArticleid(Article $articleid): self
    {
        if (!$this->articleid->contains($articleid)) {
            $this->articleid[] = $articleid;
        }

        return $this;
    }

    public function removeArticleid(Article $articleid): self
    {
        if ($this->articleid->contains($articleid)) {
            $this->articleid->removeElement($articleid);
        }

        return $this;
    }

}
