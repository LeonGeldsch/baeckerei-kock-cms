<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;
use WBD0321\Model\Users as UsersModel;
use WBD0321\Model\Orders as OrdersModel;
use WBD0321\Model\OrderItems as OrderItemsModel;
use WBD0321\Model\Products as ProductsModel;
use WBD0321\View\Script;
use WBD0321\View\Stylesheet;

final class Admin extends AbstractController implements IndexController {

    private ?UsersModel $UsersModel = NULL;
    private ?OrdersModel $OrdersModel = NULL;
    private ?OrderItemsModel $OrderItemsModel = NULL;
    private ?ProductsModel $ProductsModel = NULL;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->UsersModel = new UsersModel();
        $this->OrdersModel = new OrdersModel();
        $this->OrderItemsModel = new OrderItemsModel();
        $this->ProductsModel = new ProductsModel();

        // Nutzerlogin überprüfen
        // Alle Methoden des Kontrollers sind nur für eingeloggte Admins erreichbar
        $this->authorize_admin();
    }

    /**
     * Index
     *
     * Methode zur Darstellung der eigenen Nutzerseite (Route: /user)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @access  public
     * @return  void
     */
    public function index() : void {
        /** @var string $session_username */

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'admin/index' );
        $this->View->getTemplatePart( 'footer' );
    }

    public function today() : void {
        /** @var string $session_username */

        $currentTime = time();
        $beginOfToday = strtotime( 'today', $currentTime );
        $endOfToday = strtotime( 'tomorrow', $beginOfToday ) - 1;

        $orders = $this->OrdersModel->getOrdersByDate( $beginOfToday, $endOfToday );

        foreach ( $orders as $index => $order ) {
            $user = $this->UsersModel->getUserById( $order[ 'orderUserId' ] );
            $order[ 'orderUserFirstname' ] = $user[ 'userFirstname' ];
            $order[ 'orderUserLastname' ] = $user[ 'userLastname' ];
            $order[ 'orderItems' ] = $this->OrderItemsModel->getOrderItemsByOrderId( $order[ 'orderId' ] );
            foreach ($order[ 'orderItems' ] as $itemIndex => $orderItem) {
                $orderItem[ 'orderItemProductName' ] = $this->ProductsModel->getProductNameById( $orderItem[ 'orderItemProductId' ] );
                $order[ 'orderItems' ][ $itemIndex] = $orderItem;
            }
            $orders[ $index ] = $order;
        }

        echo "<pre>";
        print_r($orders);
        echo "</pre>";


        $this->View->orders = $orders;

        $this->View->title = 'Admin';

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'admin/today' );
        $this->View->getTemplatePart( 'footer' );
    }


    public function updateOrderStatus( int $orderId, string $newStatus ) : void {

        $this->OrdersModel->updateOrderStatus( $orderId, $newStatus );

    }


    public function products( string $action = 'index' ) : void {


        switch ( $action ) {
            case 'index':
                $this->productsIndex();
                break;
            case 'new':
                $this->addNewProduct();
                break;
                
            default:
                break;
        }

    }

    private function productsIndex() {
        $this->View->products = $this->ProductsModel->getAllProducts();
        
        $this->View->title = 'Admin - Products';
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'admin/products/index' );
        $this->View->getTemplatePart( 'footer' );
    }

    private function addNewProduct() {

        //print_r($_POST);

        $errors = [];

        if ( empty( $_POST ) === FALSE && $this->ProductsModel->addNewProduct( $errors ) ) {
            $this->redirect( '/admin/products' );
        }
        else {
            $this->View->errors = $errors;
        }

        $this->View->categories = $this->ProductsModel->getAllProductCategories();
        
        $this->View->title = "Add new product";

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'admin/products/new' );
        $this->View->getTemplatePart( 'footer' );

    }

}