<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;

/**
 * Error Controller Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Erbt von Controller (abstract), muss daher über die Methode 'index' verfügen
 * Der Error Kontroller ist der Standardkontroller für Fehlermeldungen der Instanziiert wird wenn die Anfrage nicht gefunden wurde
 *
 * @package WBD0321
 */
final class Error extends AbstractController implements IndexController {

    /**
     * Init
     *
     * Statische Methode zum Initialisieren vom Error Kontroller
     *
     * Wird außerhalb der Klasse aufgerufen, daher als "public" deklariert
     * Aufrufbar ohne Instanz der Klasse, daher als "static" deklariert
     * Hat keinen Rückgabewert deshalb return Type "void"
     *
     * @access  public
     * @static
     * @param   int     $code
     * @return  void
     */
    public static function init( int $code = 404 ) : void {
        ( new self() )->index( $code );
    }

    /**
     * Index
     *
     * Methode zur "Darstellung" der Fehlerseite
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @param   int   $code
     * @return  void
     */
    public function index( int $code = 404 ) : void {
        // HTTP response code mitschicken
        http_response_code( $code );

        switch( $code ) {
            case 404:
            default:
                echo "Page 404 - Not Found";
            break;
        }

        exit();
    }

}
