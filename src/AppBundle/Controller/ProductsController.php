<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Product;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/produkt/{id}", name="product_show")
     */
    public function showAction(Product $product, Request $request)
    {
        // pobieramy aktualnie zalogowanego użytkownika
        $user = $this->getUser();

        // tworzymy nowy komentarz
        $comment = new Comment();

        // przypisujemy produkt do komentarza
        $comment->setProduct($product);
        
        // przypisujemy zalogowanego urzytkownika do komentarza
        $comment->setUser($user);
        

        $form = $this->createForm(new CommentType(), $comment);
        
        // przetwarzamy dane wysłane z formularza - jeśli jakieś dane zostały wysłane
        $form->handleRequest($request);

        // jeśli formularz został wysłany, a uzytkownik nie jest zalogowany
        if ($form->isSubmitted() && !$user) {
            $this->addFlash('error', "Aby móc dodawać komentarze musisz się wcześniej zalogować.");
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }
        
        // jeśli formularz został wysłany i wszystkie wprowadzone dane są poprawne 
        if ($form->isValid()) {
            
            // jesli użytkownik posiada uprawnienia administratora 
            if ($user->hasRole('ROLE_ADMIN')) {
                // oznaczamy komentararz jako zweryfikowany
                $comment->setVerified(true);
            }
            
            // pobieramy entityManager
            $em = $this->getDoctrine()->getManager();
            
            // zapisujemy komentarz do bazy danych            
            $em->persist($comment);
            $em->flush();
            
            // jeśli użytkownik posiada uprawinienia admina 
            if ($user->hasRole('ROLE_ADMIN')) {
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany i opublikowany.");
            } else {
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany i czeka na weryfikacje");
            }
            
            
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }
        
        return $this->render('products/show.html.twig', [
            'product'   => $product,
            'form'      => $form->createView()
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