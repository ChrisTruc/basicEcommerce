<?php

namespace App\Entity;

use App\Repository\AdviceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=AdviceRepository::class)
 */
class Advice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      max = 10
     * )
     */
    private $quality;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      max = 10
     * )
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="advices")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
