<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CollectionProductRepository")
 */
class CollectionProduct
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collection", inversedBy="product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="collectionProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityDate;

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    /**
     * @param \Ramsey\Uuid\UuidInterface $id
     */
    public function setId(\Ramsey\Uuid\UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getCollection(): ?Collection
    {
        return $this->collection;
    }

    public function setCollection(?Collection $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAvailabilityDate(): ?\DateTimeInterface
    {
        return $this->availabilityDate;
    }

    public function setAvailabilityDate(\DateTimeInterface $availabilityDate): self
    {
        $this->availabilityDate = $availabilityDate;

        return $this;
    }
}
