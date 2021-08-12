<?php

use WBD0321\View;

function display_form_errors( string $input_name ) : void {
    if ( isset( View::$data[ 'errors' ][ $input_name ] ) ) {
        foreach ( View::$data[ 'errors' ][ $input_name ] as $error_message ) {
            echo "<p class=\"form__error\">{$error_message}</p>";
        }
    }
}

function title() : void {
    echo View::$data[ 'title' ] ?? 'Default Title';
}

function navigation_link( string $target, string $title, string $classname = 'navigation__anchor' ) : void {
    printf(
        '<a href="%1$s" class="%2$s">%3$s</a>',
        $target,
        implode( ' ', [
            $classname,
            strstr( $_SERVER[ 'REQUEST_URI' ], $target ) ? $classname . '--active' : $classname . '--inactive',
        ] ),
        $title
    );
}
