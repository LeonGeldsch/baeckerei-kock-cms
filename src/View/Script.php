<?php

namespace WBD0321\View;

class Script {

    public string $id;

    protected string $src;

    protected string $version;

    public function __construct( string $id, string $src, string $version = '0.1.0' ) {
        $this->id = $id;
        $this->src = $src;
        $this->version = $version;
    }

    protected function sourceExists() : bool {

        return file_exists( $this->src );
    }

    public function embed() : void {
//        if ( $this->sourceExists() === FALSE ) {
//            trigger_error(
//                sprintf(
//                    'Script (%s) doesn\'t exist',
//                    $this->src
//                ),
//                E_USER_WARNING
//            );
//        }

        printf(
            '<script id="%1$s" src="%2$s?%3$s"></script>' . "\n",
            $this->id,
            $this->src,
            $this->version
        );
    }

}