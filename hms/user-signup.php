  <?php
  $signup = false;
  $showError = false;
  $showexistError = false;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../dbconnect/dbconnect.php");
    $email = $_POST['email'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];

    $query = "SELECT email FROM patient_tb WHERE email= '$email'";
    $fire = mysqli_query($conn, $query);

    if (mysqli_num_rows($fire) > 0) {
      $showexistError = true;
    } else {
      $sql = "INSERT INTO `patient_tb` (`email`,`name`,`address`, `password`) VALUES ('$email','$name','$address', '$pass')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        $signup = true;
        header("location: /Hospital Management System/hms/users-login.php");
      } else {
        $showError = true;
      }
    }
  }

  ?>

  <head>
    <title>User's Signup</title>
    <?php
    require("header.php");
    ?>
    <script src="../assets/style.js"></script>
  </head>

  <body class="id1">
    <div class="id2">
      <div class="id3">
        <?php
        if ($signup) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong><br> Your entry has been submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
        }
        if ($showError) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
        }
        if ($showexistError) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!<br></strong>Username Already Exists!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
        }
        ?>
        <h1>Patient Signup</h1>

        <form action="user-signup.php" method="post">
          <div class="id4">
            <input type="email" placeholder="Email" name="email" id="email" required>
          </div>
          <div class="id4">
            <input type="text" placeholder="Name" name="name" id="name" required>
          </div>
          <div class="id4">
            <input type="text" placeholder="Address" name="address" id="address" required>
          </div>
          <div class="id4">
            <input type="password" placeholder="Password" name="pass" id="pass" required>
            <i class="fa fa-lock"></i>
          </div>

          <button type="submit">Signup</button>
        </form>
        <div style="text-align: center;">
          <p style="color:black" class="mb-0">Already have an account? <a href="users-login.php" class="text-white-50 fw-bold">Login</a></p>
        </div>
      </div><!-- End Login -->

    </div>

  </body>

  </html>