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
        // Alle Methoden des Kontrollers sind nur für eingeloggte Nutzer erreichbar
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
        $session_username = Session::get( 'login_username' );

        $this->View->getTemplatePart( 'admin/index' );
    }
}