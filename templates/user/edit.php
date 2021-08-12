<h1>Edit</h1>
<form class="form" method="POST">
    <h2>Username</h2>
    <div class="form__row">
        <label for="username" class="form__label">Username</label>
        <?php display_form_errors( 'username' ); ?>
        <input id="username" class="form__input form__input--text" type="username" name="username">
    </div>
    <div class="form__row">
        <input id="update_username" class="form__input form__input--submit" type="submit" name="update_username" value="Update Username">
    </div>
</form>
<form class="form" method="POST">
    <h2>E-Mail Address</h2>
    <div class="form__row">
        <label for="email" class="form__label">E-Mail Address</label>
        <?php display_form_errors( 'email' ); ?>
        <input id="email" class="form__input form__input--text" type="email" name="email">
    </div>
    <div class="form__row">
        <input id="update_email" class="form__input form__input--submit" type="submit" name="update_email" value="Update E-Mail">
    </div>
</form>
<form class="form" method="POST">
    <h2>Password</h2>
    <div class="form__row">
        <label for="password" class="form__label">Actual Password</label>
        <?php display_form_errors( 'old_password' ); ?>
        <input id="password" class="form__input form__input--password" type="password" name="password">
    </div>
    <div class="form__row">
        <label for="new_password" class="form__label">New Password</label>
        <?php display_form_errors( 'password' ); ?>
        <input id="new_password" class="form__input form__input--password" type="password" name="new_password">
    </div>
    <div class="form__row">
        <label for="new_password_repeat" class="form__label">Repeat new Password</label>
        <?php display_form_errors( 'password_repeat' ); ?>
        <input id="new_password_repeat" class="form__input form__input--password" type="password" name="new_password_repeat">
    </div>
    <div class="form__row">
        <input id="update_password" class="form__input form__input--submit" type="submit" name="update_password" value="Update Password">
    </div>
</form>
<form class="form" method="POST">
    <h2>Delete Account</h2>
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
        <input id="delete_user" class="form__input form__input--submit" type="submit" name="delete_user" value="Delete User">
    </div>
</form>