<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>FitLife Gym</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
        // SET THIS PER PAGE
        // example: $page_title = "signin"; OR "index";
    ?>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Dynamic CSS -->
    <?php
        if ($page_title == 'signin' || $page_title=="Signup") {
            echo "<link href='assets/css/signin.css' rel='stylesheet'>";
        } elseif ($page_title == 'index') {
            echo "<link href='assets/css/index.css' rel='stylesheet'>";
        }
    ?>
</head>
<body>