<?php

namespace WBD0321;

use PDO;

/**
 * Database Class
 *
 * Erbt von PDO (PHP Data Object) und stellt darüber eine Datenbankverbindung her
 * Es soll kein Erben von der Klasse Database geben, deshalb ist sie als final deklariert
 *
 * @package WBD0321
 */
final class Database extends PDO {

    /**
     * Constructor
     */
    public function __construct() {
        /** @var string $dsn */
        $dsn = sprintf(
            'mysql:host=%1$s;port=%2$s;dbname=%3$s;charset=%4$s',
            DATABASE_HOST,
            DATABASE_PORT,
            DATABASE_NAME,
            DATABASE_CHARSET
        );
        /** @var string $user */
        $dbuser = DATABASE_USER;
        /** @var string $password */
        $dbpass = DATABASE_PASSWORD;
        /** @var array $options */
        $options = [
            PDO::ERRMODE_WARNING => TRUE
        ];

        parent::__construct( $dsn, $dbuser, $dbpass, $options );
    }

}
