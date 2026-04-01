<?php include 'layout/header.php'; ?>

<div class="card p-4 shadow">
    <h4 class="mb-3">Add Personal Info</h4>

    <form method="POST" action="../actions/save.php">
        <div class="row">
            <div class="col-md-6">
                <input class="form-control mb-3" name="fullname" placeholder="Full Name" required>
            </div>

            <div class="col-md-6">
                <select class="form-select mb-3" name="sex">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="col-md-4">
                <input class="form-control mb-3" type="number" name="weight" placeholder="Weight (kg)" required>
            </div>

            <div class="col-md-4">
                <input class="form-control mb-3" type="number" name="height" placeholder="Height (cm)" required>
            </div>

            <div class="col-md-4">
                <input class="form-control mb-3" type="number" name="age" placeholder="Age" required>
            </div>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php include 'layout/footer.php'; ?>