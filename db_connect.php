<?php
$servername = "localhost";
$username = "root";
$password = "";
$bd_name = "image_crud";

$connect = mysqli_connect($servername, $username, $password, $bd_name);

if(mysqli_connect_error()):
    echo "Error!".mysqli_connect_error();
endif;
