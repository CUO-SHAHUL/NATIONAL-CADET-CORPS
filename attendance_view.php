<?php
include "db.php";

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Total Classes Kept (distinct attendance dates up to selected date)
$days_query = "
    SELECT COUNT(DISTINCT date) AS total_days 
    FROM attendance 
    WHERE date <= '$date'
";
$days_result = mysqli_query($conn, $days_query);
$days_row = mysqli_fetch_assoc($days_result);
$total_days = $days_row['total_days'];
?>

<h2 style="font-size:30px; font-weight:bold; text-align:center;">
    View Attendance
</h2>

<form method="get" style="text-align:center; margin-bottom:20px;">
    <label style="font-size:20px; font-weight:bold;">Select Date:</label>
    <input type="date" name="date" value="<?= $date ?>" required
        style="padding:5px; font-size:15px;">
    <button type="submit"
        style="padding:6px 15px; background:indigo; color:white; border:none; border-radius:5px;">
        View
    </button>
</form>

<table border="1" width="75%" align="center" cellpadding="10"
    style="font-size:20px; text-align:center; border-collapse:collapse;">

<tr style="background: lightblue">
    <th>Student Name</th>
    <th>Status (<?= $date ?>)</th>
    <th>Total Attended</th> <!-- NEW -->
    <th>Attendance %</th>
</tr>

<?php
$query = "
    SELECT students.id, students.student_name, attendance.status
    FROM students
    LEFT JOIN attendance 
    ON students.id = attendance.student_id 
    AND attendance.date = '$date'
";

$result = mysqli_query($conn, $query);

$total_present = 0;
$total_absent = 0;
$total_students = 0;

while ($row = mysqli_fetch_assoc($result)) {

    $total_students++;

    $student_id = $row['id'];
    $status = $row['status'] ? $row['status'] : "Not Marked";

    // Total Present Days per student
    $present_query = "
        SELECT COUNT(*) AS present_count 
        FROM attendance 
        WHERE student_id = '$student_id' 
        AND status = 'Present'
    ";
    $present_result = mysqli_query($conn, $present_query);
    $present_row = mysqli_fetch_assoc($present_result);
    $student_present = $present_row['present_count'];

    // Attendance Percentage
    $student_percentage = 0;
    if ($total_days > 0) {
        $student_percentage = ($student_present / $total_days) * 100;
    }

    $color = "black";

    if ($status == "Present") {
        $color = "rgb(2, 248, 55)";
        $total_present++;
    }

    if ($status == "Absent") {
        $color = "rgb(233, 20, 20)";
        $total_absent++;
    }
?>

<tr>
    <td><?= $row['student_name'] ?></td>

    <td style="color:<?= $color ?>; font-weight:bolder; font-size:25px;">
        <?= $status ?>
    </td>

    <td>
        <?= $student_present ?> <!-- SHOW TOTAL ATTENDED -->
    </td>

    <td>
        <?= number_format($student_percentage, 2) ?>%
    </td>
</tr>

<?php } ?>

</table>

<br>

<?php
$attendance_percentage = 0;
if ($total_students > 0) {
    $attendance_percentage = ($total_present / $total_students) * 100;
}
?>

<div style="text-align:center; font-size:22px; font-weight:bold;">
    <p>Total Classes Kept: <?= $total_days ?></p>
    <p style="color:rgb(2, 248, 55);">Total Present: <?= $total_present ?></p>
    <p style="color:rgb(233, 20, 20);">Total Absent: <?= $total_absent ?></p>
    <p>Today's Attendance: <?= number_format($attendance_percentage, 2) ?>%</p>
</div>

<br><br>

<div style="text-align:center;">
    <a href="homepage.php"
        style="padding:8px 20px; background:crimson; color:white; 
        text-decoration:none; border-radius:5px;">
        Back
    </a>
</div>