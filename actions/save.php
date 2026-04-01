<?php
require_once '../config/database.php';
require_once '../controllers/UserController.php';
require_once '../helpers/bmi.php';

$db = (new Database())->connect();
$controller = new UserController($db);

$data = [
    'fullname' => $_POST['fullname'],
    'sex' => $_POST['sex'],
    'weight' => $_POST['weight'],
    'height' => $_POST['height'],
    'age' => $_POST['age']
];

$controller->store($data);

$bmi = calculateBMI($_POST['weight'], $_POST['height']);
$status = getBMIStatus($bmi);

echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "<link rel='stylesheet' href='../assets/css/style.css'>";

echo "<div class='container mt-5'>";
echo "<div class='card p-4 shadow'>";
echo "<h4>BMI Result</h4>";

echo "<div class='bmi-box'>";
echo "<p><strong>BMI:</strong> " . number_format($bmi, 2) . "</p>";
echo "<p><strong>Recommendation:</strong> " . $status . "</p>";
echo "</div>";

echo "<a href='../views/dashboard.php' class='btn btn-primary mt-3'>Go Back</a>";

echo "</div></div>";
?>