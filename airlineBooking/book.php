<?php
include("header.php");
session_start();

$flight_details_id = $_GET['flight_details_id'];
$user_id = $_SESSION["user_id"];
$flight_id = $_SESSION["flight_id"];


$ticket_info = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM user_profile WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>
    <div class="container" style="width: 50vw; min-width:300px">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="">First name: *</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo "{$user['f_name']}" ?>" placeholder="First Name:" required>
                </div>
                <div class="col">
                    <label for="">Last name: *</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo "{$user['l_name']}" ?>" placeholder="Last Name:" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col">
                        <label for="">Data of birth: *</label>
                        <input type="date" class="form-control" name="dateOfBirth" placeholder="dateOfBirth:" required>
                    </div>
                    <div class="col">
                        <label for="">Seat: </label>
                        <input type="text" class="form-control" name="seat" placeholder="seat" required>
                    </div>
                </div>
                <?php
                echo "Fill up seat <br>";
                $searchSQL = "SELECT seat FROM ticket WHERE flight_details_id = $flight_details_id";
                $searchResult = mysqli_query($conn, $searchSQL);
                while ($row = mysqli_fetch_assoc($searchResult)) {
                    echo $row['seat'] . " , ";
                }
                ?>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="">Passport number: </label>
                    <input type="text" class="form-control" name="passportNumber" placeholder="passportNumber:">
                </div>
                <div class="col">
                    <label for="">Passport Expiry Date: </label>
                    <input type="text" class="form-control" name="passportExpiryDate" placeholder="passportExpiryDate:">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="">City: </label>
                    <input type="text" class="form-control" name="city" placeholder="city:">
                </div>
                <div class="col">
                    <label for="">Country: </label>
                    <input type="text" class="form-control" name="country" placeholder="country:">
                </div>
            </div>

            <h3>Contact details : </h3>
            <div class="form-group mb-3">
            <label for="">Email: </label>
                <input type="emamil" class="form-control" name="email" value="<?php echo "{$user['email']}" ?>" placeholder="Email:" required>
            </div>

            <div class="form-group mb-3">
            <label for="">Phone: </label>
                <input type="phone" class="form-control" name="phone" value="<?php echo "{$user['phone']}" ?>" placeholder="Phone:" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Continue" name="submit">
            </div>
        </form>
    </div>
    <?php

    // echo $flight_details_id . "<br>";
    // echo $user_id . "<br>";
    // echo $flight_id . "<br>";

    if (isset($_POST["submit"])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $seat = $_POST['seat'];
        $passportNumber = NULL;
        $passportNumber = $_POST['passportNumber'];
        $passportExpiryDate = NULL;
        $passportExpiryDate = $_POST['passportExpiryDate'];
        $city = NULL;
        $city = $_POST['city'];
        $country = NULL;
        $country = $_POST['country'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $availSeat = true;

        $searchSQL = "SELECT seat FROM ticket WHERE flight_details_id = $flight_details_id";
        $searchResult = mysqli_query($conn, $searchSQL);
        while ($row = mysqli_fetch_assoc($searchResult)) {
            if($seat == $row['seat']){
                $availSeat = false;
            }
        }
        if($availSeat){
             $sql = "INSERT INTO ticket(t_passportNumber, t_passportExpiryDate, seat, profile_id, flight_id, flight_details_id)
     VALUES ('$passportNumber','$passportExpiryDate','$seat','$user_id','$flight_id','$flight_details_id')";
        if (mysqli_query($conn, $sql)) {
            echo "ticket stored ";
            $ticket_info = true;
            $sql = "SELECT available_seats FROM flight_details WHERE id = $flight_details_id";
            $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $seat = $row['available_seats'] - 1;
            $updateSql = "UPDATE flight_details SET available_seats = '$seat'";
            mysqli_query($conn, $updateSql);
            // header("Location: tiket_info.php?tickt_id=$");

        } else {
            echo "ticket store failed";
        }
        }else{
            echo "seat fill up. try another seat";
        }
       
    }
    ?>
    <div class="container" style="width: 50vw; min-width:300px">
        <h3 style="margin: 15px 0 15px 0;">Ticket informations :</h3>
        <div class="row mb-3">
            <div class="col">
                <h5>First Name : <?php
                                    if ($ticket_info) {
                                        echo $fname;
                                    }
                                    ?></h5>
            </div>
            <div class="col">
                <h5>Last Name : <?php
                                if ($ticket_info) {
                                    echo $lname;
                                }
                                ?></h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <h5>email Name : <?php
                                    if ($ticket_info) {
                                        echo $email;
                                    }
                                    ?></h5>
            </div>
            <div class="col">
                <h5>phone Name : <?php
                                    if ($ticket_info) {
                                        echo $phone;
                                    }
                                    ?></h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <h5>seat : <?php
                            if ($ticket_info) {
                                echo $seat;
                            }
                            ?></h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <h5>departure_date :
                    <?php
                    $sql = "SELECT * FROM flight_details WHERE id = $flight_details_id";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    if ($ticket_info) {
                        echo $row['departure_date'];
                    }
                    ?>
                </h5>
            </div>
            <div class="col">
                <h5>departure_time: <?php if ($ticket_info) {
                                        echo $row['departure_time'];
                                    } ?></h5>
            </div>
        </div>

    </div>

</body>

</html>