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
 } 