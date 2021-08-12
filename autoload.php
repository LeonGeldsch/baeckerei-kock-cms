<?php

namespace WBD0321;

/**
 * Autoload
 *
 * Wird automatisiert aufgerufen wenn eine Klasse verwendet wird, welche noch unbekannt ist
 * Wir überprüfen ob die aufgerufene Klasse in unserem Namespace liegt
 * Wir manipulieren die anfrage zu einem Dateipfad und binden diese Datei ein, wenn sie existiert
 * Wir orientieren uns an der Spezifikation für Autoloader nach PSR-4 (https://www.php-fig.org/psr/psr-4/)
 *
 * @param   string  $class
 * @return  void
 */
function autoload(string $class) : void {
    /** @var string $namespace */
    $namespace = __NAMESPACE__;

    // Überprüfen ob die angefragte Klasse in unserem Namespace liegt
    if ( strstr( $class, $namespace ) !== FALSE ) {
        // Namespace durch den Pfad zum 'src' Ordner ersetzen
        /** @var string $replace_namespace */
        $replace_namespace = str_replace( $namespace, APP_SRC_DIR, $class );
        // Backslashes durch Directory Separator ersetzen
        /** @var string $replace_backslashes */
        $replace_backslashes = str_replace( '\\', DIRECTORY_SEPARATOR, $replace_namespace );
        // Add '.php' file extension
        /** @var string $file */
        $file = "{$replace_backslashes}.php";

        if ( file_exists( $file ) ) {

            require_once $file;
        }
    }
}

spl_autoload_register( __NAMESPACE__ . '\\autoload' );
