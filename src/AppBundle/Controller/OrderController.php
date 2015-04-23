<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Orders;


 class OrderController extends Controller
 {
 	/**
     * @Route("/zamowienia", name="orders_list")
     */
    public function indexAction()
    {

        $orders = $this->getUser()->getOrders();

         return $this->render('orders/index.html.twig', [
             'orders' => $orders,
         ]);
    }
    
    /**
     * @Route("/zamowienia/show/{id}/", name="order_show")
     */
    public function editAction($id)
    {
    	$order = $this->getDoctrine()
    	              ->getRepository('AppBundle:Orders')
    	              ->find($id);

    	if (!$order) {
    		throw $this->createNotFoundException(
    			    'Nie znaleziono zamówienia nr' . $id
    	    );
    	}
    	$products = $order->getProducts();
    	return $this->render('orders/show.html.twig', [
            'products' => $products,
            'order' => $order,   
    	]);
    }
 } 