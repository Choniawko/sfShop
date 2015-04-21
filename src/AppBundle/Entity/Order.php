<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Order
 *
 * @ORM\Table(name="order")
 * @ORM\Entity()
 */
class Order
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
     * @var integer
     *
     * @ORM\Column(name="products_quantity", type="integer", length=255)
     */
    private $products_quantity;

     /**
     * @var integer
     *
     * @ORM\Column(name="order_value", type="decimal", precision=10, scale=2)
     */
    private $order_value;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="orders")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }


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
     * Set products_quantity
     *
     * @param integer $productsQuantity
     * @return Order
     */
    public function setProductsQuantity($productsQuantity)
    {
        $this->products_quantity = $productsQuantity;

        return $this;
    }

    /**
     * Get products_quantity
     *
     * @return integer 
     */
    public function getProductsQuantity()
    {
        return $this->products_quantity;
    }

    /**
     * Set order_value
     *
     * @param string $orderValue
     * @return Order
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
     * Add products
     *
     * @param \AppBundle\Entity\Product $products
     * @return Order
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
}
