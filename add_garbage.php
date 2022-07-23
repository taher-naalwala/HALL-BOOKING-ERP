<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "37" || $formid == "16") {
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
    <title>Garbage</title>
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
        date_default_timezone_set('Asia/kolkata');
        $current_date = date('Y-m-d');
        $time = date('H:i:s');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Garbage</h6>
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
                        $sql2 = "SELECT its,name,mobile,date,status,jk_id,timings_id,jk_rent from booking_info WHERE id=$input AND garbage=''";


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
                                                $s4 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                                $run4 = $conn->query($s4);
                                                $row4 = $run4->fetch_assoc();
                                                $jk_name = $row4['name'];
                                                $amount=$row['jk_rent'];

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



                                                </tr>
                                            <?php     }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <?php
                            $s0 = "SELECT COUNT(*) as c from garbage WHERE bk_id=$id";
                            $run0 = $conn->query($s0);
                            $row0 = $run0->fetch_assoc();
                            $c = $row0['c'];
                            if ($c > 0) {
                                $s1 = "SELECT amount from garbage WHERE bk_id=$id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $garbage_amount = $row1['amount'];
                            } else {
                                $s1 = "SELECT amount from garbage WHERE bk_id=0";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $garbage_amount = $row1['amount'];
                            }
                            ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Garbage Charge/Thaal:</label>
                                        <input type="number" class="form-control" name="garbage" id="input1" value="<?php echo $garbage_amount ?>" readonly>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Thaals:</label>
                                        <input type="number" placeholder="Enter Thaals" class="form-control" name="thaals" id="input2" value="">
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Garbage Amount:</label>
                                        <input type="number" class="form-control" name="output" id="output" value="" readonly>
                                    </div>
                                </div>
                                <br>
                                <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Submit</button>

                                <?php
                                if (isset($_POST['cleared'])) {
                                    $id = $_POST['cleared'];
                                    $input = $_GET['input'];
                                    if (strpos($input, '(') !== false) {
                                        $first_index = stripos($input, "(") + 1;
                                        $s_id_e = substr($input, $first_index);
                                        $input = rtrim($s_id_e, ") ");
                                    }

                                    $thaals = $_POST['thaals'];
                                    $garbage = $_POST['garbage'];
                                    $garbage_amt = $thaals * $garbage;


                                    if (empty($garbage)) {
                                    } else {
                                        $sql = "UPDATE booking_info SET garbage='$garbage_amt' WHERE id=$input";
                                        if (mysqli_query($conn, $sql)) {
                                            $s1 = "INSERT INTO garbage_info (`bk_id`, `per_thaal`, `thaals`) VALUES($input,'$thaals','$garbage')";
                                            if (mysqli_query($conn, $s1)) {
                                                $s2 = "INSERT INTO ledger2 (`bk_id`, `amount`,`trust_id` ,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($input,'$garbage_amt',1,'','',1,1,0,'$current_date','$time',1,'','',3)";
                                                if (mysqli_query($conn, $s2)) {
														$d2="SELECT id from ledger2 WHERE bk_id=$input AND amount='$garbage_amt' AND trust_id=1 AND check_number='' AND account_number='' AND pay_mode=1 AND debit=1 AND c_date='$current_date' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=3 ORDER BY id DESC LIMIT 1";
														$rund=$conn->query($d2);
													$rowd=$rund->fetch_assoc();
													$d2_id=$rowd['id'];
													$f2="INSERT INTO receipt_garbage(`ledger_id`) VALUES ($d2_id)";
													mysqli_query($conn,$f2);
                                                    $s2 = "SELECT mobile,its,name,date,jk_id,laagat,thaals,name,timings_id from booking_info WHERE id=$input";
                                                    $run2 = $conn->query($s2);
                                                    $row2 = $run2->fetch_assoc();
                                                    $mobile = $row2['mobile'];
                                                    $its = $row2['its'];
                                                    $name = $row2['name'];
                                                    $date = $row2['date'];
                                                    $jk_id = $row2['jk_id'];
                                                    $laagat = $row2['laagat'];
                                                    $thaals = $row2['thaals'];
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
                                                    $msg = "Garbage Amount of Rs." . $garbage_amt . " Recieved..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A%0D%0AReceipt No.- BKIDG" . $input;
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
                                        }
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        window.location = 'receipt.php?name=G&ledger_id=<?php echo $d2_id ?>&submit=submit';
                                    </script>
                                <?php
                                }
                                ?>
                            </form>
                        <?php
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                                   No Cleared Booking Found
                                  </div>';
                        }
                    } else {
                        $sql2 = "SELECT * from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


                        $run2 = $conn->query($sql2); ?>
                        <?php if ($run2->num_rows > 0) {
                            while ($row = $run2->fetch_assoc()) { ?>
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


                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php
                                                $id = $row['id'];
                                                $its = $row['its'];
                                                $name = $row['name'];
                                                $mobile = $row['mobile'];
                                                $date = $row['date'];
                                                $status = $row['status'];
                                                $jk_id = $row['jk_id'];
                                                $s4 = "SELECT * from jk_info WHERE id=$jk_id";
                                                $run4 = $conn->query($s4);
                                                $row4 = $run4->fetch_assoc();
                                                $jk_name = $row4['name'];
                                                $s20 = "SELECT * from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                                                $run20 = $conn->query($s20);
                                                if ($run20->num_rows > 0) {
                                                    $row20 = $run20->fetch_assoc();
                                                    $amount = $row20['amount'];
                                                }
                                                $capacity = $row4['capacity'];
                                                $timings_id = $row['timings_id'];
                                                $s6 = "SELECT * from timings WHERE id=$timings_id";
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



                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <form method="POST">
                                    <div class="form-group">
                                        <input name="laagat" type="number" placeholder="Enter Laagat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input name="thaals" type="number" placeholder="Enter Thaals" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input name="scd" type="number" placeholder="Enter Security Deposit" class="form-control">
                                    </div>
                                    <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Submit</button>
                                    <?php
                                    if (isset($_POST['cleared'])) {
                                        $id = $_POST['cleared'];
                                        $input = $_GET['input'];
                                        $laagat = $_POST['laagat'];
                                        $scd = $_POST['scd'];
                                        $thaals = $_POST['thaals'];
                                        $sql = "UPDATE booking_info SET laagat='$laagat',thaals='$thaals',sc_deposit='$scd' WHERE id=$id";
                                        if (mysqli_query($conn, $sql)) {
                                            $s2 = "SELECT * from booking_info WHERE id=$id";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mobile = $row2['mobile'];
                                            $its = $row2['its'];
                                            $name = $row2['name'];
                                            $date = $row2['date'];
                                            $jk_id = $row2['jk_id'];
                                            $amount=$row2['jk_rent'];
                                            $s4 = "SELECT * from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                           
                                            $capacity = $row4['capacity'];
                                            $timings_id = $row2['timings_id'];
                                            $s6 = "SELECT * from timings WHERE id=$timings_id";
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
                                            $msg = "Jamaat Khana Booked with Laagat and Thaals..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
                                            $final_msg = str_replace(" ", "%20", $msg);
                                            $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . "9179711189" . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

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
                                                window.location = 'receipt.php?name=G&ledger_id=<?php echo $input ?>';
                                            </script>
                                    <?php
                                        } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                                       Fail
                                                      </div>';
                                        }
                                    }
                                    ?>

                                </form>



                <?php
                            }
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                                   No Booking Found
                                  </div>';
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
        $("#input2,#input1").keyup(function() {

            $('#output').val($('#input1').val() * $('#input2').val());

        });
    </script>
    <?php
    require('footer.php');
    ?>
</body>

</body>

</html>