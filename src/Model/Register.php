<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Model\Traits\Users as UsersTrait;
use WBD0321\Model\Traits\UsersValidation as UsersValidationTrait;
use WBD0321\Model\Traits\ImageUpload as ImageUploadTrait;

/**
 * Register Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Register Model wird im Register Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Register extends AbstractModel {

    use ImageUploadTrait;
    use UsersTrait;
    use UsersValidationTrait;

    /**
     * Register Users
     *
     * Wird von außerhalb der Klasse aufgerufen, deshalb als public deklariert
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * @access  public
     * @param   array   $errors
     * @return  bool
     */
    public function registerUser( array &$errors ) : bool {
        /** @var string|NULL $username */
        $username = filter_input( INPUT_POST, 'username' );
        /** @var string|NULL $email */
        $email = filter_input( INPUT_POST, 'email' );
        /** @var string|NULL $password */
        $password = filter_input( INPUT_POST, 'password' );
        /** @var string|NULL $password_repeat */
        $password_repeat = filter_input( INPUT_POST, 'password_repeat' );

        /** @var bool $validate_username */
        $validate_username = $this->validateUsername( $errors, $username );
        /** @var bool $validate_email */
        $validate_email = $this->validateEmail( $errors, $email );
        /** @var bool $validate_password */
        $validate_password = $this->validatePassword( $errors, $username, $password, $password_repeat );

        if ( $validate_username && $validate_email && $validate_password ) {
            /** @var array|NULL $avatar */
            $avatar = $this->uploadImage( $errors,'avatar' );
            /** @var string $hashedSalt */
            $hashedSalt = $this->createHashedSalt();
            /** @var string $hashedPassword */
            $hashedPassword = $this->createHashedPassword( $password, $hashedSalt );

            /** @var string $statement */
            $statement = 'INSERT INTO users ( username, email, password, salt, registered, avatar ) VALUES ( :username, :email, :password, :salt, :registered, :avatar );';
            /** @var \PDOStatement $query */
            $query = $this->Database->prepare( $statement );
            $query->bindValue( ':username', $username );
            $query->bindValue( ':email', $email );
            $query->bindValue( ':password', $hashedPassword );
            $query->bindValue( ':salt', $hashedSalt );
            $query->bindValue( ':registered', $_SERVER[ 'REQUEST_TIME' ] );
            $query->bindValue( ':avatar', $avatar );
            $query->execute();

            return $query->rowCount() > 0;
        }
        else {

            return FALSE;
        }
    }

}
