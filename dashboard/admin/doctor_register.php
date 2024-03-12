<?php
require('includes/doctor_navbar.php');
$delete = false;
include("../../dbconnect/dbconnect.php");

if (isset($_GET['deleteid'])) {
  $id = $_GET['deleteid'];
  $delete = true;
  $sql = "DELETE FROM `book_appointment_tb` WHERE book_id ='$id'";
  $result = mysqli_query($conn, $sql);
}
if ($delete) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your appointment has been deleted successfully!
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
  $symptomes = $_POST['symptomesEdit'];
  $date = $_POST['dateEdit'];
  $time = $_POST['timeEdit'];

  $sql = "UPDATE `book_appointment_tb` SET `name` = '$name', `email` = '$email',`phone` = '$phone',`symptomes` = '$symptomes',`date`= '$date',`time`='$time' WHERE `book_id` ='$id' ";
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
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Register | Doctor</title>
</head>

<body>
  <!-- Edit patient data-->

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="dialog" role="document">
            <div>
              <form action="" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="edit_id" id="edit_id" class="form-control">
                  <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="nameEdit" id="nameEdit" placeholder="Enter Name" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="emailEdit" id="emailEdit" placeholder="Enter your email" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" pattern="[0-9]{10}" name="phoneEdit" id="phoneEdit" placeholder="Enter your phone number" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Diagnosis</label>
                    <select class="form-control" name="symptomesEdit" id="symptomesEdit">
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
                    <label>Date</label>
                    <input type="date" name="dateEdit" id="dateEdit" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Time</label>
                    <input type="text" name="timeEdit" id="timeEdit" class="form-control" />
                  </div>


                </div>
                <div class="modal-footer">
                  <button type="button" class=" btn btn-secondary" data-dismiss="modal">Close</button>

                  <button type="submit" name="editbtn" class="btn btn-success btn-icon-split">Update</button>
                </div>
              </form>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Appointment List
          <a type="button" href="doctor_calender.php" class="btn btn-primary" style="color: white;">
            Add Appointment
          </a>
        </h6>
      </div>

      <table class="table" id="myTable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Sr no</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone no</th>
            <th scope="col">Symptomes</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM `book_appointment_tb`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = $result->fetch_assoc()) {
            $book_id = $row['book_id'];
            $sno = $sno + 1;
          ?>
            <tr>
              <th><?php echo $sno; ?></th>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['symptomes']; ?></td>
              <td><?php echo $row['date']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td>
                <button id="<?php echo $book_id; ?>" class="edit btn btn-sm btn-primary">Edit</button>
                <a class="btn btn-sm btn-danger" href="doctor_register.php?deleteid=<?php echo $book_id; ?>">Delete</a>
              </td>
            </tr>
          <?php } ?>

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
        symptomes = tr.getElementsByTagName("td")[3].innerText;
        date = tr.getElementsByTagName("td")[4].innerText;
        time = tr.getElementsByTagName("td")[5].innerText;
        console.log(name, phone, email, symptomes, date, time);
        nameEdit.value = name;
        emailEdit.value = email;
        phoneEdit.value = phone;
        symptomesEdit.value = symptomes;
        dateEdit.value = date;
        timeEdit.value = time;
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
          window.location = `/Hospital Management System/dashboard/admin/doctor_register.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        } else {
          console.log("no");
        }
      })
    })
  </script>
  <?php
  require('includes/scripts.php');
  require('includes/footer.php');
  ?>