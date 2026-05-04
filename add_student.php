<?php
include "db.php";

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$query = "
    SELECT students.student_name, attendance.status
    FROM students
    LEFT JOIN attendance 
        ON student.id = attendance.student_id 
        AND attendance.attendance_date = '$date'
";

$result = mysqli_query($conn, $query);
?>

<h2 style="font-size:30px; font-weight:bold;">View Attendance</h2>

<form method="get">
    <input type="date" name="date" value="<?= $date ?>" required>
    <button type="submit">View</button>
</form>

<br><br>

<table border="1" cellpadding="10" style="font-size:20px;">
<tr>
    <th>Student Name</th>
    <th>Status</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['student_name'] ?></td>
    <td>
        <?= $row['status'] ? $row['status'] : "Not Marked" ?>
    </td>
</tr>
<?php } ?>

</table>
