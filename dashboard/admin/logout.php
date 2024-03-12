<?php
session_start();

session_unset();
session_destroy();

header("location: /Hospital Management System/hms/user-login.php ");
exit;
