<?php

namespace App\Service\Cart;

use App\Repository\DrawingRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    public function __construct(private RequestStack $requestStack, private DrawingRepository $drawingRepository) {
    }

    public function add(int $id){
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);
        if (!empty($cart[$id])){
            $cart[$id]++;
        } else {
            $cart [$id] = 1;
        }
        $session->set('cart', $cart);
    }

    public function remove(int $id){
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart',[]);
        if (!empty($cart[$id])){
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
    }
    public function getFullCart() : array{
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);
        $cartData = [];
        foreach ($cart as $id => $quantity){
            $drawingRepository = $this->drawingRepository->find($id);
            $cartData[] = [
                'drawing' => $drawingRepository,
                'quantity' => $quantity
            ];
        }
        return $cartData;
    }

    public function getTotal(): float{
        $total = 0;
        foreach ($this->getFullCart() as $item){
            $total += $item['drawing']->getPrice() * $item['quantity'];
        }
        return $total;
    }
}