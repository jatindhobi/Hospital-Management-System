<?php
require('includes/admin_navbar.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include("../../dbconnect/dbconnect.php");

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $category = $_POST['category'];
  $pass = $_POST['pass'];
  $confirmpass = $_POST['confirmpassword'];


  if ($pass === $confirmpass) {
    $query = "SELECT email FROM doctor_tb WHERE email= '$email'";
    $fire = mysqli_query($conn, $query);

    if (mysqli_num_rows($fire) > 0) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Email Already Exists :( Try Different Email!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
    } else {
      $sql = "INSERT INTO `doctor_tb` (`name`,`email`,`phone`,`category`, `password`) VALUES ('$name','$email','$phone','$category', '$pass')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Password and Confirm Password Does not Match
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>';
  }
}

?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Add Doctor | Admin</title>
</head>

<div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
      </div>
      <form action="add_doctor.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
            <label> Name </label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email" required>
            <small class="error_email" style="color: red;"></small>
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" pattern="[0-9]{10}" name="phone" id="phone" placeholder="Enter Phone Number" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category">
              <option>--Select--</option>
              <option value="General Physician">General Physician</option>
              <option value="Bone">Bone</option>
              <option value="Heart">Heart</option>
              <option value="Dentist">Dentist</option>
              <option value="Neurologist">Neurologist</option>
              <option value="Kidney">Kidney</option>
              <option value="Cardiologist">Cardiologist</option>
              <option value="Plastic Surgeon">Plastic Surgeon</option>
            </select>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="registerbtn" class="btn btn-success formbold-btn">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<?php
require('includes/scripts.php');
require('includes/footer.php');
?>