<?php require("header.php"); ?>

<head>
    <title>Contact Us</title>
</head>

<body>
    <section class="section-services">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include("../dbconnect/dbconnect.php");
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $sql = "INSERT INTO `contact-us_tb` (`fullname`, `email`,`message`) VALUES ('$fullname', '$email', '$message')";
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
        } ?>
        <div class="contact_us_container">
            <div class="row justify-content-center text-center">
                <div class="col-md-10 col-lg-8">
                    <div class="header-section">
                        <h2 class="title">Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="cont_us">
        <section class="contact_us_section">
            <div class="section-header">
                <div class="contact_us_container">
                    <p class="contact_p">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>

            <div class="contact_us_container">
                <div class="contact_row">

                    <div class="contact-info">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-home"></i>
                            </div>

                            <div class="contact-info-content">
                                <h4 class="contact_h4">Address</h4>
                                <p class="contact_p">4671 Sugar Camp Road,<br /> Owatonna, Minnesota, <br />55060</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone"></i>
                            </div>

                            <div class="contact-info-content">
                                <h4 class="contact_h4">Phone</h4>
                                <p class="contact_p">571-457-2321</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div class="contact-info-content">
                                <h4 class="contact_h4">Email</h4>
                                <p class="contact_p">ntamerrwael@mfano.ga</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form action="contact_us.php" id="contact-form" method="POST">
                            <h2 class="contact_h2">Send Message</h2>
                            <div class="input-box">
                                <input class="contact_us_input" type="text" required="true" name="fullname" placeholder="Fullname">
                            </div>

                            <div class="input-box">
                                <input class="contact_us_input" type="email" required="true" name="email" placeholder="Email">
                            </div>

                            <div class="input-box">
                                <textarea class="textarea" required="true" name="message" placeholder="Message"></textarea>
                            </div>

                            <div class="input-box">
                                <input type="submit" value="Send" name="">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <?php require("footer.php"); ?>