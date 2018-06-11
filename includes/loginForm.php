<div class="login-form">
    <h2>Login</h2>
    <hr/>
    <small class="form-text text-muted font-italic">Login to an existing account</small>
    <hr/>
    <form method="post">
        <div class="form-group">
            <label for="login-emailUsername">Username or email</label>
            <input
                   name="usernameEmail"
                   type="text"
                   class="form-control form-control-sm"
                   id="login-emailUsername"
                   placeholder="Enter your username or email">
        </div>

        <div class="form-group">
            <label for="login-password">Password</label>
            <input
                   name="password"
                   type="password"
                   class="form-control form-control-sm"
                   id="login-password"
                   placeholder="Enter password">
        </div>

        <div class="custom-control custom-checkbox">
            <input
                   name="login-keepLogin"
                   type="checkbox"
                   class="custom-control-input"
                   id="customCheck1">
          <label class="custom-control-label" for="customCheck1">Keep me logged in</label>
        </div>
        <br />
        <input type="hidden" name="action" value="loginUser">
        <div style="text-align:right">New user? <a href="?userAction=register">Register</a> &nbsp; <button type="submit" class="btn btn-primary">Login</button></div>
    </form>
</div>
