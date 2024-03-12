<?php
include("includes/admin_navbar.php");
require('../../dbconnect/dbconnect.php');
$sql = "SELECT * FROM `admin_tb` WHERE `email`='$admin_email' ";
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $name = $row['name'];
    $phone = $row['phone'];
?>

    <head>
        <title>Profile | Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <div id="popup1" class="overlay" style="color: black;">
        <div class="popup">
            <center>
                <h2></h2>
                <div class="content">
                    Health Care Web App<br>
                </div>
                <div style="display: flex;justify-content: center;">
                    <table width="80%">
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 700;">View Details.</p><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Name: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <?php echo $name  ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Email: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <?php echo $email  ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Phone: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <?php echo $phone  ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="admin_index.php"><input type="button" value="OK" class="btn btn-primary"></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
            <br><br>
        </div>
    </div>
<?php } ?>

<?php
require('includes/scripts.php');
?>