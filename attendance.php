<?php
include "db.php";
if (isset($_POST['add'])) {
    $name = $_POST['student_name'];
    mysqli_query($conn, "INSERT INTO students (student_name) VALUES ('$name')");
    }
?>

<form method="post" >
    <input type="text" name="student_name" placeholder="Student Name" style="color: inherit;width: 15%;height:10%; background-color: transparent;border: none;border-bottom: 3px solid white;padding-left: 1.5rem;font-size: 15px;" required>
    <button name="add" style="font-size: 1.1rem;padding: 8px 0;border-radius: 5px;outline: none;border: none;width: 10%;background-color: indigo;color: white;cursor: pointer;transition: 0.9s;">Add Student</button>
</form>
<?php
include "db.php";

if (isset($_POST['delete'])) {
    $name = $_POST['student_name'];
    mysqli_query($conn, "DELETE FROM students WHERE student_name = '$name'");
}
?>

<form method="post">
    <input type="text" name="student_name" placeholder="Student Name"
        style="color: inherit;width: 15%;height:10%; background-color: transparent;
        border: none;border-bottom: 3px solid white;padding-left: 1.5rem;font-size: 15px;"
        required>

    <button name="delete"
        style="font-size: 1.1rem;padding: 8px 0;border-radius: 5px;
        outline: none;border: none;width: 10%;
        background-color: crimson;color: white;cursor: pointer;transition: 0.9s;">
        Remove Student
    </button>
</form>
<h3 style="font-size:30px; font-weight:bolder; color:black; padding-left:300px">Students</h3>
<ol style="font-size:30px; font-weight:bolder; color:white; padding-left:300px">
<?php
$res = mysqli_query($conn, "SELECT * FROM students");
while ($row = mysqli_fetch_assoc($res)) {
    echo "<li>{$row['student_name']}</li>";
}
?>
</ol>
<?php
include "db.php";
include "select_date.php";
?>