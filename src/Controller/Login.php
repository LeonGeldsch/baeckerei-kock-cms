<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Model\Login as LoginModel;

/**
 * Login Controller Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Erbt von Controller (abstract), muss daher über die Methode 'index' verfügen
 * Der Login Kontroller ist der Kontroller der Instanziiert wird wenn die Loginseite (oder Unterseiten) angezeigt werden soll
 *
 * @package WBD0321
 */
final class Login extends AbstractController implements IndexController {

    /**
     * Constructor
     *
     * Wir überschreiben den Konstruktor vom Elternelement und entfernen die Parameter, weil wir für diese keine Verwendung haben
     * Wir rufen den Konstruktor vom Elternelement auf und binden eine Instanz vom Login Model an die Klassenvariable $Model
     */
    public function __construct() {
        parent::__construct( new LoginModel() );
    }

    /**
     * Index
     *
     * Methode zur "Darstellung" der Loginseite (Route: /login)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     */
    public function index() : void {
        /** @var array $errors */
        $errors = [];

        // Überprüfen ob das Formular abgeschickt wurde
        // Ob wir Daten in $_POST haben
        if ( empty( $_POST ) === FALSE && $this->Model->loginUser( $errors ) ) {
            $this->redirect( 'home' );
        }
        else {
            $this->View->errors = $errors;
        }

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'login/index' );
        $this->View->getTemplatePart( 'footer' );
    }

    /**
     * Reset
     *
     * Methode zur "Darstellung" der Resetseite (Route: /login/reset)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     */
    public function reset() : void {
        /** @var array $errors */
        $errors = [];

        // Überprüfen ob das Formular abgeschickt wurde
        // Ob wir Daten in $_POST haben
        if ( empty( $_POST ) === FALSE && $this->Model->resetPassword( $errors ) ) {
            $this->redirect( '/login' );
        }
        else {
            $this->View->errors = $errors;
        }

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'login/reset' );
        $this->View->getTemplatePart( 'footer' );
    }

}
