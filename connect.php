<?php
$con=new mysqli("localhost","root","","login",3307);
if($con->connect_error){
    echo "Failed to connect DB".$con->connect_error;
}
?>