<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;

/**
 * Orders Items Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Users Model wird im Users Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class OrderItems extends AbstractModel {

    public function getOrderItemsByOrderId( int $orderId ) : ?array {
        $query = 'SELECT * FROM orderItems WHERE orderItemOrderId = :orderId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderId', $orderId);
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function orderItemExists( int $orderId, int $productId ) : int {
        $query = 'SELECT * FROM orderItems WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderId', $orderId);
        $statement->bindParam( ':productId', $productId );
        $statement->execute();
        $results = $statement->fetchAll();

        return count( $results );
    }

    public function getOrderItemByOrderIdAndProductId( int $orderId, int $productId ) : ?array {
        $query = 'SELECT * FROM orderItems WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderId', $orderId );
        $statement->bindParam( ':productId', $productId );
        $statement->execute();

        return $statement->fetch( \PDO::FETCH_ASSOC );
    }

    public function addOrderItem( int $orderId, int $productId, int $amount ) : ?array {
        $query = 'INSERT INTO orderItems ( orderItemOrderId, orderItemProductId, orderItemAmount ) VALUES ( :orderItemOrderId, :orderItemProductId, :orderItemAmount );';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderItemOrderId', $orderId );
        $statement->bindParam( ':orderItemProductId', $productId );
        $statement->bindParam( ':orderItemAmount', $amount );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getOrderAmount( int $orderId, int $productId ) : ?int {
        $query = 'SELECT orderItemAmount FROM orderItems WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderId', $orderId );
        $statement->bindParam( ':productId', $productId );
        $statement->execute();
        $result = $statement->fetch( \PDO::FETCH_ASSOC );
        $amount = $result[ 'orderItemAmount' ];

        return $amount;
    }

    public function addToOrderItemAmount( int $orderId, int $productId, int $addedAmount ) : ?array {
        $oldAmount = $this->getOrderAmount( $orderId, $productId );
        $newAmount = $oldAmount + $addedAmount;
        $query = 'UPDATE orderItems SET orderItemAmount = :newAmount WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':newAmount', $newAmount );
        $statement->bindParam( ':orderId', $orderId );
        $statement->bindParam( ':productId', $productId );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function removeOrderItemByProductAndOrderId( int $productId, int $orderId ) : ?array {
        $query = 'DELETE FROM orderItems WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':orderId', $orderId );
        $statement->bindValue( ':productId', $productId );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

}