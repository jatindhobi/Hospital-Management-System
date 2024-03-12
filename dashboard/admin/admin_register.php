<?php
require('includes/admin_navbar.php');
include("../../dbconnect/dbconnect.php");

$delete = false;

if (isset($_GET['delete'])) {
  $doctor_id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `doctor_tb` WHERE `doctor_id` = '$doctor_id'";
  $result = mysqli_query($conn, $sql);
}

if ($delete) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your entry has been deleted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
}

if (isset($_POST['edit_id'])) {
  $id = $_POST['edit_id'];
  $name = $_POST['nameEdit'];
  $email = $_POST['emailEdit'];
  $phone = $_POST['phoneEdit'];
  $category = $_POST['categoryEdit'];
  $pass = $_POST['passEdit'];
  $confirmpass = $_POST['confirmpasswordEdit'];

  if ($pass == $confirmpass) {
    $sql = "UPDATE `doctor_tb` SET doctor_id='$id',`name`='$name' , email='$email',`phone`='$phone',category='$category', `password`='$pass' WHERE doctor_id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your entry has been updated successfully!
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
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Username Or Password and Confirm Password Does not Match
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['registerbtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $pass = $_POST['pass'];
    $confirmpass = $_POST['confirmpassword'];

    $query = "SELECT email FROM doctor_tb WHERE email= '$email'";
    $fire = mysqli_query($conn, $query);

    if (mysqli_num_rows($fire) > 0) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Username Already Exists :( Try Different Username!
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
  }
}
?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Register | Admin</title>
</head>

<div class="modal fade" id="adddoctorprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="dialog" role="document">
          <div>
            <form action="admin_register.php" method="POST">

              <div class="modal-body">

                <div class="form-group">
                  <label> Name </label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="tel" pattern="[0-9]{10}" name="phone" id="phone" placeholder="Enter Phone Number" class="form-control" required />
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="category" id="category">
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
                  <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="registerbtn" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Doctor Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin_register.php" method="POST">

        <div class="modal-body">
          <input type="hidden" name="edit_id" id="edit_id" class="form-control">
          <div class="form-group">
            <label> Name </label>
            <input type="text" name="nameEdit" id="nameEdit" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="emailEdit" id="emailEdit" class="form-control" placeholder="Enter Email" required>
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" pattern="[0-9]{10}" name="phoneEdit" id="phoneEdit" placeholder="Enter Phone Number" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="categoryEdit" id="categoryEdit">
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
            <input type="password" name="passEdit" id="passEdit" class="form-control" placeholder="Enter Password" required>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpasswordEdit" class="form-control" placeholder="Confirm Password" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editbtn" class="btn btn-success">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Doctor List
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddoctorprofile">
          Add Doctor
        </button>
      </h6>
    </div>

    <table class="table" id="myTable">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Sr no</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Category</th>
          <th scope="col">Password</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `doctor_tb`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['category'] . "</td>
            <td>" . $row['password'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . $row['doctor_id'] . ">Edit</button>
             <button class='delete btn btn-sm btn-danger' id=d" . $row['doctor_id'] . ">Delete</button>  </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</div>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();

  });
</script>
<script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ");
      tr = e.target.parentNode.parentNode;
      name = tr.getElementsByTagName("td")[0].innerText;
      email = tr.getElementsByTagName("td")[1].innerText;
      phone = tr.getElementsByTagName("td")[2].innerText;
      category = tr.getElementsByTagName("td")[3].innerText;
      password = tr.getElementsByTagName("td")[4].innerText;
      console.log(name, email, phone, category, password);
      nameEdit.value = name;
      emailEdit.value = email;
      phoneEdit.value = phone;
      categoryEdit.value = category;
      passEdit.value = password;
      edit_id.value = e.target.id;
      console.log(e.target.id)
      $('#editModal').modal('toggle');
    })
  })

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ");
      sno = e.target.id.substr(1);

      if (confirm("Are you sure you want to delete this note!")) {
        console.log("yes");
        window.location = `/Hospital Management System/dashboard/admin/admin_register.php?delete=${sno}`;
        // TODO: Create a form and use post request to submit a form
      } else {
        console.log("no");
      }
    })
  })
</script>
</body>

</html>

<!-- /.container-fluid -->

<?php
require('includes/scripts.php');
require('includes/footer.php');
?>