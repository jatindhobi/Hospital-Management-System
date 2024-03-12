<?php
session_start();
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../dbconnect/dbconnect.php");

  $user_email = $_POST['user_email'];
  $user_pass = $_POST['user_pass'];

  $sql = "Select * from patient_tb where email='$user_email' AND password='$user_pass'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $login = true;
    $_SESSION['logged_in'] = true;
    $_SESSION['user_email'] = $user_email;
    header("location: /Hospital Management System/dashboard/admin/user_index.php");
  } else {
    $showError = "User not Registered";
  }
}

if (isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])) {
  header("location: /Hospital Management System/dashboard/admin/user_index.php");
}
?>

<head>
  <title>User's Login</title>
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
      <h1>Patient Login</h1>

      <form action="" method="post">
        <div class="id4">
          <input type="email" placeholder="Email" name="user_email" id="user_email" required>
        </div>
        <div class="id4">
          <input type="password" placeholder="Password" name="user_pass" id="user_pass" required>
          <i class="fa fa-lock"></i>
        </div>
        <button type="submit">Login</button>
      </form>
      <div style="text-align: center;">
        <p style="color:black" class="mb-0">Don't have an account? <a href="user-signup.php" class="text-white-50 fw-bold">Sign Up</a>
        </p>
      </div>
    </div><!-- End Login -->

  </div>
</body>

</html>