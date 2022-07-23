<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "22" || $formid == "16") {
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
    <title>Cancel Booking</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="modal_box.css" rel="stylesheet">
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
    <div id="right_modal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <img align="left" style="width:25%;height:25%;" src="images/right_caption_img.png">
            &nbsp; <b>
                <p style="font-size: x-large;">Success</p>
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
        $date = date('Y/m/d');
        $time = date('H:i:s');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cancel Booking</h6>
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
                </div>
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
                        $sql2 = "SELECT its,name,mobile,status,jk_id,timings_id,laagat,thaals,date,jk_rent from booking_info WHERE id=$input AND status!=4";


                        $run2 = $conn->query($sql2); ?>
                        <?php if ($run2->num_rows > 0) {
                        ?>
                            <div class="row mt-4">
                                <div class="table-responsive mb-2">
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

                                                <th>Rent</th>
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>

                                                <th>Laagat</th>
                                                <th>Thaals</th>


                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php

                                            while ($row = $run2->fetch_assoc()) {
                                                $id = $input;
                                                $its = $row['its'];
                                                $amount = $row['jk_rent'];
                                                $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
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
                                                    $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
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
                                                $name = $row['name'];
                                                $mobile = $row['mobile'];
                                                $date = $row['date'];
                                                $status = $row['status'];
                                                $jk_id = $row['jk_id'];
                                                $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                $run4 = $conn->query($s4);
                                                $row4 = $run4->fetch_assoc();
                                                $jk_name = $row4['name'];
                                               // $amount = $row4['amount'];
                                                $capacity = $row4['capacity'];
                                                $timings_id = $row['timings_id'];
                                                $s6 = "SELECT label from timings WHERE id=$timings_id";
                                                $run6 = $conn->query($s6);
                                                $row6 = $run6->fetch_assoc();
                                                $label_name = $row6['label'];

                                                $laagat = $row['laagat'];
                                                $thaals = $row['thaals'];

                                            ?>
                                                <tr>
                                                    <td><?php echo $id ?></td>
                                                    <td><?php echo $its ?></td>
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $mobile ?></td>
                                                    <td><?php echo $jk_name ?></td>
                                                    <td><?php echo $date ?></td>
                                                    <td><?php echo $label_name ?></td>

                                                    <td><?php echo $amount ?></td>
                                                    <td><?php echo $total_rent_paid ?></td>
                                                    <td><?php echo $total_rent_cleared ?></td>
                                                    <td><?php echo $laagat ?></td>
                                                    <td><?php echo $thaals ?></td>




                                                </tr>
                                            <?php     }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
            </div>
        </div>
        <div class="card shadow mb-4 ">
            <div class="card-body">
                <?php
                            $s1 = "SELECT amount,check_number,account_number,pay_mode,trust_id,status,type from ledger2 WHERE bk_id=$id AND debit=1";
                            $run1 = $conn->query($s1);
                            while ($row1 = $run1->fetch_assoc()) {
                                $a = $row1['amount'];
                                $cn = $row1['check_number'];
                                $an = $row1['account_number'];
                                $pay_mode = $row1['pay_mode'];
                                $trust_id = $row1['trust_id'];
                                $type = $row1['type'];
                                $status = $row1['status'];
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
                    <div class="row">
                        <div class="col-lg-2">
                            <input class="form-control" value='<?php echo $trust_name ?>' readonly>
                        </div>

                        <div class="col-lg-2">
                            <input class="form-control mb-2" value='<?php echo $pay_name ?>' readonly>
                        </div>


                        <div class="col-lg-2"> <input class="form-control mb-2" value='<?php echo $a ?>' readonly></div>


                        <div class="col-lg-2"> <input class="form-control" value='<?php if ($status == "0") {
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
                                                                                    if ($status == "4") {
                                                                                        echo "Previous Entry";
                                                                                    }
                                                                                    ?>' readonly></div>


                        <div class="col-lg-2"> <input class="form-control" value='<?php if ($type == "0") {
                                                                                        echo "Hall Rent";
                                                                                    }
                                                                                    if ($type == "1") {
                                                                                        echo "Security Deposit";
                                                                                    }
                                                                                    if ($type == "3") {
                                                                                        echo "Garbage";
                                                                                    }
                                                                                    ?>' readonly></div>

                    </div>
                <?php
                            }
                ?>

                <?php
                            $s1 = "SELECT amount,check_number,account_number,pay_mode,trust_id,status,type from ledger3 WHERE bk_id=$id AND debit=1";
                            $run1 = $conn->query($s1);
                            while ($row1 = $run1->fetch_assoc()) {
                                $a = $row1['amount'];
                                $cn = $row1['check_number'];
                                $an = $row1['account_number'];
                                $type = $row1['type'];
                                $pay_mode = $row1['pay_mode'];
                                $trust_id = $row1['trust_id'];
                                $status = $row1['status'];
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
                    <div class="row">
                        <div class="col-lg-2">
                            <input class="form-control" value='<?php echo $trust_name ?>' readonly>
                        </div>

                        <div class="col-lg-2">
                            <input class="form-control mb-2" value='<?php echo $pay_name ?>' readonly>
                        </div>


                        <div class="col-lg-2"> <input class="form-control mb-2" value='<?php echo $a ?>' readonly></div>


                        <div class="col-lg-2"> <input class="form-control" value='<?php if ($status == "0") {
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
                                                                                    if ($status == "4") {
                                                                                        echo "Previous Entry";
                                                                                    }
                                                                                    ?>' readonly></div>

                        <div class="col-lg-2"> <input class="form-control" value='<?php if ($type == "0") {
                                                                                        echo "Hall Rent";
                                                                                    }
                                                                                    if ($type == "1") {
                                                                                        echo "Security Deposit";
                                                                                    }
                                                                                    if ($type == "3") {
                                                                                        echo "Garbage";
                                                                                    }
                                                                                    ?>' readonly></div>

                    </div>

                <?php
                            }
                ?>
            </div>
        </div>
        <div class="card shadow mb-4 ">
            <div class="card-body">
                <form method="POST">

                    <?php
                            $sql = "SELECT * from trust";
                            $run = $conn->query($sql);
                            while ($row = $run->fetch_assoc()) {
                                $trust_name = $row['name'];
                                $trust_id = $row['id'];
                    ?>

                        <div class="row">
                            <div class="col-lg-3">

                                <select class="form-control" name="trust_id[]" readonly>

                                    <option value='<?php echo $trust_id ?>'><?php echo $trust_name ?></option>


                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input name="refund[]" type="number" placeholder="Enter Refund Amount" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3">

                                <select onchange="pay_mode_change<?php echo $trust_id ?>()" class="form-control" id="pay_mode<?php echo $trust_id ?>" name="pay_mode[]" required>
                                    <option value="" style="display:none">--MODE--</option>
                                    <option disabled>--MODE--</option>
                                    <option value="0">Cheque</option>
                                    <option value="1">Cash</option>
                                </select>
                            </div>
                            <div class="col-lg-3">

                                <input id="cheque_number<?php echo $trust_id ?>" style="display: none;" class="form-control cheque_number" name="check_number[]" placeholder="Enter Check Number">
                            </div>

                        </div>
                    <?php

                            }
                    ?>
                    <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Cancel Booking</button>
            </div>
        </div>
        <?php
                            if (isset($_POST['cleared'])) {
                                $id = $_POST['cleared'];
                                $input = $_GET['input'];
                                if (strpos($input, '(') !== false) {
                                    $first_index = stripos($input, "(") + 1;
                                    $s_id_e = substr($input, $first_index);
                                    $input = rtrim($s_id_e, ") ");
                                }
                                $refund = $_POST['refund'];
                                $refund_sum = array_sum($refund);
                                $pay_mode = $_POST['pay_mode'];
                                $cn = $_POST['check_number'];
                                $trust_id = $_POST['trust_id'];

                                $c = date('Y-m-d');


                                $sql = "UPDATE booking_info SET status=4 WHERE id=$id";
                                if (mysqli_query($conn, $sql)) {
                                    foreach ($trust_id as $index => $trust) {
                                        $a = $refund[$index];
                                        $mode = $pay_mode[$index];
                                        $check_num = $cn[$index];
                                        if ($a == 0) {
                                        } else {


                                            if ($trust == 1) {

                                                $s2 = "INSERT INTO ledger2 ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',1,'$check_num','',$mode,0,1,'$c','$time',1,'$c','',5)";
                                                $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$trust AND check_number='$check_num' AND pay_mode=$mode AND debit=0 AND c_date='$c' AND time='$time' AND status=1  AND name='' AND type=5 ORDER BY id DESC LIMIT 1";
                                            } else {

                                                $s2 = "INSERT INTO ledger3 ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',2,'$check_num','',$mode,0,1,'$c','$time',1,'$c','',5)";
                                                $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$trust AND check_number='$check_num' AND pay_mode=$mode AND debit=0 AND c_date='$c' AND time='$time' AND status=1  AND name='' AND type=5 ORDER BY id DESC LIMIT 1";
                                            }


                                            if (mysqli_query($conn, $s2)) {
                                                $rund = $conn->query($d2);
                                                $rowd = $rund->fetch_assoc();
                                                $d2_id = $rowd['id'];

                                                if ($trust == "1") {

                                                    $f2 = "INSERT INTO voucher_ht(`ledger_id`) VALUES ($d2_id)";
                                                    mysqli_query($conn, $f2);
                                                } else {

                                                    $f2 = "INSERT INTO voucher_mt(`ledger_id`) VALUES ($d2_id)";
                                                    mysqli_query($conn, $f2);
                                                }
                                            }
                                        }




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
                                        $msg = "Jamaat Khana Booking Cancelled..%0D%0ARefund Amount: Rs." . $refund_sum . "%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                if ($refund_sum != 0) {
                ?>
                <script type="text/javascript">
                    window.location = 'voucher_view.php?type=0&br=0&input=<?php echo $input ?>&submit=submit';
                </script>
        <?php
                                }
                            }
        ?>
        </form>
    <?php
                        } else {
                            echo "No Clearance Booking Found";
                        }
                    } else {
                        $sql2 = "SELECT id,name,mobile,jk_id,timings_id,laagat,thaals,status,jk_rent from booking_info WHERE its=$input  AND status!=4";


                        $run2 = $conn->query($sql2); ?>
    <?php if ($run2->num_rows > 0) {
                            while ($row = $run2->fetch_assoc()) { ?>
            <div class="row mt-4">
                <div class="table-responsive mb-2">
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
                                <th>Capacity</th>
                                <th>Rent</th>
                                <th>Laagat</th>
                                <th>Thaals</th>
                                <th>Rent Paid</th>
                                <th>Rent Cleared</th>


                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                $id = $row['id'];
                                $its = $input;
                                $name = $row['name'];
                                $amount = $row['jk_rent'];
                                $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND type=0 UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND type=0";
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
                                $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND type=0 UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND type=0 ";
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
                                <td><?php echo $capacity ?></td>
                                <td><?php echo $amount ?></td>
                                <td><?php echo $laagat ?></td>
                                <td><?php echo $thaals ?></td>
                                <td><?php echo $total_rent_paid ?></td>
                                <td><?php echo $total_rent_cleared ?></td>



                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input name="refund" type="number" placeholder="Enter Refund Amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="pay_mode">

                            <option value="0">Cheque</option>
                            <option value="1">Cash</option>
                        </select>
                    </div>
                    <div class="col-lg-3">

                        <input name="check_number" class="form-control" placeholder="Enter Check Number">
                    </div>


                </div>
                <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Cancel Booking</button>
                <?php
                                if (isset($_POST['cleared'])) {
                                    $id = $_POST['cleared'];
                                    $input = $_GET['input'];
                                    $refund = $_POST['refund'];
                                    $pay_mode = $_POST['pay_mode'];
                                    $cn = $_POST['check_number'];
                                    $c = date('Y-m-d');

                                    if (empty($refund)) {
                                    } else {
                                        $sql = "UPDATE booking_info SET status=4 WHERE id=$id";
                                        if (mysqli_query($conn, $sql)) {

                                            $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$refund',0,'$cn','',$pay_mode,'',0,1,'$c',1,'')";
                                            if (mysqli_query($conn, $s1)) {
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
                                                $msg = "Jamaat Khana Booking Cancelled..%0D%0ARefund Amount: Rs." . $refund . "%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                                Booking Cancelled
                                               </div>';
                                            } else {
                                                echo '<div class="alert alert-danger mt-2" role="alert">
                                                Fail
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
    <script>
        <?php $s1 = "SELECT id from trust";
        $run1 = $conn->query($s1);
        if ($run1->num_rows > 0) {
            while ($row1 = $run1->fetch_assoc()) {
                $trust_id_js = $row1['id'];
        ?>

                function pay_mode_change<?php echo $trust_id_js ?>() {
                    var cat = document.getElementById('pay_mode<?php echo $trust_id_js ?>').value;
                    if (cat == "0") {

                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").style.display = "block";
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").required = true;

                        return false;


                    } else {
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").style.display = "none";
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").required = false;

                    }
                    return true;
                }

        <?php
            }
        }
        ?>
    </script>

    <?php
    require('footer.php');
    ?>

</body>

</html>