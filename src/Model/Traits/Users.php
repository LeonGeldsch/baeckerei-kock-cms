<?php

namespace WBD0321\Model\Traits;

/**
 * Users Trait
 *
 * Geteilte Funktionen für die users Tabelle, die in mehreren Models Verwendung finden
 *
 * @package WBD0321\Model\Traits
 */
trait Users {

    /**
     * Compare Passwords
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * Vergleichen ob das vom Nutzer eingegebene Passwort mit dem Salt aus der Datenbank verschlüsselt dem verschlüsselten Passwort aus Datenbank entspricht.
     *
     * @access  private
     * @param   array   $credentials
     * @param   string  $user_input
     * @return  bool
     */
    private function comparePasswords( array $credentials, string $user_input ) : bool {
        /** @var string $hashedSalt */
        $hashedSalt = $credentials[ 'salt' ];
        /** @var string $hashedPassword */
        $hashedPassword = $credentials[ 'password' ];

        return $hashedPassword === $this->createHashedPassword( $user_input, $hashedSalt );
    }

    /**
     * Create hashed password
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen String als Rückgabewert deshalb return Type 'string'
     *
     * Passwort in kombination mit dem Salt verschlüsseln
     *
     * @access  private
     * @param   string  $password
     * @param   string  $salt
     * @return  string
     */
    private function createHashedPassword( string $password, string $salt ) : string {

        return hash( 'sha512', "{$password}{$salt}" );
    }

    /**
     * Create hashed salt
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen String als Rückgabewert deshalb return Type 'string'
     *
     * Einen verschlüsselten Wert erzeugen
     *
     * @access  private
     * @return  string
     */
    private function createHashedSalt() : string {
        /** @var int $rand */
        $rand = rand( 1234, 9876 );
        /** @var int $time */
        $time = time();

        return hash( 'sha512', "{$time}-{$rand}" );
    }

    /**
     * Email Exists
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * Überprüfen ob eine E-Mail Adresse bereits in der Datenbank existiert
     *
     * @access  private
     * @param   string|NULL $email
     * @return  bool
     */
    private function emailExists( ?string $email ) : bool {
        /** @var string $query */
        $query = 'SELECT email FROM users WHERE email = :email;';
        /** @var \PDOStatement $statement */
        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':email', $email );
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    /**
     * Get Credentials
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Array als Rückgabewert deshalb return Type 'array'
     *
     * Passwort und Salt per Nutzername aus der Datenbank selektieren.
     *
     * @access  private
     * @param   string  $username
     * @return  array
     */
    private function getCredentials( string $username ) : array {
        /** @var string $query */
        $query = 'SELECT id, password, salt FROM users WHERE username = :username;';
        /** @var \PDOStatement $statement */
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':username', $username );
        $statement->execute();

        return $statement->fetch( \PDO::FETCH_ASSOC );
    }

    /**
     * @access  public  Wird vom Kontroller aufgerufen
     * @param string $username
     * @return array
     */
    public function getUserByUsername( string $username ) : ?array {
        $query = 'SELECT u.id, u.username, u.email, u.registered, f.filename, f.filepath, f.fileuri, f.thumbnails FROM users AS u LEFT JOIN files AS f ON u.avatar = f.id WHERE username = :username;';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':username', $username );
        $statement->execute();

        $user = $statement->fetch( \PDO::FETCH_ASSOC );

        return is_array( $user ) ? $user : NULL;
    }

    /**
     * Username Exists
     *
     * Wird von innerhalb der Klasse aufgerufen, deshalb als private deklariert
     * (private anstatt protected weil es keiner Erben von der Klasse gibt, welche auf die Methode zugriff bräuchten)
     * Hat einen Boolean als Rückgabewert deshalb return Type 'bool'
     *
     * Überprüfen ob ein Nutzername bereits in der Datenbank Tabelle existiert
     *
     * @access  private
     * @param   string|NULL $username
     * @return  bool
     */
    private function usernameExists( ?string $username ) : bool {
        /** @var string $query */
        $query = 'SELECT username FROM users WHERE username = :username;';
        /** @var \PDOStatement $statement */
        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':username', $username );
        $statement->execute();
        $results = $statement->fetchAll();

        return count( $results ) > 0;
    }

}