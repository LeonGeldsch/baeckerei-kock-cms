<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Model\Register as RegisterModel;

/**
 * Register Controller Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Erbt von Controller (abstract), muss daher über die Methode 'index' verfügen
 * Der Register Kontroller ist der Kontroller der Instanziiert wird wenn die Registerseite (oder Unterseiten) angezeigt werden soll
 *
 * @package WBD0321
 */
final class Register extends AbstractController implements IndexController {

    /**
     * Constructor
     *
     * Wir überschreiben den Konstruktor vom Elternelement und entfernen die Parameter, weil wir für diese keine Verwendung haben
     * Wir rufen den Konstruktor vom Elternelement auf und binden eine Instanz vom Register Model an die Klassenvariable $Model
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        parent::__construct( new RegisterModel() );
    }

    /**
     * Index
     *
     * Methode zur "Darstellung" der Registerseite (Route: /register)
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @access  public
     * @return  void
     */
    public function index() : void {
        /** @var array $errors */
        $errors = [];

        // Überprüfen ob das Formular abgeschickt wurde
        // Ob wir Daten in $_POST haben

        //print_r($_POST);

        if ( empty( $_POST ) === FALSE && $this->Model->registerUser( $errors ) ) {
            $this->redirect( '/login?status=registered' );
        }
        else {
            $this->View->errors = $errors;
        }

        $this->View->title = 'Register';

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'register/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}