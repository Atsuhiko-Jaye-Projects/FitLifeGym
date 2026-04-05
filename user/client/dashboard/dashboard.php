<?php 
include_once "../../../config/core.php";
$page_title = "Dashboard";
include_once '../layout/header.php'; 
?>


<div class="col-md-9 col-lg-10 p-4">
    <div class="hero mb-4 text-white">
        <h1>Welcome Back <?php echo $_SESSION['firstname']; ?>! </h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>
    <div class="row g-3">
        <!-- LEFT (Tall Box) -->
        <div class="col-md-6">
            <div class="box h-100"></div>
        </div>

        <!-- RIGHT (2 stacked boxes) -->
        <div class="col-md-6 d-flex flex-column">
            <div class="box flex-fill mb-3"></div>
            <div class="box flex-fill"></div>
        </div>
    </div>

</div>

<?php include '../layout/footer.php'; ?>