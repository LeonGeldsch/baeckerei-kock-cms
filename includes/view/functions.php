<?php

use WBD0321\View;
use WBD0321\Session;

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
    
    $targetArray = array_filter( explode( '/', $target ) );
    $lastTarget =  $targetArray [ count( $targetArray ) ] ?? " ";
    $uriArray = array_filter( explode( '/', $_SERVER[ 'REQUEST_URI' ] ) );
    $lastUri = $uriArray [ count( $uriArray ) ] ?? " ";
    
    printf(
        '<a href="%1$s" class="%2$s">%3$s</a>',
        $target,
        implode( ' ', [
            $classname,
            strstr( $lastTarget , $lastUri ) ? ' active' : '',
        ] ),
        $title
    );

}



function cart() : void {

    $items = Session::get( 'cart' ) ?? [];
    
    if( count( $items ) > 0 ) {
        foreach( $items as $index => $item ) {
            echo "<p data-id=" . $item[ 'itemId' ] . ">Product: " . $item[ 'itemName' ] . " | Amount: " . $item[ 'itemAmount' ] . "</p>";
        }
    } else {
        echo "cart is empty!";
    }
}


function displayLoginNav() : void {
    if( Session::isset( 'login_id' ) ) {
        echo '<li class="navigation__list-item">';
        navigation_link( '/logout', 'Logout' );
        echo '</li>';
    } else {
        echo '<li class="navigation__list-item">';
        navigation_link( '/login', 'Login' );
        echo '</li><li class="navigation__list-item">';
        navigation_link( '/register', 'Register' );
        echo '</li>';
    }
}