<?php
session_start();
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../dbconnect/dbconnect.php");

  $admin_email = $_POST['admin_email'];
  $admin_pass = $_POST['admin_pass'];
  $_SESSION['logged_in'] = true;

  $sql = "Select * from admin_tb where email='$admin_email' AND password='$admin_pass' ";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $login = true;
    $_SESSION['logged_in'] = true;
    $_SESSION['admin_email'] = $admin_email;
    header("location: /Hospital Management System/dashboard/admin/admin_index.php");
  } else {
    $showError = "Admin not Registered";
  }
}
if (isset($_SESSION['admin_email']) && !empty($_SESSION['admin_email'])) {
  header("location: /Hospital Management System/dashboard/admin/admin_index.php");
}
?>

<head>
  <title>Admin Login</title>
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
      <h1>Admin Login</h1>

      <form action="" method="post">
        <div class="id4">
          <input type="email" placeholder="Email" name="admin_email" id="admin_email" required>
        </div>

        <div class="id4">
          <input type="password" placeholder="Password" name="admin_pass" id="pass" required>
          <i class="fa fa-lock"></i>
        </div>

        <button type="submit">Login</button>
      </form>

    </div><!-- End Login -->

  </div>

</body>

</html>