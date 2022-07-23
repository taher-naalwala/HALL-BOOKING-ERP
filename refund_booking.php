<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "24" || $formid == "16") {
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
    <title>Refund Booking</title>
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
        date_default_timezone_set('Asia/kolkata');
        $date = date('Y/m/d');
        $time = date('H:i:s');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Refund Booking</h6>
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
                            $sql2 = "SELECT id,its,name,mobile,jk_id,date,timings_id,status,jk_rent from booking_info WHERE id=$input AND status!=4 ";


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
                                                    $id = $row['id'];
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
                                    <div class="row mt-2">
                                        <div class="col-lg-2">

                                            <select class="form-control" name="trust_id">
                                                <?php
                                                $sql = "SELECT name,id from trust";
                                                $run = $conn->query($sql);
                                                while ($row = $run->fetch_assoc()) {
                                                    $trust_name = $row['name'];
                                                    $trust_id = $row['id'];
                                                ?>
                                                    <option value='<?php echo $trust_id ?>'><?php echo $trust_name ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="refund" type="number" placeholder="Enter Amount" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-2">

                                            <select class="form-control" name="pay_mode">

                                                <option value="0">Cheque</option>
                                                <option value="1">Cash</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">

                                            <input class="form-control" name="check_number" placeholder="Enter Check Number">
                                        </div>

                                        <div class="col-lg-2">
                                            <button name="submit" class="btn btn-primary" value='<?php echo $id ?>'>Refund</button>

                                        </div>

                                    </div>

                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $id = $_POST['submit'];
                                        $input = $_GET['input'];
                                        if (strpos($input, '(') !== false) {
                                            $first_index = stripos($input, "(") + 1;
                                            $s_id_e = substr($input, $first_index);
                                            $input = rtrim($s_id_e, ") ");
                                        }
                                        $refund = $_POST['refund'];
                                        $mode = $_POST['pay_mode'];
                                        $cn = $_POST['check_number'];
                                        $an = "";
                                        $trust_id = $_POST['trust_id'];

                                        $c = date('Y-m-d');
                                        if ($refund == 0) {
                                        } else {
                                           // $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$refund',$trust_id,'$cn','$an',$mode,'',0,1,'$c',1,'$c')";
                                            if ($trust_id == "1") {
                                                $s2 = "INSERT INTO ledger2 ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$refund',$trust_id,'$cn','$an',0,0,1,'$c','$time',1,'$c','',5)";
                                                $d2 = "SELECT id from ledger2 WHERE bk_id=$id AND amount='$refund' AND trust_id=$trust_id AND check_number='$cn' AND account_number='$an' AND pay_mode=0 AND debit=0 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='$c' AND name='' AND type=5 ORDER BY id DESC LIMIT 1";
                                            } else {
                                                $s2 = "INSERT INTO ledger3 ( `bk_id`, `amount`, `trust_id`,`check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($id,'$refund',$trust_id,'$cn','$an',0,0,1,'$c','$time',1,'$c','',5)";
                                                $d2 = "SELECT id from ledger3 WHERE bk_id=$id AND amount='$refund' AND trust_id=$trust_id AND check_number='$cn' AND account_number='$an' AND pay_mode=0 AND debit=0 AND c_date='$c' AND time='$time' AND status=1 AND check_cleared_date='$c' AND name='' AND type=5 ORDER BY id DESC LIMIT 1";
                                            }
                                            if (mysqli_query($conn, $s2)) {
                                              //  mysqli_query($conn, $s2);
                                                $rund = $conn->query($d2);
                                                $rowd = $rund->fetch_assoc();
                                                $d2_id = $rowd['id'];
                                                if ($trust_id == "1") {
                                                    $f2 = "INSERT INTO voucher_ht(`ledger_id`) VALUES ($d2_id)";
                                                    mysqli_query($conn, $f2);
                                                } else {
                                                    $f2 = "INSERT INTO voucher_mt(`ledger_id`) VALUES ($d2_id)";
                                                    mysqli_query($conn, $f2);
                                                }
                                                if($trust_id==1)
                                                {
                                                $new_sql="SELECT id from voucher_ht where ledger_id=$d2_id";
                                                }
                                                else
                                                {
                                                    $new_sql="SELECT id from voucher_mt where ledger_id=$d2_id";
                                                }
                                                $new_run=$conn->query($new_sql);
                                                $new_row=$new_run->fetch_assoc();
                                                $voucher_id=$new_row['id'];

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
                                                $msg = "Amount of Rs." . $refund . " Refunded..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                    ?>
                                            <script type="text/javascript">
                                               
                                                window.location = 'voucher_view.php?type=1&trust_id=<?php echo $trust_id ?>&voucher_id=<?php echo $voucher_id ?>&submit=submit';
                                 
                                            </script>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                }
                            } else {
                                $sql2 = "SELECT id,its,name,mobile,date,jk_id,timings_id,status from booking_info WHERE its='$input'  AND status!=4 ";


                                $run2 = $conn->query($sql2);
                                if ($run2->num_rows > 0) {

                                    while ($row = $run2->fetch_assoc()) {
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
                                                        $id = $row['id'];
                                                        $its = $row['its'];
                                                        $name = $row['name'];
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

                                                        $mobile = $row['mobile'];
                                                        $date = $row['date'];
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
                                                            <td><?php echo $total_rent_paid ?></td>
                                                            <td><?php echo $total_rent_cleared ?></td>



                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <form method="POST">
                                            <div class="row mt-2">
                                                <div class="col-lg-2">

                                                    <select class="form-control" name="trust_id">
                                                        <?php
                                                        $sql = "SELECT name,id from trust";
                                                        $run = $conn->query($sql);
                                                        while ($row = $run->fetch_assoc()) {
                                                            $trust_name = $row['name'];
                                                            $trust_id = $row['id'];
                                                        ?>
                                                            <option value='<?php echo $trust_id ?>'><?php echo $trust_name ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <input name="refund" type="number" placeholder="Enter Amount" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">

                                                    <select class="form-control" name="pay_mode">

                                                        <option value="0">Cheque</option>
                                                        <option value="1">Cash</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">

                                                    <input class="form-control" name="check_number" placeholder="Enter Check Number">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button name="submit" class="btn btn-primary" value='<?php echo $id ?>'>Submit</button>

                                                </div>

                                            </div>

                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $id = $_POST['submit'];
                                                $input = $_GET['input'];
                                                $refund = $_POST['refund'];
                                                $mode = $_POST['pay_mode'];
                                                $cn = $_POST['check_number'];
                                                $an = "";
                                                $trust_id = $_POST['trust_id'];

                                                $c = date('Y-m-d');
                                                if (!isset($refund)) {
                                                } else {
                                                    $s1 = "INSERT INTO ledger (`booking_id`, `amount`, `trust_id`, `check_number`, `account_number`, `pay_mode`, `file`, `debit`, `credit`, `c_date`, `status`, `check_cleared_date`) VALUES($id,'$refund',$trust_id,'$cn','$an',$mode,'',0,1,'$c',1,'')";
                                                    if (mysqli_query($conn, $s1)) {
                                                        $s2 = "SELECT its,name,mobile,jk_id,timings_id from booking_info WHERE id=$id";
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
                                                        $msg = "Amount of Rs." . $refund . " Refunded..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
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
                                        </form>
                        <?php  }
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