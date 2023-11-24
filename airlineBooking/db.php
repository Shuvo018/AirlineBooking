<?php

$conn = mysqli_connect("localhost", "root", "", "airlinedb");
if($conn){
    // echo "Database connected";
}else{
    echo "Database connection failed";
}

?>