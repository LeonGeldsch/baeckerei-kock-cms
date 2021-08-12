<?php

namespace WBD0321\Model\Traits;

/**
 * Users Validation Trait
 *
 * @package WBD0321\Model\Traits
 */
trait UsersValidation {

    /**
     * Validate Username
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     * Wir verwenden $errors als Referenz und müssen den array daher nicht zurückgeben und mit den hinzugefügten Werten zu arbeiten
     *
     * Überprüfen ob der Nutzername eingegeben wurde
     * Überprüfen ob der Nutzername mindestens 4 Zeichen lang ist
     * Überprüfen ob der Nutzername maximal 16 Zeichen lang ist
     * Überprüfen ob der Nutzername nur erlaubte Zeichen enthält
     *
     * @access  private
     * @param   array       $errors
     * @param   string|NULL $username
     * @return  bool
     */
    private function validateUsername( array &$errors, ?string $username ) : bool {
        // Überprüfen ob ein Nutzername eingegeben wurde
        if ( is_null( $username ) || empty( $username ) ) {
            $errors[ 'username' ][] = 'Please type in a username';
        }
        // Überprüfen ob der Nutzername minimum 4 Zeichen lang ist
        if ( strlen( $username ) < 4 ) {
            $errors[ 'username' ][] = 'Username should be minimum 4 characters long';
        }
        // Überprüfen ob der Nutzername maximal 16 Zeichen lang ist
        if ( strlen( $username ) > 16 ) {
            $errors[ 'username' ][] = 'Username should be maximum 16 characters long';
        }
        // Überprüfen ob der Nutzername Sonderzeichen oder ähnliche verbotene Zeichen beinhaltet
        if ( preg_match( '/[^a-z_0-9]/i', $username ) ) {
            $errors[ 'username' ][] = 'Username should only contains alphanumeric characters';
        }
        // Überprüfen ob der Nutzername bereits existiert
        if ( $this->usernameExists( $username ) ) {
            $errors[ 'username' ][] = 'The username already exists';
        }

        return isset( $errors[ 'username' ] ) === FALSE || count( $errors[ 'username' ] ) === 0;
    }

    /**
     * Validate Email
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     * Wir verwenden $errors als Referenz und müssen den array daher nicht zurückgeben und mit den hinzugefügten Werten zu arbeiten
     *
     * Überprüfen ob eine E-Mail Adresse angegeben wurde
     * Überprüfen ob die E-Mail Adresse valide ist
     *
     * @access  private
     * @param   array       $errors
     * @param   string|NULL $email
     * @return  bool
     */
    private function validateEmail( array &$errors, ?string $email ) : bool {
        // Überprüfen ob eine E-Mail Adresse eingegeben wurde
        if ( is_null( $email ) || empty( $email ) ) {
            $errors[ 'email' ][] = 'Please type in a email address';
        }
        // Überprüfen ob die E-Mail Adresse valide ist
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === FALSE ) {
            $errors[ 'email' ][] = 'Please type in a valid email address';
        }
        // Überprüfen ob die E-Mail Adresse bereits existiert
        if ( $this->emailExists( $email ) ) {
            $errors[ 'email' ][] = 'The email address already exists';
        }

        return isset( $errors[ 'email' ] ) === FALSE || count( $errors[ 'email' ] ) === 0;
    }

    /**
     * Validate Password
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     * Wir verwenden $errors als Referenz und müssen den array daher nicht zurückgeben und mit den hinzugefügten Werten zu arbeiten
     *
     * Überprüfen ob ein Passwort und eine Passwort wiederholung eingegeben wurde
     * Überprüfen ob das Passwort mit der Passwort wiederholung übereinstimmt
     * Überprüfen ob das Passwort nicht mit dem Nutzernamen übereinstimmt
     * Überprüfen ob das Passwort mindestens 8 Zeichen lang ist
     * Überprüfen ob das Passwort maximal 64 Zeichen lang ist
     * Überprüfen ob das Passwort keine Leerzeichen enthält
     * Überprüfen ob das Passwort mindestens einen Kleinbuchstaben enthält
     * Überprüfen ob das Passwort mindestens einen Kleinbuchstaben enthält
     * Überprüfen ob das Passwort mindestens ein Sonderzeichen enthält
     * Überprüfen ob das Passwort mindestens eine Zahl enthält
     *
     * @access  private
     * @param   array $errors
     * @param   string|NULL $username
     * @param   string|NULL $password
     * @param   string|NULL $password_repeat
     * @return  bool
     */
    private function validatePassword( array &$errors, ?string $username, ?string $password, ?string $password_repeat ) : bool {
        // Überprüfen ob ein Passwort eingegeben wurde
        if ( is_null( $password ) || empty( $password ) ) {
            $errors[ 'password' ][] = 'Please type in a password';
        }
        // Überprüfen ob das Passwort dem Nutzername entspricht
        if ( $password === $username ) {
            $errors[ 'password' ][] = 'Password should not match the username';
        }
        // Überprüfen ob das Passwort mindestens 8 Zeichen lang ist
        if ( strlen( $password ) < 8 ) {
            $errors[ 'password' ][] = 'Password should be minimum 8 characters long';
        }
        // Überprüfen ob das Passwort maximal 64 Zeichen lang ist
        if ( strlen( $password ) > 64 ) {
            $errors[ 'password' ][] = 'Password should be maximum 64 characters long';
        }
        // Überprüfen ob das Passwort leerzeichen enthält
        if ( preg_match('/\s/', $password ) == TRUE ) {
            $errors[ 'password' ][] = 'Password should not contain any whitespace';
        }
        // Überprüfen ob das Passwort Kleinbuchtsaben enthält
        // Wir vergleichen die Werte und nicht die Typen, preg_match gibt 0 zurück ( == anstatt === )
        if ( preg_match( '/[a-z]/', $password ) == FALSE ) {
            $errors[ 'password' ][] = 'Password should contain minimum one small letter';
        }
        // Überprüfen ob das Passwort Großbuchstaben enthält
        // Wir vergleichen die Werte und nicht die Typen, preg_match gibt 0 zurück ( == anstatt === )
        if ( preg_match( '/[A-Z]/', $password ) == FALSE ) {
            $errors[ 'password' ][] = 'Password should contain minimum one capital letter';
        }
        // Überprüfen ob das Passwort Sonderzeichen (bspw. $, &, %, !, ?) enthält
        // Wir vergleichen die Werte und nicht die Typen, preg_match gibt 0 zurück ( == anstatt === )
        if ( preg_match( '/\W/', $password ) == FALSE ) {
            $errors[ 'password' ][] = 'Password should contain minimum one special character';
        }
        // Überprüfen ob das Passwort mindestens eine Zahl enthält
        // Wir vergleichen die Werte und nicht die Typen, preg_match gibt 0 zurück ( == anstatt === )
        if ( preg_match( '/\d/', $password ) == FALSE ) {
            $errors[ 'password' ][] = 'Password should contain minimum one digit';
        }

        // Überprüfen ob die Passwort wiederholung eingegeben wurde
        if ( is_null( $password_repeat ) ) {
            $errors[ 'password_repeat' ][] = 'Please type in a password';
        }
        // Überprüfen ob die Passwörter übereinstimmen
        if ( $password !== $password_repeat ) {
            $errors[ 'password_repeat' ][] = 'Passwords doesn\'t match';
        }

        return ( isset( $errors[ 'password' ] ) === FALSE || count( $errors[ 'password' ] ) === 0 )
            && ( isset( $errors[ 'password_repeat' ] ) === FALSE || count( $errors[ 'password_repeat' ] ) === 0 );
    }

}