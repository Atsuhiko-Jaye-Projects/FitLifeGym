<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo $home_url; ?>assets/css/style.css">
    <title>FitLife</title>
    <?php 
    
    if (strtolower($page_title) === "workout plans") {
        echo "<link rel='stylesheet' href='{$home_url}/assets/css/workplans.css'>";
    }
    ?>
</head>
<body>

<div class="container-fluid">
<div class="row">
    <?php include_once "sidebar.php";?>