<?php include 'layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card p-4 shadow">
            <h4 class="text-center mb-3">Login</h4>

            <form method="POST" action="../actions/login.php">
                <input class="form-control mb-3" name="username" placeholder="Username" required>
                <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>