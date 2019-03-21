<?php

namespace App\Entity;

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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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

    public function getId(): ?int
    {
        return $this->id;
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
