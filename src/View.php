<?php

namespace WBD0321;

use WBD0321\View\Script;
use WBD0321\View\Stylesheet;
use WBD0321\Session;

/**
 * View Class
 *
 * Es soll eine Instanz von der Klasse erstellt werden können, ebenfalls kann von der Klasse geerbt werden, deshalb weder als final noch abstract deklariert
 * Definiert ein gemeinsames Verhalten und gemeinsame Eigenschaften von Views
 *
 * @package WBD0321
 */
class View {

    /**
     * Data Array
     *
     * @static
     * @access  protected
     * @var     array
     */
    static public array $data = [];

    /**
     * Scripts Array
     *
     * @access  protected
     * @var     array
     */
    protected array $scripts = [];

    /**
     * Stylesheets Array
     *
     * @access  protected
     * @var     array
     */
    protected array $stylesheets = [];

    /**
     * Constructor
     */
    public function __construct() {
        // Prozeduale Funktion, welche in den Templates verwendet werden einbinden
        include_once APP_INCLUDES_DIR . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'functions.php';

        $this->addStylesheet( new Stylesheet( 'application', '/assets/css/application.css' ) ); 
        $this->addScript( new Script( 'application', '/assets/js/application.js' ) ); 
    }

    /**
     * Get (Magische Methode)
     *
     * @access  public
     * @param   string  $key
     * @return  mixed
     */
    public function __get( string $key ) {

        return self::$data[ $key ];
    }

    /**
     * Isset (Magische Methode)
     *
     * @access  public
     * @param   string  $key
     * @return  bool
     */
    public function __isset( string $key ) : bool {

        return isset( self::$data[ $key ] );
    }

    /**
     * Set (Magische Methode)
     *
     * @access  public
     * @param   string  $key
     * @param   mixed   $value
     * @return  void
     */
    public function __set( string $key, $value ) : void {

        self::$data[ $key ] = $value;
    }

    /**
     * Unset (Magische Methode)
     *
     * @access  public
     * @param   string  $key
     * @return  void
     */
    public function __unset( string $key ) : void {

        unset( self::$data[ $key ] );
    }

    /**
     * Create template path
     *
     * @access  protected
     * @param   string  $template
     * @return  string
     */
    protected function createTemplatePath( string $template ) : string {

        return APP_TEMPLATES_DIR . DIRECTORY_SEPARATOR . "$template.php";
    }

    /**
     * Template exists
     *
     * @access  protected
     * @param   string  $template_path
     * @return  bool
     */
    protected function templateExists( string $template_path ) : bool {

        return file_exists( $template_path );
    }

    /**
     * Add Stylesheet
     *
     * @access  public
     * @param   Stylesheet  $stylesheet
     * @return  void
     */
    public function addStylesheet( Stylesheet $stylesheet ) : void {
        if ( isset( $this->stylesheets[ $stylesheet->id ] ) ) {
            trigger_error(
                sprintf(
                    'Stylesheet (%s) already exists',
                    $stylesheet->id
                ),
                E_USER_WARNING
            );
        }

        $this->stylesheets[ $stylesheet->id ] = $stylesheet;
    }

    /**
     * Add Script
     *
     * @access  public
     * @param   Script      $script
     * @return  void
     */
    public function addScript( Script $script ) : void {
        if ( isset( $this->scripts[ $script->id ] ) ) {
            trigger_error(
                sprintf(
                    'Script (%s) already exists',
                    $script->id
                ),
                E_USER_WARNING
            );
        }

        $this->scripts[ $script->id ] = $script;
    }

    public function embedScripts() : void {
        foreach( $this->scripts as $script ) {
            $script->embed();
        }
    }

    public function embedStylesheets() : void {
        foreach( $this->stylesheets as $stylesheet ) {
            $stylesheet->embed();
        }
    }

    /**
     * Get template part
     *
     * @access  public
     * @param   string  $template
     * @return  void
     */
    public function getTemplatePart( string $template ) : void {
        /** @var string $template_path */
        $template_path = $this->createTemplatePath( $template );

        // Überprüfen ob das angefragte Template existiert
        if ( $this->templateExists( $template_path ) ) {

            include_once $template_path;
        }
        // Fehlermeldung ausgeben, wenn das Template nicht existiert
        else {

            trigger_error(
                sprintf(
                    'Template (%s) doesn\'t exist.',
                    $template_path
                ),
                E_USER_NOTICE
            );
        }
    }

}
