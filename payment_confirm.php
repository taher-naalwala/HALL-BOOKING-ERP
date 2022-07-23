<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="modal_box.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        $current_date = date('Y-m-d');
        $time = date('H:i:s');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php if ($_GET['type'] == "full") {
                                                                        echo "Full Payment";
                                                                    } else {
                                                                        echo "Partial Payment";
                                                                    } ?></h6>
                </div>
                <div class="card-body">
                    <?php require('connectDB.php');
                    $id = $_GET['id'];
                    $type = $_GET['type'];
                    if ($_GET['type'] == "full") {
                        $sql = "SELECT COUNT(*) as c from booking_info WHERE id=$id AND full_pay=0";
                    } else {
                        $sql = "SELECT COUNT(*) as c from booking_info WHERE id=$id AND part_pay=0";
                    }

                    $run = $conn->query($sql);
                    $row = $run->fetch_assoc();
                    $c = $row['c'];
                    if ($c > 0) {

                        $s1 = "SELECT name,id from trust";
                        $run1 = $conn->query($s1);
                        if ($run1->num_rows > 0) { ?>
                            <h6>Name: <?php echo  $_GET['name']; ?></h6>
                            <h6>Booking Date: <?php echo $_GET['date']; ?></h6>
                            <h6>Rent: <?php echo $_GET['jk_rent']; ?></h6>
                            <br>

                            <form method="POST" enctype="multipart/form-data">

                                <?php while ($row1 = $run1->fetch_assoc()) {
                                    $trust_name = $row1['name'];
                                    $trust_id = $row1['id']; ?>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input class="form-control" type="hidden" name="trust_id[]" value='<?php echo $trust_id ?>' readonly>
                                            <input class="form-control" value='<?php echo $trust_name ?>' readonly>
                                        </div>
                                        <div class="col-lg-2"> <input class="form-control mb-2" name="amount[]" placeholder="Enter Amount" required></div>

                                        <div class="col-lg-2"> <select onchange="pay_mode_change<?php echo $trust_id ?>()" class="form-control" id="pay_mode<?php echo $trust_id ?>" name="pay_mode[]" required>
                                                <option value="" style="display:none">--MODE--</option>
                                                <option disabled>--MODE--</option>
                                                <option value="0">Cheque</option>
                                                <option value="1">Cash</option>
                                                <option value="2">Online</option>
                                            </select></div>


                                        <div class="col-lg-2"> <input id="cheque_number<?php echo $trust_id ?>" style="display: none;" class="form-control cheque_number" name="check_number[]" placeholder="Enter TXN Number"></div>

                                        <!--  <div class="col-lg-2"> <input class="form-control" name="account_number[]" placeholder="Enter Account Number"></div> -->
                                    </div>


                                <?php   } ?>

                                <?php
                                if ($type == "partial") {
                                ?>
                                    <input type="file" class="form-control mb-2" name="fileToUpload" id="fileToUpload">
                                <?php
                                }
                                ?>
                                <button name="submit" class="btn btn-primary" value="submit">Submit</button>
                                <?php
                                if (isset($_POST['submit'])) {
                                    $pay_mode = $_POST['pay_mode'];
                                    $amount = $_POST['amount'];
                                    $check_num = $_POST['check_number'];
                                    // $account_num = $_POST['account_number'];
                                    $trust_id = $_POST['trust_id'];
                                    $bk_id = $_GET['id'];
                                    $c = date('Y-m-d');
                                    if ($type == "full") {
                                        if (count(array_unique($pay_mode)) == 1 && ($pay_mode[0] == "1" || $pay_mode[0] == "2")) {
                                            $sql = "UPDATE booking_info SET status=3,full_pay=1 WHERE id=$id";
                                        } else {
                                            $sql = "UPDATE booking_info SET status=2,full_pay=1 WHERE id=$id";
                                        }
                                        if (mysqli_query($conn, $sql)) {
                                            foreach ($pay_mode as $index => $mode) {
                                                $a = $amount[$index];
                                                if ($a != 0) {
                                                    $t = $trust_id[$index];
                                                    $cn = $check_num[$index];
                                                    $an = "";
                                                    if ($t == "1" && $mode == "0") {
                                                        $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                    } else if ($t == "1" && ($mode == "1" || $mode == "2")) {
                                                        $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                        $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                    } else if ($t == "2" && ($mode == "1" || $mode == "2")) {
                                                        $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                        $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                    } else {
                                                        $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                    }

                                                    /*  if ($mode == "0") {
													
													
                                                    $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$a',$t,'$cn','$an',$mode,'',1,0,'$c',0,'')";
													
                                               
                                                } else {
													
                                                    $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$a',$t,'$cn','$an',$mode,'',1,0,'$c',1,'')";
                                                    if ($t == "1") {
                                                        $s2 = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
														$d2="SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
													} else {
                                                        $s2 = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
														$d2="SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
													}
													
                                                } */
                                                    if (mysqli_query($conn, $s1)) {
                                                        if ($mode == "1" || $mode == "2") {
                                                            // mysqli_query($conn, $s2);
                                                            $rund = $conn->query($d2);
                                                            $rowd = $rund->fetch_assoc();
                                                            $d2_id = $rowd['id'];
                                                            if ($t == "1") {

                                                                $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($d2_id)";
                                                                mysqli_query($conn, $f2);
                                                            } else {

                                                                $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($d2_id)";
                                                                mysqli_query($conn, $f2);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            $s2 = "SELECT its,name,mobile,jk_id,date,timings_id,jk_rent from booking_info WHERE id=$bk_id";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mobile = $row2['mobile'];
                                            $its = $row2['its'];
                                            $name = $row2['name'];
                                            $date = $row2['date'];
                                            $jk_id = $row2['jk_id'];
                                            $amount = $row2['jk_rent'];
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
                                            $msg = "Full Payment of Rs." . $amount . " Received..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $bk_id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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

                                        } else {
                                        ?>
                                            <script>
                                                // Get the modal
                                                var modal = document.getElementById("wrong_modal");

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
                                    } else {
                                        $target_dir = "pdf/";
                                        $check = basename($_FILES["fileToUpload"]["name"]);
                                        $target_file = $target_dir . rand() * rand() . basename($_FILES["fileToUpload"]["name"]);
                                        $uploadOk = 1;
                                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                        if (empty($check)) {
                                            $sql = "UPDATE booking_info SET status=1,part_pay=1 WHERE id=$id";
                                            if (mysqli_query($conn, $sql)) {
                                                $total_pay = 0;
                                                foreach ($pay_mode as $index => $mode) {
                                                    $a = $amount[$index];
                                                    if ($a != 0) {
                                                        $total_pay = $total_pay + $a;
                                                        $t = $trust_id[$index];
                                                        $cn = $check_num[$index];
                                                        $an = $account_num[$index];
                                                        if ($t == "1" && $mode == "0") {
                                                            $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                        } else if ($t == "1" && ($mode == "1" || $mode == "2")) {
                                                            $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                            $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                        } else if ($t == "2" && ($mode == "1" || $mode == "2")) {
                                                            $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                            $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                        } else {
                                                            $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                        }
                                                        /*    if ($mode == "0") {
                                                        $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$a',$t,'$cn','$an',$mode,'',1,0,'$c',0,'')";
                                                        
                                                    } else {
                                                        $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$a',$t,'$cn','$an',$mode,'',1,0,'$c',1,'')";
                                                        if ($t == "1") {
                                                            $s2 = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                        $d2="SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
														} else {
                                                            $s2 = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                        $d2="SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
														}
                                                    } */
                                                        if (mysqli_query($conn, $s1)) {
                                                            if ($mode == "1" || $mode == "2") {
                                                                // mysqli_query($conn, $s2);
                                                                $rund = $conn->query($d2);
                                                                $rowd = $rund->fetch_assoc();
                                                                $d2_id = $rowd['id'];
                                                                if ($t == "1") {
                                                                    $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($d2_id)";
                                                                    mysqli_query($conn, $f2);
                                                                } else {
                                                                    $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($d2_id)";
                                                                    mysqli_query($conn, $f2);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }

                                                $s2 = "SELECT its,name,mobile,jk_id,date,timings_id,jk_rent from booking_info WHERE id=$bk_id";
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
                                                $amount = $row2['jk_rent'];
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
                                                $msg = "Partial Payment of Rs." . $total_pay . " Received..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $bk_id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                            } else {
                                            ?>
                                                <script>
                                                    // Get the modal
                                                    var modal = document.getElementById("wrong_modal");

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
                                        } else {
                                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                                $image_url = $target_file;
                                                $sql = "UPDATE booking_info SET status=1,part_pay=1 WHERE id=$id";
                                                if (mysqli_query($conn, $sql)) {
                                                    $total_pay = 0;
                                                    foreach ($pay_mode as $index => $mode) {
                                                        $a = $amount[$index];
                                                        if ($a != 0) {
                                                            $total_pay = $total_pay + $a;
                                                            $t = $trust_id[$index];
                                                            $cn = $check_num[$index];
                                                            $an = $account_num[$index];
                                                            if ($t == "1" && $mode == "0") {
                                                                $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                            } else if ($t == "1" && ($mode == "1" || $mode == "2")) {
                                                                $s1 = "INSERT INTO ledger2  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                                $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                            } else if ($t == "2" && ($mode == "1" || $mode == "2")) {
                                                                $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',1,'','',0)";
                                                                $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$a' AND trust_id=$t AND check_number='$cn' AND account_number='$an' AND pay_mode=$mode AND debit=1 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=0 ORDER BY id DESC LIMIT 1";
                                                            } else {
                                                                $s1 = "INSERT INTO ledger3  ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$a',$t,'$cn','$an',$mode,1,0,'$c','$time',0,'','',0)";
                                                            }
                                                            if (mysqli_query($conn, $s1)) {
                                                                if ($mode == "1" || $mode == "2") {
                                                                    mysqli_query($conn, $s2);
                                                                    $rund = $conn->query($d2);
                                                                    $rowd = $rund->fetch_assoc();
                                                                    $d2_id = $rowd['id'];
                                                                    if ($t == "1") {
                                                                        $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($d2_id)";
                                                                        mysqli_query($conn, $f2);
                                                                    } else {
                                                                        $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($d2_id)";
                                                                        mysqli_query($conn, $f2);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $s2 = "SELECT its,name,mobile,jk_id,date,timings_id,jk_rent from booking_info WHERE id=$bk_id";
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
                                                    $amount = $row4['jk_rent'];

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
                                                    $msg = "Partial Payment of Rs." . $total_pay . " Received..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $bk_id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                                } else {
                                                ?>
                                                    <script>
                                                        // Get the modal
                                                        var modal = document.getElementById("wrong_modal");

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
                                        }
                                    }

                                    if (in_array("1", $pay_mode)) { ?>
                                        <script type="text/javascript">
                                            window.location = 'receipt_view.php?type=0&br=0&input=<?php echo $bk_id ?>&submit=submit';
                                        </script>
                                    <?php  }
                                    if (in_array("2", $pay_mode)) { ?>
                                        <script type="text/javascript">
                                            window.location = 'receipt_view.php?type=0&br=0&input=<?php echo $bk_id ?>&submit=submit';
                                        </script>
                        <?php  }
                                }
                            }
                        } else {

                            echo '<div class="alert alert-info mt-2" role="alert">
                            No Booking Found
                          </div>';
                        }

                        ?>
                            </form>
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


                    } else if(cat=="1") {
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").style.display = "none";
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").required = false;

                    }
                    else
                    {
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").style.display = "block";
                        document.getElementById("cheque_number<?php echo $trust_id_js ?>").required = true;

                        return false;

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