<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="form__row">
                <h1>Register</h1>
            </div>
            <div class="form__row">
                <label for="avatar" class="form__label">Avatar</label>
                <img id="avatar__placeholder" width="200" height="200">
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'image' ] ) ) {
                        foreach ( $this->errors[ 'image' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="avatar" class="form__input form__input--file" type="file" name="avatar">
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
                <label for="email" class="form__label">E-Mail</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'email' ] ) ) {
                        foreach ( $this->errors[ 'email' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="email" class="form__input form__input--email" type="email" name="email">
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
                <label for="password_repeat" class="form__label">Repeat Password</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'password_repeat' ] ) ) {
                        foreach ( $this->errors[ 'password_repeat' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="password_repeat" class="form__input form__input--password" type="password" name="password_repeat">
            </div>
            <div class="form__row">
                <input id="submit" class="form__input form__input--submit" type="submit" name="register_user" value="Register">
                <a href="/login">Login</a>
            </div>
        </form>

        <script>
            (function(){
                var avatar = document.getElementById( 'avatar' ),
                    placeholder = document.getElementById( 'avatar__placeholder' );

                avatar.addEventListener( 'change', function( event ) {
                    var target = event.target,
                        files = target.files,
                        fileReader = new FileReader();

                    fileReader.onload = function() {
                        placeholder.src = fileReader.result;
                    }

                    fileReader.readAsDataURL( files[0] );
                } );
            })();
        </script>

    </body>
</html>