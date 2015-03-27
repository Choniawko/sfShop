<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Product;

/**
 * Description of Basket
 */
class Basket 
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getProducts()
    {
    	return $this->session->get('basket', array());
    }

    public function add(Product $product, $quantity = 1)
    {
    	$products = $this->getProducts();
    	if (!array_key_exists($product->getId(), $products)) {
            $products[$product->getId()] = array(
                'id'       => $product->getId(),
                'name'     => $product->getName(),
                'price'    => $product->getPrice(),
                'quantity' => 0
             	);
    	}
        // aktualizujemy ilość produktów w koszyku
    	$products[$product->getId()]['quantity'] += $quantity;

    	$this->session->set('basket', $products);

    }

    public function remove(Product $product)
    {
    	$products = $this->getProducts();

    	if (!array_key_exists($product->getId(), $products)) {
                throw new \Exception(sprintf('Produkt "%s" nie znajduje się w twoim koszyku', $product->getName()));
            }

            unset($products[$product->getId()]);
            $this->session->set('basket', $products);


            return $this;
        
    }

    public function clear()
    {
    	$this->session->remove('basket');
    	return $this;
    }
}