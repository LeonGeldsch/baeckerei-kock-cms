<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Model\Traits\Users as UsersTrait;
use WBD0321\Model\Traits\UsersValidation as UsersValidationTrait;
use WBD0321\Session;

/**
 * Users Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Users Model wird im Users Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Users extends AbstractModel {

    use UsersTrait;
    use UsersValidationTrait;

    /**
     * Delete Users
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * TODO: Alle Inhalte die in Relation zum Nutzer stehen löschen!
     *
     * @access  public
     * @param   array   $errors
     * @return  bool
     */
    public function deleteUser( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string $username */
        $username = Session::get( 'login_username' );
        /** @var string|NULL $password */
        $password = filter_input( INPUT_POST, 'password' );

        /** @var array $credentials */
        $credentials = $this->getCredentials( $username );
        /** @var bool $comparePasswords */
        $comparePasswords = $this->comparePasswords( $credentials, $password );

        if ( $comparePasswords === FALSE ) {
            $errors[ 'password' ][] = 'Password is wrong';
        }

        if ( $comparePasswords ) {
            /** @var string $query */
            $query = 'DELETE FROM users WHERE id = :id;';
            /** @var \PDOStatement $statement */
            $statement = $this->Database->prepare( $query );
            $statement->bindParam( ':id', $user_id );
            $statement->execute();

            return $statement->rowCount() > 0;
        }
        else {

            return FALSE;
        }
    }

    /**
     * Update Email
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * @access  public
     * @param   array $errors
     * @return  bool
     */
    public function updateEmail( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $email */
        $email = filter_input( INPUT_POST, 'email' );

        if ( $this->validateEmail( $errors, $email ) ) {
            /** @var string $query */
            $query = 'UPDATE users SET email = :email WHERE id = :id;';
            /** @var \PDOStatement $statement */
            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':email', $email );
            $statement->bindValue( ':id', $user_id );
            $statement->execute();

            return $statement->rowCount() > 0;
        }
        else {

            return FALSE;
        }
    }

    /**
     * Update Username
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * @access  public
     * @param   array $errors
     * @return  bool
     */
    public function updateUsername( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $username */
        $username = filter_input( INPUT_POST, 'username' );

        if ( $this->validateUsername( $errors, $username ) ) {
            /** @var string $query */
            $query = 'UPDATE users SET username = :username WHERE id = :id;';
            /** @var \PDOStatement $statement */
            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':username', $username );
            $statement->bindValue( ':id', $user_id );
            $statement->execute();

            return $statement->rowCount() > 0 && Session::set( 'login_username', $username );
        }
        else {

            return FALSE;
        }
    }

    /**
     * Update Password
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * @access  public
     * @param   array $errors
     * @return  bool
     */
    public function updatePassword( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string $username */
        $username = Session::get( 'login_username' );

        /** @var string|NULL $password */
        $password = filter_input( INPUT_POST, 'password' );

        /** @var string|NULL $new_password */
        $new_password = filter_input( INPUT_POST, 'new_password' );
        /** @var string|NULL $new_password_repeat */
        $new_password_repeat = filter_input( INPUT_POST, 'new_password_repeat' );

        /** @var array $credentials */
        $credentials = $this->getCredentials( $username );
        /** @var bool $comparePasswords */
        $comparePasswords = $this->comparePasswords( $credentials, $password );

        if ( $comparePasswords === FALSE ) {
            $errors[ 'old_password' ][] = 'Password is wrong';
        }

        if ( $comparePasswords && $this->validatePassword( $errors, $username, $new_password, $new_password_repeat ) ) {
            /** @var string $hashedSalt */
            $hashedSalt = $this->createHashedSalt();
            /** @var string $hashedPassword */
            $hashedPassword = $this->createHashedPassword( $new_password, $hashedSalt );

            /** @var string $query */
            $query = 'UPDATE users SET password = :password, salt = :salt WHERE id = :id;';

            /** @var \PDOStatement $statement */
            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':password', $hashedPassword );
            $statement->bindValue( ':salt', $hashedSalt );
            $statement->bindValue( ':id', $user_id );
            $statement->execute();

            return $statement->rowCount() > 0;
        }
        else {

            return FALSE;
        }
    }

}
