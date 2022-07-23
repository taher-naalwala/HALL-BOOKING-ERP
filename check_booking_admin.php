<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
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
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamaat Khana Booking</title>
    <style>
        .row {
            margin-right: 10px;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        @media print {

            html,
            body,
            div,
            span,
            applet,
            object,
            iframe,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            blockquote,
            pre,
            a,
            abbr,
            acronym,
            address,
            big,
            cite,
            code,
            del,
            dfn,
            em,
            font,
            ins,
            kbd,
            q,
            s,
            samp,
            small,
            strike,
            strong,
            sub,
            sup,
            tt,
            var,
            dl,
            dt,
            dd,
            ol,
            ul,
            li,
            fieldset,
            form,
            label,
            legend,
            table,
            caption,
            tbody,
            tfoot,
            thead,
            tr,
            th,
            td {
                font-size: 20pt !important;
            }

            h1.entry-title {
                font-size: 24pt !important;
            }
        }
    </style>
</head>

<body>
    <?php
    require('style_user.php');

    ?>
    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">
            Booking Info
        </div>
        <div class="card-body" style="background-color: #F7F5E6;">
            <?php
            require('connectDB.php');

            if (isset($_POST['submit'])) {

                $its = $_POST['its'];
                $name = $_POST['name'];
                $mobile = $_POST['mobile'];
                $formid = $_POST['formid'];
                $purpose = $_POST['purpose'];

                $date = $_SESSION['date'];
                $c = date('Y-m-d');
                $adminid = $_SESSION['varname'];

                $jk_id = $_SESSION['jk_id'];
                $timings_id = $_SESSION['timings_id'];

                $jk_rent = $_POST['jk_rent'];
                $amount = $jk_rent;

                $s1 = "SELECT COUNT(*) as c from booking_info where date='$date' and jk_id=$jk_id and timings_id=$timings_id and (status=1 or status=2 or status=3)";
                $run1 = $conn->query($s1);
                $row1 = $run1->fetch_assoc();
                $count = $row1['c'];
                if ($count > 0) {
                    echo "CLOSE THIS WINDOW";
                } else {


                    $sql = "INSERT INTO booking_info ( `its`, `name`, `mobile`, `date`, `jk_id`, `timings_id`, `status`, `laagat`, `thaals`, `full_pay`, `part_pay`, `c_date`, `adminid`, `purpose`, `manager_approval`, `sc_deposit`, `refund_sc`, `formid`, `transfer`, `garbage`,`jk_rent`) VALUES('$its','$name','$mobile','$date',$jk_id,$timings_id,1,'','',0,0,'$c',$adminid,'$purpose',0,'',0,'$formid',0,'','$jk_rent')";
                    if (mysqli_query($conn, $sql)) {

                        $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                        $run4 = $conn->query($s4);
                        $row4 = $run4->fetch_assoc();
                        $jk_name = $row4['name'];

                        $capacity = $row4['capacity'];
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


                        $s5 = "SELECT id from booking_info WHERE its='$its' AND mobile='$mobile' AND date='$date' AND jk_id=$jk_id AND timings_id=$timings_id AND status=1 AND name='$name'";
                        $run5 = $conn->query($s5);
                        $row5 = $run5->fetch_assoc();
                        $booking_id = $row5['id'];
                        $msg = "JAMAAT KHAANA RESERVED..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $booking_id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                        <img src="photos/tick.png" class="center" style="width: 15%;">
                        <br>

                        <div class="alert alert-success text-center" role="alert">
                            <h3> JAMAAT KHANA RESERVED </h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <button onclick="window.print()" class="span4 pull-right btn btn-outline-primary">Print</button>
                                <div class="row">
                                    <div class=" col-lg-6">
                                        <b>User Details-</b>
                                        <br>
                                        <b> ITS:</b> <?php echo $its ?><br>
                                        <b> NAME:</b> <?php echo $name ?><br>
                                        <b> MOBILE NUMBER:</b> <?php echo $mobile ?>
                                        <br>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Booking Details-</b>
                                        <br>
                                        <b> Booking ID:</b> <?php echo $booking_id ?><br>

                                        <b> Jamaat Khana:</b> <?php echo $jk_name ?><br>
                                        <b> Booking Date:</b> <?php echo $date ?><br>
                                        <b> Timing:</b> <?php echo $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" ?><br>
                                        <b> Rent:</b> <?php echo $amount ?><br>
                                        <b> Capacity:</b> <?php echo $capacity ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php   }
                }
            }

            ?>





        </div>
    </div>
</body>

</html>