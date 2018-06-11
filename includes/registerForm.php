<div class="register-inline-form">
    <h2>Register</h2>
    <hr/>
    <small id="emailHelp" class="form-text text-muted font-italic">Register a new user</small>
    <hr/>
    <form method="POST">

        <div class="row">
            <div class="col">
                <label for="register-username">Username</label>
                <input
                       class="form-control form-control-sm"
                       id="register-username"
                       type="text"
                       name="username"
                       placeholder="Enter a username"
                       value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['username']; } } ?>">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="register-email">Email</label>
                <input
                       class="form-control form-control-sm form-control form-control-sm-sm"
                       id="register-email"
                       type="email"
                       name="email"
                       placeholder="Enter email"
                       value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['email']; } } ?>">
            </div>

            <div class="col">
                <label for="register-confirmEmail">Confirm email</label>
                <input
                       class="form-control form-control-sm"
                       id="register-confirmEmail"
                       type="email"
                       name="confirmEmail"
                       placeholder="Repeat email"
                       value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['confirmEmail']; } } ?>">

            </div>
        </div>



        <div class="col">
            <div class="row">
                <label for="register-firstName">First name</label>
                <input
                       class="form-control form-control-sm"
                       id="register-firstName"
                       type="text"
                       name="firstName"
                       placeholder="Enter your first name"
                       value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['firstName']; } } ?>">
            </div>

            <div class="row">
                <label for="register-lastName">Last name</label>
                <input
                       class="form-control form-control-sm"
                       id="register-lastName"
                       type="text"
                       name="lastName"
                       placeholder="Last name"
                       value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['lastName']; } } ?>">
            </div>

        </div>

        <div class="row">
            <div class="col">
                <label for="register-password">Password</label>
                <input
                       class="form-control form-control-sm"
                       id="register-password"
                       type="password"
                       name="password"
                       placeholder="Enter a password">
            </div>

            <div class="col">
                <label for="register-confirmPassword">Confirm password</label>
                <input
                       class="form-control form-control-sm"
                       id="register-confirmPassword"
                       type="password"
                       name="confirmPassword"
                       placeholder="Repeat password">
            </div>
        </div>
        <input
               type="hidden"
               name="action"
               value="registerUser">
        <button type="submit" class="btn btn-primary">Register</button>

    </form>
</div>
