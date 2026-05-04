<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST['date'];

    if (isset($_POST['status'])) {

        foreach ($_POST['status'] as $student_id => $status) {
            $check = mysqli_query($conn, 
                "SELECT * FROM attendance 
                 WHERE student_id = '$student_id' 
                 AND date = '$date'"
            );

            if (mysqli_num_rows($check) > 0) {

                mysqli_query($conn, 
                    "UPDATE attendances
                     SET status = '$status' 
                     WHERE student_id = '$student_id' 
                     AND date = '$date'"
                );

            } else {

                mysqli_query($conn, 
                    "INSERT INTO attendance (student_id, date, status) 
                     VALUES ('$student_id', '$date', '$status')"
                );
            }
        }

        echo "<h3 style='color:green;'>Attendance Saved Successfully!</h3>";
        echo "<a href='homepage.php'>Go Back</a>";
    }
}
?>
