<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d=date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "30" ) {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        header('Location:main.php');
        exit();
    }
} 
else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");
    
    die();
}
else{
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts</title>
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
                    <h6 class="m-0 font-weight-bold text-primary">Alerts</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">

                            <div class="col-lg-3">

                                <select class="form-control" name="type">
                                    <option value="1">Payment Pending</option>
                                    <option value="3">Booking Confirmed</option>
                                    <option value="2">Check Clearance Pending</option>
                                    <option value="4">Booking Confirmed with no Laagat and Thaals</option>
                                </select>

                            </div>
                            <div class="col-lg-3">

                                <input type="text" class="form-control" name="daterange" />

                            </div>
                            <div class="col-lg-3">

                                <textarea name="custom_msg" class="form-control" placeholder="Enter Custom Message" maxlength="40"></textarea>

                            </div>
                            <div class="col-lg-3">

                                <button value="submit" name="submit" class="btn btn-primary">Submit</button>

                            </div>
                    </form>
                </div>
                <?php require('connectDB.php');

                if (isset($_POST['submit'])) {
                    $custom_msg = $_POST['custom_msg'];
                    $range = $_POST['daterange'];
                    $type = $_POST['type'];
                    list($first, $second) = explode('-', $range);

                    list($f_m, $f_d, $f_y) = explode('/', $first);
                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                    $f_first = str_replace(' ', '', $f_first0);

                    list($s_m, $s_d, $s_y) = explode('/', $second);
                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                    $f_second = str_replace(' ', '', $f_second0);

                    if ($type == "1") {
                        $sql = "SELECT mobile,id,jk_id,date from booking_info WHERE status=1 AND (date>='$f_first' AND date<='$f_second')";
                        $run = $conn->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $mobile = $row['mobile'];
                            $id = $row['id'];
                            $jk_id = $row['jk_id'];
                            $date = $row['date'];
                            $s1 = "SELECT amount,debit,credit from ledger WHERE booking_id=$id";
                            $run1 = $conn->query($s1);
                            $paid_amount = 0;
                            while ($row1 = $run1->fetch_assoc()) {
                                $amount = $row1['amount'];
                                $debit = $row1['debit'];
                                $credit = $row1['credit'];
                                if ($debit == "1") {
                                    $paid_amount = $paid_amount + $amount;
                                }
                                if ($credit == "1") {
                                    $paid_amount = $paid_amount - $amount;
                                }
                            }
                            $s20 = "SELECT amount from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                            $run20 = $conn->query($s20);
                            if ($run20->num_rows > 0) {
                                $row20 = $run20->fetch_assoc();
                                $amount = $row20['amount'];
                            }
                            $pending_amount = $amount - $paid_amount;

                            $s2 = "SELECT its,name,mobile,laagat,thaals,date,jk_id,timings_id from booking_info WHERE id=$id";
                            $run2 = $conn->query($s2);
                            $row2 = $run2->fetch_assoc();
                            $mobile = $row2['mobile'];
                            $its = $row2['its'];
                            $name = $row2['name'];
                            $laagat = $row2['laagat'];
                            $thaals = $row2['thaals'];
                            $date = $row2['date'];
                            $jk_id = $row2['jk_id'];
                            $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                            $run4 = $conn->query($s4);
                            $row4 = $run4->fetch_assoc();
                            $jk_name = $row4['name'];
                            $amount = $row4['amount'];
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
                            $msg = $custom_msg . " %0D%0AReminder- %0D%0APayment of Rs. " . $pending_amount . " Pending%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                        }
                        echo '<div class="alert alert-success mt-2" role="alert">
                        Alert Sent
                       </div>';
                    }
                    if ($type == "3") {
                        $sql = "SELECT id,mobile,jk_id from booking_info WHERE status=3 AND (date>='$f_first' AND date<='$f_second')";
                        $run = $conn->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $mobile = $row['mobile'];
                            $id = $row['id'];
                            $jk_id = $row['jk_id'];


                            $s2 = "SELECT mobile,its,name,laagat,thaals,date,jk_id,timings_id from booking_info WHERE id=$id";
                            $run2 = $conn->query($s2);
                            $row2 = $run2->fetch_assoc();
                            $mobile = $row2['mobile'];
                            $its = $row2['its'];
                            $name = $row2['name'];
                            $laagat = $row2['laagat'];
                            $thaals = $row2['thaals'];
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
                            $msg = $custom_msg . " %0D%0AReminder- %0D%0AJamaat Khaana Booking Confirmed..%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                        }
                        echo '<div class="alert alert-success mt-2" role="alert">
                        Alert Sent
                       </div>';
                    }
                    if ($type == "2") {
                        $sql = "id,mobile,jk_id from booking_info WHERE status=2 AND (date>='$f_first' AND date<='$f_second')";
                        $run = $conn->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $mobile = $row['mobile'];
                            $id = $row['id'];
                            $jk_id = $row['jk_id'];


                            $s2 = "SELECT its,name,mobile,laagat,thaals,date,jk_id,timings_id from booking_info WHERE id=$id";
                            $run2 = $conn->query($s2);
                            $row2 = $run2->fetch_assoc();
                            $mobile = $row2['mobile'];
                            $its = $row2['its'];
                            $name = $row2['name'];
                            $laagat = $row2['laagat'];
                            $thaals = $row2['thaals'];
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
                            $msg = $custom_msg . " %0D%0AReminder- %0D%0ACheque Clearance Pending..%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                        }
                        echo '<div class="alert alert-success mt-2" role="alert">
                        Alert Sent
                       </div>';
                    }
                    if ($type == "4") {
                        $sql = "SELECT id,mobile,jk_id from booking_info WHERE status=3 AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second')";
                        $run = $conn->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $mobile = $row['mobile'];
                            $id = $row['id'];
                            $jk_id = $row['jk_id'];


                            $s2 = "SELECT its,name,mobile,laagat,thaals,date,jk_id,timings_id from booking_info WHERE id=$id";
                            $run2 = $conn->query($s2);
                            $row2 = $run2->fetch_assoc();
                            $mobile = $row2['mobile'];
                            $its = $row2['its'];
                            $name = $row2['name'];
                            $laagat = $row2['laagat'];
                            $thaals = $row2['thaals'];
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
                            $msg = $custom_msg . " %0D%0AReminder- %0D%0ALaagat Pending..%0D%0ABooking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                        }
                        echo '<div class="alert alert-success mt-2" role="alert">
                        Alert Sent
                       </div>';
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
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
<?php
require('footer.php');
?>
</body>

</body>

</html>