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

        <header id="masthead">
            <div id="masthead__inner" class="wrapper">

                <h1>Bakery</h1>

                <nav id="masthead__navigation" class="navigation">
                    <ul class="navigation__list">
                    <li class="navigation__list-item">
                            <?php navigation_link( '/', 'Home' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/products/buns', 'Buns' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/products/bread', 'Bread' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/products/cake', 'Cake' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/products/', 'All categories' );  ?>
                        </li>
                        <?php displayLoginNav() ?>
                    </ul>
                </nav><!-- /#masthead__navigation -->
                <?php cart() ?>

            </div><!-- /#masthead__inner -->
        </header><!-- /#masthead -->

        <main id="content">
            <div id="content__inner">