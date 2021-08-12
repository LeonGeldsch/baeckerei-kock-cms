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

                <form id="masthead__search-form" action="/search" method="GET">
                    <input type="text" name="keyword">
                    <input type="submit" value="Suchen">
                </form>

                <nav id="masthead__navigation" class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__list-item">
                            <?php navigation_link( '/feed', 'Feed' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/user', 'User' );  ?>
                        </li>
                        <li class="navigation__list-item">
                            <?php navigation_link( '/logout', 'Logout' );  ?>
                        </li>
                    </ul>
                </nav><!-- /#masthead__navigation -->

            </div><!-- /#masthead__inner -->
        </header><!-- /#masthead -->

        <main id="content">
            <div id="content__inner">