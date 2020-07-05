<?php


namespace App\Model;


class UserRating
{
    private $rating;
    private $articleid;

    public function setRating($rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setArticleid($articleid): self
    {
        $this->articleid = $articleid;
        return $this;
    }

    public function getArticleid():int
    {
        return $this->articleid;
    }
}