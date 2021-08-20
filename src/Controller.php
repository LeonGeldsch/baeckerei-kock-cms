<?php

namespace WBD0321;

/**
 * Controller Class
 *
 * Es soll keine Instanz von der Klasse erstellt werden können, deshalb als abstract deklariert
 * Definiert ein gemeinsames Verhalten und gemeinsame Eigenschaften von Kontrollern
 *
 * @package WBD0321
 */
abstract class Controller {

    /**
     * Enthält eine Instanz vom verwendeten Model im Kontroller oder NULL
     * Zugriff nur innerhalb der Klasse und innerhalb von Erben, deshalb als protected deklariert
     *
     * @access  protected
     * @var     Model|NULL
     */
    protected ?Model $Model = NULL;

    /**
     * Enthält eine Instanz vom verwendeten View im Kontroller oder NULL
     * Zugriff nur innerhalb der Klasse und innerhalb von Erben, deshalb als protected deklariert
     *
     * @access  protected
     * @var     View|NULL
     */
    protected ?View $View = NULL;

    /**
     * Constructor
     *
     * @param   Model|NULL  $model
     * @param   View|NULL   $view
     */
    public function __construct( ?Model $model = NULL, ?View $view = NULL ) {
        $this->Model = $model;
        $this->View = $view ?? new View();
    }

    /**
     * Index
     *
     * Wird von Erben der Klasse die Instanziiert werden können benötigt, deshalb als abstract deklariert
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @access  public
     * @abstract
     * @return  void
     */
    //Wird über ein Interface gelöst
    //abstract public function index() : void;

    /**
     * Authorize User
     *
     * Wird von innerhalb der Klasse und Erben aufgerufen, deshalb als protected deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * Überprüft ob der Nutzer eingeloggt ist und zugang zu der angefragten Seite hat
     *
     * @access  protected
     * @return  void
     */
    protected function authorize_user() : void {

        if (
            Session::isset( 'login_id' ) === FALSE
            || Session::isset( 'login_username' ) === FALSE
            || Session::isset( 'login_timestamp' ) === FALSE
        ) {
            $this->redirect( '/login?status=required' );
        };
    }


    protected function authorize_admin() : void {

        if( Session::get( 'user_level' ) !== "admin" ) {
            $this->redirect( '/login?status=insufficient_permission' );
        };
    }

    /**
     * Redirect
     *
     * Wird von innerhalb der Klasse und Erben aufgerufen, deshalb als protected deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * Weiterleiten zu einem anderen Kontroller
     *
     * @access  protected
     * @param   string  $target
     * @return  void
     */
    protected function redirect( string $target ) : void {

        header( "Location: $target" );
    }

}