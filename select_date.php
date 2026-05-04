<form action="mark_attendance.php" method="get">
    <label style="font-size:30px; font-weight:bolder; color:darkblue">Select Date:</label>
    <input type="date" name="date" style="color: inherit;width: 15%;height:10%; background-color: transparent;border: none;border-bottom: 3px solid white;padding-left: 1.5rem;font-size: 15px;" required>
    <button type="submit" style="font-size: 1.1rem;padding: 8px 0;border-radius: 5px;outline: none;border: none;width: 10%;background-color: indigo;color: white;cursor: pointer;transition: 0.9s;">Mark Attendance</button>
</form>
<?php
include "save_attendance.php";
?>