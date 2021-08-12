<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;

/**
 * Logout Controller Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Erbt von Controller (abstract), muss daher über die Methode 'index' verfügen
 * Der Logout Kontroller ist der Kontroller der Instanziiert wird wenn die Logoutseite (oder Unterseiten) angezeigt werden soll
 *
 * @package WBD0321
 */
final class Logout extends AbstractController implements IndexController {

    /**
     * Index
     *
     * Methode zur "Darstellung" der Logoutseite (Route: /logout)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     */
    public function index() : void {
        Session::remove( 'login_id' );
        Session::remove( 'login_username' );
        Session::remove( 'login_timestamp' );

        $this->redirect( '/login?status=logout' );
    }

}
