<?php
include("header.php");
session_start();
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
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <h2>User profile</h2>
        <form action="profile.php" method="post">
            <?php
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM user_profile WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            $fname = $user['f_name'];
            ?>
            <div class="row mb-3">
                <div class="col">
                    <label for="">First name : </label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" placeholder="First Name:">
                </div>
                <div class="col">
                    <label for="">Last name :</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $user['l_name']; ?>" placeholder="Last Name:">
                </div>
            </div>
            <div class="form-group">
                <label for="">Email :</label>
                <input type="emamil" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="Email:">
            </div>
            <div class="form-group">
                <label for="">Phone :</label>
                <input type="phone" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone:">
            </div>
            
        </form>
    </div>

    <div class="container" style="width: 70vw; min-width:300px">
        <h3 style="margin: 15px 0 15px 0;">Ticket informations :</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">from loc</th>
                    <th scope="col">to loc</th>
                    <th scope="col">Departure date</th>
                    <th scope="col">Departure time</th>
                    <th scope="col">seat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM ticket WHERE profile_id = $user_id";
                $result = mysqli_query($conn, $sql);
                
                
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    $seat = $row['seat'];
                    $FD_id = $row['flight_details_id'];

                    $FD_sql = "SELECT * FROM flight_details WHERE id = $FD_id";
                    $FD_result = mysqli_query($conn, $FD_sql);
                    $FD_row = mysqli_fetch_assoc($FD_result);
                    echo "<tr>
                    <th> {$fname} </th>
                    <td> {$FD_row['from_loc']} </td>
                    <td> {$FD_row['to_loc']} </td>
                    <td> {$FD_row['departure_date']} </td>
                    <td> {$FD_row['departure_time']} </td>
                    <td> {$seat} </td>
                     </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>
<?php

?>