<?php
include_once "config/core.php";

$page_title = "signin";
include_once "layout/header.php";
$require_login = false;
include_once "login_checker.php";


$message = "";
$message_type = "";

if ($_POST) {

    include_once "config/database.php";
    include_once "objects/user.php";
    
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $user->email_address = $_POST['email_address'];

    if ($user->emailExists()) {

        // check password
        if (password_verify($_POST['password'], $user->password)) {

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['access_level'] = $user->access_level;
            $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8');
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['access_level'] = $user->access_level;

            if ($user->access_level == 'Admin') {
                header("Location: {$home_url}admin/index.php?action=login_success");
            } else {
                header("Location: {$home_url}user/client/index.php?action=login_success");
            }

        } else {
            $message = "Invalid password!";
            $message_type = "error";
        }

    } else {
        $message = "Email does not exist!";
        $message_type = "error";
    }
}


?>

<div class="login-container">

    <div class="login-card">

        <!-- TITLE -->
        <div class="text-center mb-4">
            <i class="bi bi-heart-pulse"></i>
            <h3 class="logo">Fit<span>Life</span></h3>
            <small class="text-muted">Fitness Tracking System</small>
            <hr style="border-color: #222;">
        </div>

        <!-- FORM -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <!-- EMAIL -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email_address" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <!-- LOGIN BUTTON -->
            <button type="submit" class="btn btn-login w-100 mt-2">
                Login
            </button>

        </form>

        <!-- FOOTER -->
        <div class="text-center mt-3">
            <small class="text-muted">
                Don’t have an account? 
                <a href="signup.php">Sign Up</a>
            </small>
        </div>

    </div>

</div>

<?php include_once "layout/footer.php"; ?>