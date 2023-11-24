<?php
include("header.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM user_profile WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $fname = $user['f_name'];
    ?>

    <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Profile</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-flight">My flight</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="imgs/narutoImg.jpg" alt class="d-block ui-w-80">
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">First name</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo $fname; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="<?php echo $user['l_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo $user['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="<?php echo $user['phone']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="" value="Chattogram">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Birthday</label>
                                    <input type="date" class="form-control" value="May 3, 1995">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="custom-select">
                                        <option>USA</option>
                                        <option>Canada</option>
                                        <option>UK</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                        <option selected>Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Contacts</h6>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="+0 (123) 456 7891">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">email</label>
                                    <input type="email" class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="account-flight">


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
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
            <button type="button" class="btn btn-primary">update</button>&nbsp;
            <button type="button" class="btn btn-default">Cancel</button>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>