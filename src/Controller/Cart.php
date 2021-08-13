<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;
use WBD0321\View\Script;
use WBD0321\View\Stylesheet;
use WBD0321\Model\Products as ProductsModel;


final class Cart extends AbstractController implements IndexController {

    public function __construct() {
        parent::__construct();

        $this->ProductsModel = new ProductsModel();
    }

    public function index() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;

        $this->View->title = 'Cart';
        $this->View->items = Session::get( 'cart' );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'cart/index' );
        $this->View->getTemplatePart( 'footer' );
    }

    
    private function cartItemExists( ?int $itemId ) : bool {
        $cart = Session::get( 'cart' ) ?: [];
        foreach ($cart as $item) {
            if ($item['itemId'] == $itemId) {
                return true;
            }
        }
        return false;
    }


    private function getItemAmount( ?int $itemId ) : int {
        $cart = Session::get( 'cart' ) ?: [];
        foreach ($cart as $item) {
            if ($item['itemId'] == $itemId) {
                return $item['itemAmount'];
            }
        }
        return 0;
    }


    private function changeItemAmount( ?int $itemId, ?int $newAmount ) : void {
        $cart = Session::get( 'cart' ) ?: [];
        foreach ($cart as $key => $item) {
            if ($item['itemId'] == $itemId) {
                $cart[$key]['itemAmount'] = $newAmount;
            }
        }
        Session::set( 'cart', $cart );
    }


    public function addToCart() : void {

        $itemId = $_POST['itemId'];
        $itemAmount = $_POST['itemAmount'];
        $itemName =  $this->ProductsModel->getProductNameById( $itemId );

        $cartItemExist = $this->cartItemExists($itemId);

        if ( !is_null( $itemId ) && !is_null( $itemAmount ) ) {

            
            $newItem = array( 'itemId' => $itemId, 'itemAmount' => $itemAmount, 'itemName' => $itemName);

            $cart = Session::get( 'cart' ) ?: [];
    

            if ($cartItemExist) {
                $oldAmount = $this->getItemAmount( $itemId );
                $newAmount = $oldAmount + $itemAmount;
                
                $this->changeItemAmount($itemId, $newAmount);

            } else {
                array_push( $cart, $newItem );
        
                Session::set( 'cart', $cart );
    
                $cart = Session::get( 'cart' );
    
            }

            $cart = Session::get( 'cart' );
            $cartJson = json_encode($cart);
            echo $cartJson;
        }
    }


    public function removeFromCart() : void {

        $itemId = $_POST['itemId'];
        $itemAmount = $_POST['itemAmount'];

        $cartItemExist = $this->cartItemExists($itemId);

        if ( !is_null( $itemId ) && !is_null( $itemAmount ) ) {

            
            $newItem = array( 'itemId' => $itemId, 'itemAmount' => $itemAmount);

            $cart = Session::get( 'cart' ) ?: [];
    

            if ($cartItemExist) {
                $oldAmount = $this->getItemAmount( $itemId );
                $newAmount = $oldAmount - $itemAmount;
                
                $this->changeItemAmount($itemId, $newAmount);
            }

            $cart = Session::get( 'cart' );
            $cartJson = json_encode($cart);
            echo $cartJson;
        }
    }


}