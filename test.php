<?php
$weeks = [
    ["week" => "Week 1", "progress" => 90],
    ["week" => "Week 2", "progress" => 60],
    ["week" => "Week 3", "progress" => 40],
    ["week" => "Week 4", "progress" => 20],
];

$currentProgress = $weeks[count($weeks)-1]['progress'];
?>

<!DOCTYPE html>
<html>
<head>
<title>FitLife Progress UI</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* 🔥 Circular Progress */
.circle {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    background: conic-gradient(#198754 <?php echo $currentProgress; ?>%, #e9ecef 0%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin: auto;
}

/* 🔥 Week cards */
.week-card {
    border-radius: 15px;
    padding: 15px;
    color: white;
    text-align: center;
    font-weight: 600;
}

.good { background: #198754; }
.mid { background: #ffc107; color: black; }
.bad { background: #dc3545; }
</style>

</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow rounded-4 text-center">
        <h3 class="fw-bold mb-4">🔥 Your Fitness Progress</h3>

        <!-- 🔵 CIRCLE -->
        <div class="circle mb-4">
            <?php echo $currentProgress; ?>%
        </div>

        <!-- 📅 WEEKLY CARDS -->
        <div class="row g-3">
            <?php foreach ($weeks as $w): 
                $class = "bad";
                if ($w['progress'] >= 70) $class = "good";
                elseif ($w['progress'] >= 40) $class = "mid";
            ?>
            <div class="col-md-3">
                <div class="week-card <?php echo $class; ?>">
                    <div><?php echo $w['week']; ?></div>
                    <div style="font-size: 22px;"><?php echo $w['progress']; ?>%</div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>

</body>
</html>