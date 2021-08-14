<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;

/**
 * Orders Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Users Model wird im Users Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Orders extends AbstractModel {

    private function getAllOrderItems( int $orderId ) {

    }

    public function getOrdersById( int $userId ) : ?array {
        $query = 'SELECT * FROM orders WHERE orderUserId = :userId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':userId', $userId);
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }


    public function addOrder( int $userId, int $pickupTime ) : ?array {
        
        $status = 'in progress';
        $timestamp = $_SERVER[ 'REQUEST_TIME' ];

        $statement = 'INSERT INTO orders ( orderUserId, orderStatus, orderTimestamp, orderPickupTime ) VALUES ( :userId, :status, :timestamp, :pickupTime );';
        $query = $this->Database->prepare( $statement );
        $query->bindValue( ':userId', $userId );
        $query->bindValue( ':status', $status );
        $query->bindValue( ':timestamp', $timestamp );
        $query->bindValue( ':pickupTime', $pickupTime );
        $query->execute();

        $return = $query->fetchAll( \PDO::FETCH_ASSOC );

        print_r($return);

        return $query->fetchAll( \PDO::FETCH_ASSOC );
    }

    /*
    private function addOrderItems( int $orderId, array $orderItems ) : ?array {

        $return = [];

        foreach ($orderItems as $orderItem) {

            $this

            array_merge($return, $query->fetchAll( \PDO::FETCH_ASSOC ));
        }
        
        return $return;
    }
    */

}