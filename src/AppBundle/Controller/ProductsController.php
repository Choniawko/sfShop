<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Category;
use AppBundle\Form\ProductType;


class ProductsController extends Controller
{
    /**
     * @Route("/produkty/{id}", name="products_list", defaults={"id" = false}, requirements={"id": "\d+"})
     */
    public function indexAction(Request $request, Category $category = null)
    {
        $getProductsQuery = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->getProductsQuery($category);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $getProductsQuery,
            $request->query->get('page', 1),
            8
        );

        return $this->render('products/index.html.twig', [
            'products' => $pagination,
        ]);
    }


    
    /**
    * @Route("/produkty/pokaz/{id}", name="products_show")
    */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Nie znaleziono produktu.');
        }
        
       return $this->render('products/show.html.twig', [
            'product' => $entity,
        ]);
    }
 
       /**
     * @Route("/szukaj", name="product_search")
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('query');
        
        // validacja wartości przekazanej w parametrze
//        $constraint = new NotBlank();
//        $errors = $this->get('validator')->validate($query, $constraint);
        
        // alternatywny sposób zapisu zapytania
//        $products = $this->getDoctrine()
//            ->getManager()
//            ->createQueryBuilder()
//            ->from('AppBundle:Product', 'p')
//            ->select('p')
//            ->where('p.name LIKE :query')
//            ->setParameter('query', '%'.$query.'%')
//            ->getQuery()
//            ->getResult();
        
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.name LIKE :query')
            ->orWhere('p.description LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult();
        
        return $this->render('products/search.html.twig', [
            'query'     => $query,
            'products'  => $products
        ]);
    }
}