<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php title() ?></title>

        <?php $this->embedStylesheets(); ?>

        <style>
            .navigation__anchor--active {
                color: green;
            }
            .navigation__anchor--inactive {
                color: red;
            }
        </style>
    </head>
    <body>

        <header class="header">
            <div class="wrapper">

                <div class="header-top-row">
                    <div class="top-links">
                        <?php navigation_link( '/contact', 'Contact', 'header-secondary-link' ) ?>
                        <?php navigation_link( '/imprint', 'Imprint', 'header-secondary-link' ) ?>
                        <?php navigation_link( '/offers', 'Offers', 'header-secondary-link' ) ?>
                        <?php navigation_link( '/career', 'Career', 'header-secondary-link' ) ?>
                        <!--
                        <a class="header-secondary-link" href="">Contact</a>
                        <a class="header-secondary-link" href="">Imprint</a>
                        <a class="header-secondary-link" href="">Offers</a>
                        <a class="header-secondary-link" href="">Career</a>
                        -->
                    </div>
                    <a href="/">
                        <img src="/assets/img/kock_logo.jpg" alt="Kock logo" class="header-logo">
                    </a>
                    <div class="top-links top-right-links">
                        <a class="header-link" href="/">
                            <img src="/assets/img/heart.svg" alt="">
                        </a>
                        <a class="header-link" href="/user">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="<?php topLink( 'user' ) ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </a>
                        <div class="header-link" id="header-cart-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="<?php topLink( 'cart' ) ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>                            <span class="header-cart-amount <?php cartAmountActive() ?>"><?php cartAmount() ?></span>
                        </div>
                        <div class="header-cart">
                        </div>
                    </div>
                </div>
                <div class="header-divider"></div>
                <div class="header-bottom-row">
                    <?php navigation_link( '/products/buns', 'Buns', 'header-primary-link' ) ?>
                    <?php navigation_link( '/products/bread', 'Bread', 'header-primary-link' ) ?>
                    <?php navigation_link( '/products/cake', 'Cake', 'header-primary-link' ) ?>
                    <?php navigation_link( '/products', 'All categories', 'header-primary-link' ) ?>
                    <!--
                    <a class="header-primary-link" href="/products/buns">Buns</a>
                    <a class="header-primary-link" href="/products/bread">Bread</a>
                    <a class="header-primary-link" href="/products/cake">Cake</a>
                    <a class="header-primary-link" href="/products">All categories</a>
                    -->
                </div>

            </div>
        </header>

        <div class="cart-modal-wrapper">
            <div class="cart-modal">
                <h3>Cart</h3>
                <img class="cart-modal-close-button" src="/assets/img/x.svg"></img>
                <div class="cart-items">
                    <?php cart() ?>
                </div>
                <a href="/cart"><button>Go to checkout</button></a>
            </div>
        </div>

        <main class="content">
            <div class="content-wrapper">