<?php
include("includes/user_navbar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include("../../dbconnect/dbconnect.php");
  $review = $_POST['review'];
  $reviewer_name = $_POST['name'];

  $sql = "INSERT INTO `testimonial_tb` (`review`, `reviewer_name`) VALUES ('$review', '$reviewer_name')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your review has been submitted successfully!
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


<head>
  <title>Testimonial | User</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
        </div>
        <form action="user_testimonial.php" method="POST">

          <div class="modal-body">

            <div class="form-group">
              <label> Name </label>
              <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Review</label>
              <textarea rows="10" cols="50" type="address" name="review" id="symptomes" placeholder="Write Review" class="form-control" required></textarea>
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