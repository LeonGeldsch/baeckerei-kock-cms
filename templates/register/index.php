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
                <label for="firstname" class="form__label">Firstname*</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'firstname' ] ) ) {
                        foreach ( $this->errors[ 'firstname' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="firstname" class="form__input form__input--text" type="text" name="firstname">
            </div>
            <div class="form__row">
                <label for="lastname" class="form__label">Lastname*</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'lastname' ] ) ) {
                        foreach ( $this->errors[ 'lastname' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="lastname" class="form__input form__input--text" type="text" name="lastname">
            </div>
            <div class="form__row">
                <label for="username" class="form__label">Username*</label>
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
                <label for="email" class="form__label">E-Mail*</label>
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
                <label for="password" class="form__label">Password*</label>
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
                <label for="password_repeat" class="form__label">Repeat Password*</label>
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
                <label for="phoneNumber" class="form__label">Phone number</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'phoneNumber' ] ) ) {
                        foreach ( $this->errors[ 'phoneNumber' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="phoneNumber" class="form__input form__input--password" type="text" name="phoneNumber">
            </div>
            <div class="form__row">
                <label for="mobileNumber" class="form__label">Mobile number</label>
                <?php
                    if ( isset( $this->errors ) && isset( $this->errors[ 'mobileNumber' ] ) ) {
                        foreach ( $this->errors[ 'mobileNumber' ] as $error_message ) {
                            echo "<p class=\"form__error\">{$error_message}</p>";
                        }
                    }
                ?>
                <input id="mobileNumber" class="form__input form__input--password" type="text" name="mobileNumber">
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