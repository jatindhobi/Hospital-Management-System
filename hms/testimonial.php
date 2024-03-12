<head>
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <div class="testi">
    <div class="main">
      <div class="testimonials">
        <input type="radio" name="testimonial" id="input-testimonial1" checked>
        <input type="radio" name="testimonial" id="input-testimonial2">
        <input type="radio" name="testimonial" id="input-testimonial3">
        <input type="radio" name="testimonial" id="input-testimonial4">
        <input type="radio" name="testimonial" id="input-testimonial5">
        <div class="testimonials-inner">
          <?php
          include("../dbconnect/dbconnect.php");

          $sql = "SELECT * FROM `testimonial_tb` ORDER BY `sno` DESC LIMIT 5 ";
          $result = mysqli_query($conn, $sql);
          while ($rows = $result->fetch_assoc()) {
          ?>
            <div class="testimonial">
              <div class="testimonial-text">
                <p><?php echo $rows['review']; ?></p>
              </div>
              <div class="testimonial-author"><?php echo $rows['reviewer_name']; ?></div>
            </div>
          <?php } ?>
        </div>
        <div class="testimonials-arrows">
          <div class="arrow arrow-left">
            <label for="input-testimonial1"></label>
            <label for="input-testimonial2"></label>
            <label for="input-testimonial3"></label>
            <label for="input-testimonial4"></label>
            <label for="input-testimonial5"></label>
            <span></span>
          </div>
          <div class="arrow arrow-right">
            <label for="input-testimonial1"></label>
            <label for="input-testimonial2"></label>
            <label for="input-testimonial3"></label>
            <label for="input-testimonial4"></label>
            <label for="input-testimonial5"></label>
            <span></span>
          </div>
        </div>
        <div class="testimonials-bullets">
          <label for="input-testimonial1">
            <div class="bullet">
              <div>
                <span></span>
              </div>
            </div>
          </label>
          <label for="input-testimonial2">
            <div class="bullet">
              <div>
                <span></span>
              </div>
            </div>
          </label>
          <label for="input-testimonial3">
            <div class="bullet">
              <div>
                <span></span>
              </div>
            </div>
          </label>
          <label for="input-testimonial4">
            <div class="bullet">
              <div>
                <span></span>
              </div>
            </div>
          </label>
          <label for="input-testimonial5">
            <div class="bullet">
              <div>
                <span></span>
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
  </div>