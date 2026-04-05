<?php
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/user.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$page_title = "signup";
include_once "layout/header.php";

$require_login = false;
include_once "login_checker.php";

$message = "";
$message_type = "";

if ($_POST) {

    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->contact_no = $_POST['contact_no'];
    $user->email_address = $_POST['email_address'];
    $user->password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($user->password != $confirm_password) {
        $message = "Passwords do not match!";
        $message_type = "error";
    }else if($user->EmailAlreadyTaken()) {
        $message = "Email is already taken";
        $message_type = "error";
    
    }else if($user->ContactAlreadyTaken()) {
        $message = "Contact no. is already taken";
        $message_type = "error";
    }else{
        $user->createUser();
        $message = "Registration successful!";
        $message_type = "success";
    }
}




?>
<div class="login-container">
    
    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-heart-pulse"></i>
            <h3 class="logo">Fit<span>Life</span><span> Gym</span></h3>
            <small class="text-muted">Create your account</small>
            <hr style="border-color: #222;">
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="firstname" class="form-control" placeholder="Enter your first name" required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="lastname" class="form-control" placeholder="Enter your last name" required />
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-phone"></i>
                    </span>
                    <input type="tel" name="contact_no" class="form-control" placeholder="Enter your contact no" maxlength="12" pattern="[0-9]{1,12}" required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email_address" class="form-control" placeholder="Enter your email" required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Create a password" required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required />
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100 mt-2">Sign Up</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">
                Already have an account?
                <a href="signin.php">Sign In</a>
            </small>
        </div>
    </div>
</div>


<?php include_once "layout/footer.php"; ?>