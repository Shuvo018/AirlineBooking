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
    <div class="d-grid gap-2">
        <a href="add_flight.php" class="btn btn-primary" role="button">Add flight</a>
        <a href="add_flight_details.php" class="btn btn-primary" role="button">Add flight details</a>
    </div>
    <div class="tablename m-3 ">
        <h3>flight details</h3>
    </div>
    <table class="table mb-3">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">from_loc</th>
                <th scope="col">to_loc</th>
                <th scope="col">departure_time</th>
                <th scope="col">departure_date</th>
                <th scope="col">duration</th>
                <th scope="col">available_seats</th>
                <th scope="col">price</th>
                <th scope="col"> flight_id</th>
                <th scope="col"> action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM flight_details";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $flightId = $row['flight_id'];
                $sql2 = "SELECT airline_id FROM flight WHERE id = $flightId";
                $row2 = mysqli_fetch_assoc(mysqli_query($conn, $sql2));

                echo "<tr>
                    <th> {$row['id']} </th>
                    <td> {$row['from_loc']} </td>
                    <td> {$row['to_loc']} </td>
                    <td> {$row['departure_time']} </td>
                    <td> {$row['departure_date']} </td>
                    <td> {$row['duration']} </td>
                    <td> {$row['available_seats']} </td>
                    <td> {$row['price']} </td>
                    
                    <td> {$row2['airline_id']} </td>
                    <td> <a href = 'update_flight_details.php?msg={$id}' class='btn btn-primary'> update</a>
                     <a href = '#' class='btn btn-danger'> cancel</a>
                     </td>
                </tr>";
            }
            ?>

        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>