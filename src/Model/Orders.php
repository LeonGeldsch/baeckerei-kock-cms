<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Session;
use WBD0321\Model\OrderItems as OrderItemsModel;
use WBD0321\Model\Products as ProductsModel;

/**
 * Orders Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Users Model wird im Users Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Orders extends AbstractModel {

    private ?OrderItemsModel $OrderItemsModel = NULL;
    private ?ProductsModel $ProductsModel = NULL;


    public function __construct() {
        parent::__construct();

        $this->OrderItemsModel = new OrderItemsModel();
    }


    public function getOrdersByUserId( int $userId ) : ?array {
        $query = 'SELECT * FROM orders WHERE orderUserId = :userId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':userId', $userId);
        $statement->execute();
        $result = $statement->fetchAll( \PDO::FETCH_ASSOC );

        return $result;
    }


    public function updateOrderStatus( int $orderId, string $orderStatus ) : bool {
        $query = 'UPDATE orders SET orderStatus = :orderStatus WHERE orderId = :orderId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':orderStatus', $orderStatus);
        $statement->bindParam( ':orderId', $orderId);
        $statement->execute();

        return $statement->rowCount() > 0;
    }


    public function getOrdersByDate( int $fromDate, int $toDate ) : ?array {
        $query = 'SELECT * FROM orders WHERE orderPickupTime BETWEEN :fromDate AND :toDate';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':fromDate', $fromDate);
        $statement->bindParam( ':toDate', $toDate);
        $statement->execute();
        $result = $statement->fetchAll( \PDO::FETCH_ASSOC );

        return $result;
    }
    

    /*
     * returns the id of the inserted Order
     */
    public function addOrder( int $userId, int $pickupTime ) : ?int {
        
        $status = 'in progress';
        $timestamp = $_SERVER[ 'REQUEST_TIME' ];

        $statement = 'INSERT INTO orders ( orderUserId, orderStatus, orderTimestamp, orderPickupTime ) VALUES ( :userId, :status, :timestamp, :pickupTime );';
        $query = $this->Database->prepare( $statement );
        $query->bindValue( ':userId', $userId );
        $query->bindValue( ':status', $status );
        $query->bindValue( ':timestamp', $timestamp );
        $query->bindValue( ':pickupTime', $pickupTime );
        $query->execute();

        return $this->Database->lastInsertId();
    }

}