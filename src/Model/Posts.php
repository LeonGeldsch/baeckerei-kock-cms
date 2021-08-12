<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;

/**
 * Posts Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Feed Model wird in mehreren Kontrollern instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Posts extends AbstractModel {

    public function createPost( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $message */
        $message = filter_input( INPUT_POST, 'message' );

        if ( $this->validateMessage( $errors, $message ) === TRUE ) {
            /** @var string $query */
            $query = 'INSERT INTO posts ( user_id, message, timestamp ) VALUES ( :user_id, :message, :timestamp );';

            /** @var \PDOStatement $statement */
            $statement = $this->Database->prepare( $query );
            $statement->bindValue( ':user_id', $user_id );
            $statement->bindValue( ':message', $message );
            $statement->bindValue( ':timestamp', $_SERVER[ 'REQUEST_TIME' ] );
            $statement->execute();

            return $statement->rowCount() > 0;
        }

        return FALSE;
    }

    public function deletePostById( array &$errors ) : bool {
        /** @var string $user_id */
        $user_id = Session::get( 'login_id' );
        /** @var string|NULL $post_id */
        $post_id = filter_input( INPUT_POST, 'post_id' );

        if ( $this->validatePostId( $errors, $post_id ) ) {
            /** @var string $query */
            $query = 'DELETE FROM posts WHERE id = :id AND user_id = :user_id;';

            $statement = $this->Database->prepare( $query );
            $statement->bindParam( ':id', $post_id );
            $statement->bindParam( ':user_id', $user_id );
            $statement->execute();

            return $statement->rowCount() > 0;
        }

        return FALSE;
    }

    public function getPostById( string $post_id ) : ?array {
        $query =
            'SELECT p.id AS post_id, u.id AS user_id, count( DISTINCT c.id ) as comments, count( DISTINCT l.id ) as likes, count( DISTINCT r.id ) as reposts, u.username, p.message, p.timestamp, f.thumbnails as avatar'
        .   ' FROM posts AS p'
        .   ' LEFT JOIN users AS u ON p.user_id = u.id'
        .   ' LEFT JOIN comments AS c ON p.id = c.post_id'
        .   ' LEFT JOIN likes AS l ON p.id = l.post_id'
        .   ' LEFT JOIN reposts AS r ON p.id = r.post_id'
        .   ' LEFT JOIN files AS f ON u.avatar = f.id'
        .   ' WHERE p.id = :post_id;';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':post_id', $post_id );
        $statement->execute();

        $post = $statement->fetch( \PDO::FETCH_ASSOC );

        return isset( $post[ 'post_id' ] ) && $post[ 'post_id' ] === $post_id ? $post : NULL;
    }

    public function getPosts() : array {
        /** @var string $query */
        $query =
            'SELECT p.id AS post_id, u.id AS user_id, count( DISTINCT c.id ) as comments, count( DISTINCT l.id ) as likes, count( DISTINCT r.id ) as reposts, u.username, p.message, p.timestamp, f.thumbnails as avatar'
        .   ' FROM posts AS p'
        .   ' LEFT JOIN users AS u ON p.user_id = u.id'
        .   ' LEFT JOIN comments AS c ON p.id = c.post_id'
        .   ' LEFT JOIN likes AS l ON p.id = l.post_id'
        .   ' LEFT JOIN reposts AS r ON p.id = r.post_id'
        .   ' LEFT JOIN files AS f ON u.avatar = f.id'
        .   ' GROUP BY p.id'
        .   ' ORDER BY p.timestamp DESC';

        $statement = $this->Database->prepare( $query );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getPostsByIds( array $post_ids ) : array {
        $placeholders = str_repeat ('?, ',  count ($post_ids) - 1) . '?';
        /** @var string $query */
        $query =
            'SELECT p.id AS post_id, u.id AS user_id, count( DISTINCT c.id ) as comments, count( DISTINCT l.id ) as likes, count( DISTINCT r.id ) as reposts, u.username, p.message, p.timestamp, f.thumbnails as avatar'
            .   ' FROM posts AS p'
            .   ' LEFT JOIN users AS u ON p.user_id = u.id'
            .   ' LEFT JOIN comments AS c ON p.id = c.post_id'
            .   ' LEFT JOIN likes AS l ON p.id = l.post_id'
            .   ' LEFT JOIN reposts AS r ON p.id = r.post_id'
            .   ' LEFT JOIN files AS f ON u.avatar = f.id'
            .   ' WHERE p.id IN(' . $placeholders .  ')'
            .   ' GROUP BY p.id'
            .   ' ORDER BY p.timestamp DESC';

        $statement = $this->Database->prepare( $query );
        $statement->execute( $post_ids );

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getRepostsByUsername( string $username ) : array {
        // Post IDs von den Reposts holen
        /** @var string $query */
        $query = 'SELECT post_id FROM reposts AS r LEFT JOIN users AS u ON r.user_id = u.id WHERE u.username = :username;';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':username', $username );
        $statement->execute();

        $post_ids = $statement->fetchAll( \PDO::FETCH_ASSOC );

        $clean_ids = [];

        foreach ( $post_ids as $post_id) {
            $clean_ids[] = $post_id[ 'post_id' ];
        }

        return $this->getPostsByIds( $clean_ids );
    }

    public function getAllPostsByUsername( string $username ) : array {
        /** @var array $posts */
        $posts = $this->getPostsByUsername( $username );
        /** @var array $reposts */
        $reposts = $this->getRepostsByUsername( $username );

        $all_posts = array_merge( $posts, $reposts );
        $posts_per_timestamp = [];
        $i = 0;

        foreach( $all_posts as $post ) {
            $post[ 'repost' ] = $username !== $post[ 'username' ];
            $posts_per_timestamp[ $post[ 'timestamp' ] . "-$i" ] = $post;
            $i++;
        }

        krsort( $posts_per_timestamp );

        return $posts_per_timestamp;
    }

    public function getPostsByUsername( string $username ) : array {
        /** @var string $query */
        $query =
                'SELECT p.id AS post_id, u.id AS user_id, count( DISTINCT c.id ) as comments, count( DISTINCT l.id ) as likes, u.username, p.message, p.timestamp, f.thumbnails as avatar'
            .   ' FROM posts AS p'
            .   ' LEFT JOIN users AS u ON p.user_id = u.id'
            .   ' LEFT JOIN comments AS c ON p.id = c.post_id'
            .   ' LEFT JOIN likes AS l ON p.id = l.post_id'
            .   ' LEFT JOIN reposts AS r ON u.id = r.user_id'
            .   ' LEFT JOIN files AS f ON u.avatar = f.id'
            .   ' WHERE u.username = :username'
            .   ' GROUP BY p.id'
            .   ' ORDER BY p.timestamp DESC;';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':username', $username );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );

    }

    private function validateMessage( array &$errors, ?string $message ) : bool {
        if ( is_null( $message ) ) {
            $errors[ 'message' ][] = 'Please type in a valid message';
        }
        if ( strlen( $message ) < 20 ) {
            $errors[ 'message' ][] = 'Message should be minimum 20 characters long';
        }
        if ( strlen( $message ) > 400 ) {
            $errors[ 'message' ][] = 'Message should be maximum 400 characters long';
        }

        return isset( $errors[ 'message' ] ) === FALSE || count( $errors[ 'message' ] ) === 0;
    }

    private function validatePostId( array &$errors, ?string $post_id ) : bool {
        if ( is_null( $post_id ) ) {
            $errors[ 'post_id' ][] = 'Please delete a valid post';
        }

        return isset( $errors[ 'post_id' ] ) === FALSE || count( $errors[ 'post_id' ] ) === 0;
    }

}
