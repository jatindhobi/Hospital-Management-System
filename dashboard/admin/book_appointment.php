<?php
include("includes/user_navbar.php");
include("../../dbconnect/dbconnect.php");


if (isset($_GET['date'])) {
  $date = $_GET['date'];
  $stmt = $conn->prepare("select * from book_appointment_tb where date = ?");
  $stmt->bind_param('s', $date);
  $bookings = array();
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bookings[] = $row['time'];
      }
      $stmt->close();
    }
  }
}

$duration = 20;
$cleanup = 0;
$start = "9:00";
$end = "21:00";

function timeslots($duration, $cleanup, $start, $end)
{

  $start = new DateTime($start);
  $end = new DateTime($end);
  $interval = new DateInterval("PT" . $duration . "M");
  $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
  $slots = array();
  for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
    $endPeriod = clone $intStart;
    $endPeriod->add($interval);

    if ($endPeriod > $end) {
      break;
    }
    $slots[] = $intStart->format("H:iA") . " - " . $endPeriod->format("H:iA");
  }

  return $slots;
}



if (isset($_POST['registerbtn'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $symptomes = $_POST['symptomes'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $bookings[] = $time;

  $stmt = $conn->prepare("select * from book_appointment_tb where date = ? AND time = ?");
  $stmt->bind_param('ss', $date, $time);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      if ($result) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry!</strong> Already Booked!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    </div>';
      }
    } else {
      if ($email == $user_email) {

        $sql = "INSERT INTO `book_appointment_tb` (`name`, `email`,`phone`,`symptomes`,`date`,`time`) VALUES ('$name', '$email', '$phone', '$symptomes', '$date', '$time')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your Appointment has been booked successfully!
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
        <strong>Success!</strong> Your Username Does not match Please Enter Correct Username !
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
  <title>Book Appointment | User</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="" rel="stylesheet">

</head>



<div class="container">

  <h1 class="text-center"> Book for Date : <?php echo date('d/m/Y', strtotime($date)); ?></h1>
  <hr>
  <div class="row">
    <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
    foreach ($timeslots as $ts) {
    ?>
      <div class="col-md-2">
        <div class="form-group">
          <?php if (in_array($ts, $bookings)) { ?>
            <button class="btn btn-danger"><?php echo $ts; ?></button>
          <?php } else { ?>
            <button class="btn btn-success booking" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>

</div>
<div class="modal fade" id="bookappointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Book Appointment</span></h5>
      </div>
      <form action="" method="POST">

        <div class="modal-body">
          <div class="form-group">
            <label> Name </label>
            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo $user_email ?>" id="email" placeholder="Enter your email" class="form-control" required readonly />
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" pattern="[0-9]{10}" name="phone" id="phone" placeholder="Enter your phone number" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Diagnosis</label>
            <select class="form-control" name="symptomes">
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
            <input type="date" name="date" id="date" value="<?php echo $date; ?>" class="form-control" required readonly />
          </div>
          <div class="form-group">
            <label>Time</label>
            <input type="text" name="time" id="time" class="form-control" required readonly />
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="registerbtn" class="btn btn-success formbold-btn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384- Tc5lQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA712mCWNlpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  $(".booking").click(function() {
    var timeslot = $(this).attr('data-timeslot');
    $("#time").val(timeslot);
    $("#bookappointment").modal("show");
  })
</script>
</body>

</html>
<?php
require('includes/scripts.php');
require('includes/footer.php');
?>