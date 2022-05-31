<?php 
$db = mysqli_connect("localhost","root","","akmar.org");

if(!$db){
    die("Error Connecting to Server".mysqli_errno());
}

?>