<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;

/**
 * Likes Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Feed Model wird in mehreren Kontrollern instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Likes extends AbstractModel {

    public function getLikesByPostId( int $post_id ) : array {
        $query = 'SELECT u.username as username, u.id as user_id'
        . ' FROM likes as l'
        . ' LEFT JOIN users as u ON u.id = l.user_id'
        . ' WHERE l.post_id = :post_id';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':post_id', $post_id );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function likePost( array &$errors ) : bool {
        /** @var int $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $post_id */
        $post_id = filter_input( INPUT_POST, 'post_id' );

        /** @var bool $validate_post_id */
        $validate_post_id = $this->validatePostId( $errors, $post_id );
        /** @var bool $like_exists */
        $like_exists = $this->likeExist( $post_id, $user_id );

        if ( $validate_post_id ) {

            // Like hinzufügen, wenn dieser noch nicht existiert
            if ( $like_exists === FALSE ) {
                /** @var string $query */
                $query = 'INSERT INTO likes ( post_id, user_id ) VALUES ( :post_id, :user_id );';

                $statement = $this->Database->prepare( $query );

                $statement->bindValue( ':post_id', $post_id );
                $statement->bindValue( ':user_id', $user_id );
                $statement->execute();

                return $statement->rowCount() > 0;
            }
            // Like entfernen, wenn dieser bereits existiert
            else {
                /** @var string $query */
                $query = 'DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id;';

                $statement = $this->Database->prepare( $query );
                $statement->bindParam( ':post_id', $post_id );
                $statement->bindParam( ':user_id', $user_id );
                $statement->execute();

                return $statement->rowCount() > 0;
            }

        }

        return FALSE;
    }

    private function likeExist( int $post_id, int $user_id ) : bool {
        /** @var string $query */
        $query = 'SELECT id FROM likes WHERE post_id = :post_id AND user_id = :user_id;';

        $statement = $this->Database->prepare( $query );

        $statement->bindParam( ':post_id', $post_id );
        $statement->bindParam( ':user_id', $user_id );
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    private function validatePostId( array &$errors, ?string $post_id ) : bool {
        if ( is_null( $post_id ) ) {
            $errors[ 'post_id' ][] = 'Please delete a valid post';
        }

        return isset( $errors[ 'post_id' ] ) === FALSE || count( $errors[ 'post_id' ] ) === 0;
    }


}
