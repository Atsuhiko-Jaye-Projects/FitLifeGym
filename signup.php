<?php

$page_title = "Signup";
include_once "layout_head.php";
?>

<form>
    <h1>Create Account</h1>
    <p>Sign up to get started with your account</p>

    <label for="fullname">Full Name</label>
    <input type="text" name="fullname" id="fullname" placeholder="Your Name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="you@example.com" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter password" required>

    <label for="confirm-password">Confirm Password</label>
    <input type="password" name="confirm-password" id="confirm-password" placeholder="Re-enter password" required>

    <button type="submit">Sign Up</button>

    <div class="divider">or</div>

    <button type="button" class="social-btn">Sign up with Google</button>
    <button type="button" class="social-btn">Sign up with Facebook</button>

    <div class="login-link">
        Already have an account? <a href="#">Sign In</a>
    </div>
    
</form>
<?php include_once "layout_foot.php"; ?>