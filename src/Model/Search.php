<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;

/**
 * Search Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Feed Model wird in mehreren Kontrollern instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Search extends AbstractModel {

    public function searchForUsers( string $keyword ) : array {
        /** @var string $query */
        $query = 'SELECT * FROM users WHERE username LIKE :keyword OR email LIKE :keyword;';

        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':keyword', '%' . $keyword . '%' );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function searchForPosts( string $keyword ) : array {
        /** @var string $query */
        $query = 'SELECT p.id, p.message FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE p.message LIKE :keyword OR u.username LIKE :keyword GROUP BY p.id;';

        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':keyword', '%' . $keyword . '%' );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }


}
