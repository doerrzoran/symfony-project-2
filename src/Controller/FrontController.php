<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Entity\Product;
use App\Form\CartType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_front')]
    public function index(): Response
    {
        // Fetch products from the database
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        // $orderLine = new OrderLine
        // $form = $this->createForm(CartType::class, );

        // Pass products to the view
        return $this->render('front/index.html.twig', [
            'products' => $products,
        ]);
    }
}
