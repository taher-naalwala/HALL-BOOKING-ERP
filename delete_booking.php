<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "25" || $formid == "16") {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        header('Location:main.php');
        exit();
    }
} else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");

    die();
} else {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
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
    <?php
    require('search_name_css.php');
    ?>
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
                    <h6 class="m-0 font-weight-bold text-primary">Delete Booking</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">

                            <div class="col-lg-3">

                                <select class="form-control" name="type">

                                    <option value="booking_id">Booking ID</option>

                                </select>

                            </div>
                            <div class="col-lg-3">

                                <div class="search-box">

                                    <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." />

                                    <div class="result"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">

                                <button value="submit" name="submit" class="btn btn-primary">Submit</button>

                            </div>
                    </form>
                    <?php require('connectDB.php');
                    if (isset($_GET['submit'])) {
                        $type = $_GET['type'];
                        $input = $_GET['input'];
                        if (strpos($input, '(') !== false) {
                            $first_index = stripos($input, "(") + 1;
                            $s_id_e = substr($input, $first_index);
                            $input = rtrim($s_id_e, ") ");
                        }

                        if ($type == "booking_id") {
                            $sql2 = "SELECT its,name,mobile,jk_id,date,timings_id,laagat,thaals,status from booking_info WHERE id=$input AND status!=4 ";


                            $run2 = $conn->query($sql2); ?>
                            <?php if ($run2->num_rows > 0) {
                            ?>
                                <div class="row mt-4">
                                    <div class="table-responsive mb-2 ml-2 mr-2">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ITS</th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>

                                                    <th>Jamaat Khana</th>
                                                    <th>Date</th>
                                                    <th>Timing</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>



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
                                                    $s4 = "SELECT name,amount,capacity from jk_info WHERE id=$jk_id";
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
                                                    $laagat = $row['laagat'];
                                                    $thaals = $row['thaals'];

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
                                                    } else if ($start_time == 12) {
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
                                                    } else if ($end_time == 12) {
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




                                                    </tr>
                                                <?php     }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <form method="POST">
                                    <button name='delete_booking' class="btn btn-danger" value='<?php echo $id ?>'>Delete</button>
                                    <?php
                                    if (isset($_POST['delete_booking'])) {

                                        $id = $_POST['delete_booking'];
                                        $sql = "UPDATE booking_info SET status=5 WHERE id=$id";
                                        if (mysqli_query($conn, $sql)) {
                                            $s1 = "UPDATE ledger SET status=3 WHERE booking_id=$id";
                                            if (mysqli_query($conn, $s1)) {
                                                $s2 = "UPDATE ledger2 SET status=3 WHERE bk_id=$id";
                                                if (mysqli_query($conn, $s2)) {
                                                    $s3 = "UPDATE ledger3 SET status=3 WHERE bk_id=$id";
                                                    if (mysqli_query($conn, $s3)) {
                                                        echo '<div class="alert alert-success mt-2">
                                        Booking Deleted
                                        </div>';
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    ?>

                                </form>

                            <?php
                            } else {
                                echo '<div class="alert alert-info mt-2">
                               No Booking Found For Deletion
                                </div>';
                            }
                        } else {
                            $sql2 = "SELECT id,name,mobile,date,jk_id,timings_id,laagat,thaals,status from booking_info WHERE its=$input  AND status!=4";


                            $run2 = $conn->query($sql2); ?>
                            <?php if ($run2->num_rows > 0) {
                                while ($row = $run2->fetch_assoc()) { ?>
                                    <div class="row mt-4">
                                        <div class="table-responsive mb-2 ml-2 mr-2">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ITS</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>

                                                        <th>Jamaat Khana</th>
                                                        <th>Date</th>
                                                        <th>Timing</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>



                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $id = $row['id'];
                                                    $its = $input;
                                                    $name = $row['name'];

                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
                                                    $laagat = $row['laagat'];
                                                    $thaals = $row['thaals'];
                                                    $status = $row['status'];
                                                    $jk_id = $row['jk_id'];
                                                    $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                    $run4 = $conn->query($s4);
                                                    $row4 = $run4->fetch_assoc();
                                                    $jk_name = $row4['name'];

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
                                                    } else if ($start_time > 12) {
                                                        $whole = floor($start_time) - 12;
                                                        $fraction = ($start_time - ($whole + 12)) * 60;
                                                        if ($fraction == "0") {
                                                            $final_start_time = $whole . ":00 PM";
                                                        } else {
                                                            $final_start_time = $whole . ":" . $fraction . " PM";
                                                        }
                                                    } else if ($start_time == 12) {
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
                                                    } else if ($end_time > 12) {
                                                        $whole_end = floor($end_time) - 12;
                                                        $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                                                        if ($fraction_end == "0") {
                                                            $final_end_time = $whole_end . ":00 PM";
                                                        } else {
                                                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                                                        }
                                                    } else if ($end_time == 12) {
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



                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                    <form method="POST">
                                        <button name='delete_booking<?php echo $id ?>' class="btn btn-danger" value='<?php echo $id ?>'>Delete</button>
                                        <?php
                                        $l = "delete_booking" . $id;
                                        if (isset($_POST[$l])) {

                                            $sql = "DELETE FROM booking_info WHERE id=$id";
                                            if (mysqli_query($conn, $sql)) {
                                                $s1 = "DELETE FROM ledger WHERE booking_id=$id";
                                                if (mysqli_query($conn, $s1)) {
                                                    $s2 = "DELETE FROM garbage_info WHERE bk_id=$id";
                                                    if (mysqli_query($conn, $s2)) {
                                                        echo '<div class="alert alert-success mt-2">
                                        Booking Deleted
                                        </div>';
                                                    }
                                                }
                                            }
                                        }

                                        ?>

                                    </form>

                    <?php

                                }
                            }
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

</body>

</html>