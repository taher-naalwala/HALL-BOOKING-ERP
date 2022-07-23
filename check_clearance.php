<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "20" || $formid == "16") {
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
    <title>Cheque Clearance</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="modal_box.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheque Clearance</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }
    </style>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
</head>

<body id="page-top">

    <div id="right_modal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <img align="left" style="width:25%;height:25%;" src="images/right_caption_img.png">
            &nbsp; <b>
                <p style="font-size: large;">Success <a href="check_clearance.php">Refresh Page</a></p>
            </b>
        </div>

    </div>

    <div id="wrong_modal" class="modal">


        <div class="modal-content">
            <span class="close">&times;</span>

            <img align="left" style="width:25%;height:25%;" src="images/wrong_caption_img.png"> &nbsp;
            &nbsp;<b>
                <p style="font-size: x-large">Fail</p>
            </b>
        </div>

    </div>
    <div id="wrapper">
        <?php
        require('style.php');
        date_default_timezone_set('Asia/kolkata');
        $date0 = date('Y-m-d');
        $time0 = date('H:i:s');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cheque Clearance</h6>
                </div>
                <div class="card-body">
                    <!--
                    <form method="GET">
                        <div class="row">


                            <div class="col-lg-4">

                                <input name="input" placeholder="Enter Cheque Number" class="form-control">

                            </div>
                            <div class="col-lg-4">

                                <button value="check" name="check" class="btn btn-primary">Submit</button>

                            </div>
                        </div>
                    </form>

    -->

                    <?php require('connectDB.php');
                    if (isset($_GET['check'])) {

                        $check_num = $_GET['input'];

                        $sql = "SELECT booking_id,amount,check_number,account_number,pay_mode,trust_id from ledger WHERE check_number='$check_num' AND status=0";
                        $run = $conn->query($sql);
                        if ($run->num_rows > 0) {
                            while ($row = $run->fetch_assoc()) {
                                $input = $row['booking_id'];
                                $a = $row['amount'];
                                $cn = $row['check_number'];
                                $an = $row['account_number'];
                                $pay_mode = $row['pay_mode'];
                                $trust_id = $row['trust_id'];
                                $sql2 = "SELECT its,name,mobile,jk_id,timings_id,date from booking_info WHERE id=$input";


                                $run2 = $conn->query($sql2); ?>
                                <?php if ($run2->num_rows > 0) {
                                ?>
                                    <div class="row mt-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="5px">
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
                                                        <th>Capacity</th>
                                                        <th>Rent</th>
                                                        <th>Rent Paid</th>
                                                        <th>Rent Cleared</th>

                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php

                                                    while ($row = $run2->fetch_assoc()) {
                                                        $id = $input;
                                                        $its = $row['its'];
                                                        $name = $row['name'];
                                                        $s7 = "SELECT amount from ledger WHERE booking_id=$id AND debit=1 AND (status=0 OR status=1)";
                                                        $run7 = $conn->query($s7);
                                                        $total_rent_paid = 0;
                                                        if ($run7->num_rows > 0) {
                                                            while ($row7 = $run7->fetch_assoc()) {
                                                                $al = $row7['amount'];
                                                                $total_rent_paid = $total_rent_paid + $al;
                                                            }
                                                        }

                                                        $s8 = "SELECT amount from ledger WHERE booking_id=$id AND debit=1 AND (status=1)";
                                                        $run8 = $conn->query($s8);
                                                        $total_rent_cleared = 0;
                                                        if ($run8->num_rows > 0) {
                                                            while ($row8 = $run8->fetch_assoc()) {
                                                                $al = $row8['amount'];
                                                                $total_rent_cleared = $total_rent_cleared + $al;
                                                            }
                                                        }
                                                        $mobile = $row['mobile'];
                                                        $date = $row['date'];

                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                        $run20 = $conn->query($s20);
                                                        if ($run20->num_rows > 0) {
                                                            $row20 = $run20->fetch_assoc();
                                                            $amount = $row20['amount'];
                                                        }
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
                                                            <td><?php echo $label_name ?></td>
                                                            <td><?php echo $final_start_time ?></td>
                                                            <td><?php echo $final_end_time ?></td>
                                                            <td><?php echo $capacity ?></td>
                                                            <td><?php echo $amount ?></td>
                                                            <td><?php echo $total_rent_paid ?></td>
                                                            <td><?php echo $total_rent_cleared ?></td>


                                                        </tr>
                                                    <?php     }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <?php require('connectDB.php');


                                    $s2 = "SELECT name from trust WHERE id=$trust_id";
                                    $run2 = $conn->query($s2);
                                    $row2 = $run2->fetch_assoc();
                                    $trust_name = $row2['name'];
                                    $pay_name = "";
                                    if ($pay_mode == "0") {
                                        $pay_name = "Cheque";
                                    } else {
                                        $pay_name = "Cash";
                                    }


                                    ?>
                                    <form method="POST">
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <input class="form-control" value='<?php echo $trust_name ?>' readonly>
                                            </div>
                                            <input class="form-control" type="hidden" name="trust_id" value='<?php echo $trust_id ?>'>
                                        </div>

                                        <div class="col-lg-2">
                                            <input class="form-control mb-2" value='<?php echo $pay_name ?>' readonly>
                                        </div>


                                        <div class="col-lg-2"> <input name="a" class="form-control mb-2" value='<?php echo $a ?>' readonly></div>

                                        <div class="col-lg-2"> <input class="form-control" name="cn" value='<?php echo $cn ?>' readonly></div>

                                        <div class="col-lg-2"> <input class="form-control" value='<?php echo $an ?>' name="an" readonly></div>

                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <input type="text" placeholder="Date" name="date" class="form-control datepicker">
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-success" name="pass" value='<?php echo $id ?>'>Clear</button>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-danger" name="fail" value='<?php echo $id ?>'>Not Clear</button>
                    </div>
                </div>
                <?php
                                    if (isset($_POST['pass'])) {
                                        $check_number = $_GET['input'];
                                        $id = $_POST['pass'];
                                        $check_amount = $_POST['a'];
                                        $an = $_POST['an'];
                                        $first = $_POST['date'];
                                        $trust_id = $_POST['trust_id'];
                                        list($f_m, $f_d, $f_y) = explode('/', $first);
                                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                        $cl_date = str_replace(' ', '', $f_first0);
                                        $sql = "UPDATE ledger SET status=1,check_cleared_date='$cl_date' WHERE check_number='$check_number' AND account_number='$an' AND booking_id=$id";
                                        if ($trust_id == "1") {
                                            $s2 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$check_amount',$trust_id,'$check_number','$an',0,1,0,'$date0','$time0',1,'$cl_date','',0)";
                                            $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$check_amount' AND trust_id=$trust_id AND check_number='$check_number' AND account_number='$an' AND pay_mode=0 AND debit=1 AND c_date='$date0' AND time='$time0' AND status=1 AND check_cleared_date='$cl_date' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                        } else {
                                            $s2 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$check_amount',$trust_id,'$check_number','$an',0,1,0,'$date0','$time0',1,'$cl_date','',0)";
                                            $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$check_amount' AND trust_id=$trust_id AND check_number='$check_number' AND account_number='$an' AND pay_mode=0 AND debit=1 AND c_date='$date0' AND time='$time0' AND status=1 AND check_cleared_date='$cl_date' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                        }
                                        if (mysqli_query($conn, $sql)) {
                                            mysqli_query($conn, $s2);
                                            $rund = $conn->query($d2);
                                            $rowd = $rund->fetch_assoc();
                                            $d2_id = $rowd['id'];
                                            if ($trust_id == "1") {
                                                $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($d2_id)";
                                                mysqli_query($conn, $f2);
                                            } else {
                                                $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($d2_id)";
                                                mysqli_query($conn, $f2);
                                            }
                                            $s0 = "SELECT COUNT(*) as c from booking_info WHERE id=$id AND status=2";
                                            $run0 = $conn->query($s0);
                                            $row0 = $run0->fetch_assoc();
                                            $c0 = $row0['c'];
                                            if ($c0 > 0) {
                                                $s1 = "SELECT COUNT(*) as c_1 from ledger WHERE status=0 AND booking_id=$id";
                                                $run1 = $conn->query($s1);
                                                $row1 = $run1->fetch_assoc();
                                                $c_1 = $row1['c_1'];
                                                if ($c_1 > 0) {
                                                    $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                                    $run2 = $conn->query($s2);
                                                    $row2 = $run2->fetch_assoc();
                                                    $mobile = $row2['mobile'];
                                                    $its = $row2['its'];
                                                    $name = $row2['name'];
                                                    $date = $row2['date'];
                                                    $jk_id = $row2['jk_id'];
                                                    $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                    $run4 = $conn->query($s4);
                                                    $row4 = $run4->fetch_assoc();
                                                    $jk_name = $row4['name'];
                                                    $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                    $run20 = $conn->query($s20);
                                                    if ($run20->num_rows > 0) {
                                                        $row20 = $run20->fetch_assoc();
                                                        $amount = $row20['amount'];
                                                    }
                                                    $capacity = $row4['capacity'];
                                                    $timings_id = $row2['timings_id'];
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
                                                    }
                                                    $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                                    $final_msg = str_replace(" ", "%20", $msg);
                                                    $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                                    $ch = curl_init();

                                                    // set url 
                                                    curl_setopt($ch, CURLOPT_URL, $url);

                                                    //return the transfer as a string 
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                    // $output contains the output string 
                                                    $output = curl_exec($ch);


                                                    // close curl resource to free up system resources 
                                                    curl_close($ch);

                                                    echo '<div class="alert alert-success mt-2" role="alert">
                                            Success
                                           </div>';
                ?>

                                <?php     } else {
                                                    $s2 = "UPDATE booking_info SET status=3 WHERE id=$id";
                                                    if (mysqli_query($conn, $s2)) {
                                                        $s2 = "SELECT mobile,its,name,date,jk_id,timings_id from booking_info WHERE id=$id";
                                                        $run2 = $conn->query($s2);
                                                        $row2 = $run2->fetch_assoc();
                                                        $mobile = $row2['mobile'];
                                                        $its = $row2['its'];
                                                        $name = $row2['name'];
                                                        $date = $row2['date'];
                                                        $jk_id = $row2['jk_id'];
                                                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                        $run20 = $conn->query($s20);
                                                        if ($run20->num_rows > 0) {
                                                            $row20 = $run20->fetch_assoc();
                                                            $amount = $row20['amount'];
                                                        }
                                                        $capacity = $row4['capacity'];
                                                        $timings_id = $row2['timings_id'];
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
                                                        }
                                                        $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0AJamaat Khaana Booking Confirmed%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                                        $final_msg = str_replace(" ", "%20", $msg);
                                                        $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                                        $ch = curl_init();

                                                        // set url 
                                                        curl_setopt($ch, CURLOPT_URL, $url);

                                                        //return the transfer as a string 
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                        // $output contains the output string 
                                                        $output = curl_exec($ch);


                                                        // close curl resource to free up system resources 
                                                        curl_close($ch);

                                                        echo '<div class="alert alert-success mt-2" role="alert">
                                            Success
                                           </div>';



                                ?>

                    <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                            Fail
                                           </div>';
                                                    }
                                                }
                                            } else {
                                                $s1 = "SELECT COUNT(*) as c_2 from ledger WHERE status=0 AND booking_id=$id";
                                                $run1 = $conn->query($s1);
                                                $row1 = $run->fetch_assoc();
                                                $c_2 = $row1['c_2'];
                                                if ($run1->num_rows > 0) {
                                                    $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                                    $run2 = $conn->query($s2);
                                                    $row2 = $run2->fetch_assoc();
                                                    $mobile = $row2['mobile'];
                                                    $its = $row2['its'];
                                                    $name = $row2['name'];
                                                    $date = $row2['date'];
                                                    $jk_id = $row2['jk_id'];
                                                    $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                    $run4 = $conn->query($s4);
                                                    $row4 = $run4->fetch_assoc();
                                                    $jk_name = $row4['name'];
                                                    $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                    $run20 = $conn->query($s20);
                                                    if ($run20->num_rows > 0) {
                                                        $row20 = $run20->fetch_assoc();
                                                        $amount = $row20['amount'];
                                                    }
                                                    $capacity = $row4['capacity'];
                                                    $timings_id = $row2['timings_id'];
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
                                                    }
                                                    $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                                    $final_msg = str_replace(" ", "%20", $msg);
                                                    $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                                    $ch = curl_init();

                                                    // set url 
                                                    curl_setopt($ch, CURLOPT_URL, $url);

                                                    //return the transfer as a string 
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                    // $output contains the output string 
                                                    $output = curl_exec($ch);


                                                    // close curl resource to free up system resources 
                                                    curl_close($ch);

                                                    echo '<div class="alert alert-success mt-2" role="alert">
                                                Success
                                               </div>';
                                                }
                                            }
                                        }
                    ?>
                    <script type="text/javascript">
                        window.location = 'receipt.php?name=CN&Number=<?php echo $check_number ?>&bk_id=<?php echo $id ?>&trust_';
                    </script>
                <?php
                                    }

                                    if (isset($_POST['fail'])) {
                                        $check_number = $_GET['input'];
                                        $id = $_POST['fail'];
                                        $check_amount = $_POST['a'];
                                        $first = $_POST['date'];
                                        list($f_m, $f_d, $f_y) = explode('/', $first);
                                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                        $cl_date = str_replace(' ', '', $f_first0);
                                        $sql = "UPDATE ledger SET status=2,check_cleared_date='$cl_date' WHERE check_number='$check_number' AND booking_id=$id";

                                        if (mysqli_query($conn, $sql)) {

                                            $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mobile = $row2['mobile'];
                                            $its = $row2['its'];
                                            $name = $row2['name'];
                                            $date = $row2['date'];
                                            $jk_id = $row2['jk_id'];
                                            $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                            $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                            $run20 = $conn->query($s20);
                                            if ($run20->num_rows > 0) {
                                                $row20 = $run20->fetch_assoc();
                                                $amount = $row20['amount'];
                                            }
                                            $capacity = $row4['capacity'];
                                            $timings_id = $row2['timings_id'];
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
                                            }
                                            $msg = "Cheque Clearance Failed..%0D%0ACheque of Rs." . $check_amount . " Failed to Clear..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0AVisit Jamaat Office and pay the amount";
                                            $final_msg = str_replace(" ", "%20", $msg);
                                            $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                            $ch = curl_init();

                                            // set url 
                                            curl_setopt($ch, CURLOPT_URL, $url);

                                            //return the transfer as a string 
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                            // $output contains the output string 
                                            $output = curl_exec($ch);


                                            // close curl resource to free up system resources 
                                            curl_close($ch);
                                            echo '<div class="alert alert-success mt-2" role="alert">
                                            Success
                                           </div>';
                                        }
                                    }


                ?>

                </form>

    <?php
                                }
                            }
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                                           No Clearance Cheque Found
                                           </div>';
                        }
                    } else {
    ?>


    <div class="row mt-4">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                <thead>
                    <tr>
                        <th>Cheque Number</th>
                        <th>Amount</th>

                        <th>Name</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                        $sql = "SELECT id,bk_id,amount,check_number,trust_id from ledger2 WHERE status=0 AND pay_mode=0 UNION ALL SELECT id,bk_id,amount,check_number,trust_id from ledger3 WHERE status=0 AND pay_mode=0";
                        $run = $conn->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $id = $row['bk_id'];
                            $amount = $row['amount'];
                            $check_number = $row['check_number'];
                            $account_number = "";
                            $ledger_id = $row['id'];
                            $trust_id = $row['trust_id'];
                            $s1 = "SELECT name from booking_info WHERE id=$id";
                            $run1 = $conn->query($s1);
                            $row1 = $run1->fetch_assoc();
                            $name = $row1['name']; ?>
                        <tr>
                            <form method="POST">
                                <td><?php echo $check_number ?></td>
                                <td><?php echo $amount ?></td>

                                <td><?php echo $name ?></td>
                                <td> <input type="text" placeholder="Date" name="date" class="form-control datepicker">
                                </td>
                                <input type="hidden" name="cn" value='<?php echo $check_number ?>'>
                                <input type="hidden" name="trust_id" value='<?php echo $trust_id ?>'>
                                <input type="hidden" name="an" value='<?php echo $account_number ?>'>
                                <input type="hidden" name="a" value='<?php echo $amount ?>'>
                                <input type="hidden" name="ledger_id" value='<?php echo $ledger_id ?>'>
                                <td> <button class="btn btn-success" name="pass" value='<?php echo $id ?>'>Clear</button></td>
                                <td> <button class="btn btn-danger" name="fail" value='<?php echo $id ?>'>Not Clear</button></td>
                            </form>
                        </tr>
                    <?php
                        }
                    ?>
                    <?php
                        if (isset($_POST['pass'])) {
                            $check_number = $_POST['cn'];
                            $id = $_POST['pass'];
                            $check_amount = $_POST['a'];
                            $an = "";
                            $first = $_POST['date'];
                            $ledger_id = $_POST['ledger_id'];
                            $trust_id = $_POST['trust_id'];
                            list($f_m, $f_d, $f_y) = explode('/', $first);
                            $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                            $cl_date = str_replace(' ', '', $f_first0);
                            // $sql = "UPDATE ledger SET status=1,check_cleared_date='$cl_date' WHERE check_number='$check_number' AND account_number='$an' AND booking_id=$id";
                            if ($trust_id == "1") {
                                //$s2 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$check_amount',$trust_id,'$check_number','$an',0,1,0,'$date0','$time0',1,'$cl_date','',0)";
                                // $d2="SELECT id from ledger2 WHERE bk_id=$id AND amount='$check_amount' AND trust_id=$trust_id AND check_number='$check_number' AND account_number='$an' AND pay_mode=0 AND debit=1 AND c_date='$date0' AND time='$time0' AND status=1 AND check_cleared_date='$cl_date' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                $s2 = "UPDATE ledger2 SET status=1,check_cleared_date='$cl_date' WHERE id=$ledger_id";
                            } else {
                                //$s2 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$check_amount',$trust_id,'$check_number','$an',0,1,0,'$date0','$time0',1,'$cl_date','',0)";
                                //$d2="SELECT id from ledger3 WHERE bk_id=$id AND amount='$check_amount' AND trust_id=$trust_id AND check_number='$check_number' AND account_number='$an' AND pay_mode=0 AND debit=1 AND c_date='$date0' AND time='$time0' AND status=1 AND check_cleared_date='$cl_date' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                $s2 = "UPDATE ledger3 SET status=1,check_cleared_date='$cl_date' WHERE id=$ledger_id";
                            }
                            if (mysqli_query($conn, $s2)) {
                                // mysqli_query($conn, $s2);
                                //$rund=$conn->query($d2);
                                //$rowd=$rund->fetch_assoc();
                                $d2_id = $ledger_id;
                                if ($trust_id == "1") {
                                    $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($d2_id)";
                                    mysqli_query($conn, $f2);
                                } else {
                                    $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($d2_id)";
                                    mysqli_query($conn, $f2);
                                }

                                $s0 = "SELECT COUNT(*) as c from booking_info WHERE id=$id AND status=2";
                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();
                                $c0 = $row0['c'];

                                if ($trust_id == "1") {
                                    $fq = "SELECT id from receipt_hr_ht where ledger_id=$ledger_id";
                                } else {
                                    $fq = "SELECT id from receipt_hr_mt where ledger_id=$ledger_id";
                                }

                                $runfq = $conn->query($fq);
                                $rowfq = $runfq->fetch_assoc();
                                $receipt_id = $rowfq['id'];

                                if ($c0 > 0) {
                                    // $s1 = "SELECT COUNT(*) as c_1 from ledger2 WHERE status=0 AND booking_id=$id";
                                    $s1 = "SELECT id from ledger2 WHERE status=0 AND bk_id=$id UNION ALL SELECT id from ledger3 WHERE status=0 AND bk_id=$id";
                                    $run1 = $conn->query($s1);
                                    // $row1 = $run1->fetch_assoc();
                                    //  $c_1 = $row1['c_1'];
                                    if ($run1->num_rows > 0) {
                                        $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                        $run2 = $conn->query($s2);
                                        $row2 = $run2->fetch_assoc();
                                        $mobile = $row2['mobile'];
                                        $its = $row2['its'];
                                        $name = $row2['name'];
                                        $date = $row2['date'];
                                        $jk_id = $row2['jk_id'];
                                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                        $run20 = $conn->query($s20);
                                        if ($run20->num_rows > 0) {
                                            $row20 = $run20->fetch_assoc();
                                            $amount = $row20['amount'];
                                        }
                                        $capacity = $row4['capacity'];
                                        $timings_id = $row2['timings_id'];
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
                                        }
                                        $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A  Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                        $final_msg = str_replace(" ", "%20", $msg);
                                        $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                        $ch = curl_init();

                                        // set url 
                                        curl_setopt($ch, CURLOPT_URL, $url);

                                        //return the transfer as a string 
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                        // $output contains the output string 
                                        $output = curl_exec($ch);


                                        // close curl resource to free up system resources 
                                        curl_close($ch);

                                        echo '<div class="alert alert-success mt-2" role="alert">
    Success
   </div>';
                    ?>
                                    <script type="text/javascript">
                                        window.location = ' receipt_view.php?type=0&br=1&br_trust=<?php echo $trust_id ?>&receipt_id=<?php echo $receipt_id ?>&submit=submit';
                                    </script>
                                    <?php
                                    } else {
                                        $s2 = "UPDATE booking_info SET status=3 WHERE id=$id";
                                        if (mysqli_query($conn, $s2)) {
                                            $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mobile = $row2['mobile'];
                                            $its = $row2['its'];
                                            $name = $row2['name'];
                                            $date = $row2['date'];
                                            $jk_id = $row2['jk_id'];
                                            $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                            $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                            $run20 = $conn->query($s20);
                                            if ($run20->num_rows > 0) {
                                                $row20 = $run20->fetch_assoc();
                                                $amount = $row20['amount'];
                                            }
                                            $capacity = $row4['capacity'];
                                            $timings_id = $row2['timings_id'];
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
                                            }
                                            $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0AJamaat Khaana Booking Confirmed%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                            $final_msg = str_replace(" ", "%20", $msg);
                                            $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                            $ch = curl_init();

                                            // set url 
                                            curl_setopt($ch, CURLOPT_URL, $url);

                                            //return the transfer as a string 
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                            // $output contains the output string 
                                            $output = curl_exec($ch);


                                            // close curl resoure to free up system resources 
                                            curl_close($ch);

                                            echo '<div class="alert alert-success mt-2" role="alert">
    Success
   </div>';
                                    ?>

                                        <script type="text/javascript">
                                            window.location = ' receipt_view.php?type=0&br=1&br_trust=<?php echo $trust_id ?>&receipt_id=<?php echo $receipt_id ?>&submit=submit';
                                        </script>
                        <?php } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
    Fail
   </div>';
                                        }
                                    }
                                } else {
                                    $s1 = "SELECT COUNT(*) as c from ledger WHERE status=0 AND booking_id=$id";
                                    $run1 = $conn->query($s1);
                                    $row1 = $run1->fetch_assoc();
                                    $c = $row1['c'];
                                    if ($c > 0) {
                                        $s2 = "SELECT its,name,mobile,jk_id,date,timings_id from booking_info WHERE id=$id";
                                        $run2 = $conn->query($s2);
                                        $row2 = $run2->fetch_assoc();
                                        $mobile = $row2['mobile'];
                                        $its = $row2['its'];
                                        $name = $row2['name'];
                                        $date = $row2['date'];
                                        $jk_id = $row2['jk_id'];
                                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                        $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                        $run20 = $conn->query($s20);
                                        if ($run20->num_rows > 0) {
                                            $row20 = $run20->fetch_assoc();
                                            $amount = $row20['amount'];
                                        }
                                        $capacity = $row4['capacity'];
                                        $timings_id = $row2['timings_id'];
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
                                        }
                                        $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                                        $final_msg = str_replace(" ", "%20", $msg);
                                        $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                        $ch = curl_init();

                                        // set url 
                                        curl_setopt($ch, CURLOPT_URL, $url);

                                        //return the transfer as a string 
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                        // $output contains the output string 
                                        $output = curl_exec($ch);


                                        // close curl resource to free up system resources 
                                        curl_close($ch);

                                        echo '<div class="alert alert-success mt-2" role="alert">
        Success
       </div>';
                                    }
                                }
                            }
                        ?>

                        <script type="text/javascript">
                            window.location = ' receipt_view.php?type=0&br=1&br_trust=<?php echo $trust_id ?>&receipt_id=<?php echo $receipt_id ?>&submit=submit';
                        </script>
                        <?php


                        }

                        if (isset($_POST['fail'])) {
                            $check_number = $_POST['cn'];
                            $id = $_POST['fail'];
                            $check_amount = $_POST['a'];
                            $an = "";
                            $ledger_id = $_POST['ledger_id'];
                            $trust_id = $_POST['trust_id'];
                            $first = $_POST['date'];
                            list($f_m, $f_d, $f_y) = explode('/', $first);
                            $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                            $cl_date = str_replace(' ', '', $f_first0);
                            if ($trust_id == "1") {
                                $sql = "UPDATE ledger2 SET status=2,check_cleared_date='$cl_date' WHERE id=$ledger_id";
                            } else {
                                $sql = "UPDATE ledger3 SET status=2,check_cleared_date='$cl_date' WHERE id=$ledger_id";
                            }

                            // $sql = "UPDATE ledger SET status=2,check_cleared_date='$cl_date' WHERE check_number='$check_number' AND account_number='$an' AND booking_id=$id";
                            $sql_n = "UPDATE booking_info SET status=1,part_pay=1 WHERE id=$id";

                            if (mysqli_query($conn, $sql)) {
                                mysqli_query($conn, $sql_n);

                                $s2 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$id";
                                $run2 = $conn->query($s2);
                                $row2 = $run2->fetch_assoc();
                                $mobile = $row2['mobile'];
                                $its = $row2['its'];
                                $name = $row2['name'];
                                $date = $row2['date'];
                                $jk_id = $row2['jk_id'];
                                $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                $run4 = $conn->query($s4);
                                $row4 = $run4->fetch_assoc();
                                $jk_name = $row4['name'];
                                $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                $run20 = $conn->query($s20);
                                if ($run20->num_rows > 0) {
                                    $row20 = $run20->fetch_assoc();
                                    $amount = $row20['amount'];
                                }
                                $capacity = $row4['capacity'];
                                $timings_id = $row2['timings_id'];
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
                                }
                                $msg = "Cheque Clearance Failed..%0D%0ACheque of Rs." . $check_amount . " Failed to Clear..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0AVisit Jamaat Office and pay the amount";
                                $final_msg = str_replace(" ", "%20", $msg);
                                $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                                $ch = curl_init();

                                // set url 
                                curl_setopt($ch, CURLOPT_URL, $url);

                                //return the transfer as a string 
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                // $output contains the output string 
                                $output = curl_exec($ch);


                                // close curl resource to free up system resources 
                                curl_close($ch);
                        ?>
                            <script>
                                // Get the modal
                                var modal = document.getElementById("right_modal");

                                // Get the button that opens the modal
                                var btn = document.getElementById("myBtn");

                                // Get the <span> element that closes the modal
                                var span = document.getElementsByClassName("close")[0];



                                // When the user clicks on <span> (x), close the modal
                                span.onclick = function() {
                                    modal.style.display = "none";
                                }

                                // When the user clicks anywhere outside of the modal, close it
                                window.onclick = function(event) {
                                    if (event.target == modal) {
                                        modal.style.display = "none";
                                    }
                                }




                                modal.style.display = "block";
                            </script>
                    <?php

                            }
                        }
                    ?>

                    </form>
                </tbody>
            </table>
        </div>
    </div>



<?php
                    }
?>

            </div>
        </div>
    </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <?php
    require('footer.php');
    ?>
</body>

</html>