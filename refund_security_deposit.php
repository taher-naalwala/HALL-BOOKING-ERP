<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "29" || $formid == "26") {
            $flag = 1;
        }
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
    <title>Refund Security Deposit</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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
                    <h6 class="m-0 font-weight-bold text-primary">Refund Security Deposit</h6>
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

                                    <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required />

                                    <div class="result"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">

                                <button value="submit" name="submit" class="btn btn-primary">Submit</button>

                            </div>
                    </form>
                </div>
                <?php require('connectDB.php');
                if (isset($_SESSION['done'])) {
                    echo '<div class="alert alert-success mt-2" role="alert">
                     Security Deposit Refunded
                   </div>';
                    $_SESSION['done'] = '';
                    unset($_SESSION['done']);
                }
                if (isset($_GET['submit'])) {
                    $type = $_GET['type'];
                    $input = $_GET['input'];
                    if (strpos($input, '(') !== false) {
                        $first_index = stripos($input, "(") + 1;
                        $s_id_e = substr($input, $first_index);
                        $input = rtrim($s_id_e, ") ");
                    }

                    if ($type == "booking_id") {
                        $sql2 = "SELECT its,name,mobile,jk_id,date,timings_id,manager_approval,sc_deposit,status from booking_info WHERE status=3 AND id=$input AND (refund_sc=0 OR refund_sc=2) AND sc_deposit!=''";


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
                                                <th>Label</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Manager Status</th>
                                                <th>Security Deposit</th>


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
                                                $manager_approval = $row['manager_approval'];
                                                $scd = $row['sc_deposit'];
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
                                                    <td><?php if ($manager_approval == "0") {
                                                            echo "In Progress";
                                                        }
                                                        if ($manager_approval == "1") {
                                                            echo "Approved";
                                                        }

                                                        if ($manager_approval == "2") {
                                                            echo "Denied";
                                                        }
                                                        ?></td>
                                                    <td><?php echo "Rs. " . $scd ?></td>



                                                </tr>
                                            <?php     }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>

                            <form method="POST">

                                <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Refund</button>
                                <input type="hidden" name="scd" value="<?php echo $scd ?>" />


                                <?php

                                if (isset($_POST['cleared'])) {

                                    $id = $_POST['cleared'];
                                    $scd = $_POST['scd'];
                                    $sql = "UPDATE booking_info SET refund_sc=1 WHERE id=$id";
                                    if (mysqli_query($conn, $sql)) {
                                        $s2 = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$scd',1,'','',1,0,1,'$current_date','$time',1,'','',2)";
                                        if (mysqli_query($conn, $s2)) {
											 $d2_1="SELECT id from ledger2 WHERE bk_id=$id AND amount='$scd' AND trust_id=1 AND check_number='' AND account_number='' AND pay_mode=1 AND debit=0 AND c_date='$current_date' AND time='$time' AND status=1 AND check_cleared_date='' AND name='' AND type=2 ORDER BY id DESC LIMIT 1";
													$rund_1=$conn->query($d2_1);
													$rowd_1=$rund_1->fetch_assoc();
													$d2_id=$rowd_1['id'];
													$f2_1="INSERT INTO receipt_rsd(`ledger_id`) VALUES ($d2_id)";
													mysqli_query($conn,$f2_1);
                                            $s2 = "SELECT its,name,mobile,date,jk_id,timings_id,laagat,thaals from booking_info WHERE id=$id";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mobile = $row2['mobile'];
                                            $its = $row2['its'];
                                            $name = $row2['name'];
                                            $laagat = $row2['laagat'];
                                            $thaals = $row2['thaals'];
                                            $date = $row2['date'];
                                            $jk_id = $row2['jk_id'];
                                            $s4 = "SELECT name,amount,capacity from jk_info WHERE id=$jk_id";
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
                                            $msg = "Security Deposit Refunded to You..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                            echo '<div class="alert alert-info mt-2" role="alert">
                       Success
                      </div>';
                                ?>
                                            <script type="text/javascript">
                                                window.location = 'receipt.php?name=RSDA&ID=<?php echo $id ?>';
                                            </script>

                            <?php
                                        }
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                       No Booking For Security Deposit Refund Found
                      </div>';
                            }
                        } else {
                            $sql2 = "SELECT id,name,mobile,jk_id,timings_id,date from booking_info WHERE status=3 AND its=$input AND refund_sc=0 AND sc_deposit!=''";


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
                                                        <th>Manager Status</th>
                                                        <th>Security Deposit</th>


                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $id = $row['id'];
                                                    $its = $input;
                                                    $name = $row['name'];
                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
                                                    $manager_approval = $row['manager_approval'];
                                                    $scd = $row['sc_deposit'];
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
                                                        <td><?php if ($manager_approval == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($manager_approval == "1") {
                                                                echo "Approved";
                                                            }

                                                            if ($manager_approval == "2") {
                                                                echo "Denied";
                                                            } ?></td>
                                                        <td><?php echo $scd ?></td>



                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                    <form method="POST">

                                        <button name="cleared" class="btn btn-success" value='<?php echo $id ?>'>Refund</button>


                        <?php
                                    if (isset($_POST['cleared'])) {
                                        $id = $_POST['cleared'];
                                        $sql = "SELECT mobile from booking_info WHERE id=$id";
                                        $run = $conn->query($sql);
                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        $_SESSION['actual_link'] = $actual_link;
                                        $row = $run->fetch_assoc();
                                        $mobile = $row['mobile'];
                                        $_SESSION['booking_id_client'] = $id;
                                        $_SESSION['mobile_client'] = $mobile;
                                        echo "<script>window.location='mobile_check_admin.php'</script>";
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                                No Booking For Security Deposit Refund Found
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

    <?php
    require('footer.php');
    ?>

</body>

</html>