<?php

namespace WBD0321;

/**
 * Model Class
 *
 * Es soll keine Instanz von der Klasse erstellt werden können, deshalb als abstract deklariert
 * Definiert ein gemeinsames Verhalten und gemeinsame Eigenschaften von Modeln
 *
 * @package WBD0321
 */
abstract class Model {

    /**
     * Enthält eine Instanz von Database oder NULL
     * Zugriff nur innerhalb der Klasse und innerhalb von Erben, deshalb als protected deklariert
     *
     * @access  protected
     * @var     Database|NULL
     */
    protected ?Database $Database = NULL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->Database = new Database();
    }

}
