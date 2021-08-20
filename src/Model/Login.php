<?php

namespace WBD0321\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use WBD0321\Model as AbstractModel;
use WBD0321\Model\Traits\Users as UsersTrait;
use WBD0321\Session;

/**
 * Login Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Login Model wird im Login Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Login extends AbstractModel {

    use UsersTrait;

    public function resetPassword( array &$errors ) : bool {
        /** @var string|NULL $email */
        $email = filter_input( INPUT_POST, 'email' );

        if ( $this->emailExists( $email ) === TRUE ) {
            $new_password = $this->createPassword();
            $hashed_salt = $this->createHashedSalt();
            $hashed_password = $this->createHashedPassword( $new_password, $hashed_salt );

            $query = 'UPDATE users SET userPassword = :password, userSalt = :salt WHERE userEmail = :email;';

            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':password', $hashed_password );
            $statement->bindValue( ':salt', $hashed_salt );
            $statement->bindValue( ':email', $email );
            $statement->execute();

            if ( $statement->rowCount() > 0 ) {
                $phpmailer  = new PHPMailer();
                // SMTP nutzen
//                $phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;
//                $phpmailer->isSMTP();
//                $phpmailer->Host = 'host';
//                $phpmailer->SMTPAuth = TRUE;
//                $phpmailer->Username = 'username';
//                $phpmailer->Password = 'password';
//                $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//                $phpmailer->Port = 25;

                $phpmailer->setFrom( 'noreply@ourcms.de' );
                $phpmailer->addAddress( $email );


                $phpmailer->isHTML( TRUE );
                $phpmailer->Subject = 'Here is your new Password!';
                $phpmailer->Body =  'Your new Password is <b>' . $new_password . '</b> Have fun!';
                $phpmailer->AltBody = 'Your new Password is ' . $new_password . ' Have fun';

                if ( $phpmailer->send() !== FALSE ) {

                    return TRUE;
                }
                else {

                    $errors[ 'email' ][] = 'We was not able to send u an email. Your new Password is ' . $new_password;
                }
            }
        }
        else {
            $errors[ 'email' ][] = 'E-Mail address doesn\'t exist';
        }

        return FALSE;
    }

    private function createPassword() : string {

        return md5( rand( 123456789, 987654321 ) );
    }

    /**
     * Login Users
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * @access  public
     * @param   array   $errors
     * @return  bool
     */
    public function loginUser( array &$errors ) : bool {
        /** @var string|NULL $username */
        $username = filter_input( INPUT_POST, 'username' );
        /** @var string|NULL $password */
        $password = filter_input( INPUT_POST, 'password' );

        /** @var bool $validate_username */
        $validate_username = $this->validateUsername( $errors, $username );
        /** @var bool $validate_password */
        $validate_password = $this->validatePassword( $errors, $password );

        if ( $validate_username && $validate_password ) {
            /** @var array $credentials */
            $credentials = $this->getCredentials( $username );
            /** @var bool $comparePasswords */
            $comparePasswords = $this->comparePasswords( $credentials, $password );

            if ( $comparePasswords === TRUE ) {
                // Logindaten vom Nutzer in der Session speichern
                Session::set( 'login_id', $credentials[ 'userId' ] );
                Session::set( 'user_level', $credentials[ 'userLevel' ] );
                Session::set( 'login_username', $username );
                Session::set( 'login_timestamp', time() );
            }
            else {
                $errors[ 'password' ][] = 'Password is wrong!';
            }

            return $comparePasswords;
        }
        else {

            return FALSE;
        }
    }

    /**
     * Validate Username
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     * Wir verwenden $errors als Referenz und müssen den array daher nicht zurückgeben und mit den hinzugefügten Werten zu arbeiten
     *
     * Überprüfen ob ein Nutzername eingegeben wurde
     * Überprüfen ob der Nutzername existiert
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
        // Überprüfen ob der Nutzername existiert
        if ( $this->usernameExists( $username ) === FALSE ) {
            $errors[ 'username' ][] = 'Username doesn\'t exist';
        }

        return isset( $errors[ 'username' ] ) === FALSE || count( $errors[ 'username' ] ) === 0;
    }

    /**
     * Validate Password
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     * Wir verwenden $errors als Referenz und müssen den array daher nicht zurückgeben und mit den hinzugefügten Werten zu arbeiten
     *
     * Überprüfen ob ein Passwort eingegeben wurde
     *
     * @access  private
     * @param   array       $errors
     * @param   string|NULL $password
     * @return  bool
     */
    private function validatePassword( array &$errors, ?string $password ) : bool {
        // Überprüfen ob ein Passwort eingegebn wurde
        if ( is_null( $password ) || empty( $password ) ) {
            $errors[ 'password' ][] = 'Please type in a password';
        }

        return isset( $errors[ 'password' ] ) === FALSE || count( $errors[ 'password' ] ) === 0;
    }

}
