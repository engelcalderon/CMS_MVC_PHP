<div class="login-signup-container">
    <h5 class="title">Login</h5>
<form method="POST">
    <div class="form-group">
        <label>Username</label><br>
        <input type="text" class="inputValue" name="username" placeHolder="Username" required>
    </div>
    <div class="form-group">
        <label>Password</label><br>
        <input type="password" class="inputValue" name="password" placeHolder="Password" required>
    </div>
<input type="submit" class="btn btn-primary" value="Login"/>
</form>
<a href="index.php?admin=signup" class="message"><span>Don't have an account? </span>Sign Up</a>
<?php

$mvc = new MvcController();
$mvc->userLoginController();

?>

</div>