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
        $query = 'SELECT * FROM orderItems WHERE orderitemOrderId = :orderId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderId', $orderId);
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function addOrderItem( int $orderId, int $itemId ) : ?array {
        $query = 'INSERT INTO orderItems ( orderitemProductId, orderitemOrderId ) VALUES ( :itemId, :orderId );';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':itemId', $itemId);
        $statement->bindParam( ':orderId', $orderId);
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function removeOrderItemByProductAndOrderId( int $orderId, int $productId ) : ?array {
        $statement = 'DELETE FROM orderItems WHERE orderItemOrderId = :orderId AND orderItemProductId = :productId;';
        $query = $this->Database->prepare( $statement );
        $query->bindValue( ':orderId', $orderId );
        $query->bindValue( ':productId', $productId );
        $query->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

}