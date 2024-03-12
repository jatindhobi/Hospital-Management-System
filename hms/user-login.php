<?php require("header.php"); ?>

<head>
    <title>User Login</title>
</head>

<body>
    <div class="card-category-1">
        <div class="basic-card basic-card-light">
            <div class="card-content">
                <span class="card-title">Patient Login</span>
            </div>

            <div class="card-link">
                <a href="user-signup.php"><span>SignUp</span></a>&emsp;&emsp;
                <a href="users-login.php"><span>Login</span></a>
            </div>
        </div>

        <div class="basic-card basic-card-light">
            <div class="card-content">
                <span class="card-title">Doctor Login</span>
            </div>
            <div class="card-link">
                <a href="doctor-login.php"><span>Login</span></a>
            </div>
        </div>

        <div class="basic-card basic-card-light">
            <div class="card-content">
                <span class="card-title">Admin Login</span>
            </div>

            <div class="card-link">
                <a href="admin-login.php"><span>Login</span></a>
            </div>
        </div>

    </div>
    <?php
    require("footer.php");
    ?>