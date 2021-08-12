<?php

namespace WBD0321;

/**
 * Application Class
 *
 * Es soll kein Erben von der Klasse Application geben, deshalb ist sie als final deklariert
 * Die Klasse Application soll ein einziges mal instanziiert werden und den Anwendungsablauf starten
 * Sie ist dafür zuständig die Nutzeranfrage zu Verarbeiten und den richtigen Kontroller mit der richtigen Methode aufzurufen
 * Sollte eine Nutzeranfrage ungültig sein wird ein Error Kontroller instanziiert
 *
 * @package WBD0321
 */
final class Application {

    // Enthält einen String mit dem Standard Kontroller der genutzt wird, wenn der Nutzer keine Anfrage zu einem anderen Kontroller stellt
    // Siehe: sanitize_request_controller
    const DEFAULT_CONTROLLER        = 'WBD0321\\Controller\\Register';
    // Enthält einen String mit der Standard Methode die genutzt wird, wenn der Nutzer keine Anfrage zu einer anderen Methode stellt
    // Siehe: sanitize_request_method
    const DEFAULT_CONTROLLER_METHOD = 'index';

    // Enthält einen String mit dem Error Kontroller der genutzt wird, wenn die Nutzer Anfrage ungültig ist
    // Siehe: run
    const ERROR_CONTROLLER          = 'WBD0321\\Controller\\Error';
    // Enthält einen String mit der Standard Methode die genutzt wird, wenn der Error Kontroller aufgerufen wird
    // Siehe: run
    const ERROR_CONTROLLER_METHOD   = 'index';

    /**
     * Controller
     *
     * Enthält die Instanz vom verwendeten Kontroller
     * Diese Variable wird nur innerhalb der Klasse verwendet, deshalb als private deklariert
     * Muss vom Typen Controller oder NULL sein daher declaration Type (?Controller)
     *
     * @access  private
     * @var     Controller|NULL
     */
    private ?Controller $Controller = NULL;

    /**
     * Request
     *
     * Enthält die zerlegte und bereinigte Anfrage vom Nutzer mit Informationen zum gewünschte Kontroller, der gewünschten Methode und der zu übergebenden Argumente
     * Diese Variable wird nur innerhalb der Klasse verwendet, deshalb als private deklariert
     *
     * @access  private
     * @var     array
     */
    private array $request = [];

    /**
     * Constructor
     *
     * Wird aufgerufen beim Instanziieren der Klasse, noch vor dem Aufruf einer weiteren Method (run)
     * Ruft parseRequest auf und speichert den zurückgegeben Array in der Klassenvariable $request
     */
    public function __construct() {
        $this->request = $this->parseRequest();
    }

    /**
     * Controller exists
     *
     * Überprüft ob die angefragte Kontroller Klasse existiert
     * Nutzt den abgespeicherten Wert mit dem Index 'controller' aus der Klassenvariable $request
     * Der Rückgabe wert ist ein Boolean deshalb return Type (bool)
     *
     * @return  bool
     */
    private function controller_exists() : bool {

        return class_exists( $this->request[ 'controller' ] );
    }

    /**
     * Controller Method exists
     *
     * Überprüft ob der angefragte Kontroller über die angefragte Methode verfügt.
     * Nutzt die abgespeicherten Werte  mit dem Index 'controller' und 'method' aus der Klassenvariable $request
     * Der Rückgabe wert ist ein Boolean deshalb return Type (bool)
     *
     * @return  bool
     */
    private function controller_method_exists() : bool {

        return method_exists( $this->request[ 'controller' ], $this->request[ 'method' ] );
    }

    /**
     * Parse Request
     *
     * Methode zum Zerlegen der Nutzeranfrage in einen verwertbaren Array
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     *
     * @return array
     */
    private function parseRequest() : array {
        // Wir holen uns die URL aus dem $_GET Array mit dem Index '_url' (definiert in der .htaccess)
        // Sollte kein Wert vorhanden sein nutzen wir einen leeren string
        /** @var string $url_input */
        $url_input = filter_input( INPUT_GET, '_url' ) ?? '';

        // Die URL in kleinbuchstaben umbauen, falls der Nutzer Groß und Kleinschreibung in der URL genutzt hat
        /** @var string $url_lower */
        $url_lower = strtolower( $url_input );

        // Das letzte potenzielle Slash von der Nutzeranfrage entfernen
        /** @var string $url_rtrim */
        $url_rtrim = rtrim( $url_lower, '/' );

        // Den String in einen Array zerlegen, trennen bei jedem '/'
        /** @var array $url_exploded */
        $url_exploded = explode( '/', $url_rtrim );

        // Die gewonnen Information von der Nutzeranfrage in einem assoziativen Array zurückgeben
        return [
            'controller'    =>  $this->sanitize_request_controller( $url_exploded[ 0 ] ?? NULL ),
            'method'        =>  $this->sanitize_request_method( $url_exploded[ 1 ] ?? NULL ),
            'argument'      =>  $url_exploded[2] ?? NULL
        ];
    }

    /**
     * Sanitize Request Controller
     *
     * Methode zum "bereinigen" des angefragten Kontroller, sollte es keine Anfrage geben verwenden wir den Standard Kontroller (DEFAULT_CONTROLLER)
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Erwartet einen string oder null als Argument deshalb type declaration '?string'
     * Gibt einen String als Rückgabewert deshalb return Type 'string'
     *
     * @param   string|NULL   $controller
     * @return  mixed|string
     */
    private function sanitize_request_controller( ?string $controller ) : string {

        return $controller
            ? "WBD0321\\Controller\\" . ucfirst( $controller )
            : self::DEFAULT_CONTROLLER;
    }

    /**
     * Sanitize Request Method
     *
     * Methode zum "bereinigen" der angefragten Methode, sollte es keine Anfrage geben verwenden wir die Standard Methode (DEFAULT_CONTROLLER_METHOD)
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Erwartet einen string oder null als Argument deshalb type declaration '?string'
     * Gibt einen String als Rückgabewert deshalb return Type 'string'
     *
     * @param   string|NULL     $method
     * @return  string
     */
    private function sanitize_request_method( ?string $method ) : string {

        return $method ?? self::DEFAULT_CONTROLLER_METHOD;
    }

    /**
     * Run
     *
     * Methode um den Anwendungsablauf zu starten
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat keinen Rückgabewert deshalb return Type 'void'
     *
     * @return  void
     */
    public function run() : void {
        // Session starten (Notwendig für Login von Nutzern)
        Session::start();

        // Überprüfen ob der angefragte Kontroller existiert und der Kontroller über die angefragte Methode verfügt
        if ( $this->controller_exists() && $this->controller_method_exists() ) {
            // Eine Instanz vom angefragten Kontroller erstellen
            /** @var object $controller */
            $this->Controller = new $this->request[ 'controller' ]();
            // Die angefragte Methode ohne argumente aufrufen
            if ( is_null( $this->request[ 'argument' ] ) ) {
                $this->Controller->{$this->request[ 'method' ]}();
            }
            // Die angefragte Methode mit argumente aufrufen
            else {
                $this->Controller->{$this->request[ 'method' ]}( $this->request[ 'argument' ] );
            }
        }
        // Sollte der angefragte Kontroller nicht existieren erstellen wir eine Error Meldung
        else {
            $controller = self::ERROR_CONTROLLER;
            // Eine Instanz vom error Kontroller erstellen
            $this->Controller = new $controller();
            // Die Error Kontroller Methode aufrufen
            $this->Controller->{ self::ERROR_CONTROLLER_METHOD }();
        }
    }

}
