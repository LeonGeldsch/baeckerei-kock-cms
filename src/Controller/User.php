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

/**
 * Users Controller Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Erbt von Controller (abstract), muss daher über die Methode 'index' verfügen
 * Der Users Kontroller ist der Kontroller der Instanziiert wird wenn die Userseite (oder Unterseiten) angezeigt werden soll
 *
 * @package WBD0321
 */
final class User extends AbstractController implements IndexController {

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
        // Alle Methoden des Kontrollers sind nur für eingeloggte Nutzer erreichbar
        $this->authorize_user();
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
        $session_username = Session::get( 'login_username' );

        $this->orders();
    }

    /**
     * Index
     *
     * Methode zur Darstellung der Einstellungsseite für Nutzer (Route: /user/edit)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @access  public
     * @return  void
     */
    public function edit() : void {
        /** @var array $errors */
        $errors = [];

        // Bearbeiten vom Nutzerprofil
        switch( TRUE ) {
            case isset( $_POST[ 'delete_user' ] ):
                if ( $this->UsersModel->deleteUser( $errors ) ) {
                    $this->redirect( '/logout' );
                };
                break;
            case isset( $_POST[ 'update_email' ] ):
                $this->UsersModel->updateEmail( $errors );
                break;
            case isset( $_POST[ 'update_username' ] ):
                $this->UsersModel->updateUsername( $errors );
                break;
            case isset( $_POST[ 'update_password' ] ):
                $this->UsersModel->updatePassword( $errors );
                break;
        }

        $this->View->errors = $errors;

        // Titel vergeben
        $this->View->title = 'Edit Users';
        // Stylesheet einbinden
        $this->View->addStylesheet( new Stylesheet( 'application', APP_URL . '/assets/dist/css/application.css', '0.1.0' ) );
        // Script einbinden
        $this->View->addScript( new Script( 'application', APP_URL . '/assets/dist/js/application.js', '1.0.0' ) );

        // Template Parts rendern
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'user/edit' );
        $this->View->getTemplatePart( 'footer' );
    }


    /**
     * View
     *
     * Methode zur Darstellung einer Nutzerseite (Route: /user/profile/%username%)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @access  public
     * @param   string|NULL     $username
     * @return  void
     */
    public function orders() : void {
        $userOrders = $this->OrdersModel->getOrdersByUserId( Session::get( 'login_id' ) );

        if ( $userOrders === NULL ) {
            echo "you have no orders!";
        }



        foreach ($userOrders as $orderIndex => $order) {
            
            $totalPrice = 0;
            $totalAmount = 0;

            $order[ 'orderItems' ] = $this->OrderItemsModel->getOrderItemsByOrderId( $order[ 'orderId' ] );
            foreach ($order[ 'orderItems' ] as $itemIndex => $orderItem) {
                $orderItem[ 'orderItemProduct' ] = $this->ProductsModel->getProductById( $orderItem[ 'orderItemProductId' ] );
                $orderItem[ 'orderItemPrice' ] = $orderItem[ 'orderItemProduct' ][ 'productPrice' ] * $orderItem[ 'orderItemAmount' ];
                $totalAmount += $orderItem[ 'orderItemAmount' ];
                $totalPrice += $orderItem[ 'orderItemAmount' ] * $orderItem[ 'orderItemProduct' ][ 'productPrice' ];
                $order[ 'orderItems' ][ $itemIndex] = $orderItem;
            }
            $order[ 'orderAmount' ] = $totalAmount;
            $order[ 'orderPrice' ] = $totalPrice;
            $userOrders[ $orderIndex ] = $order;
        }
        /*
        echo "<pre>";
        print_r($userOrders);
        echo "</pre>";
        */
        $this->View->title = "My orders";

        $this->View->addStylesheet( new Stylesheet( 'user', '/assets/css/user.css', '0.1.0' ) );
        $this->View->addScript( new Script( 'user', '/assets/js/user.js', '0.1.0' ) );

        $this->View->orders = $userOrders;

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'user/orders' );
        $this->View->getTemplatePart( 'footer' );
    }

}