<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;

final class Products extends AbstractModel {

    public function getAllProducts() : ?array {
        $query = 'SELECT * FROM products;';
        $statement = $this->Database->prepare( $query );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getProductsByCategory( string $category ) : ?array {
        $query = 'SELECT * FROM products WHERE productCategory = :category;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':category', $category );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getAllProductCategories() : ?array {
        $query = 'SELECT * FROM productCategories;';
        $statement = $this->Database->prepare( $query );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getProductNameById( ?int $productId ) : ?string {
        $query = 'SELECT productName FROM products WHERE productId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':productId', $productId );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC )[0]['productName'] ?? null;
    }

    public function productExists( ?int $productId ) : ?bool {
        $query = 'SELECT * FROM products WHERE productId = :productId;';
        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':productId', $productId );
        $statement->execute();

        return $statement->rowCount() > 0;
    }


}