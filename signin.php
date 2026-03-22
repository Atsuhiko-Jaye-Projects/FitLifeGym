<?php 
include_once "layout_head.php";
?>

<!-- all contents will be here -->
<form> 
    <h1>Sign in to your Account</h1>
    <p>Enter your Email and Password to log in</p>

    <label for="email">Email</label><br>
    <input type="text" name="email" id="email" required>

    <label for="password">Password</label><br>
    <input type="password" name="password" id="password" required><br>

    <a>Forgot password?</a><br>
    <span>No Account yet? </span><a href="signup.php"><strong>HERE</strong></a><br>
    
    <button>Log in</button><br>

    <p>or</p>

    <div>
        <h4>Continue with Facebook</h4>
        <h4>Continue with Facebook</h4>
    </div>
</form>


<?php include_once "layout_foot.php"; ?>
