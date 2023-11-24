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
    <h1>This is flight details page</h1>
    <div class="container d-flex justify-content-center ">
        <form action="add_flight_details.php" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label for="form-label">from loc</label>
                    <!-- <input type="text" class="form-control" name="from_loc" placeholder="from_loc :"> -->
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="from_loc">
                        <option selected>From loc</option>
                        <option value="chattogram">Chattogram</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="sylhet">Sylhet</option>
                    </select>
                </div>
                <div class="col">
                    <label for="form-label">to loc</label>
                    <!-- <input type="text" class="form-control" name="to_loc" placeholder="to_loc:"> -->
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="to_loc">
                        <option selected>To loc</option>
                        <option value="chattogram">Chattogram</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="sylhet">Sylhet</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="time" class="form-control" name="departure_time" placeholder="departure_time:">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="departure_date" placeholder="departure_date:">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="hour" class="form-control" name="duration" placeholder="duration:">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="available_seats" placeholder="available seats:">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" name="price" placeholder="price:">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="flight_id" placeholder="flight_id:">
                </div>
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
if (isset($_POST['submit'])) {
    $from_loc = $_POST['from_loc'];
    $to_loc = $_POST['to_loc'];
    $departure_time = $_POST['departure_time'];
    $departure_date = $_POST['departure_date'];
    $duration = $_POST['duration'];
    $available_seats = $_POST['available_seats'];
    $price = $_POST['price'];
    $flight_id = $_POST['flight_id'];
    if (
        empty($from_loc) || empty($to_loc) || empty($departure_time) ||
        empty($departure_date) || empty($duration) || empty($available_seats) ||
        empty($price) || empty($flight_id)
    ) {
        echo "<div class='alert alert-danger'>All fields are required</div>";

    } else {

        $sql = "INSERT INTO flight_details(from_loc, to_loc, departure_time, departure_date, duration, available_seats, price, flight_id) 
        VALUES ('$from_loc', '$to_loc', '$departure_time', '$departure_date', '$duration', '$available_seats', '$price', '$flight_id')";
        if(mysqli_query($conn, $sql)){
            echo "<div class='alert alert-success'>new flight add successfully</div>";
        }else{
            die("Something went wrong");
        }
    }
}


?>