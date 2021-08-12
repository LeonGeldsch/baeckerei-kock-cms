<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;

/**
 * Comments Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Feed Model wird in mehreren Kontrollern instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Comments extends AbstractModel {

    public function createComment( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $post_id */
        $post_id = filter_input( INPUT_POST, 'post_id' );
        /** @var string|NULL $comment */
        $comment = filter_input( INPUT_POST, 'comment' );

        /** @var bool $validate_post_id */
        $validate_post_id = $this->validatePostId( $errors, $post_id );
        /** @var bool $validate_comment */
        $validate_comment = $this->validateComment( $errors, $comment );

        if ( $validate_post_id === TRUE && $validate_comment === TRUE ) {
            /** @var string $query */
            $query = 'INSERT INTO comments (post_id, user_id, comment, timestamp) VALUES (:post_id, :user_id, :comment, :timestamp);';

            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':post_id', $post_id );
            $statement->bindValue( ':user_id', $user_id );
            $statement->bindValue( ':comment', $comment );
            $statement->bindValue( ':timestamp', $_SERVER[ 'REQUEST_TIME' ] );
            $statement->execute();

            return $statement->rowCount() > 0;
        }

        return FALSE;
    }

    public function getCommentsByPostId( string $post_id ) : array {
        $query =
            'SELECT c.comment, c.timestamp, u.username, u.registered, f.thumbnails as avatar'
        .   ' FROM comments AS c'
        .   ' LEFT JOIN users AS u ON c.user_id = u.id'
        .   ' LEFT JOIN files AS f ON u.avatar = f.id'
        .   ' WHERE c.post_id = :post_id'
        .   ' ORDER BY c.timestamp DESC';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':post_id', $post_id );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    private function validateComment( array &$errors, ?string $comment ) : bool {
        if ( is_null( $comment ) ) {
            $errors[ 'comment' ][] = 'Please type in a valid comment';
        }
        if ( strlen( $comment ) < 20 ) {
            $errors[ 'comment' ][] = 'Message should be minimum 20 characters long';
        }
        if ( strlen( $comment ) > 400 ) {
            $errors[ 'comment' ][] = 'Message should be maximum 400 characters long';
        }

        return isset( $errors[ 'comment' ] ) === FALSE || count( $errors[ 'comment' ] ) === 0;
    }

    private function validatePostId( array &$errors, ?string $post_id ) : bool {
        if ( is_null( $post_id ) ) {
            $errors[ 'post_id' ][] = 'Please delete a valid post';
        }

        return isset( $errors[ 'post_id' ] ) === FALSE || count( $errors[ 'post_id' ] ) === 0;
    }

}
