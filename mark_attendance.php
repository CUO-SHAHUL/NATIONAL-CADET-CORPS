<?php
include "db.php";
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$students = mysqli_query($conn, "SELECT * FROM students");
?>

<h2 style="font-size:30px; font-weight:bold;">Attendance for <?= $date ?></h2>

<form method="post" action="save_attendance.php">
<input type="hidden" name="date" value="<?= $date ?>">

<table style="font-size:30px; font-weight:bold; ">
<tr>
    <th style="padding-left:300px;padding-right:90px;">Name</th>
    <th>Status</th>
</tr>

<?php while ($s = mysqli_fetch_assoc($students)) { ?>
<tr>
    <td><?= $s['student_name'] ?></td>
    <td>
        <input type="radio" name="status[<?= $s['id'] ?>]" value="Present" required> Present
        <input type="radio" name="status[<?= $s['id'] ?>]" value="Absent"> Absent
    </td>
</tr>
<?php } ?>

</table>

<button type="submit" style="font-size: 1.1rem;padding: 8px 0;border-radius: 5px;outline: none;border: none;width: 100%;background-color: indigo;color: white;cursor: pointer;transition: 0.9s;">Save Attendance</button>
</form>
