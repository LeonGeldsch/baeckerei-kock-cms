<?php

namespace WBD0321;

// Error Reporting für alle arten von Fehlermeldungen anschalten
// Ausgabe im Browser einschalten
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

/** @var string $autoload_file */
$autoload_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
/** @var string $config_file */
$config_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

// Überprüfen ob das $autoload_file existiert
// Error Meldung ausgeben wenn nicht
if ( !file_exists( $autoload_file ) ) {
    trigger_error(
        sprintf(
            'Autoload file (%s) doesn\'t exist.',
            $autoload_file
        ),
        E_USER_ERROR
    );
}

// Überprüfen ob das $config_file existiert
// Error Meldung ausgeben wenn nicht
if ( !file_exists( $config_file ) ) {
    trigger_error(
        sprintf(
            'Config file (%s) doesn\'t exist.',
            $config_file
        ),
        E_USER_ERROR
    );
}

// Autoload File einbinden
require_once $autoload_file;
// Config File einbinden
require_once $config_file;

// Anonyme Instanz von Application erzeugen ( new Application() )
// Methode run aufrufen ( ->run() )
( new Application() )->run();
