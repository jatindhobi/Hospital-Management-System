<?php
session_start();
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../dbconnect/dbconnect.php");

  $doctor_email = $_POST['doctor_email'];
  $doctor_pass = $_POST['doctor_pass'];
  $_SESSION['logged_in'] = true;

  $sql = "Select * from doctor_tb where email='$doctor_email' AND password='$doctor_pass' ";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $login = true;
    $_SESSION['logged_in'] = true;
    $_SESSION['doctor_email'] = $doctor_email;
    header("location: /Hospital Management System/dashboard/admin/doctor_index.php");
  } else {
    $showError = "Doctor not Registered";
  }
}
if (isset($_SESSION['doctor_email']) && !empty($_SESSION['doctor_email'])) {
  header("location: /Hospital Management System/dashboard/admin/doctor_index.php");
}
?>

<head>
  <title>Doctor Login</title>
  <?php
  require("header.php");
  ?>
  <script src="../assets/style.js"></script>
</head>

<body class="id1">
  <div class="id2">
    <div class="id3">
      <?php
      if ($login) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
      }
      if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!<br></strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
      }
      ?>
      <h1>Doctor Login</h1>

      <form action="" method="post">
        <div class="id4">
          <input type="email" placeholder="Email" name="doctor_email" id="doctor_email" required>
        </div>
        <div class="id4">
          <input type="password" placeholder="Password" name="doctor_pass" id="pass" required>
          <i class="fa fa-lock"></i>
        </div>

        <button type="submit">Login</button>
      </form>

    </div><!-- End Login -->

  </div>

</body>

</html>