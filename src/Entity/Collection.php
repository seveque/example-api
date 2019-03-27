<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CollectionRepository")
 */
class Collection
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
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CollectionProduct", mappedBy="collection", orphanRemoval=true)
     */
    private $collectionProducts;

    public function __construct()
    {
        $this->collectionProducts = new ArrayCollection();
    }

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCollectionProducts()
    {
        return $this->collectionProducts;
    }

    public function addCollectionProduct(CollectionProduct $collectionProduct): self
    {
        if (!$this->collectionProducts->contains($collectionProduct)) {
            $this->collectionProducts[] = $collectionProduct;
            $collectionProduct->setProduct($this);
        }

        return $this;
    }

    public function removeCollectionProduct(CollectionProduct $collectionProduct): self
    {
        if ($this->collectionProducts->contains($collectionProduct)) {
            $this->collectionProducts->removeElement($collectionProduct);
            // set the owning side to null (unless already changed)
            if ($collectionProduct->getProduct() === $this) {
                $collectionProduct->setProduct(null);
            }
        }

        return $this;
    }
}
