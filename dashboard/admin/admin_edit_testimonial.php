<?php
require('includes/admin_navbar.php');
?>

<?php
$delete = false;
include("../../dbconnect/dbconnect.php");

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `testimonial_tb` WHERE `sno` = $sno";
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
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Testimonial | Admin</title>
</head>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Testimonial</h6>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr no</th>
                    <th scope="col">Review</th>
                    <th scope="col">Reviewer Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `testimonial_tb`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                            <th scope='row'>" . $sno . "</th>
                            <td>" . $row['review'] . "</td>
                            <td>" . $row['reviewer_name'] . "</td>
                            <td><button class='delete btn btn-sm btn-danger' id=d" . $row['sno'] . ">Delete</button></td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

</div>
<script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            sno = e.target.id.substr(1);

            if (confirm("Are you sure you want to delete this note!")) {
                console.log("yes");
                window.location = `/Hospital Management System/dashboard/admin/admin_edit_testimonial.php?delete=${sno}`;
                // TODO: Create a form and use post request to submit a form
            } else {
                console.log("no");
            }
        })
    })
</script>
</body>
<?php
require('includes/scripts.php');
require('includes/footer.php');
?>