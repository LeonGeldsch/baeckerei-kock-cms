<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;
use WBD0321\Model\Traits\ImageUpload as ImageUploadTrait;


final class Products extends AbstractModel {

    use ImageUploadTrait;

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

    public function addNewProduct( array &$errors ) : bool {

        //print_r( $_FILES );
        
        $productName = filter_input( INPUT_POST, 'name' );
        $productPrice = filter_input( INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $productDescription = filter_input( INPUT_POST, 'description' );
        $productActive = filter_input( INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT ) ?? 0;
        $productImageId = $this->uploadImage( $errors, 'image' );
        $productCategory = filter_input( INPUT_POST, 'category' );

        
        $query = 'INSERT INTO products ( productName, productPrice, productDescription, productActive, productImageId, productCategory) VALUES ( :productName, :productPrice, :productDescription, :productActive, :productImageId, :productCategory);';
        
        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':productName', $productName );
        $statement->bindValue( ':productPrice', $productPrice );
        $statement->bindValue( ':productDescription', $productDescription );
        $statement->bindValue( ':productActive', $productActive );
        $statement->bindValue( ':productImageId', $productImageId );
        $statement->bindValue( ':productCategory', $productCategory );

        $statement->execute();

        print_r($statement->errorInfo());

        return $statement->rowCount() > 0;
    }

}