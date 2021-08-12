<?php

namespace WBD0321\Model\Traits;

use WBD0321\Session;

trait ImageUpload {

    /**
     * @return string
     */
    private function createDateCodedPath() : string {
        $date = date( 'Y.m.d', time() );
        $code = explode( '.', $date );
        $path = implode( DIRECTORY_SEPARATOR, $code );

        return $path;
    }

    /**
     * @param string $dir
     * @return bool
     */
    private function createFolder( string $dir ) : bool {
        // Überprüfen ob Ordner existiert,
        // Falls nicht, dann einen Ordner anlegen
        if ( file_exists( $dir ) === FALSE ) {

            return (bool) mkdir( $dir, 0777, TRUE );
        }
        // Wenn der Ordner bereits existiert geben TRUE zurück

        return TRUE;
    }

    /**
     * @param $file
     * @param $target
     * @return bool
     */
    private function moveFile( $file, $target ) : bool {

        return (bool) move_uploaded_file( $file, $target );
    }

    /**
     * @param string $type
     * @return string|null
     */
    private function sanitizeFileExtension( string $type ) : ?string {
        switch( $type )  {
            case IMAGETYPE_JPEG:
                return '.jpeg';
            case IMAGETYPE_PNG:
                return '.png';
            default:
                return NULL;
        }
    }

    /**
     * @param array $errors
     * @param string $type
     * @return bool
     */
    private function validateImageType( array &$errors, string $type ) : bool {
        if ( in_array( $type, [ IMAGETYPE_JPEG, IMAGETYPE_PNG ] ) === FALSE ) {
            $errors[ 'image' ][] = 'Please use a valid image type';
        }

        return isset( $errors[ 'image' ] ) === FALSE || count( $errors[ 'image' ] ) === 0;
    }

    /**
     * @param   string $type
     * @param   string $name
     * @param   string $path
     * @param   string $uri
     * @return  int|NULL
     */
    private function insertFile( string $type, string $name, string $path, string $uri, array $thumbnails ) : ?int {
        $query = 'INSERT INTO files ( type, filename, filepath, fileuri, thumbnails ) VALUES ( :type, :filename, :filepath, :fileuri, :thumbnails )';

        $statement = $this->Database->prepare( $query );
        $statement->bindValue( ':type', $type );
        $statement->bindValue( ':filename', $name );
        $statement->bindValue( ':filepath', $path );
        $statement->bindValue( ':fileuri', $uri );
        $statement->bindValue( ':thumbnails', serialize( json_encode( $thumbnails ) ) );
        $statement->execute();

        return $statement->rowCount() > 0 ? $this->Database->lastInsertId() : NULL;
    }

    private function createThumbnail(
        string $imagePath,
        string $thumbnailName,
        string $thumbnailPath,
        string $thumbnailUri,
        int $thumbnailWidth,
        int $thumbnailHeight
    ) : ?array {
        list( $imageWidth, $imageHeight, $imageType ) = getimagesize( $imagePath );

        switch( $imageType ) {
            case IMAGETYPE_JPEG:
                $gdImage = imagecreatefromjpeg( $imagePath );
                break;
            case IMAGETYPE_PNG:
                $gdImage = imagecreatefrompng( $imagePath );
                break;
            default:
                return NULL;
        }

        /** @var int|float $imageRatio */
        $imageRatio = $imageWidth / $imageHeight;
        /** @var int|float $thumbnailRatio */
        $thumbnailRatio = $thumbnailWidth / $thumbnailHeight;

        if ( $thumbnailRatio > $imageRatio ) {
            $thumbnailWidth = $thumbnailHeight * $imageRatio;
        }
        else {
            $thumbnailHeight = $thumbnailWidth / $imageRatio;
        }

        $gdThumbnail = imagecreatetruecolor( $thumbnailWidth, $thumbnailHeight );

        imagecopyresampled( $gdThumbnail, $gdImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $imageWidth, $imageHeight );
        imagejpeg( $gdThumbnail, $thumbnailPath, 90 );

        imagedestroy( $gdImage );
        imagedestroy( $gdThumbnail );

        return [
            'filename' =>   $thumbnailName,
            'filepath' =>   $thumbnailPath,
            'fileuri'  =>   $thumbnailUri
        ];
    }

    /**
     * @param   array $errors
     * @param   string $input_name
     * @param   string $upload_path
     * @param   string $upload_uri
     * @return  int|NULL
     */
    private function uploadImage(
        array &$errors,
        string $input_name,
        string $upload_path = APP_UPLOADS_DIR,
        string $upload_uri = '/uploads',
        ?array $thumbnails = [
            'thumbnail' =>  [ 200, 200 ],
            'full-hd'   =>  [ 1920, 1080 ]
        ]
    ) : ?int {
        // Überprüfen ob der Nutzer eine Datei mit geschickt hat
        if ( isset( $_FILES[ $input_name ] ) === NULL ) {

            return NULL;
        }
        var_dump( $_FILES[ $input_name ] );

        /** @var string $tempImageID */
        $tempImageID = $_FILES[ $input_name ][ 'name' ];
        /** @var string $tempImageFile */
        $tempImageFile = $_FILES[ $input_name ][ 'tmp_name' ];
        /** @var string $tempImageType */
        $tempImageType = $_FILES[ $input_name ][ 'type' ];
        /** @var array $tempImgArr */
        $tempImageArr = @explode( '.', $tempImageID );
        /** @var string $tempImageExt */
        $tempImageExt = '.' . $tempImageArr[ count( $tempImageArr ) - 1 ];

        // TODO: Validierung ob der Nutzer ein Bild hochgeladen hat
        // Ansonten Error bei getimagesize()

        list( $imageWidth, $imageHeight, $imageType ) = getimagesize( $tempImageFile );

        // Image Type Validieren
        /** @var bool $validateImageType */
        $validateImageType = $this->validateImageType( $errors, $imageType );
        /** @var string $imageType */
        $imageExt = $this->sanitizeFileExtension( $imageType );

        if ( $validateImageType === FALSE && $imageExt !== NULL ) {

            return NULL;
        }

        /** @var string $tempImageName */
        $tempImageName = str_replace( $tempImageExt, '', $tempImageID );
        /** @var string $imageName */
        $imageName = sprintf(
            '%1$s-%2$s-%3$s',
            $tempImageName,
            time(),
            rand(1234,9876)
        );
        // Date Coded Path, bspw: 2021/07/27
        /** @var string $dateCodedPath */
        $dateCodedPath = $this->createDateCodedPath();
        // Target Dir, bspw: /uploads/2021/07/27
        $targetDir = $upload_path . DIRECTORY_SEPARATOR . $dateCodedPath;

        $imagePath = $targetDir . DIRECTORY_SEPARATOR . $imageName . $imageExt;

        $imageUri = $upload_uri . DIRECTORY_SEPARATOR . $dateCodedPath . DIRECTORY_SEPARATOR . $imageName . $imageExt;

        // Ordner erstellen
        if ( $this->createFolder( $targetDir ) === FALSE ) {
            $errors[ 'image' ][] = 'Can\'t create Directory for file upload';
            return NULL;
        }
        // Datei verschieben
        if ( $this->moveFile( $tempImageFile, $imagePath ) === FALSE ) {
            $errors[ 'image' ][] = 'Can\'t move the file';
            return NULL;
        }

        $thumbs = [];

        if ( is_null( $thumbnails ) === FALSE ) {
            foreach( $thumbnails as $key => $thumbnail ) {
                $thumbnailName = $imageName . "-key";
                $thumbnailPath = $targetDir . DIRECTORY_SEPARATOR . $imageName . "-$key" . $imageExt;
                $thumbnailUri = $upload_uri . DIRECTORY_SEPARATOR . $dateCodedPath . DIRECTORY_SEPARATOR . $imageName . "-$key" . $imageExt;
                $thumbWidth = $thumbnail[ 0 ];
                $thumbHeight = $thumbnail[ 1 ];

                $thumbs[ $key ] = $this->createThumbnail( $imagePath, $thumbnailName, $thumbnailPath, $thumbnailUri, $thumbWidth, $thumbHeight );
            }
        }


        var_dump( $thumbs );


        return  $this->insertFile( $tempImageType, $imageName . $imageExt, $imagePath, $imageUri, $thumbs );
    }

}