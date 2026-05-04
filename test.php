<?php
$conn=new mysqli("localhost","root","","test",3307);
if($conn->connect_error){
    die("failed:".$conn->connect_error);
}
else "connected successfully";
?>