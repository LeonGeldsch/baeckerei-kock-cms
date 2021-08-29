<?php

namespace WBD0321\Model;

use WBD0321\Model as AbstractModel;

/**
 * Users Model Class
 *
 * Es soll keine Erben von der Klasse Controller geben, deshalb ist sie als final deklariert
 * Das Users Model wird im Users Kontroller instanziiert und verwendet um Information zu verarbeiten
 *
 * @package WBD0321\Model
 */
final class Files extends AbstractModel {

    public function getImageById( int $imageId ) : ?array {
        $query = 'SELECT fileId, fileName, filePath, fileType, fileUri, fileThumbnails FROM files WHERE fileId = :imageId;';

        $statement = $this->Database->prepare( $query );
        $statement->bindParam( ':imageId', $imageId );
        $statement->execute();

        $image = $statement->fetch( \PDO::FETCH_ASSOC );

        return is_array( $image ) ? $image : NULL;

    }

}