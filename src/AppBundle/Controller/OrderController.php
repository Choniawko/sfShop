<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Order;

/**
 * @Route("zamowienia", name="orders_list")
 */
 class OrderController extends Controller
 {
    public function indexAction()
    {
    	$orders = $this
    	             ->getUser()
    	             ->getOrders();

        return $this->render('orders/index.html.twig', [
            'orders' => $orders
        ]);
    }
 } 