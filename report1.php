<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "35") {
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
    <title>Report</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .ui-datepicker-calendar {
            display: none;
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
                    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">

                            <div class="col-lg-2">


                                <select name="type" class="form-control" onChange="change_type()" id="type" required>
                                    <option>Select Report By</option>
                                    <option value="6">Jamaat Khaana</option>
                                    <option value="1">ITS</option>
                                    <option value="7">Booking ID</option>
                                    <option value="2">Name</option>
                                    <option value="3">Mobile</option>
                                    <option value="4">Payment Pending</option>
                                    <option value="5">Jamaat Khaana Block Dates</option>
                                    <option value="8">Cash Ledger</option>
                                    <option value="9">Cheque Ledger</option>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div id="1">

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="2">

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="3">

                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="bkid" name="checkbox[]" value="bkid" checked>
                                <label class="form-check-label" for="bkid">Booking ID</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="its" checked>
                                <label class="form-check-label" for="its">ITS</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="name" checked>
                                <label class="form-check-label" for="name">Name</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="mobile" name="checkbox[]" value="mobile" checked>
                                <label class="form-check-label" for="mobile">Mobile</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="jk" name="checkbox[]" value="jk" checked>
                                <label class="form-check-label" for="jk">Jamaat Khaana</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="capacity" name="checkbox[]" value="capacity">
                                <label class="form-check-label" for="capacity">Capacity</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="date" name="checkbox[]" value="date" checked>
                                <label class="form-check-label" for="date">Booking Date</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="timing" name="checkbox[]" value="timing" checked>
                                <label class="form-check-label" for="timing">Timing</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="start_time" name="checkbox[]" value="start_time">
                                <label class="form-check-label" for="start_time">Start Time</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="end_time" name="checkbox[]" value="end_time">
                                <label class="form-check-label" for="end_time">End Time</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rent" name="checkbox[]" value="rent" checked>
                                <label class="form-check-label" for="rent">Rent</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rentp" name="checkbox[]" value="rentp" checked>
                                <label class="form-check-label" for="rentp">Rent Paid</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rentc" name="checkbox[]" value="rentc" checked>
                                <label class="form-check-label" for="rentc">Rent Cleared</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="admin" name="checkbox[]" value="admin">
                                <label class="form-check-label" for="admin">Admin</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="laagat" name="checkbox[]" value="laagat">
                                <label class="form-check-label" for="laagat">Laagat</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="thaals" name="checkbox[]" value="thaals">
                                <label class="form-check-label" for="thaals">Thaals</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="purpose" name="checkbox[]" value="purpose">
                                <label class="form-check-label" for="purpose">Purpose</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="scd" name="checkbox[]" value="scd" checked>
                                <label class="form-check-label" for="scd">Security Deposit</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="m" name="checkbox[]" value="m">
                                <label class="form-check-label" for="m">Manager Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rs" name="checkbox[]" value="rs">
                                <label class="form-check-label" for="rs">Refund Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="bks" name="checkbox[]" value="bks" checked>
                                <label class="form-check-label" for="bks">Booking Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="formid" name="checkbox[]" value="formid">
                                <label class="form-check-label" for="formid">Form ID</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="pdf" name="checkbox[]" value="pdf">
                                <label class="form-check-label" for="pdf">Pdf/Image</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="garbage" name="checkbox[]" value="garbage" checked>
                                <label class="form-check-label" for="garbage">Garbage Charge</label>
                            </div>
                            <button name="submit" class="btn btn-primary ml-2 mt-2" value="submit">Submit</button>
                        </div>

                </div>
            </div>
            </form>

            <?php require('connectDB.php');
            if (isset($_GET['its']) && $_GET['type'] == "1") {
                $its = $_GET['its'];
                $checkbox = $_GET['checkbox'];

                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE its='$its' ORDER BY date ASC";
                $run = $conn->query($sql);
                $total_booking = $run->num_rows;
                $sql1 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=1 AND its='$its' ORDER BY date ASC";
                $run1 = $conn->query($sql1);
                $total_payment_pending = $run1->num_rows;
                $sql2 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=2 AND its='$its' ORDER BY date ASC";
                $run2 = $conn->query($sql2);
                $total_clearance_pending = $run2->num_rows;

            ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4 ml-2 mr-2">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary  h-100 py-2">
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
                                <div class="card border-left-success  h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment Pending</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_payment_pending ?></div>
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
                                <div class="card border-left-success  h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clearance Pending</div>
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

                        <div class="row ml-2">
                            <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
                            <div class=" card-body">



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                        <thead>
                                            <tr>
                                                <?php
                                                foreach ($checkbox as $col) {
                                                    echo "<th>";
                                                    if ($col == "bkid") {
                                                        echo "#";
                                                    }
                                                    if ($col == "its") {
                                                        echo "ITS";
                                                    }
                                                    if ($col == "name") {
                                                        echo "Name";
                                                    }
                                                    if ($col == "mobile") {
                                                        echo "Mobile";
                                                    }
                                                    if ($col == "jk") {
                                                        echo "Jamaat Khaana";
                                                    }
                                                    if ($col == "date") {
                                                        echo "Booking Date";
                                                    }
                                                    if ($col == "timing") {
                                                        echo "Timing";
                                                    }
                                                    if ($col == "start_time") {
                                                        echo "Start Time";
                                                    }
                                                    if ($col == "end_time") {
                                                        echo "End Time";
                                                    }
                                                    if ($col == "capacity") {
                                                        echo "Capacity";
                                                    }
                                                    if ($col == "rent") {
                                                        echo "Rent";
                                                    }
                                                    if ($col == "rentp") {
                                                        echo "Rent Paid";
                                                    }
                                                    if ($col == "rentc") {
                                                        echo "Rent Cleared";
                                                    }
                                                    if ($col == "admin") {
                                                        echo "Admin";
                                                    }
                                                    if ($col == "laagat") {
                                                        echo "Laagat";
                                                    }
                                                    if ($col == "thaals") {
                                                        echo "Thaals";
                                                    }
                                                    if ($col == "purpose") {
                                                        echo "Purpose";
                                                    }
                                                    if ($col == "scd") {
                                                        echo "Security Deposit";
                                                    }
                                                    if ($col == "m") {
                                                        echo "Manager Status";
                                                    }
                                                    if ($col == "rs") {
                                                        echo "Refund Status";
                                                    }
                                                    if ($col == "bks") {
                                                        echo "Booking Status";
                                                    }
                                                    if ($col == "formid") {
                                                        echo "Form ID";
                                                    }
                                                    if ($col == "pdf") {
                                                        echo "Pdf/Images";
                                                    }
                                                    if ($col == "garbage") {
                                                        echo "Garbage Charge";
                                                    }

                                                    echo "</th>";
                                                }

                                                ?>
                                                <!--      <th>ID</th>
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
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];

                                                foreach ($checkbox as $col) {
                                                    if ($col == "bkid") {
                                                        $id = $row['id'];
                                                    }
                                                    if ($col == "its") {
                                                        $its = $row['its'];
                                                    }
                                                    if ($col == "name") {
                                                        $name = $row['name'];
                                                    }
                                                    if ($col == "mobile") {
                                                        $mobile = $row['mobile'];
                                                    }

                                                    if ($col == "jk") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                    }
                                                    if ($col == "date") {
                                                        $date = $row['date'];
                                                    }
                                                    if ($col == "timing") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();
                                                        $label_name = $row6['label'];
                                                    }
                                                    if ($col == "start_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $start_time = $row6['start_time'];
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
                                                    }
                                                    if ($col == "end_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $end_time = $row6['end_time'];

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
                                                        }
                                                    }
                                                    if ($col == "capacity") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $capacity = $row4['capacity'];
                                                    }
                                                    if ($col == "rent") {
                                                        $date = $row['date'];
                                                        $jk_id = $row['jk_id'];
                                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                        $run20 = $conn->query($s20);
                                                        if ($run20->num_rows > 0) {
                                                            $row20 = $run20->fetch_assoc();
                                                            $amount = $row20['amount'];
                                                        }
                                                    }
                                                    if ($col == "rentp") {
                                                        $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                                        $run7 = $conn->query($s7);
                                                        $total_rent_paid = 0;
                                                        if ($run7->num_rows > 0) {
                                                            while ($row7 = $run7->fetch_assoc()) {
                                                                $a = $row7['amount'];
                                                                $debit = $row7['debit'];

                                                                if ($debit == "1") {
                                                                    $total_rent_paid = $total_rent_paid + $a;
                                                                } else {
                                                                    $total_rent_paid = $total_rent_paid - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "rentc") {

                                                        $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                                        $run8 = $conn->query($s8);
                                                        $total_rent_cleared = 0;

                                                        if ($run8->num_rows > 0) {
                                                            while ($row8 = $run8->fetch_assoc()) {
                                                                $a = $row8['amount'];
                                                                $debit = $row8['debit'];
                                                                if ($debit == "1") {
                                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                                } else {
                                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "admin") {
                                                        $adminid = $row['adminid'];
                                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                                        $runq = $conn->query($sqlq);
                                                        $rowq = $runq->fetch_assoc();
                                                        $admin_name = $rowq['name'];
                                                    }
                                                    if ($col == "laagat") {
                                                        $laagat = $row['laagat'];
                                                    }
                                                    if ($col == "thaals") {
                                                        $thaals = $row['thaals'];
                                                    }
                                                    if ($col == "purpose") {
                                                        $purpose = $row['purpose'];
                                                    }
                                                    if ($col == "scd") {
                                                        $scd = $row['sc_deposit'];
                                                    }
                                                    if ($col == "m") {
                                                        $manager_approval = $row['manager_approval'];
                                                    }
                                                    if ($col == "rs") {
                                                        $rs = $row['refund_sc'];
                                                    }
                                                    if ($col == "bks") {
                                                        $status = $row['status'];
                                                    }
                                                    if ($col == "formid") {
                                                        $formid = $row['formid'];
                                                    }
                                                    if ($col == "garbage") {
                                                        $fgarbage = $row['garbage'];
                                                    }
                                                    if ($col == "pdf") {
                                                        $file = '';
                                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                                        $runr = $conn->query($sr);
                                                        if ($runr->num_rows > 0) {
                                                            $rowr = $runr->fetch_assoc();
                                                            $file = $rowr['file'];
                                                        }
                                                    }
                                                }









                                            ?>
                                                <tr>
                                                    <?php
                                                    foreach ($checkbox as $col) {
                                                        echo "<td>";
                                                        if ($col == "bkid") {
                                                            echo $id;
                                                        }
                                                        if ($col == "its") {
                                                            echo $its;
                                                        }
                                                        if ($col == "name") {
                                                            echo $name;
                                                        }
                                                        if ($col == "mobile") {
                                                            echo $mobile;
                                                        }
                                                        if ($col == "jk") {
                                                            echo $jk_name;
                                                        }
                                                        if ($col == "date") {
                                                            echo $date;
                                                        }
                                                        if ($col == "timing") {
                                                            echo $label_name;
                                                        }
                                                        if ($col == "start_time") {
                                                            echo $final_start_time;
                                                        }
                                                        if ($col == "end_time") {
                                                            echo $final_end_time;
                                                        }
                                                        if ($col == "capacity") {
                                                            echo $capacity;
                                                        }
                                                        if ($col == "rent") {
                                                            echo $amount;
                                                        }
                                                        if ($col == "rentp") {
                                                            echo $total_rent_paid;
                                                        }
                                                        if ($col == "rentc") {
                                                            echo $total_rent_cleared;
                                                        }
                                                        if ($col == "admin") {
                                                            echo $admin_name;
                                                        }
                                                        if ($col == "laagat") {
                                                            echo $laagat;
                                                        }
                                                        if ($col == "thaals") {
                                                            echo $thaals;
                                                        }
                                                        if ($col == "purpose") {
                                                            echo $purpose;
                                                        }
                                                        if ($col == "scd") {
                                                            echo $scd;
                                                        }
                                                        if ($col == "m") {
                                                            if ($manager_approval == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($manager_approval == "1") {
                                                                echo "Approved";
                                                            }

                                                            if ($manager_approval == "2") {
                                                                echo "Denied";
                                                            }
                                                        }
                                                        if ($col == "rs") {
                                                            if ($rs == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($rs == "1") {
                                                                echo "Refunded";
                                                            }

                                                            if ($rs == "2") {
                                                                echo "Not Refunded";
                                                            }
                                                        }
                                                        if ($col == "bks") {
                                                            if ($status == "1") {
                                                                echo "Payment Pending";
                                                            }
                                                            if ($status == "2") {
                                                                echo "Clearance Pending";
                                                            }
                                                            if ($status == "3") {
                                                                echo "Booked";
                                                            }
                                                            if ($status == "4") {
                                                                echo "Cancelled";
                                                            }
                                                            if ($status == "5") {
                                                                echo "Deleted";
                                                            }
                                                        }
                                                        if ($col == "formid") {
                                                            echo $formid;
                                                        }
                                                        if ($col == "garbage") {
                                                            echo $garbage;
                                                        }
                                                        if ($col == "pdf") {
                                                            if (empty($file)) {
                                                            } else {
                                                    ?>
                                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                                    <?php  }
                                                        }

                                                        echo "</td>";
                                                    }


                                                    ?>


                                                </tr>
                                            <?php     }

                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="card ml-4 mb-4" style="width: 100%;">
                                <div class=" card-header">Ledger</div>
                                <div class=" card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Mode</th>

                                                    <th>Debit</th>

                                                    <th>Credit</th>
                                                    <th>Check Number</th>
                                                    <th>Status</th>
                                                    <th>Clearance Date</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT id from booking_info WHERE its='$its'";
                                                $run = $conn->query($sql);
                                                while ($row = $run->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $s1 = "SELECT amount,check_number,account_number,debit,status,credit,pay_mode,c_date,check_cleared_date from ledger WHERE booking_id=$id";
                                                    $run1 = $conn->query($s1);
                                                    if ($run1->num_rows > 0) {
                                                        while ($row1 = $run1->fetch_assoc()) {
                                                            $amount = $row1['amount'];
                                                            $cn = $row1['check_number'];
                                                            $an = $row1['account_number'];
                                                            $status = $row1['status'];
                                                            $debit = $row1['debit'];
                                                            $credit = $row1['credit'];
                                                            $pay_mode = $row1['pay_mode'];
                                                            $date = $row1['c_date'];
                                                            $cl_date = $row1['check_cleared_date'];


                                                ?>
                                                            <tr>
                                                                <td><?php echo $date ?></td>
                                                                <td><?php if ($pay_mode == "0") {
                                                                        echo "Cheque";
                                                                    } else {
                                                                        echo "Cash";
                                                                    } ?></td>

                                                                <td><?php if ($debit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></td>
                                                                <td><?php if ($credit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></td>

                                                                <td><?php echo $cn ?></td>

                                                                <td><?php
                                                                    if ($status == "0") {
                                                                        echo "Clearance Pending";
                                                                    }
                                                                    if ($status == "1") {
                                                                        echo "Cleared";
                                                                    }
                                                                    if ($status == "2") {
                                                                        echo "Failed";
                                                                    }
                                                                    if ($status == "3") {
                                                                        echo "Deleted";
                                                                    }

                                                                    ?></td>
                                                                <td><?php echo $cl_date ?></td>


                                                            </tr>
                                                <?php     }
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
            if (isset($_GET['name']) && $_GET['type'] == "2") {
                $name = $_GET['name'];
                $checkbox = $_GET['checkbox'];

                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE name LIKE '%$name%' ORDER BY date ASC";
                $run = $conn->query($sql);
                $total_booking = $run->num_rows;
                $sql1 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=1 AND name LIKE '%$name%' ORDER BY date ASC";
                $run1 = $conn->query($sql1);
                $total_payment_pending = $run1->num_rows;
                $sql2 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=2 AND name LIKE '%$name%' ORDER BY date ASC";
                $run2 = $conn->query($sql2);
                $total_clearance_pending = $run2->num_rows;

                ?>

                    <div class="row ml-2">
                        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
                        <div class=" card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                    <thead>
                                        <tr>
                                            <?php
                                            foreach ($checkbox as $col) {
                                                echo "<th>";
                                                if ($col == "bkid") {
                                                    echo "#";
                                                }
                                                if ($col == "its") {
                                                    echo "ITS";
                                                }
                                                if ($col == "name") {
                                                    echo "Name";
                                                }
                                                if ($col == "mobile") {
                                                    echo "Mobile";
                                                }
                                                if ($col == "jk") {
                                                    echo "Jamaat Khaana";
                                                }
                                                if ($col == "date") {
                                                    echo "Booking Date";
                                                }
                                                if ($col == "timing") {
                                                    echo "Timing";
                                                }
                                                if ($col == "start_time") {
                                                    echo "Start Time";
                                                }
                                                if ($col == "end_time") {
                                                    echo "End Time";
                                                }
                                                if ($col == "capacity") {
                                                    echo "Capacity";
                                                }
                                                if ($col == "rent") {
                                                    echo "Rent";
                                                }
                                                if ($col == "rentp") {
                                                    echo "Rent Paid";
                                                }
                                                if ($col == "rentc") {
                                                    echo "Rent Cleared";
                                                }
                                                if ($col == "admin") {
                                                    echo "Admin";
                                                }
                                                if ($col == "laagat") {
                                                    echo "Laagat";
                                                }
                                                if ($col == "thaals") {
                                                    echo "Thaals";
                                                }
                                                if ($col == "purpose") {
                                                    echo "Purpose";
                                                }
                                                if ($col == "scd") {
                                                    echo "Security Deposit";
                                                }
                                                if ($col == "m") {
                                                    echo "Manager Status";
                                                }
                                                if ($col == "rs") {
                                                    echo "Refund Status";
                                                }
                                                if ($col == "bks") {
                                                    echo "Booking Status";
                                                }
                                                if ($col == "formid") {
                                                    echo "Form ID";
                                                }
                                                if ($col == "pdf") {
                                                    echo "Pdf/Images";
                                                }
                                                if ($col == "garbage") {
                                                    echo "Garbage Charge";
                                                }

                                                echo "</th>";
                                            }

                                            ?>
                                            <!--      <th>ID</th>
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
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($row = $run->fetch_assoc()) {
                                            $id = $row['id'];

                                            foreach ($checkbox as $col) {
                                                if ($col == "bkid") {
                                                    $id = $row['id'];
                                                }
                                                if ($col == "its") {
                                                    $its = $row['its'];
                                                }
                                                if ($col == "name") {
                                                    $name = $row['name'];
                                                }
                                                if ($col == "mobile") {
                                                    $mobile = $row['mobile'];
                                                }
                                                if ($col == "jk") {
                                                    $jk_id = $row['jk_id'];
                                                    $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                                    $run4 = $conn->query($s4);
                                                    $row4 = $run4->fetch_assoc();
                                                    $jk_name = $row4['name'];
                                                }
                                                if ($col == "date") {
                                                    $date = $row['date'];
                                                }
                                                if ($col == "timing") {
                                                    $timings_id = $row['timings_id'];
                                                    $s6 = "SELECT label from timings WHERE id=$timings_id";
                                                    $run6 = $conn->query($s6);
                                                    $row6 = $run6->fetch_assoc();
                                                    $label_name = $row6['label'];
                                                }
                                                if ($col == "start_time") {
                                                    $timings_id = $row['timings_id'];
                                                    $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                                    $run6 = $conn->query($s6);
                                                    $row6 = $run6->fetch_assoc();

                                                    $start_time = $row6['start_time'];
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
                                                }
                                                if ($col == "end_time") {
                                                    $timings_id = $row['timings_id'];
                                                    $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                                    $run6 = $conn->query($s6);
                                                    $row6 = $run6->fetch_assoc();

                                                    $end_time = $row6['end_time'];

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
                                                    }
                                                }
                                                if ($col == "capacity") {
                                                    $jk_id = $row['jk_id'];
                                                    $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                                    $run4 = $conn->query($s4);
                                                    $row4 = $run4->fetch_assoc();
                                                    $capacity = $row4['capacity'];
                                                }
                                                if ($col == "rent") {
                                                    $date = $row['date'];
                                                    $jk_id = $row['jk_id'];
                                                    $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                    $run20 = $conn->query($s20);
                                                    if ($run20->num_rows > 0) {
                                                        $row20 = $run20->fetch_assoc();
                                                        $amount = $row20['amount'];
                                                    }
                                                }
                                                if ($col == "rentp") {
                                                    $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                                    $run7 = $conn->query($s7);
                                                    $total_rent_paid = 0;
                                                    if ($run7->num_rows > 0) {
                                                        while ($row7 = $run7->fetch_assoc()) {
                                                            $a = $row7['amount'];
                                                            $debit = $row7['debit'];

                                                            if ($debit == "1") {
                                                                $total_rent_paid = $total_rent_paid + $a;
                                                            } else {
                                                                $total_rent_paid = $total_rent_paid - $a;
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($col == "rentc") {

                                                    $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                                    $run8 = $conn->query($s8);
                                                    $total_rent_cleared = 0;

                                                    if ($run8->num_rows > 0) {
                                                        while ($row8 = $run8->fetch_assoc()) {
                                                            $a = $row8['amount'];
                                                            $debit = $row8['debit'];
                                                            if ($debit == "1") {
                                                                $total_rent_cleared = $total_rent_cleared + $a;
                                                            } else {
                                                                $total_rent_cleared = $total_rent_cleared - $a;
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($col == "admin") {
                                                    $adminid = $row['adminid'];
                                                    $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                                    $runq = $conn->query($sqlq);
                                                    $rowq = $runq->fetch_assoc();
                                                    $admin_name = $rowq['name'];
                                                }
                                                if ($col == "laagat") {
                                                    $laagat = $row['laagat'];
                                                }
                                                if ($col == "thaals") {
                                                    $thaals = $row['thaals'];
                                                }
                                                if ($col == "purpose") {
                                                    $purpose = $row['purpose'];
                                                }
                                                if ($col == "scd") {
                                                    $scd = $row['sc_deposit'];
                                                }
                                                if ($col == "m") {
                                                    $manager_approval = $row['manager_approval'];
                                                }
                                                if ($col == "rs") {
                                                    $rs = $row['refund_sc'];
                                                }
                                                if ($col == "bks") {
                                                    $status = $row['status'];
                                                }
                                                if ($col == "formid") {
                                                    $formid = $row['formid'];
                                                }
                                                if ($col == "garbage") {
                                                    $garbage = $row['garbage'];
                                                }
                                                if ($col == "pdf") {
                                                    $file = '';
                                                    $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                                    $runr = $conn->query($sr);
                                                    if ($runr->num_rows > 0) {
                                                        $rowr = $runr->fetch_assoc();
                                                        $file = $rowr['file'];
                                                    }
                                                }
                                            }








                                        ?>
                                            <tr>
                                                <?php
                                                foreach ($checkbox as $col) {
                                                    echo "<td>";
                                                    if ($col == "bkid") {
                                                        echo $id;
                                                    }
                                                    if ($col == "its") {
                                                        echo $its;
                                                    }
                                                    if ($col == "name") {
                                                        echo $name;
                                                    }
                                                    if ($col == "mobile") {
                                                        echo $mobile;
                                                    }
                                                    if ($col == "jk") {
                                                        echo $jk_name;
                                                    }
                                                    if ($col == "date") {
                                                        echo $date;
                                                    }
                                                    if ($col == "timing") {
                                                        echo $label_name;
                                                    }
                                                    if ($col == "start_time") {
                                                        echo $final_start_time;
                                                    }
                                                    if ($col == "end_time") {
                                                        echo $final_end_time;
                                                    }
                                                    if ($col == "capacity") {
                                                        echo $capacity;
                                                    }
                                                    if ($col == "rent") {
                                                        echo $amount;
                                                    }
                                                    if ($col == "rentp") {
                                                        echo $total_rent_paid;
                                                    }
                                                    if ($col == "rentc") {
                                                        echo $total_rent_cleared;
                                                    }
                                                    if ($col == "admin") {
                                                        echo $admin_name;
                                                    }
                                                    if ($col == "laagat") {
                                                        echo $laagat;
                                                    }
                                                    if ($col == "thaals") {
                                                        echo $thaals;
                                                    }
                                                    if ($col == "purpose") {
                                                        echo $purpose;
                                                    }
                                                    if ($col == "scd") {
                                                        echo $scd;
                                                    }
                                                    if ($col == "m") {
                                                        if ($manager_approval == "0") {
                                                            echo "In Progress";
                                                        }
                                                        if ($manager_approval == "1") {
                                                            echo "Approved";
                                                        }

                                                        if ($manager_approval == "2") {
                                                            echo "Denied";
                                                        }
                                                    }
                                                    if ($col == "rs") {
                                                        if ($rs == "0") {
                                                            echo "In Progress";
                                                        }
                                                        if ($rs == "1") {
                                                            echo "Refunded";
                                                        }

                                                        if ($rs == "2") {
                                                            echo "Not Refunded";
                                                        }
                                                    }
                                                    if ($col == "bks") {
                                                        if ($status == "1") {
                                                            echo "Payment Pending";
                                                        }
                                                        if ($status == "2") {
                                                            echo "Clearance Pending";
                                                        }
                                                        if ($status == "3") {
                                                            echo "Booked";
                                                        }

                                                        if ($status == "4") {
                                                            echo "Cancelled";
                                                        }
                                                        if ($status == "5") {
                                                            echo "Deleted";
                                                        }
                                                    }
                                                    if ($col == "formid") {
                                                        echo $formid;
                                                    }
                                                    if ($col == "garbage") {
                                                        echo $garbage;
                                                    }
                                                    if ($col == "pdf") {
                                                        if (empty($file)) {
                                                        } else {
                                                ?>
                                                            <a href='<?php echo $file ?>' target="_blank">View</a>
                                                <?php  }
                                                    }

                                                    echo "</td>";
                                                }


                                                ?>


                                            </tr>
                                        <?php     }

                                        ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                </div>
        </div>
    <?php
            }
            if (isset($_GET['mobile']) && $_GET['type'] == "3") {
                $mobile = $_GET['mobile'];
                $checkbox = $_GET['checkbox'];

                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE mobile='$mobile' ORDER BY date ASC";
                $run = $conn->query($sql);
                $total_booking = $run->num_rows;


    ?>

        <div class="row ml-2">
            <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <?php
                                foreach ($checkbox as $col) {
                                    echo "<th>";
                                    if ($col == "bkid") {
                                        echo "#";
                                    }
                                    if ($col == "its") {
                                        echo "ITS";
                                    }
                                    if ($col == "name") {
                                        echo "Name";
                                    }
                                    if ($col == "mobile") {
                                        echo "Mobile";
                                    }
                                    if ($col == "jk") {
                                        echo "Jamaat Khaana";
                                    }
                                    if ($col == "date") {
                                        echo "Booking Date";
                                    }
                                    if ($col == "timing") {
                                        echo "Timing";
                                    }
                                    if ($col == "start_time") {
                                        echo "Start Time";
                                    }
                                    if ($col == "end_time") {
                                        echo "End Time";
                                    }
                                    if ($col == "capacity") {
                                        echo "Capacity";
                                    }
                                    if ($col == "rent") {
                                        echo "Rent";
                                    }
                                    if ($col == "rentp") {
                                        echo "Rent Paid";
                                    }
                                    if ($col == "rentc") {
                                        echo "Rent Cleared";
                                    }
                                    if ($col == "admin") {
                                        echo "Admin";
                                    }
                                    if ($col == "laagat") {
                                        echo "Laagat";
                                    }
                                    if ($col == "thaals") {
                                        echo "Thaals";
                                    }
                                    if ($col == "purpose") {
                                        echo "Purpose";
                                    }
                                    if ($col == "scd") {
                                        echo "Security Deposit";
                                    }
                                    if ($col == "m") {
                                        echo "Manager Status";
                                    }
                                    if ($col == "rs") {
                                        echo "Refund Status";
                                    }
                                    if ($col == "bks") {
                                        echo "Booking Status";
                                    }
                                    if ($col == "formid") {
                                        echo "Form ID";
                                    }
                                    if ($col == "pdf") {
                                        echo "Pdf/Images";
                                    }
                                    if ($col == "garbage") {
                                        echo "Garbage Charge";
                                    }

                                    echo "</th>";
                                }

                                ?>
                                <!--      <th>ID</th>
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
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = $run->fetch_assoc()) {
                                $id = $row['id'];

                                foreach ($checkbox as $col) {
                                    if ($col == "bkid") {
                                        $id = $row['id'];
                                    }
                                    if ($col == "its") {
                                        $its = $row['its'];
                                    }
                                    if ($col == "name") {
                                        $name = $row['name'];
                                    }
                                    if ($col == "mobile") {
                                        $mobile = $row['mobile'];
                                    }
                                    if ($col == "jk") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                    }
                                    if ($col == "date") {
                                        $date = $row['date'];
                                    }
                                    if ($col == "timing") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();
                                        $label_name = $row6['label'];
                                    }
                                    if ($col == "start_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $start_time = $row6['start_time'];
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
                                    }
                                    if ($col == "end_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $end_time = $row6['end_time'];

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
                                        }
                                    }
                                    if ($col == "capacity") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $capacity = $row4['capacity'];
                                    }
                                    if ($col == "rent") {
                                        $date = $row['date'];
                                        $jk_id = $row['jk_id'];
                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                        $run20 = $conn->query($s20);
                                        if ($run20->num_rows > 0) {
                                            $row20 = $run20->fetch_assoc();
                                            $amount = $row20['amount'];
                                        }
                                    }
                                    if ($col == "rentp") {
                                        $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                        $run7 = $conn->query($s7);
                                        $total_rent_paid = 0;
                                        if ($run7->num_rows > 0) {
                                            while ($row7 = $run7->fetch_assoc()) {
                                                $a = $row7['amount'];
                                                $debit = $row7['debit'];

                                                if ($debit == "1") {
                                                    $total_rent_paid = $total_rent_paid + $a;
                                                } else {
                                                    $total_rent_paid = $total_rent_paid - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "rentc") {

                                        $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                        $run8 = $conn->query($s8);
                                        $total_rent_cleared = 0;

                                        if ($run8->num_rows > 0) {
                                            while ($row8 = $run8->fetch_assoc()) {
                                                $a = $row8['amount'];
                                                $debit = $row8['debit'];
                                                if ($debit == "1") {
                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                } else {
                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "admin") {
                                        $adminid = $row['adminid'];
                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                        $runq = $conn->query($sqlq);
                                        $rowq = $runq->fetch_assoc();
                                        $admin_name = $rowq['name'];
                                    }
                                    if ($col == "laagat") {
                                        $laagat = $row['laagat'];
                                    }
                                    if ($col == "thaals") {
                                        $thaals = $row['thaals'];
                                    }
                                    if ($col == "purpose") {
                                        $purpose = $row['purpose'];
                                    }
                                    if ($col == "scd") {
                                        $scd = $row['sc_deposit'];
                                    }
                                    if ($col == "m") {
                                        $manager_approval = $row['manager_approval'];
                                    }
                                    if ($col == "rs") {
                                        $rs = $row['refund_sc'];
                                    }
                                    if ($col == "bks") {
                                        $status = $row['status'];
                                    }
                                    if ($col == "formid") {
                                        $formid = $row['formid'];
                                    }
                                    if ($col == "garbage") {
                                        $garbage = $row['garbage'];
                                    }
                                    if ($col == "pdf") {
                                        $file = '';
                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                        $runr = $conn->query($sr);
                                        if ($runr->num_rows > 0) {
                                            $rowr = $runr->fetch_assoc();
                                            $file = $rowr['file'];
                                        }
                                    }
                                }








                            ?>
                                <tr>
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";
                                        if ($col == "bkid") {
                                            echo $id;
                                        }
                                        if ($col == "its") {
                                            echo $its;
                                        }
                                        if ($col == "name") {
                                            echo $name;
                                        }
                                        if ($col == "mobile") {
                                            echo $mobile;
                                        }
                                        if ($col == "jk") {
                                            echo $jk_name;
                                        }
                                        if ($col == "date") {
                                            echo $date;
                                        }
                                        if ($col == "timing") {
                                            echo $label_name;
                                        }
                                        if ($col == "start_time") {
                                            echo $final_start_time;
                                        }
                                        if ($col == "end_time") {
                                            echo $final_end_time;
                                        }
                                        if ($col == "capacity") {
                                            echo $capacity;
                                        }
                                        if ($col == "rent") {
                                            echo $amount;
                                        }
                                        if ($col == "rentp") {
                                            echo $total_rent_paid;
                                        }
                                        if ($col == "rentc") {
                                            echo $total_rent_cleared;
                                        }
                                        if ($col == "admin") {
                                            echo $admin_name;
                                        }
                                        if ($col == "laagat") {
                                            echo $laagat;
                                        }
                                        if ($col == "thaals") {
                                            echo $thaals;
                                        }
                                        if ($col == "purpose") {
                                            echo $purpose;
                                        }
                                        if ($col == "scd") {
                                            echo $scd;
                                        }
                                        if ($col == "m") {
                                            if ($manager_approval == "0") {
                                                echo "In Progress";
                                            }
                                            if ($manager_approval == "1") {
                                                echo "Approved";
                                            }

                                            if ($manager_approval == "2") {
                                                echo "Denied";
                                            }
                                        }
                                        if ($col == "rs") {
                                            if ($rs == "0") {
                                                echo "In Progress";
                                            }
                                            if ($rs == "1") {
                                                echo "Refunded";
                                            }

                                            if ($rs == "2") {
                                                echo "Not Refunded";
                                            }
                                        }
                                        if ($col == "bks") {
                                            if ($status == "1") {
                                                echo "Payment Pending";
                                            }
                                            if ($status == "2") {
                                                echo "Clearance Pending";
                                            }
                                            if ($status == "3") {
                                                echo "Booked";
                                            }

                                            if ($status == "4") {
                                                echo "Cancelled";
                                            }
                                            if ($status == "5") {
                                                echo "Deleted";
                                            }
                                        }
                                        if ($col == "formid") {
                                            echo $formid;
                                        }
                                        if ($col == "garbage") {
                                            echo $garbage;
                                        }
                                        if ($col == "pdf") {
                                            if (empty($file)) {
                                            } else {
                                    ?>
                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                    <?php  }
                                        }

                                        echo "</td>";
                                    }


                                    ?>


                                </tr>
                            <?php     }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
    </div>
<?php
            }
            if (isset($_GET['option_pp']) && $_GET['type'] == "4") {
                $pp = $_GET['option_pp'];
                $checkbox = $_GET['checkbox'];
                if ($pp == "0") {
                    $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=1 ORDER BY date ASC";
                } else {
                    $range = $_GET['daterange'];
                    list($first, $second) = explode('-', $range);

                    list($f_m, $f_d, $f_y) = explode('/', $first);
                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                    $f_first = str_replace(' ', '', $f_first0);

                    list($s_m, $s_d, $s_y) = explode('/', $second);
                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                    $f_second = str_replace(' ', '', $f_second0);
                    $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=1 AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                }
                $run = $conn->query($sql);
                $total_booking = $run->num_rows;


?>

    <div class="row ml-2">
        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <?php
                            foreach ($checkbox as $col) {
                                echo "<th>";
                                if ($col == "bkid") {
                                    echo "#";
                                }
                                if ($col == "its") {
                                    echo "ITS";
                                }
                                if ($col == "name") {
                                    echo "Name";
                                }
                                if ($col == "mobile") {
                                    echo "Mobile";
                                }
                                if ($col == "jk") {
                                    echo "Jamaat Khaana";
                                }
                                if ($col == "date") {
                                    echo "Booking Date";
                                }
                                if ($col == "timing") {
                                    echo "Timing";
                                }
                                if ($col == "start_time") {
                                    echo "Start Time";
                                }
                                if ($col == "end_time") {
                                    echo "End Time";
                                }
                                if ($col == "capacity") {
                                    echo "Capacity";
                                }
                                if ($col == "rent") {
                                    echo "Rent";
                                }
                                if ($col == "rentp") {
                                    echo "Rent Paid";
                                }
                                if ($col == "rentc") {
                                    echo "Rent Cleared";
                                }
                                if ($col == "admin") {
                                    echo "Admin";
                                }
                                if ($col == "laagat") {
                                    echo "Laagat";
                                }
                                if ($col == "thaals") {
                                    echo "Thaals";
                                }
                                if ($col == "purpose") {
                                    echo "Purpose";
                                }
                                if ($col == "scd") {
                                    echo "Security Deposit";
                                }
                                if ($col == "m") {
                                    echo "Manager Status";
                                }
                                if ($col == "rs") {
                                    echo "Refund Status";
                                }
                                if ($col == "bks") {
                                    echo "Booking Status";
                                }
                                if ($col == "formid") {
                                    echo "Form ID";
                                }
                                if ($col == "pdf") {
                                    echo "Pdf/Images";
                                }
                                if ($col == "garbage") {
                                    echo "Garbage Charge";
                                }

                                echo "</th>";
                            }

                            ?>
                            <!--      <th>ID</th>
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
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {
                                if ($col == "bkid") {
                                    $id = $row['id'];
                                }
                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }
                                if ($col == "jk") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $jk_name = $row4['name'];
                                }
                                if ($col == "date") {
                                    $date = $row['date'];
                                }
                                if ($col == "timing") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT label from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();
                                    $label_name = $row6['label'];
                                }
                                if ($col == "start_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $start_time = $row6['start_time'];
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
                                }
                                if ($col == "end_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $end_time = $row6['end_time'];

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
                                    }
                                }
                                if ($col == "capacity") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $capacity = $row4['capacity'];
                                }
                                if ($col == "rent") {
                                    $date = $row['date'];
                                    $jk_id = $row['jk_id'];
                                    $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                    $run20 = $conn->query($s20);
                                    if ($run20->num_rows > 0) {
                                        $row20 = $run20->fetch_assoc();
                                        $amount = $row20['amount'];
                                    }
                                }
                                if ($col == "rentp") {
                                    $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                    $run7 = $conn->query($s7);
                                    $total_rent_paid = 0;
                                    if ($run7->num_rows > 0) {
                                        while ($row7 = $run7->fetch_assoc()) {
                                            $a = $row7['amount'];
                                            $debit = $row7['debit'];

                                            if ($debit == "1") {
                                                $total_rent_paid = $total_rent_paid + $a;
                                            } else {
                                                $total_rent_paid = $total_rent_paid - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "rentc") {

                                    $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                    $run8 = $conn->query($s8);
                                    $total_rent_cleared = 0;

                                    if ($run8->num_rows > 0) {
                                        while ($row8 = $run8->fetch_assoc()) {
                                            $a = $row8['amount'];
                                            $debit = $row8['debit'];
                                            if ($debit == "1") {
                                                $total_rent_cleared = $total_rent_cleared + $a;
                                            } else {
                                                $total_rent_cleared = $total_rent_cleared - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "admin") {
                                    $adminid = $row['adminid'];
                                    $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                    $runq = $conn->query($sqlq);
                                    $rowq = $runq->fetch_assoc();
                                    $admin_name = $rowq['name'];
                                }
                                if ($col == "laagat") {
                                    $laagat = $row['laagat'];
                                }
                                if ($col == "thaals") {
                                    $thaals = $row['thaals'];
                                }
                                if ($col == "purpose") {
                                    $purpose = $row['purpose'];
                                }
                                if ($col == "scd") {
                                    $scd = $row['sc_deposit'];
                                }
                                if ($col == "m") {
                                    $manager_approval = $row['manager_approval'];
                                }
                                if ($col == "rs") {
                                    $rs = $row['refund_sc'];
                                }
                                if ($col == "bks") {
                                    $status = $row['status'];
                                }
                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                                if ($col == "pdf") {
                                    $file = '';
                                    $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                    $runr = $conn->query($sr);
                                    if ($runr->num_rows > 0) {
                                        $rowr = $runr->fetch_assoc();
                                        $file = $rowr['file'];
                                    }
                                }
                            }








                        ?>
                            <tr>
                                <?php
                                foreach ($checkbox as $col) {
                                    echo "<td>";
                                    if ($col == "bkid") {
                                        echo $id;
                                    }
                                    if ($col == "its") {
                                        echo $its;
                                    }
                                    if ($col == "name") {
                                        echo $name;
                                    }
                                    if ($col == "mobile") {
                                        echo $mobile;
                                    }
                                    if ($col == "jk") {
                                        echo $jk_name;
                                    }
                                    if ($col == "date") {
                                        echo $date;
                                    }
                                    if ($col == "timing") {
                                        echo $label_name;
                                    }
                                    if ($col == "start_time") {
                                        echo $final_start_time;
                                    }
                                    if ($col == "end_time") {
                                        echo $final_end_time;
                                    }
                                    if ($col == "capacity") {
                                        echo $capacity;
                                    }
                                    if ($col == "rent") {
                                        echo $amount;
                                    }
                                    if ($col == "rentp") {
                                        echo $total_rent_paid;
                                    }
                                    if ($col == "rentc") {
                                        echo $total_rent_cleared;
                                    }
                                    if ($col == "admin") {
                                        echo $admin_name;
                                    }
                                    if ($col == "laagat") {
                                        echo $laagat;
                                    }
                                    if ($col == "thaals") {
                                        echo $thaals;
                                    }
                                    if ($col == "purpose") {
                                        echo $purpose;
                                    }
                                    if ($col == "scd") {
                                        echo $scd;
                                    }
                                    if ($col == "m") {
                                        if ($manager_approval == "0") {
                                            echo "In Progress";
                                        }
                                        if ($manager_approval == "1") {
                                            echo "Approved";
                                        }

                                        if ($manager_approval == "2") {
                                            echo "Denied";
                                        }
                                    }
                                    if ($col == "rs") {
                                        if ($rs == "0") {
                                            echo "In Progress";
                                        }
                                        if ($rs == "1") {
                                            echo "Refunded";
                                        }

                                        if ($rs == "2") {
                                            echo "Not Refunded";
                                        }
                                    }
                                    if ($col == "bks") {
                                        if ($status == "1") {
                                            echo "Payment Pending";
                                        }
                                        if ($status == "2") {
                                            echo "Clearance Pending";
                                        }
                                        if ($status == "3") {
                                            echo "Booked";
                                        }

                                        if ($status == "4") {
                                            echo "Cancelled";
                                        }
                                        if ($status == "5") {
                                            echo "Deleted";
                                        }
                                    }
                                    if ($col == "formid") {
                                        echo $formid;
                                    }
                                    if ($col == "garbage") {
                                        echo $garbage;
                                    }
                                    if ($col == "pdf") {
                                        if (empty($file)) {
                                        } else {
                                ?>
                                            <a href='<?php echo $file ?>' target="_blank">View</a>
                                <?php  }
                                    }

                                    echo "</td>";
                                }


                                ?>


                            </tr>
                        <?php     }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>
    </div>
<?php
            }
            if (isset($_GET['jk_id']) and $_GET['type'] == "5") {
                $jk_id = $_GET['jk_id'];
                if ($jk_id == "0") {
                    $sql = "SELECT jk_id,timings_id,date,label from blocked";
                } else {
                    $sql = "SELECT jk_id,timings_id,date,label from blocked WHERE jk_id=$jk_id";
                }
                $run = $conn->query($sql);
?>
    <div class="row ml-2">
        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <th>Jamaat Khaana Name</th>
                            <th>Block Date</th>
                            <th>Timing</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $run->fetch_assoc()) {
                            $jk = $row['jk_id'];
                            $timings_id = $row['timings_id'];
                            $date = $row['date'];
                            $reason = $row['label'];
                            $s4 = "SELECT name from jk_info WHERE id=$jk";
                            $run4 = $conn->query($s4);
                            $row4 = $run4->fetch_assoc();
                            $jk_name = $row4['name'];

                            $s6 = "SELECT label,start_time,end_time from timings WHERE id=$timings_id";
                            $run6 = $conn->query($s6);
                            $row6 = $run6->fetch_assoc();
                            $label_name = $row6['label'];

                            $start_time = $row6['start_time'];
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

                            $end_time = $row6['end_time'];

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
                            }
                        ?>
                            <tr>
                                <td><?php echo $jk_name ?></td>
                                <td><?php echo $date ?></td>
                                <td><?php echo $label_name ?></td>
                                <td><?php echo $final_start_time ?></td>
                                <td><?php echo $final_end_time ?></td>
                                <td><?php echo $reason ?></td>
                            </tr>
                        <?php   }
                    }
                    if (isset($_GET['jk_id']) && ($_GET['type'] == "6")  && isset($_GET['status']) && isset($_GET['daterange'])) {
                        $jk_id = $_GET['jk_id'];

                        $status = $_GET['status'];
                        $range = $_GET['daterange'];
                        $checkbox = $_GET['checkbox'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);

                        if ($jk_id == "0" && $status == "0") {
                            $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                        } else if ($jk_id != "0" && $status == "0") {

                            $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE jk_id=$jk_id AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                        } else if ($jk_id == "0" && $status != "0") {

                            if ($status == "5") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=3 AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "6") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE (status!=4 AND status!=5) AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "7") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=5 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=$status AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            }
                        } else if ($jk_id != "0" && $status != "0") {
                            if ($status == "5") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=3 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "6") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE (status!=4 AND status!=5) AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "7") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=5 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE status=$status AND jk_id=$jk_id  AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            }
                        }
                        $run = $conn->query($sql);


                        ?>

                        <div class="row ml-2">
                            <div class="card ml-2 mb-4"">
                                        <div class=" card-header">Info</div>
                            <div class=" card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                        <thead>
                                            <tr>
                                                <?php
                                                foreach ($checkbox as $col) {
                                                    echo "<th>";
                                                    if ($col == "bkid") {
                                                        echo "#";
                                                    }
                                                    if ($col == "its") {
                                                        echo "ITS";
                                                    }
                                                    if ($col == "name") {
                                                        echo "Name";
                                                    }
                                                    if ($col == "mobile") {
                                                        echo "Mobile";
                                                    }
                                                    if ($col == "jk") {
                                                        echo "Jamaat Khaana";
                                                    }
                                                    if ($col == "date") {
                                                        echo "Booking Date";
                                                    }
                                                    if ($col == "timing") {
                                                        echo "Timing";
                                                    }
                                                    if ($col == "start_time") {
                                                        echo "Start Time";
                                                    }
                                                    if ($col == "end_time") {
                                                        echo "End Time";
                                                    }
                                                    if ($col == "capacity") {
                                                        echo "Capacity";
                                                    }
                                                    if ($col == "rent") {
                                                        echo "Rent";
                                                    }
                                                    if ($col == "rentp") {
                                                        echo "Rent Paid";
                                                    }
                                                    if ($col == "rentc") {
                                                        echo "Rent Cleared";
                                                    }
                                                    if ($col == "admin") {
                                                        echo "Admin";
                                                    }
                                                    if ($col == "laagat") {
                                                        echo "Laagat";
                                                    }
                                                    if ($col == "thaals") {
                                                        echo "Thaals";
                                                    }
                                                    if ($col == "purpose") {
                                                        echo "Purpose";
                                                    }
                                                    if ($col == "scd") {
                                                        echo "Security Deposit";
                                                    }
                                                    if ($col == "m") {
                                                        echo "Manager Status";
                                                    }
                                                    if ($col == "rs") {
                                                        echo "Refund Status";
                                                    }
                                                    if ($col == "bks") {
                                                        echo "Booking Status";
                                                    }
                                                    if ($col == "formid") {
                                                        echo "Form ID";
                                                    }
                                                    if ($col == "pdf") {
                                                        echo "Pdf/Images";
                                                    }
                                                    if ($col == "garbage") {
                                                        echo "Garbage Charge";
                                                    }

                                                    echo "</th>";
                                                }

                                                ?>
                                                <!--      <th>ID</th>
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
                                                        <th>Rent Paid</th>
                                                        <th>Rent Cleared</th>
                                                        <th>Status</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];

                                                foreach ($checkbox as $col) {
                                                    if ($col == "bkid") {
                                                        $id = $row['id'];
                                                    }
                                                    if ($col == "its") {
                                                        $its = $row['its'];
                                                    }
                                                    if ($col == "name") {
                                                        $name = $row['name'];
                                                    }
                                                    if ($col == "mobile") {
                                                        $mobile = $row['mobile'];
                                                    }
                                                    if ($col == "jk") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                    }
                                                    if ($col == "date") {
                                                        $date = $row['date'];
                                                    }
                                                    if ($col == "timing") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();
                                                        $label_name = $row6['label'];
                                                    }
                                                    if ($col == "start_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $start_time = $row6['start_time'];
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
                                                    }
                                                    if ($col == "end_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $end_time = $row6['end_time'];

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
                                                        }
                                                    }
                                                    if ($col == "capacity") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $capacity = $row4['capacity'];
                                                    }
                                                    if ($col == "rent") {
                                                        $date = $row['date'];
                                                        $jk_id = $row['jk_id'];
                                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                        $run20 = $conn->query($s20);
                                                        if ($run20->num_rows > 0) {
                                                            $row20 = $run20->fetch_assoc();
                                                            $amount = $row20['amount'];
                                                        }
                                                    }
                                                    if ($col == "rentp") {
                                                        $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                                        $run7 = $conn->query($s7);
                                                        $total_rent_paid = 0;
                                                        if ($run7->num_rows > 0) {
                                                            while ($row7 = $run7->fetch_assoc()) {
                                                                $a = $row7['amount'];
                                                                $debit = $row7['debit'];

                                                                if ($debit == "1") {
                                                                    $total_rent_paid = $total_rent_paid + $a;
                                                                } else {
                                                                    $total_rent_paid = $total_rent_paid - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "rentc") {

                                                        $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                                        $run8 = $conn->query($s8);
                                                        $total_rent_cleared = 0;

                                                        if ($run8->num_rows > 0) {
                                                            while ($row8 = $run8->fetch_assoc()) {
                                                                $a = $row8['amount'];
                                                                $debit = $row8['debit'];
                                                                if ($debit == "1") {
                                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                                } else {
                                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "admin") {
                                                        $adminid = $row['adminid'];
                                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                                        $runq = $conn->query($sqlq);
                                                        $rowq = $runq->fetch_assoc();
                                                        $admin_name = $rowq['name'];
                                                    }
                                                    if ($col == "laagat") {
                                                        $laagat = $row['laagat'];
                                                    }
                                                    if ($col == "thaals") {
                                                        $thaals = $row['thaals'];
                                                    }
                                                    if ($col == "purpose") {
                                                        $purpose = $row['purpose'];
                                                    }
                                                    if ($col == "scd") {
                                                        $scd = $row['sc_deposit'];
                                                    }
                                                    if ($col == "m") {
                                                        $manager_approval = $row['manager_approval'];
                                                    }
                                                    if ($col == "rs") {
                                                        $rs = $row['refund_sc'];
                                                    }
                                                    if ($col == "bks") {
                                                        $status = $row['status'];
                                                    }
                                                    if ($col == "formid") {
                                                        $formid = $row['formid'];
                                                    }
                                                    if ($col == "garbage") {
                                                        $garbage = $row['garbage'];
                                                    }
                                                    if ($col == "pdf") {
                                                        $file = '';
                                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                                        $runr = $conn->query($sr);
                                                        if ($runr->num_rows > 0) {
                                                            $rowr = $runr->fetch_assoc();
                                                            $file = $rowr['file'];
                                                        }
                                                    }
                                                }








                                            ?>
                                                <tr>
                                                    <?php
                                                    foreach ($checkbox as $col) {
                                                        echo "<td>";
                                                        if ($col == "bkid") {
                                                            echo $id;
                                                        }
                                                        if ($col == "its") {
                                                            echo $its;
                                                        }
                                                        if ($col == "name") {
                                                            echo $name;
                                                        }
                                                        if ($col == "mobile") {
                                                            echo $mobile;
                                                        }
                                                        if ($col == "jk") {
                                                            echo $jk_name;
                                                        }
                                                        if ($col == "date") {
                                                            echo $date;
                                                        }
                                                        if ($col == "timing") {
                                                            echo $label_name;
                                                        }
                                                        if ($col == "start_time") {
                                                            echo $final_start_time;
                                                        }
                                                        if ($col == "end_time") {
                                                            echo $final_end_time;
                                                        }
                                                        if ($col == "capacity") {
                                                            echo $capacity;
                                                        }
                                                        if ($col == "rent") {
                                                            echo $amount;
                                                        }
                                                        if ($col == "rentp") {
                                                            echo $total_rent_paid;
                                                        }
                                                        if ($col == "rentc") {
                                                            echo $total_rent_cleared;
                                                        }
                                                        if ($col == "admin") {
                                                            echo $admin_name;
                                                        }
                                                        if ($col == "laagat") {
                                                            echo $laagat;
                                                        }
                                                        if ($col == "thaals") {
                                                            echo $thaals;
                                                        }
                                                        if ($col == "purpose") {
                                                            echo $purpose;
                                                        }
                                                        if ($col == "scd") {
                                                            echo $scd;
                                                        }
                                                        if ($col == "m") {
                                                            if ($manager_approval == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($manager_approval == "1") {
                                                                echo "Approved";
                                                            }

                                                            if ($manager_approval == "2") {
                                                                echo "Denied";
                                                            }
                                                        }
                                                        if ($col == "rs") {
                                                            if ($rs == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($rs == "1") {
                                                                echo "Refunded";
                                                            }

                                                            if ($rs == "2") {
                                                                echo "Not Refunded";
                                                            }
                                                        }
                                                        if ($col == "bks") {
                                                            if ($status == "1") {
                                                                echo "Payment Pending";
                                                            }
                                                            if ($status == "2") {
                                                                echo "Clearance Pending";
                                                            }
                                                            if ($status == "3") {
                                                                echo "Booked";
                                                            }

                                                            if ($status == "4") {
                                                                echo "Cancelled";
                                                            }
                                                            if ($status == "5") {
                                                                echo "Deleted";
                                                            }
                                                        }
                                                        if ($col == "formid") {
                                                            echo $formid;
                                                        }
                                                        if ($col == "garbage") {
                                                            echo $garbage;
                                                        }
                                                        if ($col == "pdf") {
                                                            if (empty($file)) {
                                                            } else {
                                                    ?>
                                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                                    <?php  }
                                                        }

                                                        echo "</td>";
                                                    }


                                                    ?>


                                                </tr>
                                            <?php     }

                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

            </div>
        </div>
    <?php
                    }
                    if (isset($_GET['id']) && $_GET['type'] == "7") {
                        $id = $_GET['id'];
                        $checkbox = $_GET['checkbox'];

                        $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE id=$id ORDER BY date ASC";
                        $run = $conn->query($sql);
                        $total_booking = $run->num_rows;


    ?>

        <div class="row ml-2">
            <div class="card ml-2 mb-4"">
                                    <div class=" card-header">Info</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <?php
                                foreach ($checkbox as $col) {
                                    echo "<th>";
                                    if ($col == "bkid") {
                                        echo "#";
                                    }
                                    if ($col == "its") {
                                        echo "ITS";
                                    }
                                    if ($col == "name") {
                                        echo "Name";
                                    }
                                    if ($col == "mobile") {
                                        echo "Mobile";
                                    }
                                    if ($col == "jk") {
                                        echo "Jamaat Khaana";
                                    }
                                    if ($col == "date") {
                                        echo "Booking Date";
                                    }
                                    if ($col == "timing") {
                                        echo "Timing";
                                    }
                                    if ($col == "start_time") {
                                        echo "Start Time";
                                    }
                                    if ($col == "end_time") {
                                        echo "End Time";
                                    }
                                    if ($col == "capacity") {
                                        echo "Capacity";
                                    }
                                    if ($col == "rent") {
                                        echo "Rent";
                                    }
                                    if ($col == "rentp") {
                                        echo "Rent Paid";
                                    }
                                    if ($col == "rentc") {
                                        echo "Rent Cleared";
                                    }
                                    if ($col == "admin") {
                                        echo "Admin";
                                    }
                                    if ($col == "laagat") {
                                        echo "Laagat";
                                    }
                                    if ($col == "thaals") {
                                        echo "Thaals";
                                    }
                                    if ($col == "purpose") {
                                        echo "Purpose";
                                    }
                                    if ($col == "scd") {
                                        echo "Security Deposit";
                                    }
                                    if ($col == "m") {
                                        echo "Manager Status";
                                    }
                                    if ($col == "rs") {
                                        echo "Refund Status";
                                    }
                                    if ($col == "bks") {
                                        echo "Booking Status";
                                    }
                                    if ($col == "formid") {
                                        echo "Form ID";
                                    }
                                    if ($col == "pdf") {
                                        echo "Pdf/Images";
                                    }
                                    if ($col == "garbage") {
                                        echo "Garbage Charge";
                                    }

                                    echo "</th>";
                                }

                                ?>
                                <!--      <th>ID</th>
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
                                                    <th>Rent Paid</th>
                                                    <th>Rent Cleared</th>
                                                    <th>Status</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = $run->fetch_assoc()) {
                                $id = $row['id'];

                                foreach ($checkbox as $col) {
                                    if ($col == "bkid") {
                                        $id = $row['id'];
                                    }
                                    if ($col == "its") {
                                        $its = $row['its'];
                                    }
                                    if ($col == "name") {
                                        $name = $row['name'];
                                    }
                                    if ($col == "mobile") {
                                        $mobile = $row['mobile'];
                                    }
                                    if ($col == "jk") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                    }
                                    if ($col == "date") {
                                        $date = $row['date'];
                                    }
                                    if ($col == "timing") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();
                                        $label_name = $row6['label'];
                                    }
                                    if ($col == "start_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $start_time = $row6['start_time'];
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
                                    }
                                    if ($col == "end_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $end_time = $row6['end_time'];

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
                                        }
                                    }
                                    if ($col == "capacity") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $capacity = $row4['capacity'];
                                    }
                                    if ($col == "rent") {
                                        $date = $row['date'];
                                        $jk_id = $row['jk_id'];
                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                        $run20 = $conn->query($s20);
                                        if ($run20->num_rows > 0) {
                                            $row20 = $run20->fetch_assoc();
                                            $amount = $row20['amount'];
                                        }
                                    }
                                    if ($col == "rentp") {
                                        $s7 = "SELECT amount,debit from ledger WHERE booking_id=$id  AND (status=0 OR status=1)";
                                        $run7 = $conn->query($s7);
                                        $total_rent_paid = 0;
                                        if ($run7->num_rows > 0) {
                                            while ($row7 = $run7->fetch_assoc()) {
                                                $a = $row7['amount'];
                                                $debit = $row7['debit'];

                                                if ($debit == "1") {
                                                    $total_rent_paid = $total_rent_paid + $a;
                                                } else {
                                                    $total_rent_paid = $total_rent_paid - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "rentc") {


                                        $s8 = "SELECT amount,debit from ledger WHERE booking_id=$id AND status=1";
                                        $run8 = $conn->query($s8);
                                        $total_rent_cleared = 0;

                                        if ($run8->num_rows > 0) {
                                            while ($row8 = $run8->fetch_assoc()) {
                                                $a = $row8['amount'];
                                                $debit = $row8['debit'];
                                                if ($debit == "1") {
                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                } else {
                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "admin") {
                                        $adminid = $row['adminid'];
                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                        $runq = $conn->query($sqlq);
                                        $rowq = $runq->fetch_assoc();
                                        $admin_name = $rowq['name'];
                                    }
                                    if ($col == "laagat") {
                                        $laagat = $row['laagat'];
                                    }
                                    if ($col == "thaals") {
                                        $thaals = $row['thaals'];
                                    }
                                    if ($col == "purpose") {
                                        $purpose = $row['purpose'];
                                    }
                                    if ($col == "scd") {
                                        $scd = $row['sc_deposit'];
                                    }
                                    if ($col == "m") {
                                        $manager_approval = $row['manager_approval'];
                                    }
                                    if ($col == "rs") {
                                        $rs = $row['refund_sc'];
                                    }
                                    if ($col == "bks") {
                                        $status = $row['status'];
                                    }
                                    if ($col == "formid") {
                                        $formid = $row['formid'];
                                    }
                                    if ($col == "garbage") {
                                        $garbage = $row['garbage'];
                                    }
                                    if ($col == "pdf") {
                                        $file = '';
                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                        $runr = $conn->query($sr);
                                        if ($runr->num_rows > 0) {
                                            $rowr = $runr->fetch_assoc();
                                            $file = $rowr['file'];
                                        }
                                    }
                                }








                            ?>
                                <tr>
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";
                                        if ($col == "bkid") {
                                            echo $id;
                                        }
                                        if ($col == "its") {
                                            echo $its;
                                        }
                                        if ($col == "name") {
                                            echo $name;
                                        }
                                        if ($col == "mobile") {
                                            echo $mobile;
                                        }
                                        if ($col == "jk") {
                                            echo $jk_name;
                                        }
                                        if ($col == "date") {
                                            echo $date;
                                        }
                                        if ($col == "timing") {
                                            echo $label_name;
                                        }
                                        if ($col == "start_time") {
                                            echo $final_start_time;
                                        }
                                        if ($col == "end_time") {
                                            echo $final_end_time;
                                        }
                                        if ($col == "capacity") {
                                            echo $capacity;
                                        }
                                        if ($col == "rent") {
                                            echo $amount;
                                        }
                                        if ($col == "rentp") {
                                            echo $total_rent_paid;
                                        }
                                        if ($col == "rentc") {
                                            echo $total_rent_cleared;
                                        }
                                        if ($col == "admin") {
                                            echo $admin_name;
                                        }
                                        if ($col == "laagat") {
                                            echo $laagat;
                                        }
                                        if ($col == "thaals") {
                                            echo $thaals;
                                        }
                                        if ($col == "purpose") {
                                            echo $purpose;
                                        }
                                        if ($col == "scd") {
                                            echo $scd;
                                        }
                                        if ($col == "m") {
                                            if ($manager_approval == "0") {
                                                echo "In Progress";
                                            }
                                            if ($manager_approval == "1") {
                                                echo "Approved";
                                            }

                                            if ($manager_approval == "2") {
                                                echo "Denied";
                                            }
                                        }
                                        if ($col == "rs") {
                                            if ($rs == "0") {
                                                echo "In Progress";
                                            }
                                            if ($rs == "1") {
                                                echo "Refunded";
                                            }

                                            if ($rs == "2") {
                                                echo "Not Refunded";
                                            }
                                        }
                                        if ($col == "bks") {
                                            if ($status == "1") {
                                                echo "Payment Pending";
                                            }
                                            if ($status == "2") {
                                                echo "Clearance Pending";
                                            }
                                            if ($status == "3") {
                                                echo "Booked";
                                            }

                                            if ($status == "4") {
                                                echo "Cancelled";
                                            }
                                            if ($status == "5") {
                                                echo "Deleted";
                                            }
                                        }
                                        if ($col == "formid") {
                                            echo $formid;
                                        }
                                        if ($col == "garbage") {
                                            echo $garbage;
                                        }
                                        if ($col == "pdf") {
                                            if (empty($file)) {
                                            } else {
                                    ?>
                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                    <?php  }
                                        }

                                        echo "</td>";
                                    }


                                    ?>


                                </tr>
                            <?php     }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
    </div>
<?php
                    }
                    if (isset($_GET['type']) && $_GET['type'] == "8") {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);

                        $c_ledger = $_GET['c_ledger'];
                        $c_ledger1 = $_GET['c_ledger_1'];
                        if ($c_ledger1 == "2") {

                            if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1  AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=2 AND  (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1 AND type=$c_ledger1   AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        } else {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1  AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1 AND type=$c_ledger1 AND type!=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        }
                        $run = $conn->query($sql);
?>

    <div class="row">
        <div class="card ml-4 mb-4" style="width: 100%;">
            <div class=" card-header">Cash Ledger</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Debit</th>

                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Receipt</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = $run->fetch_assoc()) {
                                $amount = $row['amount'];
                                $time = $row['time'];
                                $name = $row['name'];
                                $ledger_id = $row['id'];
                                $bk_id = $row['bk_id'];
                                $debit = $row['debit'];
                                $credit = $row['credit'];
                                $date = $row['c_date'];
                                $type = $row['type'];
                                $id = $row['id'];
                                $trust_id = $row['trust_id'];
                                $status = $row['status'];


                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php if ($bk_id == "0" || $type == "5") {
                                            echo $name . " (" . $bk_id . ")";
                                        } else {
                                            $s1 = "SELECT name from booking_info WHERE id=$bk_id";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $name1 = $row1['name'] . " (" . $bk_id . ")";
                                        } ?></td>
                                    <td><?php
                                        if ($type == "0") {
                                            $s11 = "SELECT purpose from booking_info WHERE id=$bk_id";
                                            $run11 = $conn->query($s11);
                                            $row11 = $run11->fetch_assoc();
                                            echo $purpose = $row11['purpose'];
                                        }
                                        if ($type == "1") {
                                            echo "Security Deposit";
                                        }
                                        if ($type == "2") {
                                            echo "Refund Security Deposit";
                                        }
                                        if ($type == "3") {
                                            echo "Garbage";
                                        }
                                        if ($type == "4") {
                                            echo "Miscellaneous";
                                        }
                                        if ($type == "5") {
                                            echo "Payment Voucher";
                                        }

                                        ?></td>

                                    <td style="color: #000000;"><b><?php if ($credit == "1") {
                                            echo $amount;
                                        } else {
                                            echo "-";
                                        } ?></b></td>
                                    <td style="color: #000000;"><b><?php if ($debit == "1") {
                                            echo $amount;
                                        } else {
                                            echo "-";
                                        } ?></b></td>

                                    <td style="color: #000000;"><b><?php
                                        if ($status == "3") {
                                            echo "Deleted";
                                        } else if($status == "4")
                                        {
                                            echo "Previous Entry";

                                        } else {

                                            if ($debit == "1") {
                                                echo $sum = $sum + $amount;
                                            } else {
                                                echo $sum = $sum - $amount;
                                            }
                                        }

                                        ?></b></td>
                                    <td><a href="<?php
                                                    if ($type == "0") {
                                                        echo "receipt.php?name=Cash&bk_id=" . $bk_id;
                                                    }
                                                    if ($type == "1") {
                                                        echo "receipt.php?name=SDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "2") {
                                                        echo "receipt.php?name=RSDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "3") {
                                                        echo "receipt.php?name=G&ID=" . $bk_id;
                                                    }
                                                    if ($type == "4") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt.php?name=MISC&date=" . $date . "&time=" . $time . "&name_user=" . $name . "&amount=" . $amount . "&purpose=" . $purpose_misc;
                                                    }
                                                    if ($type == "5") {

                                                        echo "receipt.php?name=VOUCHER&ledger_id=" . $ledger_id . "&trust_id=" . $trust_id;
                                                    }

                                                    ?>" target="_blank">View</a></td>


                                </tr>
                            <?php     }



                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
                    }
                    if (isset($_GET['type']) && $_GET['type'] == "9") {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);
                        $c_ledger = $_GET['c_ledger'];
                        $c_ledger1 = $_GET['c_ledger_1'];

                        if ($c_ledger1 == "2") {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger2
                            WHERE pay_mode=0 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger3
                            WHERE pay_mode=0  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger2
                            WHERE pay_mode=0 AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger3
                            WHERE pay_mode=0 AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            }
                        } else {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger2
                            WHERE pay_mode=0 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger3
                            WHERE pay_mode=0  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger2
                            WHERE pay_mode=0 AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status FROM ledger3
                            WHERE pay_mode=0 AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            }
                        }

                        $run = $conn->query($sql);
?>

    <div class="row">
        <div class="card ml-4 mb-4" style="width: 100%;">
            <div class=" card-header">Cheque Ledger</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Cheque Number</th>
                                <th>Account Number</th>
                                <th>Debit</th>

                                <th>Credit</th>

                                <th>Balance</th>
                                <th>Receipt</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = $run->fetch_assoc()) {
                                $amount = $row['amount'];
                                $time = $row['time'];
                                $name = $row['name'];
                                $bk_id = $row['bk_id'];
                                $debit = $row['debit'];
                                $credit = $row['credit'];
                                $date = $row['check_cleared_date'];
                                $cn = $row['check_number'];
                                $an = $row['account_number'];
                                $ledger_id = $row['id'];
                                $type = $row['type'];
                                $status = $row['status'];


                            ?>
                                <tr>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php if ($bk_id == "0" || $type == "5") {
                                            echo $name . " (" . $bk_id . ")";
                                        } else {
                                            $s1 = "SELECT name from booking_info WHERE id=$bk_id";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $name1 = $row1['name'] . " (" . $bk_id . ")";
                                        } ?></td>
                                    <td><?php if ($type == "0") {
                                            $s11 = "SELECT purpose from booking_info WHERE id=$bk_id";
                                            $run11 = $conn->query($s11);
                                            $row11 = $run11->fetch_assoc();
                                            echo $purpose = $row11['purpose'];
                                        }
                                        if ($type == "1") {
                                            echo "Security Deposit";
                                        }
                                        if ($type == "2") {
                                            echo "Refund Security Deposit";
                                        }
                                        if ($type == "3") {
                                            echo "Garbage";
                                        }
                                        if ($type == "4") {
                                            echo "Miscellaneous";
                                        }
                                        if ($type == "5") {
                                            echo "Payment Voucher";
                                        } ?></td>

                                    <td><?php echo $cn ?></td>
                                    <td><?php echo $an  ?></td>
                                    <td style="color: #000000;"><b><?php if ($credit == "1") {
                                            echo $amount;
                                        } else {
                                            echo "-";
                                        } ?></b></td>
                                    <td style="color: #000000;"><b><?php if ($debit == "1") {
                                            echo $amount;
                                        } else {
                                            echo "-";
                                        } ?></b></td>
                                    <td style="color: #000000;"><b><?php
                                        if ($status == "3") {
                                            echo "Deleted";
                                        }
                                        else if($status == "4")
                                        {
                                            echo "Previous Entry";

                                        }
                                        else {
                                            if ($debit == "1") {
                                                echo $sum = $sum + $amount;
                                            } else {
                                                echo $sum = $sum - $amount;
                                            }
                                        }

                                        ?></b></td>
                                    <td><a href="<?php
                                                    if ($type == "0") {
                                                        echo "receipt.php?name=CN&bk_id=" . $bk_id . "&Number=" . $cn;
                                                    }
                                                    if ($type == "1") {
                                                        echo "receipt.php?name=SDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "2") {
                                                        echo "receipt.php?name=RSDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "3") {
                                                        echo "receipt.php?name=G&ID=" . $bk_id;
                                                    }
                                                    if ($type == "4") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt.php?name=MISC&date=" . $date . "&time=" . $time . "&name_user=" . $name . "&amount=" . $amount . "&purpose=" . $purpose_misc;
                                                    }
                                                    if ($type == "5") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt.php?name=VOUCHER&ledger_id=" . $ledger_id;
                                                    }

                                                    ?>" target="_blank">View</a></td>


                                </tr>
                            <?php     }



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
</div>
</div>
</div>


<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>


<script src="select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
</body>

</body>

</html>