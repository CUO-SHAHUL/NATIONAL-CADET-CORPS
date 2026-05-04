<?php
$conn = mysqli_connect("localhost", "root", "", "login",3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<html>
    <body style="background: lightblue;">
</body>
</html>
