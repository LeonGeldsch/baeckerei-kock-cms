<?php

namespace WBD0321\Controller;

use WBD0321\Controller as AbstractController;
use WBD0321\Controller\Interfaces\IndexController;
use WBD0321\Session;
use WBD0321\View\Script;
use WBD0321\View\Stylesheet;
use WBD0321\Model\Products as ProductsModel;



final class Products extends AbstractController implements IndexController {

    private ?ProductsModel $ProductsModel = NULL;

    public function __construct() {
        parent::__construct();

        $this->ProductsModel = new ProductsModel();
    }


    public function index() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;

        $this->View->categories =  $this->ProductsModel->getAllProductCategories();

        $this->View->addStylesheet( new Stylesheet( 'product', '/assets/css/categories.css' ) ); 

        $this->View->title = 'Products';

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'products/index' );
        $this->View->getTemplatePart( 'footer' );
    }


    public function buns() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;
        
        $this->View->title = 'Buns';

        $this->View->addStylesheet( new Stylesheet( 'product', '/assets/css/product.css' ) ); 

        $this->View->products = $this->ProductsModel->getProductsByCategory( 'buns' );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'products/product' );
        $this->View->getTemplatePart( 'footer' );
    }

    public function bread() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;
        
        $this->View->title = 'Bread';

        $this->View->addStylesheet( new Stylesheet( 'product', '/assets/css/product.css' ) ); 

        $this->View->products = $this->ProductsModel->getProductsByCategory( 'bread' );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'products/product' );
        $this->View->getTemplatePart( 'footer' );
    }

    public function cake() : void {
        /** @var array $errors */
        $errors = [];

        $this->View->errors = $errors;
        
        $this->View->title = 'Cake';

        $this->View->addStylesheet( new Stylesheet( 'product', '/assets/css/product.css' ) ); 

        $this->View->products = $this->ProductsModel->getProductsByCategory( 'cake' );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'products/product' );
        $this->View->getTemplatePart( 'footer' );
    }

}