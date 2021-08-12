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
        $statement->bindParam( ':category', $category);
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

    public function getAllProductCategories() : ?array {
        $query = 'SELECT * FROM productCategories;';
        $statement = $this->Database->prepare( $query );
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_ASSOC );
    }

}