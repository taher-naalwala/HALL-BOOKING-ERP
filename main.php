<?php

session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if ($_SESSION['access'] == "1" && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];
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

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .table td {
            padding: 5px;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php require('connectDB.php');
        require('style.php');
        if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Super Admin") {
            $sql = "SELECT COUNT(*) as c3 from booking_info WHERE status=1 OR status=2";
            $run = $conn->query($sql);
            $r = $run->fetch_assoc();
            $total_booking = $r['c3'];
            $sql1 = "SELECT COUNT(*) as c2 from booking_info WHERE status=1 OR (status=1 AND part_pay=1) ";
            $run1 = $conn->query($sql1);
            $r1 = $run1->fetch_assoc();
            $total_payment_pending = $r1['c2'];
            $sql2 = "SELECT COUNT(*) as c1 from booking_info WHERE status=2 ";
            $run2 = $conn->query($sql2);
            $r2 = $run2->fetch_assoc();
            $total_clearance_pending = $r2['c1'];
            $sql0 = "SELECT COUNT(*) as c from booking_info WHERE status!=4 OR status!=5";
            $run0 = $conn->query($sql0);
            $r0 = $run0->fetch_assoc();
            $overall_booking = $r0['c'];

            $sql01 = "SELECT COUNT(*) as c from booking_info WHERE status=3 AND date<'$c_d'";
            $run01 = $conn->query($sql01);
            $r01 = $run01->fetch_assoc();
            $confirmed_booking = $r01['c'];


            $sql02 = "SELECT COUNT(*) as c from booking_info WHERE status=3 AND date>'$c_d'";
            $run02 = $conn->query($sql02);
            $r02 = $run02->fetch_assoc();
            $upcoming_booking = $r02['c'];

            $sql3 = "SELECT id,its,name,mobile,jk_id,timings_id,date,status,purpose,jk_rent from booking_info WHERE status=1 AND part_pay=0 ORDER BY c_date DESC";
            $run3 = $conn->query($sql3);

        ?>



            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $overall_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Confirmed Bookings (with Event Finished)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $confirmed_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Upcoming Confirmed Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $upcoming_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Current Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cuurent Payment Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_payment_pending ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Current Clearance Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_clearance_pending ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="card ml-2 shadow mb-4"">
                    <div class=" card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ITS</th>
                                        <th>Name</th>
                                        <th>Mobile</th>

                                        <th>Jamaat Khana</th>
                                        <th>Booking Date</th>
                                        <th>Purpose</th>
                                        <th>Timing</th>
                                        <!--  <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Capacity</th> -->
                                        <th>Rent</th>

                                        <th>Full Payment</th>
                                        <th>Partial Payment</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_payment_pending > 0) {
                                        while ($row = $run3->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];
                                            $mobile = $row['mobile'];
                                            $date = $row['date'];
                                            $status = $row['status'];
                                            $jk_id = $row['jk_id'];
                                            $amount=$row['jk_rent'];

                                            $purpose = $row['purpose'];
                                            $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                            $latest_date = $date;
                                            $timestamp = strtotime($latest_date);

                                            $day = date('l', $timestamp);

                                           
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
                                                <td><?php echo $purpose ?></td>
                                                <td><?php echo $label_name ?></td>
                                                <!-- <td><?php // echo $final_start_time 
                                                            ?></td>
                                                <td><?php // echo $final_end_time 
                                                    ?></td>
                                                <td><?php // echo $capacity 
                                                    ?></td> -->
                                                <td><?php echo $amount ?></td>

                                                <?php
                                                ?>


                                                <td> <a name="recieved" class="btn btn-outline-primary" href="payment_confirm.php?type=full&id=<?php echo $id ?>&name=<?php echo $name ?>&date=<?php echo $date ?>&jk_rent=<?php echo $amount ?>">FULL</a>
                                                <td> <a name="recieved" class="btn btn-outline-primary" href="payment_confirm.php?type=partial&id=<?php echo $id ?>&name=<?php echo $name ?>&date=<?php echo $date ?>&jk_rent=<?php echo $amount ?>">Partial</a>



                                                </td>

                                            </tr>
                                    <?php  }
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        if ($_SESSION['role'] == "Manager") {
            $date = date('Y-m-d');
            $sql = "SELECT id,its,name,mobile,jk_id,timings_id,date,status,purpose from booking_info WHERE status=3 AND laagat!='' AND thaals!='' AND date>='$date'";
            $run = $conn->query($sql);
            $total_booking = $run->num_rows;

            $sql1 = "SELECT id,its,name,mobile,jk_id,timings_id,date,status,purpose from booking_info WHERE status=3 AND laagat!='' AND thaals!='' AND date='$date'";
            $run1 = $conn->query($sql1);
            $today_booking = $run1->num_rows;
            $sql2 = "SELECT id,its,name,mobile,jk_id,timings_id,date,status,purpose from booking_info WHERE status=3 AND laagat!='' AND thaals!='' AND date>'$date' ";
            $run2 = $conn->query($sql2);
            $total_upcoming = $run2->num_rows;

        ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $today_booking ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Upcoming Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_upcoming ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="card ml-2 shadow mb-4"">
                    <div class=" card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ITS</th>
                                        <th>Name</th>
                                        <th>Mobile</th>

                                        <th>Jamaat Khana</th>
                                        <th>Booking Date</th>
                                        <th>Purpose</th>
                                        <th>Timing</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Laagat</th>
                                        <th>Thaals</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_booking > 0) {
                                        while ($row = $run->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];
                                            $mobile = $row['mobile'];
                                            $date = $row['date'];
                                            $laagat = $row['laagat'];
                                            $thaals = $row['thaals'];
                                            $status = $row['status'];
                                            $jk_id = $row['jk_id'];
                                            $purpose = $row['purpose'];
                                            $s4 = "SELECT name,capacity,amount from jk_info WHERE id=$jk_id";
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
                                                <td><?php echo $purpose ?></td>
                                                <td><?php echo $label_name ?></td>
                                                <td><?php echo $final_start_time ?></td>
                                                <td><?php echo $final_end_time ?></td>
                                                <td><?php echo $laagat ?></td>
                                                <td><?php echo $thaals ?></td>


                                            </tr>
                                    <?php  }
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <?php
    require('footer.php');
    ?>
</body>

</html>