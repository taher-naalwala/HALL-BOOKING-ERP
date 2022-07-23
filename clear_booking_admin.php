<?php
session_start();
if (isset($_SESSION['access'])) {
} else {
    header('Location:main.php');
    die();

    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "13" || $formid == "11") {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        header('Location:main.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear Booking</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add <?php echo $get_name;  ?></title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Clear Booking</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">

                            <div class="col-lg-3">

                                <select class="form-control" name="type">
                                <option value="ITS">ITS</option>
                                    <option value="booking_id">Booking ID</option>
                                   
                                </select>

                            </div>
                            <div class="col-lg-3">

                                <input name="input" placeholder="Enter Value" class="form-control">

                            </div>
                            <div class="col-lg-3">

                                <button value="submit" name="submit" class="btn btn-primary">Submit</button>

                            </div>

                        </div>
                        <?php require('connectDB.php');
                        if (isset($_GET['submit'])) {
                            $type = $_GET['type'];
                            $input = $_GET['input'];

                            if ($type == "booking_id") {
                                $sql2 = "SELECT its,name,mobile,jk_id,date,timings_id from booking_info WHERE status=2 AND id=$input";
                            }
                            else
                            {
                                $sql2 = "SELECT its,name,mobile,jk_id,date,timings_id from booking_info WHERE status=2 AND its=$input";
                            }
                                $run2 = $conn->query($sql2); ?>
                                <?php if ($run2->num_rows > 0) {
                                ?>
                                    <div class="row mt-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ITS</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>

                                                        <th>Jamaat Khana</th>
                                                        <th>Date</th>
                                                        <th>Label</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Capacity</th>
                                                        <th>Rent</th>


                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php

                                                    while ($row = $run2->fetch_assoc()) {
                                                        $id = $input;
                                                        $its = $row['its'];
                                                        $name = $row['name'];
                                                        $mobile = $row['mobile'];
                                                        $date = $row['date'];
                                                        $status = $row['status'];
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                        $amount = $row4['amount'];
                                                        $capacity = $row4['capacity'];
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT label,start_time,end_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();
                                                        $label_name = $row6['label'];
                                                        $start_time = $row6['start_time'];
                                                        $end_time = $row6['end_time'];
                                                        $whole = floor($start_time);
                                                        $fraction = $start_time - $whole;

                                                        if ($start_time < 12) {
                                                            $whole = floor($start_time);
                                                            $fraction = ($start_time - $whole) * 60;
                                                            if ($fraction == "0") {
                                                                $final_start_time = $whole . ":00 AM";
                                                            } else {
                                                                $final_start_time = $whole . ":" . $fraction . " AM";
                                                            }
                                                        } else  if ($start_time > 12) {
                                                            $whole = floor($start_time) - 12;
                                                            $fraction = ($start_time - ($whole + 12)) * 60;
                                                            if ($fraction == "0") {
                                                                $final_start_time = $whole . ":00 PM";
                                                            } else {
                                                                $final_start_time = $whole . ":" . $fraction . " PM";
                                                            }
                                                        }
                                                        else if ($start_time == 12) {
                                                            $whole = floor($start_time);
                                                            $fraction = ($start_time - $whole) * 60;
                                                            if ($fraction == "0") {
                                                                $final_start_time = $whole . ":00 PM";
                                                            } else {
                                                                $final_start_time = $whole . ":" . $fraction . " PM";
                                                            }
                                                        }

                                                        $whole_end = floor($end_time);
                                                        $fraction_end = $end_time - $whole_end;

                                                        if ($end_time < 12) {
                                                            $whole_end = floor($end_time);
                                                            $fraction_end = ($end_time - $whole_end) * 60;
                                                            if ($fraction_end == "0") {
                                                                $final_end_time = $whole_end . ":00 AM";
                                                            } else {
                                                                $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                                                            }
                                                        } else  if ($end_time > 12) {
                                                            $whole_end = floor($end_time) - 12;
                                                            $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                                                            if ($fraction_end == "0") {
                                                                $final_end_time = $whole_end . ":00 PM";
                                                            } else {
                                                                $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                                                            }
                                                        }
                                                        else if ($end_time == 12) {
                                                            $whole_end = floor($end_time);
                                                            $fraction_end = ($end_time - $whole_end) * 60;
                                                            if ($fraction_end == "0") {
                                                                $final_end_time = $whole_end . ":00 PM";
                                                            } else {
                                                                $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                                                            }
                                                        } ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $its ?></td>
                                                            <td><?php echo $name ?></td>
                                                            <td><?php echo $mobile ?></td>
                                                            <td><?php echo $jk_name ?></td>
                                                            <td><?php echo $date ?></td>
                                                            <td><?php echo $label_name ?></td>
                                                            <td><?php echo $final_start_time ?></td>
                                                            <td><?php echo $final_end_time ?></td>
                                                            <td><?php echo $capacity ?></td>
                                                            <td><?php echo $amount ?></td>



                                                        </tr>
                                                    <?php     }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                    </form>
                    <form method="POST">
                        <div class="form-group">
                            <input name="laagat" type="number" placeholder="Enter Laagat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input name="thaals" type="number" placeholder="Enter Thaals" class="form-control" required>
                        </div>
                        <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Cleared</button>
                        <?php
                                    if (isset($_POST['cleared'])) {
                                        $id = $_POST['cleared'];
                                        $input = $_GET['input'];
                                        $laagat = $_POST['laagat'];
                                        $thaals = $_POST['thaals'];
                                        $sql = "UPDATE booking_info SET status=3,laagat='$laagat',thaals='$thaals' WHERE id=$input";
                                        if (mysqli_query($conn, $sql)) {
                                            echo "Booking Cleared";
                                        } else {
                                            echo "Fail";
                                        }
                                    }
                        ?>
                    </form>
        <?php
                                } else {
                                    echo "No Clearance Booking Found";
                                }
                            }
                        
        ?>

                </div>
            </div>
        </div>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<?php
require('footer.php');
?>

</body>

</html>