<?php
    include "C:/xampp/htdocs/airlineBooking/db.php";
    include("admin_navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<h1>This is adding flight page</h1>
<div class="container">
        <form action="add_flight.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="airline_id" placeholder="airline id :">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="airline_name" placeholder="airline name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="total_seats" placeholder="total seats:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="submit" name="submit">
                <input type="submit" class="btn btn-danger" value="cancel" name="submit">
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $airline_id = $_POST['airline_id'];
        $airline_name = $_POST['airline_name'];
        $total_seats = $_POST['total_seats'];
        $errors = array();
        if(empty($airline_id) || empty($airline_name) || empty($total_seats)){
            array_push($errors, "All fields are required");
        }
        if(count($errors)>0){
            foreach($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
            
            $sql = "INSERT INTO flight(airline_id, airline_name, total_seats) VALUES ('$airline_id','$airline_name', '$total_seats')";
            if(mysqli_query($conn, $sql)){
                echo "<div class='alert alert-success'>new flight add successfully</div>";
            }else{
                die("Something went wrong");
            }
        }
        
    }

?>