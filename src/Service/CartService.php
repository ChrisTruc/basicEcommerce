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
        if(empty($this->getCart())) {
            $this->setCart(array());
        }
    }

    public function addToCart(int $id, int $quantity) {
        $cart = $this->getCart();
        if(!array_key_exists($id,$cart)) {
            $cart[$id] = $quantity;
        } else {
            $cart[$id]+=$quantity;
        }
        $this->setCart($cart);
    }

    public function getCart() {
        return $this->session->get('cart');
    }

    public function setCart($cart) {
        $this->session->set('cart',$cart);
    }    
}
?>