<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form class="form" method="POST">
            <div class="form__row">
                <h1>Reset Password</h1>
            </div>
            <div class="form__row">
                <label for="email" class="form__label">Email</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'email' ] ) ) {
                        foreach ( $this->errors[ 'email' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="email" class="form__input form__input--text" type="email" name="email">
            </div>
            <div class="form__row">
                <input id="submit" class="form__input form__input--submit" type="submit" name="reset_password" value="Reset Password">
                <a href="/login">Login</a>
            </div>
        </form>
    </body>
</html>