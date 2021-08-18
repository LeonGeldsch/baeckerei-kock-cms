<form class="form" method="POST">
    <div class="form__row">
        <h1>Login</h1>
        <?php
            switch( $_GET[ 'status' ] ?? NULL ) {
                case 'required':
                    echo "<h2>Login to get full access!</h2>";
                    break;
                case 'logout':
                    echo "<h2>See you later!</h2>";
                break;
                case 'register':
                    echo "<h2>Succesfully registered</h2>";
                    break;
                default:
                    echo "<h2>Login and have fun!</h2>";
            }
        ?>
    </div>
    <div class="form__row">
        <label for="username" class="form__label">Username</label>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'username' ] ) ) {
                foreach ( $this->errors[ 'username' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
        <input id="username" class="form__input form__input--text" type="text" name="username">
    </div>
    <div class="form__row">
        <label for="password" class="form__label">Password</label>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'password' ] ) ) {
                foreach ( $this->errors[ 'password' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
        <input id="password" class="form__input form__input--password" type="password" name="password">
    </div>
    <div class="form__row">
        <input id="submit" class="form__input form__input--submit" type="submit" name="login_user" value="Login">
        <a href="/register">Register</a>
    </div>
</form>