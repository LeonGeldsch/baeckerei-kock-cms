<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;
use WBD0321\View\Script;
use WBD0321\View\Stylesheet;

final class Home extends AbstractController implements IndexController {

    public function __construct() {
        parent::__construct();
    }

    public function index() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;

        $this->View->title = 'Home';

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'home/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}