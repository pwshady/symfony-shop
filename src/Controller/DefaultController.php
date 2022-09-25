<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productList = $entityManager->getRepository(Product::class)->findAll();
        dd($productList);

        return $this->render('main/default/index.html.twig', []);
    }

    #[Route('/product-add-old', name: 'prodyct-add-old')]
    public function productAdd(): Response
    {
        $product = new Product();
        $product->setTitle('Product' . rand(1,100));
        $product->setDescription('smth');
        $product->setPrice(rand(1,100));
        $product->setQuantity(rand(1,100));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/edit-product/{id}", methods="GET|POST", name="product-edit", requirements={"id"="\d+"})
     * @Route("/add-product", methods="GET|POST", name="add-product")
     */
    public function editProduct(Request $request, int $id = null): Response
    {
        dd($id);
        return $this->render('main/default/edit_product.html.twig', []);
    }
}
