<form class="form" method="POST">
    <div class="form__row">
        <h1 class="form-heading">Login</h1>
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
                case 'insufficient_permission':
                    echo "<h2>No permission to access this area</h2>";
                    break;
                    default:
                    echo "<h2>Login and have fun!</h2>";
            }
        ?>
    </div>
    <div class="standard-input">
        <input id="username" type="text" name="username" placeholder=" ">
        <label for="test">Username</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'username' ] ) ) {
                foreach ( $this->errors[ 'username' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="standard-input">
        <input id="password" type="password" name="password" placeholder=" ">
        <label for="test">Password</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'password' ] ) ) {
                foreach ( $this->errors[ 'password' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="form-buttons">
        <a href="/register" class="form-button">Register</a>
        <input id="submit" class="form-submit-button form-button" type="submit" name="login_user" value="Login">
    </div>
</form>