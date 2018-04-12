<div class="login-signup-container">
    <h5 class="title">Register</h5>
<form method="POST">
    <div class="form-group">
        <label>Username</label><br>
        <input type="text" class="inputValue" name="username" placeHolder="Username" required>
    </div>
    <div class="form-group">
        <label>Email</label><br>
        <input type="text" class="inputValue" name="email" placeHolder="Email" required>
    </div>
    <div class="form-group">
        <label>Password</label><br>
        <input type="password" class="inputValue" name="password" placeHolder="Password" required>
    </div>
<input type="submit" class="btn btn-primary" value="Sign Up"/>
</form>
<a href="index.php?admin=login" class="message"><span>Already have an account? </span>Login</a>
<?php

$mvc = new MvcController();
$mvc->signupUserController();

?>