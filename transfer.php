<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "23" || $formid == "16") {
            $flag = 1;
        }
    }

    if ($flag == "0") {
        header('Location:main.php');
        die();
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
    <title>Transfer Booking</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
            $("#datepicker").datepicker();
        });
    </script>
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
                    <h6 class="m-0 font-weight-bold text-primary">Transfer Booking</h6>
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
                            $sql2 = "SELECT its,name,mobile,jk_id,date,timings_id,status,jk_rent from booking_info WHERE id=$input AND status!=4 ";


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
                                                $t_id;
                                                while ($row = $run2->fetch_assoc()) {
                                                    $id = $input;
                                                    $t_id = $id;
                                                    $its = $row['its'];
                                                    $name = $row['name'];
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

                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
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


                                <form method="POST">

                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
      

                                    <div class="row">
                                        <script>
                                            $(document).ready(function() {
                                                $('#datepicker').datepicker({
                                                    startDate: new Date(),
                                                    multidate: true,
                                                    format: "dd/mm/yyyy",
                                                    daysOfWeekHighlighted: "5,6",
                                                    datesDisabled: ['31/08/2017'],
                                                    language: 'en'
                                                }).on('changeDate', function(e) {
                                                    // `e` here contains the extra attributes
                                                    $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
                                                });
                                            });
                                        </script>

                                        <div class="col-lg-4">
                                            <div class="input-group date form-group" id="datepicker">
                                                <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days"  />
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <button name="search_dates" value="search" class="btn btn-primary">Search</button>

                                        </div>

                                    </div>
                                </form>
                                    <?php

                                    if (isset($_POST['search_dates'])) {
                                        $dates = $_POST['Dates'];
                                        $tags = explode(',', $dates);
                                        $booking_id=$_GET['input'];

                                        foreach ($tags as $date) {
                                            list($f_m, $f_d, $f_y) = explode('/', $date);
                                            $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                            $f_first = str_replace(' ', '', $f_first0);
                                            $date_from = strtotime($f_first);
                                            $day = date('l', $date_from);
                                    ?>
                                            <div class="card mt-2" id="forms">
                                                <div class="card-header" style="background-color: #52658F;color:white">
                                                    <h3><?php echo $date . " (" . $day . ")" ?></h3>
                                                </div>
                                                <div class="card-body" style="background-color: #F7F5E6;">
                                                    <table class="table borderless" width="100%" cellspacing="0">
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Capacity (Thaals)</th>
                                                            <th scope="col">Rent</th>
                                                            <?php
                                                            $sql = "SELECT DISTINCT label,start_time,end_time from timings ";
                                                            $run = $conn->query($sql);
                                                            if ($run->num_rows > 0) {
                                                                while ($row = $run->fetch_assoc()) {
                                                                    $label = $row['label'];
                                                                    $start_time = $row['start_time'];
                                                                    $end_time = $row['end_time'];
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
                                                            ?>
                                                                    <th scope="col"><?php echo $label . " (" . $final_start_time . " - " . $final_end_time . ")" ?></th>
                                                            <?php    }
                                                            }

                                                            ?>
                                                        </tr>
                                                       
                                                        <?php
                                                        $sql = "SELECT * from jk_info";
                                                        $run = $conn->query($sql);
                                                        if ($run->num_rows > 0) {
                                                            while ($row = $run->fetch_assoc()) {
                                                                $jk_name = $row['name'];
                                                                $jk_id = $row['id'];
                                                                $capacity = $row['capacity'];
                                                                $latest_date = date('Y-m-d');
                                                                $date_from = strtotime($f_first);
                                                                $f_day = date('l', $date_from);

                                                                $s2q = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date='$f_first' AND end_date='$f_first')  AND status=0 ";
                                                                $run2q = $conn->query($s2q);
                                                                if ($run2q->num_rows > 0) {

                                                                    $row2q = $run2q->fetch_assoc();
                                                                    $amount = $row2q['amount'];
                                                                } else {
                                                                    $s2w = "SELECT amount from rent WHERE jk_id=$jk_id AND day='$f_day' AND status=0 ";
                                                                    $run2w = $conn->query($s2w);
                                                                    if ($run2w->num_rows > 0) {
                                                                        $row2w = $run2w->fetch_assoc();
                                                                        $amount = $row2w['amount'];
                                                                    } else {
                                                                        $s2e = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date<='$f_first' AND end_date>='$f_first') and status=0 ";
                                                                        $run2e = $conn->query($s2e);
                                                                        if ($run2e->num_rows > 0) {
                                                                            $row2e= $run2e->fetch_assoc();
                                                                            $amount = $row2e['amount'];
                                                                        }
                                                                        else
                                                                        {
                                                                            $amount="NA";
                                                                        }
                                                                    }
                                                                }
                                                        ?>
                                                         <form method="POST" action="transfer_admin.php">
                                                                <tr>
                                                                  
                                                                       <input type="hidden" name="jk_id" value='<?php echo $jk_id ?>'>
                                                                        <input type="hidden" name="date" value='<?php echo $f_first ?>'>
                                                                        <input type="hidden" name="bk_id" value='<?php echo $t_id ?>'> 
                                                                        <td><?php echo $jk_name ?></td>
                                                                        <td><?php echo $capacity ?></td>
                                                                        <td><?php echo $amount ?></td>
                                                                        <?php
                                                                        $s1_0 = "SELECT id,label from timings WHERE jk_id=$jk_id";
                                                                        $run1_0 = $conn->query($s1_0);
                                                                        while ($row1 = $run1_0->fetch_assoc()) {
                                                                            $id = $row1['id'];

                                                                            $s3b = "SELECT COUNT(*) as booking_counter from booking_info WHERE timings_id=$id AND date='$f_first' AND (status=1 or status=2 or status=3) and id!=$input";
                                                                            $run3b = $conn->query($s3b);
                                                                            $row3b = $run3b->fetch_assoc();
                                                                            $booking_counter = $row3b['booking_counter'];
                                                                            if ($booking_counter > 0) {
                                                                                echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                                            } else {

                                                                                $s3 = "SELECT label from blocked WHERE (date='$f_first') AND timings_id=$id and status=0";
                                                                                $run3 = $conn->query($s3);
                                                                                if ($run3->num_rows > 0) {

                                                                                    $row3 = $run3->fetch_assoc();
                                                                                    $un_label = $row3['label'];
                                                                                    if (empty($un_label)) {
                                                                                        echo "<td>Block</td>";
                                                                                    } else {
                                                                                        echo "<td class='show-read-more' style='max-width:200px;word-wrap:break-word;'>Block <pre>(" . $un_label . ")</pre></td>";
                                                                                    }
                                                                                } else {

                                                                                    $s91 = "SELECT c_jk_id from combine_jk WHERE o_jk_id=$jk_id";
                                                                                    $run91 = $conn->query($s91);
                                                                                    if ($run91->num_rows > 0) {
                                                                                        $o_label_name = $row1['label'];
                                                                                        $flag = 0;
                                                                                        $jk_id_array_string = "";
                                                                                        while ($row91 = $run91->fetch_assoc()) {

                                                                                            $c_jk_id = $row91['c_jk_id'] . ",";
                                                                                            $jk_id_array_string = $jk_id_array_string . $c_jk_id;
                                                                                        }


                                                                                        $jk_id_array_string_mod = substr($jk_id_array_string, 0, -1);


                                                                                        $s101 = "SELECT id from timings WHERE jk_id IN ($jk_id_array_string_mod) AND label='$o_label_name'";
                                                                                        $run101 = $conn->query($s101);
                                                                                        $timings_id_array_string = "";
                                                                                        while ($row101 = $run101->fetch_assoc()) {
                                                                                            $c_id = $row101['id'];
                                                                                            $timings_id_array_string = $timings_id_array_string . $c_id . ",";
                                                                                        }
                                                                                        $timings_id_array_string_mod = substr($timings_id_array_string, 0, -1);
                                                                                        $s3c = "SELECT COUNT(*) as c_booking_counter from booking_info WHERE timings_id IN ($timings_id_array_string_mod) AND date='$f_first' AND (status=1 or status=2 or status=3) and id!=$input";
                                                                                        $run3c = $conn->query($s3c);
                                                                                        $row3c = $run3c->fetch_assoc();
                                                                                        $c_booking_counter = $row3c['c_booking_counter'];
                                                                                        if ($c_booking_counter > 0) {
                                                                                            echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                                                        } else {
                                                                                            $s3cb = "SELECT label from blocked WHERE (date='$f_first') AND timings_id IN ($timings_id_array_string_mod) and status=0";
                                                                                            $run3cb = $conn->query($s3cb);
                                                                                            if ($run3cb->num_rows > 0) {

                                                                                                $row3cb = $run3cb->fetch_assoc();
                                                                                                $un_label = $row3cb['label'];
                                                                                                if (empty($un_label)) {
                                                                                                    echo "<td>Block</td>";
                                                                                                } else {
                                                                                                    echo "<td class='show-read-more' style='max-width:200px;word-wrap:break-word;'>Block <pre>(" . $un_label . ")</pre></td>";
                                                                                                }
                                                                                            } else {
                                                                        ?>
                                                                                                <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                                                                        <?php

                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        ?>
                                                                                        <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                                                            <?php
                                                                                    }
                                                                                }
                                                                            }

                                                                            /*
                                        $s3 = "SELECT label from blocked WHERE (date='$f_first' OR day='$day') AND timings_id=$id and status=0";
                                        $run3 = $conn->query($s3);
                                        if ($run3->num_rows > 0) {

                                            $row3 = $run3->fetch_assoc();
                                            $un_label = $row3['label'];
                                            if (empty($un_label)) {
                                                echo "<td>Block</td>";
                                            } else {
                                                echo "<td class='show-read-more' style='max-width:200px;word-wrap:break-word;'>Block <pre>(" . $un_label . ")</pre></td>";
                                            }
                                        } else {

                                            $s91 = "SELECT c_jk_id from combine_jk WHERE o_jk_id=$jk_id";
                                            $run91 = $conn->query($s91);
                                            if ($run91->num_rows > 0) {
                                                $o_label_name = $row1['label'];
                                                $flag = 0;
                                                while ($row91 = $run91->fetch_assoc()) {

                                                    $c_jk_id = $row91['c_jk_id'];
                                                    $s101 = "SELECT id from timings WHERE jk_id=$c_jk_id AND label='$o_label_name'";
                                                    $run101 = $conn->query($s101);
                                                    $row101 = $run101->fetch_assoc();
                                                    $c_id = $row101['id'];
                                                    $s31 = "SELECT label from blocked WHERE (date='$f_first' OR day='$day') AND timings_id=$c_id and status=0";
                                                    $run31 = $conn->query($s31);
                                                    if ($run31->num_rows > 0) {
                                                        $row31 = $run31->fetch_assoc();
                                                        $o_un_label = $row31['label'];
                                                        $flag = 1;
                                                        break;
                                                    }
                                                }
                                                if ($flag == 1) {
                                                    if (empty($un_label)) {
                                                        echo "<td>Block</td>";
                                                    } else {
                                                        echo "<td>Block <pre>(" . $un_label . ")</pre></td>";
                                                    }
                                                } else {
                                                    $s2 = "SELECT status from booking_info WHERE timings_id=$id AND date='$f_first'";
                                                    $run2 = $conn->query($s2);
                                                    if ($run2->num_rows > 0) {
                                                        $row2 = $run2->fetch_assoc();
                                                        $status = $row2['status'];
                                                        if ($status == "1" || $status == "2" || $status == "3") {
                                                            echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                        }
                                                        if ($status == "4") {
                                                    ?>
                                                            <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>


                                                            <?php }
                                                    } else {
                                                        $s9 = "SELECT c_jk_id from combine_jk WHERE o_jk_id=$jk_id";
                                                        $run9 = $conn->query($s9);
                                                        if ($run9->num_rows > 0) {
                                                            $o_label_name = $row1['label'];
                                                            $flag = 0;
                                                            while ($row9 = $run9->fetch_assoc()) {

                                                                $c_jk_id = $row9['c_jk_id'];
                                                                $s10 = "SELECT id from timings WHERE jk_id=$c_jk_id AND label='$o_label_name'";
                                                                $run10 = $conn->query($s10);
                                                                $row10 = $run10->fetch_assoc();
                                                                $c_id = $row10['id'];
                                                                $s11 = "SELECT * from booking_info WHERE timings_id=$c_id AND date='$f_first' AND (status=1 OR status=2 OR status=3)";
                                                                $run11 = $conn->query($s11);
                                                                if ($run11->num_rows > 0) {
                                                                    $flag = 1;
                                                                    break;
                                                                }
                                                            }
                                                            if ($flag == 1) {
                                                                echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                            } else { ?>
                                                                <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                                        <?php
                                                        }
                                                    }
                                                }
                                            } else {

                                                $s2 = "SELECT status from booking_info WHERE timings_id=$id AND date='$f_first'";
                                                $run2 = $conn->query($s2);
                                                if ($run2->num_rows > 0) {
                                                    $row2 = $run2->fetch_assoc();
                                                    $status = $row2['status'];
                                                    if ($status == "1" || $status == "2" || $status == "3") {
                                                        echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                    }
                                                    if ($status == "4") {
                                                        ?>
                                                        <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>


                                                        <?php }
                                                } else {
                                                    $s9 = "SELECT c_jk_id from combine_jk WHERE o_jk_id=$jk_id";
                                                    $run9 = $conn->query($s9);
                                                    if ($run9->num_rows > 0) {
                                                        $o_label_name = $row1['label'];
                                                        $flag = 0;
                                                        while ($row9 = $run9->fetch_assoc()) {

                                                            $c_jk_id = $row9['c_jk_id'];
                                                            $s10 = "SELECT id from timings WHERE jk_id=$c_jk_id AND label='$o_label_name'";
                                                            $run10 = $conn->query($s10);
                                                            $row10 = $run10->fetch_assoc();
                                                            $c_id = $row10['id'];
                                                            $s11 = "SELECT * from booking_info WHERE timings_id=$c_id AND date='$f_first' AND (status=1 OR status=2 OR status=3)";
                                                            $run11 = $conn->query($s11);
                                                            if ($run11->num_rows > 0) {
                                                                $flag = 1;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 1) {
                                                            echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                        } else { ?>
                                                            <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <td><button name="timings_id" value='<?php echo $id ?>' class="btn btn-primary">AVAILABLE</button></td>

                                        <?php
                                                    }
                                                }
                                            }
                                        } */

                                                                            ?>




                                                                <?php    }
                                                                        echo "</tr></form>";
                                                                    }
                                                                }

                                                                ?>
                                                    </table>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </form>



                                <!--
                                    <div class="row mt-2">

                                        <div class="col-lg-3">
                                            <input type="text" placeholder="Date" name="date" class="form-control" id="datepicker">

                                        </div>

                                        <div class="col-lg-3">
                                            <select class="form-control" id="jk_id" onChange="change_jk_transfer()" name="jk_id">
                                                <option value="">Select Jamaat Khaana</option>

                                                <?php /* require('connectDB.php');
                                                $sql = "SELECT name,id from jk_info";
                                                $run = $conn->query($sql);
                                                if ($run->num_rows > 0) {
                                                    while ($row = $run->fetch_assoc()) {
                                                        $id = $row['id'];
                                                        $name = $row['name']; */
                                                ?>
                                                        <option value='<?php // echo $id 
                                                                        ?>'><?php // echo $name 
                                                                            ?></option>
                                                <?php /* }
                                                }
 */
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <div id="timing_date">
                                                <select class="form-control" name="timings_id">
                                                    <option value="">Select Timing</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button name="transfer" class="btn btn-primary" value='<?php // echo $t_id 
                                                                                                    ?>'>Transfer</button>
                                        </div>

                                    </div>
                                            -->

                    <?php
                                if (isset($_POST['transfer'])) {
                                    $id = $_POST['transfer'];
                                    $timings_id = $_POST['timings_id'];
                                    $jk_id = $_POST['jk_id'];
                                    $first = $_POST['date'];


                                    list($f_m, $f_d, $f_y) = explode('/', $first);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                    $date = str_replace(' ', '', $f_first0);
                                    $sql = "SELECT COUNT(*) as c from blocked WHERE jk_id=$jk_id AND timings_id=$timings_id AND date='$date'";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $c = $row['c'];
                                    if ($c > 0) {

                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                            Date is Blocked.Failed to Transfer Booking
                                   </div>';
                                    } else {
                                        $s1 = "SELECT COUNT(*) as c_1 from booking_info WHERE date='$date' AND jk_id=$jk_id AND timings_id=$timings_id AND status!=4";
                                        $run1 = $conn->query($s1);
                                        $row1 = $run1->fetch_assoc();
                                        $c_1 = $row1['c_1'];
                                        if ($c_1 > 0) {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                                Date is already Booked. Failed to Transfer the Booking
                                   </div>';
                                        } else {
                                            $s2 = "UPDATE booking_info SET jk_id=$jk_id,transfer=1 ,timings_id=$timings_id,status=1,part_pay=1,date='$date' WHERE id=$id";
                                            if (mysqli_query($conn, $s2)) {
                                                $s2 = "SELECT its,name,mobile,jk_id,date,timings_id from booking_info WHERE id=$id";
                                                $run2 = $conn->query($s2);
                                                $row2 = $run2->fetch_assoc();
                                                $mobile = $row2['mobile'];
                                                $its = $row2['its'];
                                                $name = $row2['name'];
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
                                                $msg = "Booking Transfered..%0D%0A" . "New Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                    Booking Transfered.. Go to Partial Payment For Completion of Booking
                                   </div>';
                                            }
                                        }
                                    }
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
    <script src="select.js"></script>

    <?php
    require('footer.php');
    ?>

</body>

</html>