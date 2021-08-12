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
        /** @var string|NULL $firstname */
        $firstname = filter_input( INPUT_POST, 'firstname' );
        /** @var string|NULL $lastname */
        $lastname = filter_input( INPUT_POST, 'lastname' );
        /** @var string|NULL $username */
        $username = filter_input( INPUT_POST, 'username' );
        /** @var string|NULL $email */
        $email = filter_input( INPUT_POST, 'email' );
        /** @var string|NULL $password */
        $password = filter_input( INPUT_POST, 'password' );
        /** @var string|NULL $password_repeat */
        $password_repeat = filter_input( INPUT_POST, 'password_repeat' );
        /** @var string|NULL $phone */
        $phoneNumber = filter_input( INPUT_POST, 'phoneNumber' );
        /** @var string|NULL $mobile */
        $mobileNumber = filter_input( INPUT_POST, 'mobileNumber' );
        /** @var string|NULL $userlevel */
        $userLevel = 'regular';




        /** @var bool $validate_username */
        $validateFirstname = $this->validateFirstname( $errors, $firstname );
        /** @var bool $validate_username */
        $validateLastname = $this->validateLastname( $errors, $lastname );
        /** @var bool $validate_username */
        $validateUsername = $this->validateUsername( $errors, $username );
        /** @var bool $validate_email */
        $validateEmail = $this->validateEmail( $errors, $email );
        /** @var bool $validate_password */
        $validatePassword = $this->validatePassword( $errors, $username, $password, $password_repeat );
        /** @var bool $validate_phone */
        $validatePhoneNumber = $this->validatePhoneNumber( $errors, $phoneNumber );
        /** @var bool $validate_phone */
        $validateMobileNumber = $this->validateMobileNumber( $errors, $mobileNumber );


        if ( $validateFirstname && $validateLastname && $validateUsername && $validateEmail && $validatePassword && $validatePhoneNumber && $validateMobileNumber ) {

            //echo "validated!";
            /** @var string $hashedSalt */
            $hashedSalt = $this->createHashedSalt();
            /** @var string $hashedPassword */
            $hashedPassword = $this->createHashedPassword( $password, $hashedSalt );

            /** @var string $statement */
            $statement = 'INSERT INTO users ( userFirstname, userLastname, userUsername, userEmail, userPassword, userSalt, userRegisterTime, userPhoneNumber, userMobileNumber, userLevel ) VALUES ( :firstname, :lastname, :username, :email, :password, :salt, :registerTime, :phoneNumber, :mobileNumber, :userLevel );';
            /** @var \PDOStatement $query */
            $query = $this->Database->prepare( $statement );
            $query->bindValue( ':firstname', $firstname );
            $query->bindValue( ':lastname', $lastname );
            $query->bindValue( ':username', $username );
            $query->bindValue( ':email', $email );
            $query->bindValue( ':password', $hashedPassword );
            $query->bindValue( ':salt', $hashedSalt );
            $query->bindValue( ':registerTime', $_SERVER[ 'REQUEST_TIME' ] );
            $query->bindValue( ':phoneNumber', $phoneNumber );
            $query->bindValue( ':mobileNumber', $mobileNumber );
            $query->bindValue( ':userLevel', $userLevel );
            $query->execute();
            
            return $query->rowCount() > 0;
        }
        else {

            return FALSE;
        }
    }

}