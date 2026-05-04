<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale">
        
    </head>
    <body style="background: lightblue;">
        <div style="text-align:center;padding:15%">
        <img src="ncc logo.jpg" height=150px width=150px>
        <img src="new logo.jpg" height=175px width=175px>
            <p style="font-size:50px;padding-left:2%;font-weight:bold;">
                <a href="attendance.php">ATTENDANCE</a>
                <a href="attendance_view.php">ATTENDANCE VIEW</a>
                <a href="detail.php">CADET INFO</a>
            </p>
            <p style="font-size:25px;font-weight:bold;">
            <a href="logout.php">LOGOUT</a>
        </p>
        </div>
    </body>
</html>