<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FitLife Gym - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* GLOBAL TEXT */
        body, label, p, h1, h2, h3, h4, h5, h6, span, small {
            color: #fff !important;
        }

        /* BACKGROUND */
        body {
            background: radial-gradient(circle at top, #1a1f2b, #0f1115);
        }

        /* CENTER LAYOUT */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* GLOW EFFECT */
        .login-container::before {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(13,110,253,0.25), transparent 70%);
            filter: blur(80px);
            z-index: 0;
        }

        /* CARD */
        .login-card {
            position: relative;
            z-index: 1;

            width: 100%;
            max-width: 400px;
            padding: 35px;
            border-radius: 16px;

            background: rgba(24, 28, 34, 0.85);
            backdrop-filter: blur(10px);

            border: 1px solid rgba(255,255,255,0.05);

            box-shadow:
                0 10px 30px rgba(0,0,0,0.6),
                0 0 0 1px rgba(255,255,255,0.02) inset;
        }

        /* LOGO */
        .logo {
            font-weight: 600;
            letter-spacing: 1px;
        }

        .logo span {
            color: #0d6efd;
        }

        /* INPUT GROUP */
        .input-group-text {
            background: #0f141a !important;
            border: 1px solid #222 !important;
            color: #fff !important;
        }

        /* INPUTS */
        .form-control {
            background: #0f141a;
            border: 1px solid #222;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
        }

        .form-control:focus {
            background: #0f141a;
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px rgba(13,110,253,0.25);
            color: #fff;
        }

        /* PLACEHOLDER */
        ::placeholder {
            color: #aaa !important;
            opacity: 1;
        }

        /* BUTTON */
        .btn-login {
            background: linear-gradient(135deg, #0d6efd, #3a8bff);
            border: none;
            padding: 12px;
            font-weight: 500;
            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(13,110,253,0.3);
            transition: 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13,110,253,0.5);
        }

        /* LINKS */
        a {
            color: #0d6efd;
        }

        a:hover {
            color: #66b2ff;
        }

        /* MUTED FIX */
        .text-muted {
            color: #aaa !important;
        }

    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <!-- TITLE -->
        <div class="text-center mb-4">
            <h3 class="logo">Fit<span>Life</span></h3>
            <small class="text-muted">Fitness Tracking System</small>
            <hr style="border-color: #222;">
        </div>

        <!-- FORM -->
        <form action="login_process.php" method="POST">

            <!-- EMAIL -->
            <div class="mb-3">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label>Password</label>
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

</body>
</html>