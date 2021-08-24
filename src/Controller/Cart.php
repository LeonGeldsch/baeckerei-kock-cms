<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;
use WBD0321\View\Script;
use WBD0321\View\Stylesheet;
use WBD0321\Model\Products as ProductsModel;
use WBD0321\Model\Orders as OrdersModel;
use WBD0321\Model\OrderItems as OrderItemsModel;


final class Cart extends AbstractController implements IndexController {

    public function __construct() {
        parent::__construct();

        $this->ProductsModel = new ProductsModel();
        $this->OrdersModel = new OrdersModel();
        $this->OrderItemsModel = new OrderItemsModel();
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
                if($newAmount === 0) {
                    unset($cart[$key]);
                } else {
                    $cart[$key]['itemAmount'] = $newAmount;                    
                }
            }
        }
        Session::set( 'cart', $cart );
    }


    public function buyCartItems() : void {
        
        if( null !== Session::get( 'login_id' )) {
            
            $pickupTime = strtotime( $_POST['pickupTime'] ) + 43200;
            array_pop($_POST);
            $items = $_POST;
    
            $cart = Session::get( 'cart' );
            $userId = Session::get( 'login_id' );
            $orderId = $this->OrdersModel->addOrder( $userId, $pickupTime );
            
            foreach( $items as $productId => $amount ) {

                $orderItemExists = $this->OrderItemsModel->orderItemExists( $orderId, $productId );

                if($orderItemExists) {
                    $this->OrderItemsModel->addToOrderItemAmount( $orderId, $productId, $amount );
                } else {
                    $this->OrderItemsModel->addOrderItem( $orderId, $productId, $amount );
                }
            }

            Session::remove( 'cart' );
    
            $this->redirect( '/user/orders?status=success' );

        } else {
            $this->redirect( '/login?status=must_be_logged_in_to_order' );
        }

    }


    public function updateCart() : void {

        $itemId = $_POST['itemId'];
        $itemAmount = $_POST['itemAmount'];

        if (!$this->ProductsModel->productExists($itemId)) {
            echo "Product doesn't exist";
            return;
        }

        if ($itemAmount < -1000) {
            echo "Amount to small";
            return;
        }

        if ($itemAmount > 1000) {
            echo "Amount too large";
            return;
        }

        $itemName =  $this->ProductsModel->getProductNameById( $itemId );
        $cartItemExist = $this->cartItemExists($itemId);

        $newItem = array( 'itemId' => $itemId, 'itemAmount' => $itemAmount, 'itemName' => $itemName );
        $cart = Session::get( 'cart' ) ?: [];

        if ($cartItemExist) {
            $oldAmount = $this->getItemAmount( $itemId );
            $newAmount = $oldAmount + $itemAmount;

            if ($newAmount < 0) {
                $newAmount = 0;
            }
            
            $this->changeItemAmount( $itemId, $newAmount );
        } else {
            if ($itemAmount < 0) {
                $newItem['itemAmount'] = 0;
            }
            array_push( $cart, $newItem );
            Session::set( 'cart', $cart );
            $cart = Session::get( 'cart' );
        }
        $cart = Session::get( 'cart' );
        $cartJson = json_encode( $cart );
        echo $cartJson;

    }
}