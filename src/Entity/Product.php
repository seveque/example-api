<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"product_read"}},
 *     denormalizationContext={"groups"={"product_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @ApiProperty(identifier=true)
     * @Groups({"product_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product_read", "product_write"})
     */
    private $label;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Picture", cascade={"persist", "remove"})
     * @Groups({"product_read", "product_write"})
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reference", mappedBy="product", orphanRemoval=true, cascade={"persist", "remove"})
     * @Groups({"product_read", "product_write"})
     */
    private $refs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Size", inversedBy="products")
     * @Groups({"product_read", "product_write"})
     */
    private $sizes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="product", orphanRemoval=true)
     * @Groups({"product_read"})
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CollectionProduct", mappedBy="product", orphanRemoval=true)
     * @Groups({"product_read"})
     */
    private $collectionProducts;


    public function __construct()
    {
        $this->collectionProducts = new ArrayCollection();
        $this->refs = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->sizes = new ArrayCollection();
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

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Reference[]
     */
    public function getRefs(): Collection
    {
        return $this->refs;
    }

    public function addRef(Reference $ref): self
    {
        if (!$this->refs->contains($ref)) {
            $this->refs[] = $ref;
            $ref->setProduct($this);
        }

        return $this;
    }

    public function removeRef(Reference $ref): self
    {
        if ($this->refs->contains($ref)) {
            $this->refs->removeElement($ref);
            // set the owning side to null (unless already changed)
            if ($ref->getProduct() === $this) {
                $ref->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Size[]
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(Size $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        if ($this->sizes->contains($size)) {
            $this->sizes->removeElement($size);
        }

        return $this;
    }
}
