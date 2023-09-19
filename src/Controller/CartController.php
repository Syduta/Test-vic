<?php

namespace App\Controller;

use App\Repository\DrawingRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name:'cart')]
    public function index(CartService $cartService){
        return $this->render('cart.html.twig', [
            'cartData' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()]);
    }

    #[Route('/cart/add/{id}', name:'cart_add')]
    public function addToCart($id, CartService $cartService){
        $cartService->add($id);
        $this->addFlash('success','Added to Cart');
        return $this->redirectToRoute('drawing',['id'=>$id]);
    }

    #[Route('/cart/remove/{id}', name:'cart_remove')]
    public function removeFromCart($id, CartService $cartService){
        $cartService->remove($id);
        return $this->redirectToRoute('cart');
    }
}