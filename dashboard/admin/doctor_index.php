<?php
include("includes/doctor_navbar.php");
require('../../dbconnect/dbconnect.php');
?>

<head>
  <title>Home | Doctor </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <div class="container-fluid">
        <div class="row">

          <!-- Total Registered Doctor -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      <h5>Total Registered Doctor</h5>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <h4>
                        <?php
                        $sql = "Select doctor_id from doctor_tb";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        echo $num;
                        ?>

                      </h4>
                    </div>
                  </div>
                  <div class="col-auto">
                    <img src="../../assets/images/doctor.png">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Registered Patient -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      <h5>Total Registered Patient</h5>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <h4>
                        <?php
                        $sql = "Select patient_id from patient_tb";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        echo $num;
                        ?>

                      </h4>
                    </div>
                  </div>
                  <div class="col-auto">
                    <img src="../../assets/images/patient.png">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Appointment -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      <h5>Total Appointment</h5>
                    </div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                          <h4>
                            <?php
                            $sql = "Select book_id from book_appointment_tb";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                            ?>
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <img src="../../assets/images/appointment.png">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--  -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                  </div>
                  <div class="col-auto">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</body>

<?php
require('includes/scripts.php');
require('includes/footer.php');
?>