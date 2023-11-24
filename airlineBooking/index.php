<?php
include("header.php");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Bootstrap demo</title>
</head>

<body>
    <h2 class="h d-flex justify-content-center">HOME PAGE</h2>

    <div class="container d-flex justify-content-center ">
        <form action="index.php" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label for="form-label">from loc</label>
                    <!-- <input type="text" class="form-control" name="from_loc" placeholder="from_loc :"> -->
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="from_loc">
                        <option value="chattogram" selected>Chattogram</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="sylhet">Sylhet</option>
                    </select>
                </div>
                <div class="col">
                    <label for="form-label">to loc</label>
                    <!-- <input type="text" class="form-control" name="to_loc" placeholder="to_loc:"> -->
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="to_loc">
                        <option value="chattogram">Chattogram</option>
                        <option value="dhaka" selected>Dhaka</option>
                        <option value="sylhet">Sylhet</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="date" class="form-control" name="departure_date" placeholder="departure_date:">
                </div>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="search" name="submit">
            </div>
        </form>
    </div>
    <table class="table mb-3">
    <thead>
            <tr>
                <th scope="col">Airline name</th>
                <th scope="col">from_loc</th>
                <th scope="col">to_loc</th>
                <th scope="col">departure_time</th>
                <th scope="col">departure_date</th>
                <th scope="col">duration</th>
                <th scope="col">available_seats</th>
                <th scope="col">price</th>
                <th scope="col"> action</th>
            </tr>
        </thead>
    <tbody>
        <?php
        if (isset($_POST['submit'])) {
            $from_loc = $_POST['from_loc'];
            $to_loc = $_POST['to_loc'];
            $departure_date = $_POST['departure_date'];

            $sql = "SELECT * FROM flight_details WHERE from_loc = '$from_loc' and to_loc = '$to_loc' and departure_date = '$departure_date'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $flightId = $row['flight_id'];
                $sql2 = "SELECT * FROM flight WHERE id = '$flightId'";
                $row2 = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
                $_SESSION["flight_id"] = $row2["id"];
                echo "<tr>
        <td> {$row2['airline_name']} </td>
        <td> {$row['from_loc']} </td>
        <td> {$row['to_loc']} </td>
        <td> {$row['departure_time']} </td>
        <td> {$row['departure_date']} </td>
        <td> {$row['duration']} </td>
        <td> {$row['available_seats']} </td>
        <td> {$row['price']} </td>

        <td> <a href ='book.php?flight_details_id=$id' class='btn btn-primary'> book</a>
         </td>
    </tr>";
            }
        }


        ?>

    </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</body>

</html>
<?php
// if (isset($_POST['submit'])) {
//     $from_loc = $_POST['from_loc'];
//     $to_loc = $_POST['to_loc'];
//     $departure_date = $_POST['departure_date'];

//     // echo $from_loc."<br>";
//     $sql = "SELECT * FROM flight_details WHERE from_loc = '$from_loc' and to_loc = '$to_loc' and departure_date = '$departure_date'";
//     $result = mysqli_query($conn, $sql);
//     while ($row = mysqli_fetch_assoc($result)) {
//         echo $row['id'] . "<br>";
//         echo $row['from_loc'] . "<br>";
//         echo $row['to_loc'] . "<br>";
//         echo $row['departure_time'] . "<br>";
//     }
// }


?>