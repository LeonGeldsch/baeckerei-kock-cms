<?php

namespace WBD0321;

/**
 * Session Class
 *
 * Es soll keine Instanz von der Klasse erstellt werden können, deshalb als abstract deklariert
 * Diese Klasse wird statisch verwendet
 *
 * @package WBD0321
 */
abstract class Session {

    /**
     * Destroy
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum zerstören der Session
     *
     * @access  public
     * @static
     * @return  void
     */
    public static function destroy() : void {
        // mit '@' vor dem Funktionsaufruf stellen wir Fehlermeldungen für den Aufruf aus
        @session_destroy();
    }

    /**
     * Get
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum beziehen von Werten aus der Session
     *
     * @access  public
     * @static
     * @param   string  $key
     * @return  mixed
     */
    public static function get( string $key ) {

        return $_SESSION[ $key ] ?? NULL;
    }

    /**
     * Isset
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum überprüfen ob Werte in der Session existieren
     *
     * @access  public
     * @static
     * @param   string  $key
     * @return  bool
     */
    public static function isset( string $key ) : bool {

        return isset( $_SESSION[ $key ] );
    }

    /**
     * Set
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum setzen von Werten in der Session
     *
     * @access  public
     * @static
     * @param   string  $key
     * @param   mixed   $value
     * @return  void
     */
    public static function set( string $key, $value ) : void {
        $_SESSION[ $key ] = $value;
    }

    /**
     * Start
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum starten der Session
     *
     * @access  public
     * @static
     * @return  void
     */
    public static function start() : void {
        // mit '@' vor dem Funktionsaufruf stellen wir Fehlermeldungen für den Aufruf aus
        @session_start();
    }

    /**
     * Remove
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Wird über die Klasse (keine Instanz) aufgerufen, daher als static deklariert
     *
     * Methode zum entfernen von Werten in der Session
     *
     * @access  public
     * @static
     * @param   string  $key
     * @return  void
     */
    public static function remove( string $key ) : void {

        unset( $_SESSION[ $key ] );
    }

}
