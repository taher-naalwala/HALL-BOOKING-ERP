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
        if ($formid == "16" || $formid == "17") {
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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamaat Khana Booking</title>

</head>

<body>
    <?php require('style_user.php');
    require('connectDB.php');
    ?>


    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">

        </div>
        <div class="card-body" style="background-color: #F7F5E6;">
            <form method="GET">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <select class="form-control" name="jk_id" required>
                                <option value=''>Select Jamaat Khana</option>
                                <?php
                                $sql = "SELECT name,id from jk_info";
                                $run = $conn->query($sql);
                                while ($row = $run->fetch_assoc()) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                <?php   }


                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="daterange" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button name="search" value="search" class="btn btn-primary">Search</button>

                    </div>

                </div>
            </form>
        </div>

    </div>

    <?php

    if (isset($_GET['search'])) {
        $jk_id = $_GET['jk_id'];
        $sql = "SELECT name,capacity from jk_info WHERE id=$jk_id";
        $run = $conn->query($sql);
        $row = $run->fetch_assoc();
        $jk_name = $row['name'];
        $capacity = $row['capacity'];

        $range = $_GET['daterange'];
        list($first, $second) = explode('-', $range);

        list($f_m, $f_d, $f_y) = explode('/', $first);
        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
        $f_first = str_replace(' ', '', $f_first0);

        list($s_m, $s_d, $s_y) = explode('/', $second);
        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
        $f_second = str_replace(' ', '', $f_second0);
    ?>
        <div class="card mt-2" id="forms">
            <div class="card-header" style="background-color: #52658F;color:white">
                <h3><?php echo $jk_name ?></h3>
            </div>
            <div class="card-body" style="background-color: #F7F5E6;">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="alert alert-warning" role="alert">
                            Capacity (Thaals): <?php echo $capacity ?>
                        </div>
                    </div>

                </div>
                <table class="table borderless table-responsive" width="100%" cellspacing="0">
                    <tr>

                        <th>Date</th>
                        <th>Day</th>
                        <th>Rent</th>
                        <?php
                        $sql = "SELECT label from timings WHERE jk_id=$jk_id";
                        $run = $conn->query($sql);
                        if ($run->num_rows > 0) {
                            while ($row = $run->fetch_assoc()) {
                                $label = $row['label'];
                        ?>
                                <th><?php echo $label ?></th>
                        <?php    }
                        }

                        ?>
                    </tr>
                    <?php

                    $date_from = strtotime($f_first); // Convert date to a UNIX timestamp  


                    $date_to = strtotime($f_second); // Convert date to a UNIX timestamp  

                    // Loop from the start date to end date and output all dates inbetween  
                    for ($i = $date_from; $i <= $date_to; $i += 86400) {
                        $latest_date = date("Y-m-d", $i);
                        $s1 = "SELECT id,label from timings WHERE jk_id=$jk_id";
                        $run1 = $conn->query($s1);
                        $timestamp = strtotime($latest_date);

                        $day = date('l', $timestamp);

                        $s2q = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date='$latest_date' AND end_date='$latest_date')  AND status=0 ";
                        $run2q = $conn->query($s2q);
                        if ($run2q->num_rows > 0) {
                            $row2q = $run2q->fetch_assoc();
                            $amount = $row2q['amount'];
                        }
                        else
                        {
                            $s2w = "SELECT amount from rent WHERE jk_id=$jk_id AND day='$day' AND status=0 ";
                            $run2w = $conn->query($s2w);
                            if ($run2w->num_rows > 0) {
                                $row2w = $run2w->fetch_assoc();
                                $amount = $row2w['amount'];
                            }
                            else
                            {
                                $s2e = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date<='$latest_date' AND end_date>='$latest_date') AND status=0 ";
                                $run2e = $conn->query($s2e);
                                if ($run2e->num_rows > 0) {
                                    $row2e = $run2e->fetch_assoc();
                                    $amount = $row2e['amount'];
                                }
                                else
                                {
                                    $amount="NA";
                                }

                            }

                        }



                    ?>

                        <tr>
                            <form method="POST" action="booking_admin.php">
                                <input type="hidden" name="jk_id" value='<?php echo $jk_id ?>'>
                                <input type="hidden" name="date" value='<?php echo $latest_date ?>'>
                                <td><?php echo $latest_date ?></td>
                                <td><?php echo $day ?></td>
                                <td><?php echo $amount ?></td>

                                <?php while ($row1 = $run1->fetch_assoc()) {
                                    $id = $row1['id'];



                                    $s3b = "SELECT COUNT(*) as booking_counter from booking_info WHERE timings_id=$id AND date='$latest_date' AND (status=1 or status=2 or status=3)";
                                    $run3b = $conn->query($s3b);
                                    $row3b = $run3b->fetch_assoc();
                                    $booking_counter = $row3b['booking_counter'];
                                    if ($booking_counter > 0) {
                                        echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                    } else {

                                        $s3 = "SELECT label from blocked WHERE (date='$latest_date') AND timings_id=$id and status=0";
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
                                                $s3c = "SELECT COUNT(*) as c_booking_counter from booking_info WHERE timings_id IN ($timings_id_array_string_mod) AND date='$latest_date' AND (status=1 or status=2 or status=3)";
                                                $run3c = $conn->query($s3c);
                                                $row3c = $run3c->fetch_assoc();
                                                $c_booking_counter = $row3c['c_booking_counter'];
                                                if ($c_booking_counter > 0) {
                                                    echo "<td><button class='btn btn-danger' disabled>Booked</button></td>";
                                                } else {
                                                    $s3cb = "SELECT label from blocked WHERE (date='$latest_date') AND timings_id IN ($timings_id_array_string_mod) and status=0";
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

                                    $s3 = "SELECT label from blocked WHERE (date='$latest_date' OR day='$day') AND timings_id=$id and status=0";
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

                                                $s31_2 = "SELECT label from blocked WHERE (date='$latest_date' OR day='$day') AND timings_id=$c_id and status=0";
                                                $run31_2 = $conn->query($s31_2);
                                                if ($run31_2->num_rows > 0) {
                                                    $row31_2 = $run31_2->fetch_assoc();
                                                    $o_un_label = $row31_2['label'];
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

                                                $s2_0 = "SELECT status from booking_info WHERE timings_id=$id AND date='$latest_date'";
                                                $run2_0 = $conn->query($s2_0);
                                                if ($run2_0->num_rows > 0) {
                                                    $row2_0 = $run2_0->fetch_assoc();
                                                    $status = $row2_0['status'];
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
                                                            $s11_2 = "SELECT id from booking_info WHERE timings_id=$c_id AND date='$latest_date' AND (status=1 OR status=2 OR status=3)";
                                                            $run11_2 = $conn->query($s11_2);

                                                            if ($run11_2->num_rows > 0) {
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

                                            $s2 = "SELECT status from booking_info WHERE timings_id=$id AND date='$latest_date'";
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
                                                        $s11 = "SELECT COUNT(*) as c_1 from booking_info WHERE timings_id=$c_id AND date='$latest_date' AND (status=1 OR status=2 OR status=3)";
                                                        $run11 = $conn->query($s11);
                                                        $row11 = $run11->fetch_assoc();
                                                        $c_1 = $row11['c_1'];
                                                        if ($c_1 > 0) {
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
                                }
                                echo "</form></tr>";
                            }

                            ?>
                </table>
            </div>
        </div>

    <?php }

    ?>
    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">

        </div>
        <div class="card-body" style="background-color: #F7F5E6;">
            <form method="GET">
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
                            <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days" required />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <button name="search_dates" value="search" class="btn btn-primary">Search</button>

                    </div>

                </div>
            </form>
        </div>

    </div>
    <?php

    if (isset($_GET['search_dates'])) {
        $dates = $_GET['Dates'];
        $tags = explode(',', $dates);

        foreach ($tags as $date) {
            list($f_d, $f_m, $f_y) = explode('/', $date);
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
                                $f_day=date('l', $date_from);
                             
                                $s2w = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date='$f_first' AND end_date='$f_first')  AND status=0 ";
                                $run2w = $conn->query($s2w);
                                if ($run2w->num_rows > 0) {
                                  
                                    $row2w = $run2w->fetch_assoc();
                                    $amount = $row2w['amount'];
                                }
                                else
                                {
                                   
                                    $s2e = "SELECT amount from rent WHERE jk_id=$jk_id AND day='$f_day' AND status=0 ";
                                    $run2e = $conn->query($s2e);
                                    if ($run2e->num_rows > 0) {
                                        $row2e = $run2e->fetch_assoc();
                                        $amount =$row2e['amount'];
                                    }
                                    else
                                    {
                                       
                                        $s2r = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date<='$f_first' AND end_date>='$f_first') and status=0 ";
                                        $run2r = $conn->query($s2r);
                                        if ($run2r->num_rows > 0) {
                                            $row2r = $run2r->fetch_assoc();
                                            $amount = $row2r['amount'];
                                        }
                                        else
                                        {
                                            $amount="NA";
                                        }

                                    }

                                }
                        ?>
                                <tr>
                                    <form method="POST" action="booking_admin.php">
                                        <input type="hidden" name="jk_id" value='<?php echo $jk_id ?>'>
                                        <input type="hidden" name="date" value='<?php echo $f_first ?>'>
                                        <td><?php echo $jk_name ?></td>
                                        <td><?php echo $capacity ?></td>
                                        <td><?php echo $amount ?></td>
                                        <?php
                                        $s1_0 = "SELECT id,label from timings WHERE jk_id=$jk_id";
                                        $run1_0 = $conn->query($s1_0);
                                        while ($row1 = $run1_0->fetch_assoc()) {
                                            $id = $row1['id'];

                                            $s3b = "SELECT COUNT(*) as booking_counter from booking_info WHERE timings_id=$id AND date='$f_first' AND (status=1 or status=2 or status=3)";
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
                                                        $s3c = "SELECT COUNT(*) as c_booking_counter from booking_info WHERE timings_id IN ($timings_id_array_string_mod) AND date='$f_first' AND (status=1 or status=2 or status=3)";
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
                                        echo "</form></tr>";
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
    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">
            <h3>Info</h3>
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
                            <th scope="col"><?php echo $label ?></th>
                    <?php    }
                    }

                    ?>
                </tr>

                <?php
                $sql = "SELECT name,id,capacity from jk_info";
                $run = $conn->query($sql);
                if ($run->num_rows > 0) {
                    while ($row = $run->fetch_assoc()) {
                        $jk_name = $row['name'];
                        $jk_id = $row['id'];
                        $capacity = $row['capacity'];
                        $latest_date = date('Y-m-d');
                       
                        $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date='$latest_date' AND end_date='$latest_date')  AND status=0 ";
                        $run2 = $conn->query($s2);
                        if ($run2->num_rows > 0) {
                            $row2 = $run2->fetch_assoc();
                            $amount = $row2['amount'];
                        }
                        else
                        {
                            $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND day='$day' AND status=0 ";
                            $run2 = $conn->query($s2);
                            if ($run2->num_rows > 0) {
                                $row2 = $run2->fetch_assoc();
                                $amount = $row2['amount'];
                            }
                            else
                            {
                                $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND end_date>='$latest_date' AND status=0 ORDER BY end_date ASC LIMIT 1";
                                $run2 = $conn->query($s2);
                                if ($run2->num_rows > 0) {
                                    $row2 = $run2->fetch_assoc();
                                    $amount = $row2['amount'];
                                }

                            }

                        }
                ?>
                        <tr>
                            <td scope="row"><?php echo $jk_name ?></td>
                            <td><?php echo $capacity ?></td>
                            <td><?php echo $amount ?></td>
                            <?php
                            $s1 = "SELECT DISTINCT label from timings ";
                            $run1 = $conn->query($s1);
                            if ($run1->num_rows > 0) {
                                while ($row1 = $run1->fetch_assoc()) {
                                    $label = $row1['label'];
                                    $s2 = "SELECT start_time,end_time from timings WHERE jk_id=$jk_id AND label='$label'";
                                    $run2 = $conn->query($s2);
                                    if ($run2->num_rows > 0) {
                                        $row2 = $run2->fetch_assoc();
                                        $start_time = $row2['start_time'];
                                        $end_time = $row2['end_time'];
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
                                        <td><?php echo $final_start_time . " - " . $final_end_time ?></td>

                                    <?php
                                    } else { ?>
                                        <td>-</td>
                            <?php  }
                                }
                            }

                            ?>
                        </tr>

                <?php    }
                }

                ?>
            </table>
        </div>
    </div>

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

</html>