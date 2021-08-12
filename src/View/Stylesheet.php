<?php

namespace WBD0321\View;

class Stylesheet extends Script {

    public function embed() : void {
//        if ( $this->sourceExists() === FALSE ) {
//            trigger_error(
//                sprintf(
//                    'Stylesheet (%s) doesn\'t exist',
//                    $this->src
//                ),
//                E_USER_WARNING
//            );
//        }

        printf(
            '<link id="%1$s" href="%2$s?%3$s">',
            $this->id,
            $this->src,
            $this->version
        );
    }

}