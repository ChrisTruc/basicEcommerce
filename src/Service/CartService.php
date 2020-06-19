<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

    private $session;

    public function __construct(RequestStack $requestStack) {
        $request = $requestStack->getCurrentRequest();
        if(!$request->hasSession()) {
            $this->session = new Session();
            $this->session->start();
        }
        else {
            $this->session = $request->getSession();
        }
        $this->initCart();
    }

    public function initCart() {
        $this->session->set('cart', array());
    }

    public function addToCart(int $id, int $quantity) {
        $cart = $this->session->get('cart');
        if(!array_key_exists($id,$cart)) {
            $cart[$id] = $quantity;
        } else {
            $cart[$id]+=$quantity;
        }
        $this->session->set('cart', $cart);
    }

    public function showCart() {
        return $this->session->get('cart');
    }

}
?>