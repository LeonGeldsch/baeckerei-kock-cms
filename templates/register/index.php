<form class="form" method="POST" enctype="multipart/form-data">
    <div class="form__row">
        <h1 class="form-heading">Register</h1>
    </div>
    <div class="standard-input">
        <input id="firstname" type="text" name="firstname" placeholder=" ">
        <label for="test">First name</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'firstname' ] ) ) {
                foreach ( $this->errors[ 'firstname' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="standard-input">
        <input id="lastname" type="text" name="lastname" placeholder=" ">
        <label for="test">Last name</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'lastname' ] ) ) {
                foreach ( $this->errors[ 'lastname' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
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
        	<input id="email" type="email" name="email" placeholder=" ">
        <label for="test">Email</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'email' ] ) ) {
                foreach ( $this->errors[ 'email' ] as $error_message ) {
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
    <div class="standard-input">
        <input id="password_repeat" type="password" name="password_repeat" placeholder=" ">
        <label for="test">Repeat password</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'password_repeat' ] ) ) {
                foreach ( $this->errors[ 'password_repeat' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="standard-input">
        <input id="phoneNumber" type="text" name="phoneNumber" placeholder=" ">
        <label for="test">Phone number</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'phoneNumber' ] ) ) {
                foreach ( $this->errors[ 'phoneNumber' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="standard-input">
        <input id="mobileNumber" type="text" name="mobileNumber" placeholder=" ">
        <label for="mobileNumber">Mobile number</label>
        <span class="underline"></span>
        <?php
            if ( isset( $this->errors ) && isset( $this->errors[ 'mobileNumber' ] ) ) {
                foreach ( $this->errors[ 'mobileNumber' ] as $error_message ) {
                    echo "<p class=\"form__error\">{$error_message}</p>";
                }
            }
        ?>
    </div>
    <div class="form-buttons">
        <a href="/login" class="form-button">Login</a>
        <input id="submit" class="form-submit-button form-button" type="submit" name="register_user" value="Register">
    </div>
</form>