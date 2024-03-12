<?php
include("includes/doctor_navbar.php");

function build_calender($month, $year)
{
    include("../../dbconnect/dbconnect.php");

    // $stmt = $conn->prepare('select * from book_appointment_tb where MONTH(date) = ? AND YEAR(date) = ?');
    // $stmt->bind_param('ss', $month, $year);
    // $bookings = array();
    // if ($stmt->execute()) {
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $bookings[] = $row['date'];
    //         }
    //         $stmt->close();
    //     }
    // }

    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $daysOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
    $calendar = "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-primary' href='?month=" . $prev_month . "&year=" . $prev_year . "'>Prev Month</a>";
    $calendar .= " <a class='btn btn-primary' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a>";
    $calendar .= " <a class='btn btn-primary' href='?month=" . $next_month . "&year=" . $next_year . "'>Next Month</a></center>";
    $calendar .= "<br><table class='table table-bordered'>";

    $calendar .= "<tr>";
    $calendar .= "<th class='header'>Sunday</th>";
    $calendar .= "<th class='header'>Monday</th>";
    $calendar .= "<th class='header'>Tuesday</th>";
    $calendar .= "<th class='header'>Wednesday</th>";
    $calendar .= "<th class='header'>Thursday</th>";
    $calendar .= "<th class='header'>Friday</th>";
    $calendar .= "<th class='header'>Saturday</th>";


    $calendar .= "</tr><tr>";

    $currentDay = 1;
    if ($daysOfWeek > 0) {
        for ($k = 0; $k < $daysOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) {
        if ($daysOfWeek == 7) {
            $daysOfWeek = 0;
            $calendar .= "<tr></tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayName = strtolower(date('l', strtotime($date)));
        $today = $date == date('Y-m-d') ? 'today' : "";

        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4><a class='btn btn-danger btn-xs'>N/A</a></td>";
        } else {
            $calendar .= "<td class='$today'><h4>$currentDay</h4><a href='add_patient.php?date=" . $date . "' class='btn btn-success btn-xs'>Book</a></td>";
        }

        $currentDay++;
        $daysOfWeek++;
    }
    if ($daysOfWeek < 7) {
        $remainingDays = 7 - $daysOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr></table>";

    return $calendar;
}




?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Appointment</title>
    <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            .empty {
                display: none;
            }


            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:nth-of-type(1):before {
                content: "Sunday";
            }

            td:nth-of-type(2):before {
                content: "Monday";
            }

            td:nth-of-type(3):before {
                content: "Tuesday";
            }

            td:nth-of-type(4):before {
                content: "Wednesday";
            }

            td:nth-of-type(5):before {
                content: "Thursday";
            }

            td:nth-of-type(6):before {
                content: "Friday";
            }

            td:nth-of-type(7):before {
                content: "Saturday";
            }
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {

            body {

                padding: 0;

                margin: 0;
            }

        }

        /* iPads (portrait and landscape)*/

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {

                width: 495px;
            }

        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }

            td {
                width: 33%;
            }
        }

        .row {
            margin-top: 20px;
        }

        .today {
            background: yellow;
        }
    </style>
</head>

<body>
    <div class="container" style="width: 1000px;">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                echo build_calender($month, $year);
                ?>
            </div>
        </div>
    </div>

    <?php
    require('includes/scripts.php');
    require('includes/footer.php');
    ?>
</body>

</html>