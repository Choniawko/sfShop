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

    /**
    * @Route("/zamowienia/usun/{id}/", name="order_remove")
    */
    public function removeAction($id)
    {
    	$em = $this->getDoctrine()
    	           ->getManager();

    	$order = $this->getDoctrine()
    	              ->getRepository('AppBundle:Orders')
    	              ->find($id);

    	if (!$order) {
    		throw $this->createNotFoundException(
    			     'Nie znaleziono zamówienia nr' . $id
    	    );

    	}
    	$em->remove($order);
    	$em->flush();

    	return $this->redirectToRoute('orders_list');

        }

    /**
     * @Route("/zamowienia/realizuj/{id}/", name="order_realize")
     */
    public function realizeAction($id)
    {
    	$em = $this->getDoctrine()
    	           ->getManager();

    	$order = $this->getDoctrine()
    	              ->getRepository('AppBundle:Orders')
    	              ->find($id);

    	if (!$order) {
    		throw $this->createNotFoundException(
    			      'Nie znaleziono zamówienia nr' . $id
    		);
    	}
    	$order->setRealised(TRUE);
    	$em->flush();



    	return $this->redirectToRoute('orders_list');
    }


 } 