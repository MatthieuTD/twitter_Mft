<?php

namespace App\Entity;

use App\Repository\TweetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TweetRepository::class)
 */
class Tweet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tweets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $Text;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="reTweets")
     */
    private $reTweet;

    public function __construct()
    {
        $this->reTweet = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
    {
        $this->Text = $Text;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getReTweet(): Collection
    {
        return $this->reTweet;
    }

    public function addReTweet(User $reTweet): self
    {
        if (!$this->reTweet->contains($reTweet)) {
            $this->reTweet[] = $reTweet;
        }

        return $this;
    }

    public function removeReTweet(User $reTweet): self
    {
        $this->reTweet->removeElement($reTweet);

        return $this;
    }

}
