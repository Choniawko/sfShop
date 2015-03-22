<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $qb = $this
            ->getDoctrine()
            ->getManager()
            ->createQueryBuilder();

        $qb
            ->select('c, p')
            ->from('AppBundle:Category', 'c')
            ->innerJoin('c.product', 'p');
            
            
        $categories = $qb
        ->getQuery()
        ->getResult();

//      $categories = $this->getDoctrine()
//        ->getRepository('AppBundle:Category')
//        ->findAll();

        return $this->render('Category/list.html.twig', [
        	'categories' => $categories,
        	]); 
    }

}
