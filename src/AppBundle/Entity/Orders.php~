<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    private $modified_at;

    /**
     * @var string
     *
     * @ORM\Column(name="order_value", type="decimal", precision=10, scale=2)
     */
    private $order_value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="realised", type="boolean")
     */
    private $realised;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="orders")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Orders
     */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime("now");

    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return Orders
     */
    public function setModifiedAt()
    {
        $this->modified_at = new \DateTime("now");

    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Set order_value
     *
     * @param string $orderValue
     * @return Orders
     */
    public function setOrderValue($orderValue)
    {
        $this->order_value = $orderValue;

        return $this;
    }

    /**
     * Get order_value
     *
     * @return string 
     */
    public function getOrderValue()
    {
        return $this->order_value;
    }

    /**
     * Set realised
     *
     * @param boolean $realised
     * @return Orders
     */
    public function setRealised($realised)
    {
        $this->realised = $realised;

        return $this;
    }

    /**
     * Get realised
     *
     * @return boolean 
     */
    public function getRealised()
    {
        return $this->realised;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param \AppBundle\Entity\Product $products
     * @return Orders
     */
    public function addProduct(\AppBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \AppBundle\Entity\Product $products
     */
    public function removeProduct(\AppBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Orders
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
