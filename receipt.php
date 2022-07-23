<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
session_start();
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];

    if ($_GET['name'] == "Hall Rent") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "39" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Cash") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "39" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }


    if ($_GET['name'] == "CN") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "39" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Garbage") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "40" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "G") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "40" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }


    if ($_GET['name'] == "Miscellaneous") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "56" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "SD") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "46" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "SDA") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "46" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "RSD") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "47" || $formid == "38") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Payment Voucher") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "45" || $formid == "52") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
} else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");

    die();
} else {
    header("Location: login.php");
    die();
}
$get_name = $_GET['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt <?php echo $get_name;  ?></title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .print-area {
            display: none;
        }

        .box_receipt1 {
            margin-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            height: 500px;
            border: 1px solid #000000;
            word-wrap: break-word;

        }


        @media print {

            .print-area {
                display: block;
            }

            .box_receipt {
                padding-left: 30px;
                padding-right: 30px;
                padding-top: 30px;
                padding-bottom: 10px;

                border: 1px solid #000000;
                word-wrap: break-word;


            }


            .example-screen {
                display: none;
            }



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
        require('connectDB.php');
        date_default_timezone_set('Asia/kolkata');
        $current_date = date('Y-m-d');
        function getIndianCurrency($number)
        {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                0 => '', 1 => 'ONE', 2 => 'TWO',
                3 => 'THREE', 4 => 'FOUR', 5 => 'FIVE', 6 => 'SIX',
                7 => 'SEVEN', 8 => 'EIGHT', 9 => 'NINE',
                10 => 'TEN', 11 => 'ELEVEN', 12 => 'TWELVE',
                13 => 'THIRTEEN', 14 => 'FOURTEEN', 15 => 'FIFTEEN',
                16 => 'SIXTEEN', 17 => 'SEVENTEEN', 18 => 'EIGHTEEN',
                19 => 'NINETEEN', 20 => 'TWENTY', 30 => 'THIRTY',
                40 => 'FORTY', 50 => 'FIFTY', 60 => 'SIXTY',
                70 => 'SEVENTY', 80 => 'EIGHTY', 90 => 'NINETY'
            );
            $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
            while ($i < $digits_length) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
            return ($Rupees ? $Rupees . 'RUPEES ' : '') . $paise;
        }


        ?>

        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Receipt <?php echo $get_name  ?></h6>
                </div>
                <div class="card-body">

                    <?php
                    if ($get_name == "Hall Rent") { ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                    <select class="form-control" name="type_id" id="type_id" onchange="change_type_receipt()">
                                        <option value="1">Cheque</option>
                                        <option value="2">Cash</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">

                                    <div class="search-box">

                                        <input class="form-control" name="bk_id" type="text" autocomplete="off" placeholder="Enter Booking ID..." required />

                                        <div class="result"></div>
                                    </div>
                                </div>



                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button value="check" name="check" class="btn btn-primary">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['check'])) {

                            if ($_POST['type_id'] == "1") {

                                $bk_id = $_POST['bk_id'];
                                if (strpos($bk_id, '(') !== false) {
                                    $first_index = stripos($bk_id, "(") + 1;
                                    $s_id_e = substr($bk_id, $first_index);
                                    $bk_id = rtrim($s_id_e, ") ");
                                }
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE type=0 AND pay_mode=0 AND bk_id=$bk_id AND (status=1 OR status=4)";
                                $run_0 = $conn->query($s_0);
                                $row_0 = $run_0->fetch_assoc();
                                $c_0 = $row_0['c_0'];
                                if ($c_0 > 0) {
                                    $sql = "SELECT id,bk_id,amount,c_date,check_number,account_number,pay_mode,status,check_cleared_date,trust_id from ledger2 WHERE type=0 AND pay_mode=0 AND bk_id=$bk_id AND (status=1 OR status=4) ";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {

                                        while ($row = $run->fetch_assoc()) {
                                            $input = $row['bk_id'];
                                            $a = $row['amount'];
                                            $cn = $row['check_number'];
                                            $an = $row['account_number'];
                                            $current_date = $row['c_date'];
                                            $pay_mode = $row['pay_mode'];
                                            $ledger_id = $row['id'];
                                            $trust_id = $row['trust_id'];
                                            $status_id_cc = $row['status'];
                                            if ($status_id_cc == "0") {
                                                $status_cc = "Clearance Pending";
                                            }
                                            if ($status_id_cc == "1") {
                                                $status_cc = "Cleared";
                                            }
                                            if ($status_id_cc == "2") {
                                                $status_cc = "Failed";
                                            }
                                            $c_c_date = $row['check_cleared_date'];
                                            $sql2 = "SELECT id,its,name,mobile,date,jk_id,purpose,timings_id,status from booking_info WHERE id=$input";


                                            $run2 = $conn->query($sql2); ?>
                                            <?php if ($run2->num_rows > 0) {
                                            ?>
                                                <?php

                                                while ($row = $run2->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $its = $row['its'];
                                                    $name = $row['name'];


                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
                                                    $status = $row['status'];
                                                    $purpose = $row['purpose'];
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

                                                <?php     }

                                                ?>

                                                <?php


                                                $pay_name = "";
                                                if ($pay_mode == "0") {
                                                    $pay_name = "Cheque";
                                                } else {
                                                    $pay_name = "Cash";
                                                }
                                                $st = "SELECT name from trust WHERE id=$trust_id";
                                                $rt = $conn->query($st);
                                                $rowt = $rt->fetch_assoc();
                                                $trust_name = $rowt['name'];



                                                ?>
                                                <br>


                                                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id ?>')" value="Print" />

                                                <br>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {
                                                                            $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                            $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }
                                                                        }  ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                            <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>

                                                            <p>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>

                                                            <p style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                            <style>
                                                                .box_r1 {
                                                                    width: 150px;
                                                                    height: 50px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <p style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="printableArea<?php echo $ledger_id ?>">
                                                    <div class="print-area">
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                            <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></h3>

                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                        <br>
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                            <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></h3>

                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>


                                        <?php
                                            }
                                        }
                                    } else {
                                        echo '<div class="alert alert-info mt-2" role="alert">
                                               No Cheque Found
                                               </div>';
                                    }
                                }

                                $sql = "SELECT c_date,id,bk_id,amount,check_number,account_number,pay_mode,status,check_cleared_date,trust_id from ledger3 WHERE type=0 AND pay_mode=0 AND bk_id=$bk_id AND (status=1 OR status=4) ";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {

                                    while ($row = $run->fetch_assoc()) {
                                        $input = $row['bk_id'];
                                        $a = $row['amount'];
                                        $cn = $row['check_number'];
                                        $an = $row['account_number'];
                                        $pay_mode = $row['pay_mode'];
                                        $ledger_id = $row['id'];
                                        $current_date = $row['c_date'];
                                        $trust_id = $row['trust_id'];
                                        $status_id_cc = $row['status'];
                                        if ($status_id_cc == "0") {
                                            $status_cc = "Clearance Pending";
                                        }
                                        if ($status_id_cc == "1") {
                                            $status_cc = "Cleared";
                                        }
                                        if ($status_id_cc == "2") {
                                            $status_cc = "Failed";
                                        }
                                        $c_c_date = $row['check_cleared_date'];
                                        $sql2 = "SELECT id,its,name,mobile,date,jk_id,purpose,timings_id,status from booking_info WHERE id=$input";


                                        $run2 = $conn->query($sql2); ?>
                                        <?php if ($run2->num_rows > 0) {
                                        ?>
                                            <?php

                                            while ($row = $run2->fetch_assoc()) {
                                                $id = $row['id'];
                                                $its = $row['its'];
                                                $name = $row['name'];


                                                $mobile = $row['mobile'];
                                                $date = $row['date'];
                                                $status = $row['status'];
                                                $purpose = $row['purpose'];
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

                                            <?php     }

                                            ?>

                                            <?php


                                            $pay_name = "";
                                            if ($pay_mode == "0") {
                                                $pay_name = "Cheque";
                                            } else {
                                                $pay_name = "Cash";
                                            }
                                            $st = "SELECT name from trust WHERE id=$trust_id";
                                            $rt = $conn->query($st);
                                            $rowt = $rt->fetch_assoc();
                                            $trust_name = $rowt['name'];



                                            ?>
                                            <br>
                                            <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id ?>')" value="Print" />

                                            <br>
                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                        $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }
                                                                    }  ?></b>
                                                            </span>

                                                        </p>
                                                        <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                        <br>
                                                        <p style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "MTNC/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                        <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>

                                                        <p>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>

                                                        <p style="text-align:left;">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <p style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id ?>">
                                                <div class="print-area">
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "MTNC/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></h3>

                                                        <h3 style="text-align:left;">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                    <br>
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "MTNC/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></h3>

                                                        <h3 style="text-align:left;">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                </div>
                                            </div>


                                        <?php
                                        }
                                    }
                                } else {
                                    echo '<div class="alert alert-info mt-2" role="alert">
                                               No Cheque Found
                                               </div>';
                                }
                            } else {
                                $bk_id = $_POST['bk_id'];
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=4) AND type=0 ";
                                $run_0 = $conn->query($s_0);
                                $row_0 = $run_0->fetch_assoc();
                                $c_0 = $row_0['c_0'];
                                if ($c_0 > 0) {
                                    $sql = "SELECT c_date,id,bk_id,amount,status,trust_id from ledger2 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=4) AND type=0  ";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        $sum = 0;

                                        while ($row = $run->fetch_assoc()) {
                                            $input = $row['bk_id'];
                                            $a = $row['amount'];
                                            $ledger_id = $row['id'];
                                            $current_date = $row['c_date'];
                                            $trust_id = $row['trust_id'];
                                            $st = "SELECT name from trust WHERE id=$trust_id";
                                            $rt = $conn->query($st);
                                            $rowt = $rt->fetch_assoc();
                                            $trust_name = $rowt['name'];

                                            $status_id_cc = $row['status'];
                                            if ($status_id_cc == "0") {
                                                $status_cc = "Clearance Pending";
                                            }
                                            if ($status_id_cc == "1") {
                                                $status_cc = "Cleared";
                                            }
                                            if ($status_id_cc == "2") {
                                                $status_cc = "Failed";
                                            }

                                            $sql2 = "SELECT id,its,name,mobile,date,status,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                            $run2 = $conn->query($sql2); ?>
                                            <?php if ($run2->num_rows > 0) {
                                            ?>
                                                <?php

                                                while ($row = $run2->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $its = $row['its'];
                                                    $name = $row['name'];


                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
                                                    $status = $row['status'];
                                                    $purpose = $row['purpose'];
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

                                                <?php     }

                                                ?>
                                                <br>
                                                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id ?>')" value="Print" />

                                                <br>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                            $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                            $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }
                                                                        } ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                            <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>


                                                            <p style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                            <style>
                                                                .box_r1 {
                                                                    width: 150px;
                                                                    height: 50px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <p style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="printableArea<?php echo $ledger_id ?>">
                                                    <div class="print-area">
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>


                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                        <br>
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>


                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>


                                            <?php
                                            }
                                        }
                                    } else {
                                        echo '<div class="alert alert-info mt-2" role="alert">
                                               Nothing Found
                                               </div>';
                                    }
                                }

                                $s_0 = "SELECT COUNT(*) as c_1 from ledger3 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=4) AND type=0 ";
                                $run_0 = $conn->query($s_0);
                                $row_0 = $run_0->fetch_assoc();
                                $c_1 = $row_0['c_1'];
                                if ($c_1 > 0) {
                                    $sql = "SELECT c_date,id,bk_id,amount,status,trust_id from ledger3 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=4) AND type=0  ";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        $sum = 0;

                                        while ($row = $run->fetch_assoc()) {
                                            $input = $row['bk_id'];
                                            $a = $row['amount'];
                                            $ledger_id = $row['id'];
                                            $current_date = $row['c_date'];
                                            $trust_id = $row['trust_id'];
                                            $st = "SELECT name from trust WHERE id=$trust_id";
                                            $rt = $conn->query($st);
                                            $rowt = $rt->fetch_assoc();
                                            $trust_name = $rowt['name'];

                                            $status_id_cc = $row['status'];
                                            if ($status_id_cc == "0") {
                                                $status_cc = "Clearance Pending";
                                            }
                                            if ($status_id_cc == "1") {
                                                $status_cc = "Cleared";
                                            }
                                            if ($status_id_cc == "2") {
                                                $status_cc = "Failed";
                                            }

                                            $sql2 = "SELECT id,its,name,mobile,date,status,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                            $run2 = $conn->query($sql2); ?>
                                            <?php if ($run2->num_rows > 0) {
                                            ?>
                                                <?php

                                                while ($row = $run2->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $its = $row['its'];
                                                    $name = $row['name'];


                                                    $mobile = $row['mobile'];
                                                    $date = $row['date'];
                                                    $status = $row['status'];
                                                    $purpose = $row['purpose'];
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

                                                <?php     }

                                                ?>
                                                <br>
                                                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id ?>')" value="Print" />

                                                <br>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                            $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                            $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                            $rund2 = $conn->query($d2);
                                                                            if ($rund2->num_rows > 0) {
                                                                                $rowd2 = $rund2->fetch_assoc();
                                                                                $receipt_id = $rowd2['id'];
                                                                            } else {
                                                                                $receipt_id = "";
                                                                            }
                                                                        } ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "MTNC/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                            <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>


                                                            <p style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                            <style>
                                                                .box_r1 {
                                                                    width: 150px;
                                                                    height: 50px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <p style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="printableArea<?php echo $ledger_id ?>">
                                                    <div class="print-area">
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "MTNC/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>


                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                        <br>
                                                        <div class="box_receipt">
                                                            <h2 style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b> <?php
                                                                        if ($trust_id == "1") {

                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        } ?></b>
                                                                </span>

                                                            </h2>
                                                            <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                            <br>
                                                            <h3 style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "MTNC/HR/" . $bk_id . "/" . $receipt_id; ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                            <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>


                                                            <h3 style="text-align:left;">
                                                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                                <span>
                                                                    on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                                </span>
                                                            </h3>

                                                            <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                            <br>
                                                            <style>
                                                                .box_r {
                                                                    width: 300px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    font-size: 40px;
                                                                }
                                                            </style>

                                                            <div class="box_r text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                            </div>
                                                            <h3 style="text-align:center;margin-left:200px">
                                                                Donor's Sign
                                                                <span style="float:right;">
                                                                    Receiver's Sign
                                                                </span>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>


                        <?php
                                            }
                                        }
                                    }
                                }
                            }
                        }


                        ?>
                    <?php
                    }
                    if ($get_name == "Online") {
                    ?>


                        <?php

                        $bk_id = $_GET['bk_id'];

                        if (isset($_GET['ledger_id'])) {
                            $ledger_id = $_GET['ledger_id'];
                            $trust_id = $_GET['trust_id'];
                            if ($trust_id == 1) {
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE pay_mode=2 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                            } else {
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger3 WHERE pay_mode=2  AND (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                            }
                        } else {
                            $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE pay_mode=2 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=3 ) AND type=0";
                        }

                        $run_0 = $conn->query($s_0);
                        $row_0 = $run_0->fetch_assoc();
                        $c_0 = $row_0['c_0'];
                        if ($c_0 > 0) {
                            

                            if (isset($_GET['ledger_id'])) {
                                if ($trust_id == 1) {
                                    $sql = "SELECT c_date,id,amount,trust_id,status,debit,check_number,bk_id from ledger2 WHERE pay_mode=2 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                                } else {
                                    $sql = "SELECT c_date,id,amount,trust_id,status,debit,check_number,bk_id from ledger3 WHERE pay_mode=2 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                                }
                            } else {
                                $sql = "SELECT c_date,id,amount,trust_id,status,debit,check_number,bk_id from ledger2 WHERE pay_mode=2 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=3 ) AND type=0";
                            }
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {
                                while ($row = $run->fetch_assoc()) {
                                    $bk_id=$row['bk_id'];
                                    $input = $bk_id;
                                    $a = $row['amount'];

                                    $ledger_id = $row['id'];
                                    $debit = $row['debit'];
                                    $cn=$row['check_number'];
                                    $trust_id = $row['trust_id'];
                                    $current_date = $row['c_date'];
                                    $st = "SELECT name from trust WHERE id=$trust_id";
                                    $rt = $conn->query($st);
                                    $rowt = $rt->fetch_assoc();
                                    $trust_name = $rowt['name'];

                                    $status = $row['status'];
                                    if ($status_id_cc == "0") {
                                        $status_cc = "Clearance Pending";
                                    }
                                    if ($status_id_cc == "1") {
                                        $status_cc = "Cleared";
                                    }
                                    if ($status_id_cc == "2") {
                                        $status_cc = "Failed";
                                    }

                                    $sql2 = "SELECT id,its,name,mobile,date,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                    $run2 = $conn->query($sql2); ?>
                                    <?php if ($run2->num_rows > 0) {
                                    ?>
                                        <?php

                                        while ($row = $run2->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];


                                            $mobile = $row['mobile'];
                                            $date = $row['date'];

                                            $purpose = $row['purpose'];
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

                                        <?php     }

                                        ?>
                                        <br>
                                        <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id . $trust_id ?>')" value="Print" />
                                        <br>
                                        <?php
                                        if ($debit == 0) {
                                        ?>
                                            <div id="printableArea1">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <div class="row">
                                                            <style>
                                                                .upper_title {
                                                                    line-height: 5px;
                                                                }
                                                            </style>
                                                            <div class="col-lg-6 upper_title">

                                                                <?php
                                                                if ($trust_id == "2") {
                                                                    $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }
                                                                ?>

                                                                    <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                                    <p> Trust Reg. No. 894/2006,Indore</p>
                                                                <?php

                                                                } else {
                                                                    $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }
                                                                ?>
                                                                    <p> <u><b>HAKIMI TRUST</b></u></p>

                                                                    <p> Trust Reg. No. 986/2008,Indore</p>
                                                                <?php
                                                                }
                                                                ?>
                                                                <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                                                <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <style>
                                                                    .box_r2 {
                                                                        width: 150px;
                                                                        height: 50px;
                                                                        border: 1px solid #000000;
                                                                        word-wrap: break-word;
                                                                        float: right;
                                                                    }
                                                                </style>
                                                                <p style="text-align:left;">
                                                                    <span style="float:right;">
                                                                        <div class="box_r2 text-center">
                                                                            <b>Voucher</b>
                                                                            <br>
                                                                            <b>No. <?php
                                                                                    if ($trust_id == "2") {
                                                                                    ?>

                                                                                    MTNC

                                                                                <?php

                                                                                    } else {
                                                                                ?>
                                                                                    HT

                                                                                    <?php
                                                                                    }
                                                                                    ?>/<?php echo $bk_id ?>/</b>
                                                                            <?php echo $receipt_id; ?>
                                                                        </div>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>




                                                        <p style="text-align:left;">
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>
                                                        <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></p>



                                                        <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>

                                                        <div style="float:left;">
                                                            <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;">

                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


                                                        <p style="text-align:left;">

                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>



                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p>Passed By</p>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <p>Receiver's Signature</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                                <div class="print-area">
                                                    <div class="box_receipt">

                                                        <style>
                                                            .upper_title1 {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="upper_title1" style="text-align:left;">
                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                            <?php
                                                            }
                                                            ?>


                                                            <style>
                                                                .box_r21 {
                                                                    width: 250px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <span style="float:right;">
                                                                <h3>
                                                                    <div class="box_r21 text-center ">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </h3>
                                                                <br>
                                                                <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                            </span>

                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                            <?php
                                                            }
                                                            ?>
                                                            <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                            <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                        </div>









                                                        <br>
                                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <div style="float:left;">
                                                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">




                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></p>


                                                        <h3 style="text-align:left;">

                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <br>
                                                        <h3 style="text-align:left;">

                                                            <span style="float: right;">
                                                                <div class="box_r1 text-center">
                                                                    &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                                </div>

                                                            </span>
                                                        </h3>
                                                        <br>

                                                        <h3>
                                                            <div style="float: left">Passed By</div>
                                                            <div style="float: right"></div>
                                                            <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                        </h3>
                                                    </div>
                                                    <br>
                                                    <div class="box_receipt">

                                                        <style>
                                                            .upper_title1 {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="upper_title1" style="text-align:left;">

                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                            <?php
                                                            }
                                                            ?>

                                                            <style>
                                                                .box_r21 {
                                                                    width: 250px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <span style="float:right;">
                                                                <h3>
                                                                    <div class="box_r21 text-center ">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </h3>
                                                                <br>
                                                                <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                            </span>



                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                            <?php
                                                            }
                                                            ?>


                                                            <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                            <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                        </div>









                                                        <br>
                                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <div style="float:left;">
                                                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">



                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                        <h3 style="text-align:left;">
                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <br>
                                                        <h3 style="text-align:left;">

                                                            <span style="float: right;">
                                                                <div class="box_r1 text-center">
                                                                    &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                                </div>

                                                            </span>
                                                        </h3>
                                                        <br>

                                                        <h3>
                                                            <div style="float: left">Passed By</div>
                                                            <div style="float: right"></div>
                                                            <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        } else {

                                        ?>

                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                        $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }
                                                                    } ?></b>
                                                            </span>

                                                        </p>
                                                        <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                        <br>
                                                        <p style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                        <div style="float:left;">
                                                            <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt"> &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>


                                                        <p style="text-align:left;display:inline-block">
                                                            &nbsp; against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <p style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </p>

                                                    </div>

                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                                <div class="print-area">
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b> <?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <div style="float:left;">
                                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt"> &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>



                                                        <p style="text-align:left;display:inline-block;font-size:18pt">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                    <br>
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b> <?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <div style="float:left;">
                                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <p style="text-align:left;display:inline-block;font-size:18pt"> &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>


                                                        <p style="text-align:left;display:inline-block;font-size:18pt">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                </div>
                                            </div>


                        <?php
                                        }
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                                           No Cheque Found
                                           </div>';
                            }
                        }
                    }






                    // DOWN IS CASH




                    if ($get_name == "Cash") {
                        ?>


                        <?php

                        $bk_id = $_GET['bk_id'];

                        if (isset($_GET['ledger_id'])) {
                            $ledger_id = $_GET['ledger_id'];
                            $trust_id = $_GET['trust_id'];
                            if ($trust_id == 1) {
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE pay_mode=1 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                            } else {
                                $s_0 = "SELECT COUNT(*) as c_0 from ledger3 WHERE pay_mode=1  AND (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                            }
                        } else {
                            $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=3 ) AND type=0";
                        }

                        $run_0 = $conn->query($s_0);
                        $row_0 = $run_0->fetch_assoc();
                        $c_0 = $row_0['c_0'];
                        if ($c_0 > 0) {

                            if (isset($_GET['ledger_id'])) {
                                if ($trust_id == 1) {
                                    $sql = "SELECT c_date,id,amount,trust_id,status,debit from ledger2 WHERE pay_mode=1 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                                } else {
                                    $sql = "SELECT c_date,id,amount,trust_id,status,debit from ledger3 WHERE pay_mode=1 AND  (status=1 OR status=3 ) AND type=0 AND id=$ledger_id ";
                                }
                            } else {
                                $sql = "SELECT c_date,id,amount,trust_id,status,debit from ledger2 WHERE pay_mode=1 AND debit=1 AND bk_id=$bk_id AND (status=1 OR status=3 ) AND type=0";
                            }
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {

                                while ($row = $run->fetch_assoc()) {
                                    $input = $bk_id;
                                    $a = $row['amount'];

                                    $ledger_id = $row['id'];
                                    $debit = $row['debit'];
                                    $trust_id = $row['trust_id'];
                                    $current_date = $row['c_date'];
                                    $st = "SELECT name from trust WHERE id=$trust_id";
                                    $rt = $conn->query($st);
                                    $rowt = $rt->fetch_assoc();
                                    $trust_name = $rowt['name'];

                                    $status = $row['status'];
                                    if ($status_id_cc == "0") {
                                        $status_cc = "Clearance Pending";
                                    }
                                    if ($status_id_cc == "1") {
                                        $status_cc = "Cleared";
                                    }
                                    if ($status_id_cc == "2") {
                                        $status_cc = "Failed";
                                    }

                                    $sql2 = "SELECT id,its,name,mobile,date,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                    $run2 = $conn->query($sql2); ?>
                                    <?php if ($run2->num_rows > 0) {
                                    ?>
                                        <?php

                                        while ($row = $run2->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];


                                            $mobile = $row['mobile'];
                                            $date = $row['date'];

                                            $purpose = $row['purpose'];
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

                                        <?php     }

                                        ?>
                                        <br>
                                        <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id . $trust_id ?>')" value="Print" />
                                        <br>
                                        <?php
                                        if ($debit == 0) {
                                        ?>
                                            <div id="printableArea1">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <div class="row">
                                                            <style>
                                                                .upper_title {
                                                                    line-height: 5px;
                                                                }
                                                            </style>
                                                            <div class="col-lg-6 upper_title">

                                                                <?php
                                                                if ($trust_id == "2") {
                                                                    $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }
                                                                ?>

                                                                    <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                                    <p> Trust Reg. No. 894/2006,Indore</p>
                                                                <?php

                                                                } else {
                                                                    $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }
                                                                ?>
                                                                    <p> <u><b>HAKIMI TRUST</b></u></p>

                                                                    <p> Trust Reg. No. 986/2008,Indore</p>
                                                                <?php
                                                                }
                                                                ?>
                                                                <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                                                <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <style>
                                                                    .box_r2 {
                                                                        width: 150px;
                                                                        height: 50px;
                                                                        border: 1px solid #000000;
                                                                        word-wrap: break-word;
                                                                        float: right;
                                                                    }
                                                                </style>
                                                                <p style="text-align:left;">
                                                                    <span style="float:right;">
                                                                        <div class="box_r2 text-center">
                                                                            <b>Voucher</b>
                                                                            <br>
                                                                            <b>No. <?php
                                                                                    if ($trust_id == "2") {
                                                                                    ?>

                                                                                    MTNC

                                                                                <?php

                                                                                    } else {
                                                                                ?>
                                                                                    HT

                                                                                    <?php
                                                                                    }
                                                                                    ?>/<?php echo $bk_id ?>/</b>
                                                                            <?php echo $receipt_id; ?>
                                                                        </div>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>




                                                        <p style="text-align:left;">
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>
                                                        <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></p>



                                                        <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>

                                                        <div style="float:left;">
                                                            <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;">

                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


                                                        <p style="text-align:left;">

                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>



                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p>Passed By</p>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <p>Receiver's Signature</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                                <div class="print-area">
                                                    <div class="box_receipt">

                                                        <style>
                                                            .upper_title1 {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="upper_title1" style="text-align:left;">
                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                            <?php
                                                            }
                                                            ?>


                                                            <style>
                                                                .box_r21 {
                                                                    width: 250px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <span style="float:right;">
                                                                <h3>
                                                                    <div class="box_r21 text-center ">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </h3>
                                                                <br>
                                                                <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                            </span>

                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                            <?php
                                                            }
                                                            ?>
                                                            <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                            <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                        </div>









                                                        <br>
                                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <div style="float:left;">
                                                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">




                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></p>


                                                        <h3 style="text-align:left;">

                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <br>
                                                        <h3 style="text-align:left;">

                                                            <span style="float: right;">
                                                                <div class="box_r1 text-center">
                                                                    &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                                </div>

                                                            </span>
                                                        </h3>
                                                        <br>

                                                        <h3>
                                                            <div style="float: left">Passed By</div>
                                                            <div style="float: right"></div>
                                                            <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                        </h3>
                                                    </div>
                                                    <br>
                                                    <div class="box_receipt">

                                                        <style>
                                                            .upper_title1 {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="upper_title1" style="text-align:left;">

                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                            <?php
                                                            }
                                                            ?>

                                                            <style>
                                                                .box_r21 {
                                                                    width: 250px;
                                                                    height: 100px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;

                                                                }
                                                            </style>

                                                            <span style="float:right;">
                                                                <h3>
                                                                    <div class="box_r21 text-center ">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </h3>
                                                                <br>
                                                                <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                            </span>



                                                            <?php
                                                            if ($trust_id == "2") {
                                                            ?>

                                                                <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                            <?php
                                                            }
                                                            ?>


                                                            <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                            <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                        </div>









                                                        <br>
                                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                        <div style="float:left;">
                                                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">



                                                            on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                        <h3 style="text-align:left;">
                                                            <span>
                                                                on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </h3>


                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <br>
                                                        <h3 style="text-align:left;">

                                                            <span style="float: right;">
                                                                <div class="box_r1 text-center">
                                                                    &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                                </div>

                                                            </span>
                                                        </h3>
                                                        <br>

                                                        <h3>
                                                            <div style="float: left">Passed By</div>
                                                            <div style="float: right"></div>
                                                            <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        } else {

                                        ?>

                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                        $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                        $rund2 = $conn->query($d2);
                                                                        if ($rund2->num_rows > 0) {
                                                                            $rowd2 = $rund2->fetch_assoc();
                                                                            $receipt_id = $rowd2['id'];
                                                                        } else {
                                                                            $receipt_id = "";
                                                                        }
                                                                    } ?></b>
                                                            </span>

                                                        </p>
                                                        <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                        <br>
                                                        <p style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                        <div style="float:left;">
                                                            <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block">
                                                            &nbsp; against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                        <style>
                                                            .box_r1 {
                                                                width: 150px;
                                                                height: 50px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <p style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </p>

                                                    </div>

                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                                <div class="print-area">
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b> <?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <div style="float:left;">
                                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                    <br>
                                                    <div class="box_receipt">
                                                        <h2 style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b> <?php
                                                                    if ($trust_id == "1") {

                                                                        echo "Trust Reg. No. 986/2008";
                                                                    } else {
                                                                        echo "Trust Reg. No. 894/2006";
                                                                    } ?></b>
                                                            </span>

                                                        </h2>
                                                        <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                        <br>
                                                        <h3 style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo  "HT/HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </h3>

                                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                        <div style="float:left;">
                                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                        </div>
                                                        <div style="float:right;">
                                                            <?php
                                                            if ($status == 3) {
                                                            ?>
                                                                <img style="max-width:200px" src="images/deleted.png">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <p style="text-align:left;display:inline-block;font-size:18pt">
                                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                            <span>
                                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                            </span>
                                                        </p>

                                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                        <br>
                                                        <style>
                                                            .box_r {
                                                                width: 300px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;
                                                                font-size: 40px;
                                                            }
                                                        </style>

                                                        <div class="box_r text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                        </div>
                                                        <h3 style="text-align:center;margin-left:200px">
                                                            Donor's Sign
                                                            <span style="float:right;">
                                                                Receiver's Sign
                                                            </span>
                                                        </h3>

                                                    </div>
                                                </div>
                                            </div>


                        <?php
                                        }
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                                       No Cheque Found
                                       </div>';
                            }
                        }
                    }

                    if ($get_name == "RB") {
                        ?>


                        <?php

                        $bk_id = $_GET['bk_id'];
                        $s_0 = "SELECT COUNT(*) as c_0 from ledger2 WHERE  debit=0 AND bk_id=$bk_id AND status=1 AND amount!=0 AND type=0";
                        $run_0 = $conn->query($s_0);
                        $row_0 = $run_0->fetch_assoc();
                        $c_0 = $row_0['c_0'];
                        if ($c_0 > 0) {

                            $sql = "SELECT c_date,id,amount,trust_id,status from ledger2 WHERE debit=0 AND amount!=0 AND bk_id=$bk_id AND status=1 AND type=0";
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {

                                while ($row = $run->fetch_assoc()) {
                                    $input = $bk_id;
                                    $a = $row['amount'];
                                    $current_date = $row['c_date'];
                                    $ledger_id = $row['id'];
                                    $trust_id = $row['trust_id'];
                                    $st = "SELECT name from trust WHERE id=$trust_id";
                                    $rt = $conn->query($st);
                                    $rowt = $rt->fetch_assoc();
                                    $trust_name = $rowt['name'];

                                    $status_id_cc = $row['status'];
                                    if ($status_id_cc == "0") {
                                        $status_cc = "Clearance Pending";
                                    }
                                    if ($status_id_cc == "1") {
                                        $status_cc = "Cleared";
                                    }
                                    if ($status_id_cc == "2") {
                                        $status_cc = "Failed";
                                    }

                                    $sql2 = "SELECT id,its,name,mobile,date,status,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                    $run2 = $conn->query($sql2); ?>
                                    <?php if ($run2->num_rows > 0) {
                                    ?>
                                        <?php

                                        while ($row = $run2->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];


                                            $mobile = $row['mobile'];
                                            $date = $row['date'];
                                            $status = $row['status'];
                                            $purpose = $row['purpose'];
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

                                        <?php     }



                                        ?>
                                        <br>
                                        <input type="button" class="btn btn-warning" onclick="printDiv('printableAreaHT<?php echo $ledger_id ?>')" value="Print" />

                                        <br>
                                        <div id="printableArea1">
                                            <div class="print-area1">
                                                <div class="box_receipt1">
                                                    <div class="row">
                                                        <style>
                                                            .upper_title {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="col-lg-6 upper_title">

                                                            <?php
                                                            if ($trust_id == "2") {
                                                                $d2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }
                                                            ?>

                                                                <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                                <p> Trust Reg. No. 894/2006,Indore</p>
                                                            <?php

                                                            } else {
                                                                $d2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }
                                                            ?>
                                                                <p> <u><b>HAKIMI TRUST</b></u></p>

                                                                <p> Trust Reg. No. 986/2008,Indore</p>
                                                            <?php
                                                            }
                                                            ?>
                                                            <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                                            <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <style>
                                                                .box_r2 {
                                                                    width: 150px;
                                                                    height: 50px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    float: right;
                                                                }
                                                            </style>
                                                            <p style="text-align:left;">
                                                                <span style="float:right;">
                                                                    <div class="box_r2 text-center">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>




                                                    <p style="text-align:left;">
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </p>
                                                    <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></p>



                                                    <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>
                                                    <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                                    <p>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


                                                    <p style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </p>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>



                                                    <span style="float: right;">
                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                        </div>

                                                    </span>
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p>Passed By</p>

                                                        </div>

                                                        <div class="col-lg-4">
                                                            <p>Receiver's Signature</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="printableAreaHT<?php echo $ledger_id ?>">
                                            <div class="print-area">
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">
                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>


                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $receipt_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>
                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>



                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                    <h3 style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                                <br>
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>

                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $receipt_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>



                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>


                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                    <h3 style="text-align:left;">
                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>


                                    <?php
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                                           No Cheque Found
                                           </div>';
                            }
                        }
                        $s_0 = "SELECT COUNT(*) as c_0 from ledger3 WHERE  debit=0 AND bk_id=$bk_id AND amount!=0 AND status=1 AND type=0";
                        $run_0 = $conn->query($s_0);
                        $row_0 = $run_0->fetch_assoc();
                        $c_0 = $row_0['c_0'];
                        if ($c_0 > 0) {

                            $sql = "SELECT c_date,id,amount,trust_id,status from ledger3 WHERE debit=0 AND amount!=0 AND bk_id=$bk_id AND status=1 AND type=0";
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {

                                while ($row = $run->fetch_assoc()) {
                                    $input = $bk_id;
                                    $a = $row['amount'];
                                    $current_date = $row['c_date'];
                                    $ledger_id = $row['id'];
                                    $trust_id = $row['trust_id'];
                                    $st = "SELECT name from trust WHERE id=$trust_id";
                                    $rt = $conn->query($st);
                                    $rowt = $rt->fetch_assoc();
                                    $trust_name = $rowt['name'];

                                    $status_id_cc = $row['status'];
                                    if ($status_id_cc == "0") {
                                        $status_cc = "Clearance Pending";
                                    }
                                    if ($status_id_cc == "1") {
                                        $status_cc = "Cleared";
                                    }
                                    if ($status_id_cc == "2") {
                                        $status_cc = "Failed";
                                    }

                                    $sql2 = "SELECT id,its,name,mobile,date,status,purpose,jk_id,timings_id from booking_info WHERE id=$input";


                                    $run2 = $conn->query($sql2); ?>
                                    <?php if ($run2->num_rows > 0) {
                                    ?>
                                        <?php

                                        while ($row = $run2->fetch_assoc()) {
                                            $id = $row['id'];
                                            $its = $row['its'];
                                            $name = $row['name'];


                                            $mobile = $row['mobile'];
                                            $date = $row['date'];
                                            $status = $row['status'];
                                            $purpose = $row['purpose'];
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

                                        <?php     }

                                        ?>
                                        <br>
                                        <input type="button" class="btn btn-warning" onclick="printDiv('printableAreaMTNC<?php echo $ledger_id ?>')" value="Print" />

                                        <br>
                                        <div id="printableArea1">
                                            <div class="print-area1">
                                                <div class="box_receipt1">
                                                    <div class="row">
                                                        <style>
                                                            .upper_title {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="col-lg-6 upper_title">

                                                            <?php
                                                            if ($trust_id == "2") {

                                                                $d2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }
                                                            ?>

                                                                <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                                <p> Trust Reg. No. 894/2006,Indore</p>
                                                            <?php

                                                            } else {
                                                                $d2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }

                                                            ?>
                                                                <p> <u><b>HAKIMI TRUST</b></u></p>

                                                                <p> Trust Reg. No. 986/2008,Indore</p>
                                                            <?php
                                                            }
                                                            ?>
                                                            <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                                            <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <style>
                                                                .box_r2 {
                                                                    width: 150px;
                                                                    height: 70px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    float: right;
                                                                    margin-bottom: 10px;
                                                                }
                                                            </style>
                                                            <p style="text-align:left;">
                                                                <span style="float:right;">
                                                                    <div class="box_r2 text-center">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>




                                                    <p style="text-align:left;">
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </p>
                                                    <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></p>



                                                    <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>
                                                    <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                                    <p>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


                                                    <p style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </p>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>



                                                    <span style="float: right;">
                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                        </div>

                                                    </span>
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p>Passed By</p>

                                                        </div>

                                                        <div class="col-lg-4">
                                                            <p>Receiver's Signature</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="printableAreaMTNC<?php echo $ledger_id ?>">
                                            <div class="print-area">
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">
                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>


                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $receipt_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>
                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                    <h3 style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                                <br>
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>

                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $ledger_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>



                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>


                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>


                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                    <h3 style="text-align:left;">
                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>


                        <?php
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-info mt-2" role="alert">
                                           No Cheque Found
                                           </div>';
                            }
                        }
                    }


                    if ($get_name == "CN") {


                        ?>
                        <script>
                            function printDiv(divName) {
                                var printContents = document.getElementById(divName).innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;

                                window.print();

                                document.body.innerHTML = originalContents;
                            }
                        </script>
                        <?php

                        $check_num = $_GET['Number'];
                        $bk_id = $_GET['bk_id'];
                        $trust_id = $_GET['trust_id'];
                        $ledger_id = $_GET['ledger_id'];



                        if ($trust_id == 1) {
                            if ($ledger_id != 0) {
                                $sql = "SELECT bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type,id from ledger2 WHERE id=$ledger_id";
                            } else {
                                $sql = "SELECT bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type,id from ledger2 WHERE bk_id=$bk_id";
                            }
                        } else {
                            if ($ledger_id != 0) {
                                $sql = "SELECT bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type,id from ledger3 WHERE id=$ledger_id";
                            } else {
                                $sql = "SELECT bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type,id from ledger3 WHERE bk_id=$bk_id";
                            }
                        }


                        $run = $conn->query($sql);
                        if ($run->num_rows > 0) {

                            while ($row = $run->fetch_assoc()) {
                                $input = $row['bk_id'];
                                $bk_id = $input;
                                $a = $row['amount'];
                                $current_date = $row['c_date'];
                                $cn = $row['check_number'];
                                $an = $row['account_number'];
                                $pay_mode = $row['pay_mode'];
                                $trust_id = $row['trust_id'];
                                $debit = $row['debit'];
                                $st = "SELECT name from trust WHERE id=$trust_id";
                                $rt = $conn->query($st);
                                $rowt = $rt->fetch_assoc();
                                $trust_name = $rowt['name'];

                                $ledger_id = $row['id'];

                                $status = $row['status'];
                                if ($status_id_cc == "0") {
                                    $status_cc = "Clearance Pending";
                                }
                                if ($status_id_cc == "1") {
                                    $status_cc = "Cleared";
                                }
                                if ($status_id_cc == "2") {
                                    $status_cc = "Failed";
                                }
                                $c_c_date = $row['check_cleared_date'];
                                $sql2 = "SELECT id,its,name,purpose,mobile,date,jk_id,timings_id from booking_info WHERE id=$input";


                                $run2 = $conn->query($sql2); ?>
                                <?php if ($run2->num_rows > 0) {
                                ?>





                                    <?php

                                    while ($row = $run2->fetch_assoc()) {
                                        $id = $row['id'];
                                        $its = $row['its'];
                                        $name = $row['name'];
                                        $purpose = $row['purpose'];


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

                                    <?php     }

                                    ?>

                                    <?php


                                    $pay_name = "";
                                    if ($pay_mode == "0") {
                                        $pay_name = "Cheque";
                                    } else {
                                        $pay_name = "Cash";
                                    }


                                    ?>
                                    <br>
                                    <input type="button" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id . $trust_id ?>')" value="Print" />

                                    <br>
                                    <?php
                                    if ($debit == 0) {
                                    ?>
                                        <div id="printableArea1">
                                            <div class="print-area1">
                                                <div class="box_receipt1">
                                                    <div class="row">
                                                        <style>
                                                            .upper_title {
                                                                line-height: 5px;
                                                            }
                                                        </style>
                                                        <div class="col-lg-6 upper_title">

                                                            <?php
                                                            if ($trust_id == "2") {
                                                                $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }
                                                            ?>

                                                                <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                                <p> Trust Reg. No. 894/2006,Indore</p>
                                                            <?php

                                                            } else {
                                                                $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                $rund2 = $conn->query($d2);
                                                                if ($rund2->num_rows > 0) {
                                                                    $rowd2 = $rund2->fetch_assoc();
                                                                    $receipt_id = $rowd2['id'];
                                                                } else {
                                                                    $receipt_id = "";
                                                                }
                                                            ?>
                                                                <p> <u><b>HAKIMI TRUST</b></u></p>

                                                                <p> Trust Reg. No. 986/2008,Indore</p>
                                                            <?php
                                                            }
                                                            ?>
                                                            <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                                            <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <style>
                                                                .box_r2 {
                                                                    width: 150px;
                                                                    height: 50px;
                                                                    border: 1px solid #000000;
                                                                    word-wrap: break-word;
                                                                    float: right;
                                                                }
                                                            </style>
                                                            <p style="text-align:left;">
                                                                <span style="float:right;">
                                                                    <div class="box_r2 text-center">
                                                                        <b>Voucher</b>
                                                                        <br>
                                                                        <b>No. <?php
                                                                                if ($trust_id == "2") {
                                                                                ?>

                                                                                MTNC

                                                                            <?php

                                                                                } else {
                                                                            ?>
                                                                                HT

                                                                                <?php
                                                                                }
                                                                                ?>/<?php echo $bk_id ?>/</b>
                                                                        <?php echo $receipt_id; ?>
                                                                    </div>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>




                                                    <p style="text-align:left;">
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </p>
                                                    <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></p>



                                                    <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>

                                                    <div style="float:left;">
                                                        <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;">

                                                        on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


                                                    <p style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </p>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>



                                                    <span style="float: right;">
                                                        <div class="box_r1 text-center">
                                                            &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                        </div>

                                                    </span>
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p>Passed By</p>

                                                        </div>

                                                        <div class="col-lg-4">
                                                            <p>Receiver's Signature</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                            <div class="print-area">
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">
                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>


                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $receipt_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>
                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <div style="float:left;">
                                                        <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;font-size:18pt">




                                                        on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></p>


                                                    <h3 style="text-align:left;">

                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                                <br>
                                                <div class="box_receipt">

                                                    <style>
                                                        .upper_title1 {
                                                            line-height: 5px;
                                                        }
                                                    </style>
                                                    <div class="upper_title1" style="text-align:left;">

                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h2> <u><b>DAWOODI BOHRA JAMAAT</b></u></h2>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                                        <?php
                                                        }
                                                        ?>

                                                        <style>
                                                            .box_r21 {
                                                                width: 250px;
                                                                height: 100px;
                                                                border: 1px solid #000000;
                                                                word-wrap: break-word;

                                                            }
                                                        </style>

                                                        <span style="float:right;">
                                                            <h3>
                                                                <div class="box_r21 text-center ">
                                                                    <b>Voucher</b>
                                                                    <br>
                                                                    <b>No. <?php
                                                                            if ($trust_id == "2") {
                                                                            ?>

                                                                            MTNC

                                                                        <?php

                                                                            } else {
                                                                        ?>
                                                                            HT

                                                                            <?php
                                                                            }
                                                                            ?>/<?php echo $bk_id ?>/</b>
                                                                    <?php echo $receipt_id; ?>
                                                                </div>
                                                            </h3>
                                                            <br>
                                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                                        </span>



                                                        <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                            <h5> Trust Reg. No. 894/2006,Indore</h5>

                                                        <?php

                                                        } else {
                                                        ?>
                                                            <h5> Trust Reg. No. 986/2008,Indore</h5>

                                                        <?php
                                                        }
                                                        ?>


                                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                                    </div>









                                                    <br>
                                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $a ?></b></u></h3>

                                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>

                                                    <div style="float:left;">
                                                        <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;font-size:18pt">



                                                        on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


                                                    <h3 style="text-align:left;">
                                                        <span>
                                                            on Dated &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>


                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <br>
                                                    <h3 style="text-align:left;">

                                                        <span style="float: right;">
                                                            <div class="box_r1 text-center">
                                                                &#x20B9;&nbsp;<b><?php echo $a ?></b>
                                                            </div>

                                                        </span>
                                                    </h3>
                                                    <br>

                                                    <h3>
                                                        <div style="float: left">Passed By</div>
                                                        <div style="float: right"></div>
                                                        <div style="margin: 0 auto; width: 150px;">Receiver's Signature</div>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    } else {

                                    ?>
                                        <div id="printableArea">
                                            <div class="print-area1">
                                                <div class="box_receipt1">
                                                    <p style="text-align:left;">
                                                        <u><b>RECEIPT</b></u>
                                                        <span style="float:right;">
                                                            <b> <?php
                                                                if ($trust_id == "1") {
                                                                    $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }

                                                                    echo "Trust Reg. No. 986/2008";
                                                                } else {
                                                                    echo "Trust Reg. No. 894/2006";
                                                                    $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $receipt_id = "";
                                                                    }
                                                                } ?></b>
                                                        </span>

                                                    </p>
                                                    <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                    <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                    <br>
                                                    <p style="text-align:left;">
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                           if($trust_id==1)
                                                           {
                                                               echo "HT/";
                                                           }
                                                           else
                                                           {
                                                               echo "MTNC/";
                                                           }
                                                        
                                                        echo "HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </p>

                                                    <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                                    <div style="float:left;">
                                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></p>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;">

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>

                                                    <p style="text-align:left;">
                                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                        <span>
                                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </p>

                                                    <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                                    <style>
                                                        .box_r1 {
                                                            width: 150px;
                                                            height: 50px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;

                                                        }
                                                    </style>

                                                    <div class="box_r1 text-center">
                                                        &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                    </div>
                                                    <h3 style="text-align:center;margin-left:200px">
                                                        Donor's Sign
                                                        <span style="float:right;">
                                                            Receiver's Sign
                                                        </span>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>


                                        <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
                                            <div class="print-area">
                                                <div class="box_receipt">
                                                    <h2 style="text-align:left;">
                                                        <u><b>RECEIPT</b></u>
                                                        <span style="float:right;">
                                                            <b> <?php
                                                                if ($trust_id == "1") {

                                                                    echo "Trust Reg. No. 986/2008";
                                                                } else {
                                                                    echo "Trust Reg. No. 894/2006";
                                                                } ?></b>
                                                        </span>

                                                    </h2>
                                                    <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                    <br>
                                                    <h3 style="text-align:left;">
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                        if($trust_id==1)
                                                        {
                                                            echo "HT/";
                                                        }
                                                        else
                                                        {
                                                            echo "MTNC/";
                                                        }
                                                        
                                                        echo "HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </h3>

                                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                                    <div style="float:left;">
                                                        <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;font-size:18pt">

                                                        By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>

                                                    <h3 style="text-align:left;">
                                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                        <span>
                                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>

                                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                    <br>
                                                    <style>
                                                        .box_r {
                                                            width: 300px;
                                                            height: 100px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;
                                                            font-size: 40px;
                                                        }
                                                    </style>

                                                    <div class="box_r text-center">
                                                        &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                    </div>
                                                    <h3 style="text-align:center;margin-left:200px">
                                                        Donor's Sign
                                                        <span style="float:right;">
                                                            Receiver's Sign
                                                        </span>
                                                    </h3>

                                                </div>
                                                <br>
                                                <div class="box_receipt">
                                                    <h2 style="text-align:left;">
                                                        <u><b>RECEIPT</b></u>
                                                        <span style="float:right;">
                                                            <b> <?php
                                                                if ($trust_id == "1") {

                                                                    echo "Trust Reg. No. 986/2008";
                                                                } else {
                                                                    echo "Trust Reg. No. 894/2006";
                                                                } ?></b>
                                                        </span>

                                                    </h2>
                                                    <h1 class="text-center"><b><?php echo $trust_name ?></b></h1>
                                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                                    <br>
                                                    <h3 style="text-align:left;">
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php 
                                                          if($trust_id==1)
                                                          {
                                                              echo "HT/";
                                                          }
                                                          else
                                                          {
                                                              echo "MTNC/";
                                                          }
                                                        
                                                        echo  "HR/" . $bk_id . "/" . $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                        </span>
                                                    </h3>

                                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>



                                                    <div style="float:left;">
                                                        <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($a) ?></b></u></h3>
                                                    </div>
                                                    <div style="float:right;">
                                                        <?php
                                                        if ($status == 3) {
                                                        ?>
                                                            <img style="max-width:200px" src="images/deleted.png">

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <p style="text-align:left;display:inline-block;font-size:18pt">
                                                        By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>

                                                    <h3 style="text-align:left;">
                                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                        <span>
                                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                                        </span>
                                                    </h3>

                                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                                    <br>
                                                    <style>
                                                        .box_r {
                                                            width: 300px;
                                                            height: 100px;
                                                            border: 1px solid #000000;
                                                            word-wrap: break-word;
                                                            font-size: 40px;
                                                        }
                                                    </style>

                                                    <div class="box_r text-center">
                                                        &#x20B9;&nbsp;<b><?php echo $a ?></b>

                                                    </div>
                                                    <h3 style="text-align:center;margin-left:200px">
                                                        Donor's Sign
                                                        <span style="float:right;">
                                                            Receiver's Sign
                                                        </span>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>


                        <?php
                                    }
                                }
                            }
                        } else {
                            echo "NOT FOUND";
                        }
                    }

                    if ($get_name == "Garbage") {
                        ?>
                        <form method="POST">
                            <div class="row">

                                <!--  <div class="col-lg-3">

                                    <select class="form-control" name="type">

                                        <option value="booking_id">Booking ID</option>

                                    </select>

                                </div> -->
                                <div class="col-lg-4">

                                    <div class="search-box">

                                        <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Booking ID/ Name..." required />

                                        <div class="result"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button value="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                                        </div>
                                    </div>
                                </div>


                        </form>
                </div>
                <?php
                        if (isset($_POST['submit'])) {


                            $type = $_POST['type'];
                            $input = $_POST['input'];
                            if (strpos($input, '(') !== false) {
                                $first_index = stripos($input, "(") + 1;
                                $s_id_e = substr($input, $first_index);
                                $input = rtrim($s_id_e, ") ");
                            }

                            if ($type == "booking_id") {
                                $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,timings_id from booking_info WHERE  id=$input AND garbage!=''";


                                $run2 = $conn->query($sql2); ?>
                        <?php if ($run2->num_rows > 0) {

                        ?>
                            <?php

                                    while ($row = $run2->fetch_assoc()) {
                                        $id = $row['id'];
                                        $its = $row['its'];
                                        $name = $row['name'];


                                        $s0 = "SELECT c_date,id,amount from ledger2 WHERE  bk_id=$input AND status=1  AND type=3";
                                        $run0 = $conn->query($s0);
                                        $row0 = $run0->fetch_assoc();
                                        $ledger_id = $row0['id'];
                                        $current_date = $row0['c_date'];
                                        $garbage_amount = $row0['amount'];
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
                            <?php     }

                            ?>

                            <?php
                                    $sql = "SELECT thaals,per_thaal from garbage_info WHERE bk_id=$id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $thaals = $row['thaals'];
                                    $per_thaal = $row['per_thaal'];
                                    $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                    $rund2 = $conn->query($d2);
                                    if ($rund2->num_rows > 0) {
                                        $rowd2 = $rund2->fetch_assoc();
                                        $receipt_id = $rowd2['id'];
                                    } else {
                                        $receipt_id = "";
                                    }


                            ?>

                            <br>
                            <div id="printableArea0">
                                <div class="print-area1">
                                    <div class="box_receipt1">
                                        <p style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </p>
                                        <p class="text-center"><b>Hakimi Trust</b></p>
                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                        <br>
                                        <p style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </p>

                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                        <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></p>


                                        <p style="text-align:left;">
                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                            </span>
                                        </p>

                                        <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                        <style>
                                            .box_r1 {
                                                width: 150px;
                                                height: 50px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;

                                            }
                                        </style>

                                        <div class="box_r1 text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <p style="text-align:center">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <div id="printableArea">
                                <div class="print-area">
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <div style="float:left;">
                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></h3>
                                        </div>
                                        <div style="float:right;">
                                            <?php
                                            if ($status == 3) {
                                            ?>
                                                <img style="max-width:200px" src="images/deleted.png">

                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <p style="text-align:left;display:inline-block;font-size:18pt">


                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                            </span>
                                        </p>

                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                    <br>
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <div style="float:left;">
                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></h3>
                                        </div>
                                        <div style="float:right;">
                                            <?php
                                            if ($status == 3) {
                                            ?>
                                                <img style="max-width:200px" src="images/deleted.png">

                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <p style="text-align:left;display:inline-block;font-size:18pt">





                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                            </span>
                                        </p>

                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                </div>
                            </div>



                        <?php
                                } else {
                                    echo '<div class="alert alert-info mt-2" role="alert">
                                   No Booking Found
                                  </div>';
                                }
                            } else {
                                $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,timings_id from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


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




                                                echo '<div class="alert alert-success mt-2" role="alert">
                                                       Success
                                                      </div>';
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
            <?php
                    }


                    if ($get_name == "G") {
            ?>


                <?php
                        if (isset($_GET['ledger_id'])) {


                            $type = "booking_id";
                            $input = $_GET['ledger_id'];

                            if ($type == "booking_id") {
                                //  $sql2 = "SELECT id,its,name,mobile,date,jk_id,timings_id,status from booking_info WHERE  id=$input";

                                $sql2 = "SELECT c_date,amount,bk_id,status from ledger2 WHERE  id=$input AND type=3";
                                $run2 = $conn->query($sql2);
                ?>
                        <?php if ($run2->num_rows > 0) {


                        ?>
                            <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                            <?php

                                    while ($row0 = $run2->fetch_assoc()) {
                                        $bk_id = $row0['bk_id'];
                                        $current_date = $row0['c_date'];
                                        $garbage_amount = $row0['amount'];
                                        $sql01 = "SELECT its,name,mobile,date,jk_id,timings_id from booking_info WHERE id=$bk_id";
                                        $run01 = $conn->query($sql01);
                                        $row = $run01->fetch_assoc();

                                        $its = $row['its'];
                                        $name = $row['name'];
                                        $mobile = $row['mobile'];
                                        $date = $row['date'];
                                        $status = $row0['status'];
                                        $jk_id = $row['jk_id'];
                                        $ledger_id = $input;





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
                            <?php     }

                            ?>

                            <?php
                                    $sql = "SELECT thaals,per_thaal from garbage_info WHERE bk_id=$bk_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $thaals = $row['thaals'];
                                    $per_thaal = $row['per_thaal'];

                                    $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                    $rund2 = $conn->query($d2);
                                    if ($rund2->num_rows > 0) {
                                        $rowd2 = $rund2->fetch_assoc();
                                        $receipt_id = $rowd2['id'];
                                    } else {
                                        $receipt_id = "";
                                    }



                            ?>

                            <br>
                            <div id="printableArea0">
                                <div class="print-area1">
                                    <div class="box_receipt1">
                                        <p style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </p>
                                        <p class="text-center"><b>Hakimi Trust</b></p>
                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                        <br>
                                        <p style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/G/" . $bk_id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </p>

                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                        <div style="float:left;">
                                            <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></p>
                                        </div>
                                        <div style="float:right;">
                                            <?php
                                            if ($status == 3) {
                                            ?>
                                                <img style="max-width:200px" src="images/deleted.png">

                                            <?php
                                            }
                                            ?>

                                        </div>



                                        <p style="text-align:left;">
                                            &nbsp; against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                            </span>
                                        </p>

                                        <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                        <style>
                                            .box_r1 {
                                                width: 150px;
                                                height: 50px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;

                                            }
                                        </style>

                                        <div class="box_r1 text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <p style="text-align:center;">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                            </hp>

                                    </div>
                                </div>
                            </div>


                            <div id="printableArea">
                                <div class="print-area">
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/G/" . $bk_id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <div style="float:left;">
                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></h3>
                                        </div>
                                        <div style="float:right;">
                                            <?php
                                            if ($status == 3) {
                                            ?>
                                                <img style="max-width:200px" src="images/deleted.png">

                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <p style="text-align:left;display:inline-block;font-size:18pt">



                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>
                                            </span>
                                        </p>

                                        <h3> on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u></h3>


                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                    <br>
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b> Trust Reg. No. 986/2008</b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $bk_id . "/" . $receipt_id ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <div style="float:left;">
                                            <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($garbage_amount) ?></b></u></h3>
                                        </div>
                                        <div style="float:right;">
                                            <?php
                                            if ($status == 3) {
                                            ?>
                                                <img style="max-width:200px" src="images/deleted.png">

                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <p style="text-align:left;display:inline-block;font-size:18pt">


                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Garbage Charge" ?></b></u>
                                            <span>

                                            </span>
                                        </p>
                                        <h3> on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u></h3>

                                        <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $garbage_amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                </div>
                            </div>



                        <?php
                                } else {
                                    echo '<div class="alert alert-info mt-2" role="alert">
                                   No Receipt Found
                                  </div>';
                                }
                            } else {
                                $sql2 = "SELECT id,its,name,mobile,jk_id,date,status,timings_id from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


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




                                                echo '<div class="alert alert-success mt-2" role="alert">
                                                       Success
                                                      </div>';
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
            <?php
                    }
                    if ($get_name == "Miscellaneous") {
            ?>
                <form method="POST">
                    <div class="row">
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
                            <input class="form-control" type="text" name="name" placeholder="Enter Name" required />
                        </div>
                        <div class="col-lg-2">
                            <textarea class="form-control" type="text" name="purpose" placeholder="Enter Purpose" required></textarea>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="number" name="amount" placeholder="Enter Amount" required />

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
                            <button name="generate" value="generate" class="btn btn-primary">Generate</button>
                        </div>
                    </div>
                </form>
                <?php
                        if (isset($_POST['generate'])) {
                            $purpose = $_POST['purpose'];
                            $amount = $_POST['amount'];
                            $name = $_POST['name'];
                            $trust_id = $_POST['trust_id'];
                            $pay_mode = $_POST['pay_mode'];

                            $check_number = $_POST['check_number'];
                            if (empty($check_number)) {
                                $check_number = "";
                            }

                            date_default_timezone_set('Asia/kolkata');
                            $date = date('Y/m/d');
                            $time = date("H:i:s");

                            if ($trust_id == 1) {
                                if ($pay_mode == 1) {
                                    $sql = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES(0,'$amount',1,'','',1,1,0,'$current_date','$time',1,'','$name',4)";
                                } else {
                                    $sql = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES(0,'$amount',1,'$check_number','',0,1,0,'$current_date','$time',1,'$current_date','$name',4)";
                                }
                            } else {
                                if ($pay_mode == 1) {
                                    $sql = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES(0,'$amount',2,'','',1,1,0,'$current_date','$time',1,'','$name',4)";
                                } else {
                                    $sql = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES(0,'$amount',2,'$check_number','',0,1,0,'$current_date','$time',1,'$current_date','$name',4)";
                                }
                            }

                            if (mysqli_query($conn, $sql)) {
                                if ($trust_id == 1) {
                                    $s0 = "SELECT c_date,id from ledger2 WHERE amount='$amount' AND bk_id=0  AND status=1 AND debit=1 AND c_date='$current_date' AND time='$time' AND type=4";
                                } else {
                                    $s0 = "SELECT c_date,id from ledger3 WHERE amount='$amount' AND bk_id=0  AND status=1 AND debit=1 AND c_date='$current_date' AND time='$time' AND type=4";
                                }
                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();

                                $ledger_id = $row0['id'];
                                $current_date = $row0['c_date'];
                                $s1 = "INSERT INTO misc (`trust_id`,`ledger_id`,`purpose`) VALUES($trust_id,$ledger_id,'$purpose')";
                                if (mysqli_query($conn, $s1)) {
                                    if ($trust_id == 1) {
                                        $d2 = "INSERT INTO receipt_misc_ht (`trust_id`,`ledger_id`) VALUES($trust_id,$ledger_id)";
                                        mysqli_query($conn, $d2);
                                        $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id";
                                    } else {
                                        $d2 = "INSERT INTO receipt_misc_mt (`trust_id`,`ledger_id`) VALUES($trust_id,$ledger_id)";
                                        mysqli_query($conn, $d2);
                                        $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id";
                                    }
                                    $rund2 = $conn->query($d2);
                                    if ($rund2->num_rows > 0) {
                                        $rowd2 = $rund2->fetch_assoc();
                                        $receipt_id = $rowd2['id'];
                                    } else {
                                        $receipt_id = "";
                                    }

                ?>

                            <br>
                            <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                            <br>
                            <div id="printableArea0">
                                <div class="print-area1">
                                    <div class="box_receipt1">
                                        <p style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b><?php if ($trust_id == "2") { ?>Trust Reg. No. 894/2006<?php } else {
                                                                                                            ?>
                                                    Trust Reg. No. 986/2008
                                                <?php
                                                                                                        } ?></b>
                                            </span>

                                        </p>
                                        <p class="text-center"><b><?php if ($trust_id == "2") { ?>MOHAMMEDI TANZEEM NIYAZ COMITTEE<?php } else {
                                                                                                                                    ?>
                                                HAKIMI TRUST
                                            <?php
                                                                                                                                } ?></b></p>
                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                        <br>
                                        <p style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                                    echo "HT/MISC/" . $receipt_id;
                                                                                } else {
                                                                                    echo "MTNC/MISC/" . $receipt_id;
                                                                                } ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </p>

                                        <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                        <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>

                                        <?php
                                        if (empty($check_number)) {
                                        ?>
                                            <p>By Cash &nbsp;&nbsp;</p>

                                        <?php
                                        } else {

                                        ?>


                                            <p>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>

                                        <?php

                                        }
                                        ?>
                                        <p style="text-align:left;">
                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </p>

                                        <p>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></p>

                                        <style>
                                            .box_r1 {
                                                width: 150px;
                                                height: 50px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;

                                            }
                                        </style>

                                        <div class="box_r1 text-center">
                                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                                        </div>
                                        <p style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <div id="printableArea">
                                <div class="print-area">
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b><?php if ($trust_id == "2") { ?>Trust Reg. No. 894/2006<?php } else {
                                                                                                            ?>
                                                    Trust Reg. No. 986/2008
                                                <?php
                                                                                                        } ?></b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b><?php if ($trust_id == "2") { ?>MOHAMMEDI TANZEEM NIYAZ COMITTEE<?php } else {
                                                                                                                                    ?>
                                                HAKIMI TRUST
                                            <?php
                                                                                                                                } ?></b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                                    echo "HT/MISC/" . $receipt_id;
                                                                                } else {
                                                                                    echo "MTNC/MISC/" . $receipt_id;
                                                                                } ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></h3>
                                        <?php
                                        if (empty($check_number)) {
                                        ?>
                                            <h3>By Cash &nbsp;&nbsp;</h3>
                                            <br>
                                        <?php
                                        } else {


                                        ?>


                                            <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></h3><br>

                                        <?php

                                        }
                                        ?>

                                        <h3 style="text-align:left;">
                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>


                                        <h3>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                    <br>
                                    <div class="box_receipt">
                                        <h2 style="text-align:left;">
                                            <u><b>RECEIPT</b></u>
                                            <span style="float:right;">
                                                <b><?php if ($trust_id == "2") { ?>Trust Reg. No. 894/2006<?php } else {
                                                                                                            ?>
                                                    Trust Reg. No. 986/2008
                                                <?php
                                                                                                        } ?></b>
                                            </span>

                                        </h2>
                                        <h1 class="text-center"><b><?php if ($trust_id == "2") { ?>MOHAMMEDI TANZEEM NIYAZ COMITTEE<?php } else {
                                                                                                                                    ?>
                                                HAKIMI TRUST
                                            <?php
                                                                                                                                } ?></b></h1>
                                        <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                        <br>
                                        <h3 style="text-align:left;">
                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                                    echo "HT/MISC/" . $receipt_id;
                                                                                } else {
                                                                                    echo "MTNC/MISC/" . $ledger_id . $receipt_id;
                                                                                } ?></b></u>
                                            <span style="float:right;">
                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>
                                        <br>
                                        <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                        <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></h3>
                                        <?php
                                        if (empty($check_number)) {
                                        ?>
                                            <h3>By Cash &nbsp;&nbsp;</h3><br>

                                        <?php
                                        } else {

                                        ?>


                                            <h3>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></h3><br>

                                        <?php

                                        }
                                        ?>

                                        <h3 style="text-align:left;">
                                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                            </span>
                                        </h3>


                                        <h3>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></h3>
                                        <br>
                                        <style>
                                            .box_r {
                                                width: 300px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;
                                                font-size: 40px;
                                            }
                                        </style>

                                        <div class="box_r text-center">
                                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                                        </div>
                                        <h3 style="text-align:center;margin-left:200px">
                                            Donor's Sign
                                            <span style="float:right;">
                                                Receiver's Sign
                                            </span>
                                        </h3>

                                    </div>
                                </div>
                            </div>


                <?php
                                } else {
                                    echo "Fail";
                                }
                            }
                        }
                    }

                    if ($get_name == "MISC") {
                        $ledger_id = $_GET['ledger_id'];

                        // $purpose = $_GET['purpose'];
                        $trust_id = $_GET['trust_id'];


                        if ($trust_id == 1) {

                            $s0 = "SELECT c_date,pay_mode,check_number,amount,name,status from ledger2 WHERE id=$ledger_id";
                        } else {
                            $s0 = "SELECT c_date,pay_mode,check_number,amount,name,status from ledger3 WHERE id=$ledger_id";
                        }
                        $run0 = $conn->query($s0);
                        $row0 = $run0->fetch_assoc();
                        $sql = "SELECT purpose from misc where ledger_id=$ledger_id AND trust_id=$trust_id";
                        $run = $conn->query($sql);
                        $row = $run->fetch_assoc();
                        $purpose = $row['purpose'];
                        $status = $row0['status'];

                        $pay_mode = $row0['pay_mode'];
                        $check_number = $row0['check_number'];
                        $amount = $row0['amount'];
                        $name = $row0['name'];
                        $date0 = $row0['c_date'];
                        //$time0 = $_GET['time'];
                        date_default_timezone_set('Asia/kolkata');
                        $date = date('Y/m/d');
                        $time = date("H:i:s");
                        $trust_id = $_GET['trust_id'];

                        if ($trust_id == 1) {
                            $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                        } else {
                            $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                        }
                        $rund2 = $conn->query($d2);
                        if ($rund2->num_rows > 0) {
                            $rowd2 = $rund2->fetch_assoc();
                            $receipt_id = $rowd2['id'];
                        } else {
                            $receipt_id = "";
                        }

                ?>

                <br>
                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                <br>
                <div id="printableArea0">
                    <div class="print-area1">
                        <div class="box_receipt1">
                            <p style="text-align:left;">
                                <u><b>RECEIPT</b></u>
                                <span style="float:right;">
                                    <b> <?php
                                        if ($trust_id == "1") {
                                        ?>
                                            Trust Reg. No. 986/2008
                                        <?php
                                        } else {
                                        ?>
                                            Trust Reg. No. 894/2006
                                        <?php
                                        }
                                        ?>
                                    </b>
                                </span>

                            </p>
                            <p class="text-center"><b><?php
                                                        if ($trust_id == "1") {
                                                        ?>
                                        HAKIMI TRUST
                                    <?php
                                                        } else {
                                    ?>
                                        MOHAMMEDI TANZEEM NIYAZ COMITTEE


                                    <?php
                                                        }
                                    ?></b></p>
                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                            <br>
                            <p style="text-align:left;">
                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                        echo "HT/MISC/" . $receipt_id;
                                                                    } else {
                                                                        echo "MTNC/MISC/" . $receipt_id;
                                                                    } ?></b></u>
                                <span style="float:right;">
                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                </span>
                            </p>

                            <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                            <div style="float:right;">
                                <?php
                                if ($status == 3) {
                                ?>
                                    <img style="max-width:200px" src="images/deleted.png">

                                <?php
                                }
                                ?>

                            </div>



                            <?php
                            if ($pay_mode == 1) {
                            ?>
                                <p>By Cash &nbsp;&nbsp;</p>

                            <?php
                            } else {

                            ?>


                                <p>By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>

                            <?php

                            }
                            ?>


                            <p style="text-align:left;">
                                against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                <span>
                                    on Date &nbsp;&nbsp;<u><b><?php echo $date0 ?></b></u>
                                </span>
                            </p>

                            <p>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></p>

                            <style>
                                .box_r1 {
                                    width: 150px;
                                    height: 50px;
                                    border: 1px solid #000000;
                                    word-wrap: break-word;

                                }
                            </style>

                            <div class="box_r1 text-center">
                                &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                            </div>
                            <p style="text-align:center;margin-left:200px">
                                Donor's Sign
                                <span style="float:right;">
                                    Receiver's Sign
                                </span>
                            </p>

                        </div>
                    </div>
                </div>


                <div id="printableArea">
                    <div class="print-area">
                        <div class="box_receipt">
                            <h2 style="text-align:left;">
                                <u><b>RECEIPT</b></u>
                                <span style="float:right;">
                                    <b> <?php
                                        if ($trust_id == "1") {
                                        ?>
                                            Trust Reg. No. 986/2008
                                        <?php
                                        } else {
                                        ?>
                                            Trust Reg. No. 894/2006
                                        <?php
                                        }
                                        ?></b>
                                </span>

                            </h2>
                            <h1 class="text-center"><b><?php
                                                        if ($trust_id == "1") {
                                                        ?>
                                        HAKIMI TRUST
                                    <?php
                                                        } else {
                                    ?>
                                        MOHAMMEDI TANZEEM NIYAZ COMITTEE


                                    <?php
                                                        }
                                    ?></b></h1>
                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                            <br>
                            <h3 style="text-align:left;">
                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                        echo "HT/MISC/" . $receipt_id;
                                                                    } else {
                                                                        echo "MTNC/MISC/" . $receipt_id;
                                                                    } ?></b></u>
                                <span style="float:right;">
                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                </span>
                            </h3>
                            <br>
                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                            <div style="float:right;">
                                <?php
                                if ($status == 3) {
                                ?>
                                    <img style="max-width:200px" src="images/deleted.png">

                                <?php
                                }
                                ?>

                            </div>

                            <p style="text-align:left;display:inline-block;font-size:18pt">




                                <?php
                                if ($pay_mode == 1) {
                                ?>
                                    By Cash &nbsp;&nbsp;</p><br>

                        <?php
                                } else {

                        ?>


                            By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p><br>

                        <?php

                                }
                        ?>

                        <h3 style="text-align:left;">
                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                            <span>
                                on Date &nbsp;&nbsp;<u><b><?php echo $date0 ?></b></u>
                            </span>
                        </h3>

                        <h3>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></h3>
                        <br>
                        <style>
                            .box_r {
                                width: 300px;
                                height: 100px;
                                border: 1px solid #000000;
                                word-wrap: break-word;
                                font-size: 40px;
                            }
                        </style>

                        <div class="box_r text-center">
                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                        </div>
                        <h3 style="text-align:center;margin-left:200px">
                            Donor's Sign
                            <span style="float:right;">
                                Receiver's Sign
                            </span>
                        </h3>

                        </div>
                        <br>
                        <div class="box_receipt">
                            <h2 style="text-align:left;">
                                <u><b>RECEIPT</b></u>
                                <span style="float:right;">
                                    <b><?php
                                        if ($trust_id == "1") {
                                        ?>
                                            Trust Reg. No. 986/2008
                                        <?php
                                        } else {
                                        ?>
                                            Trust Reg. No. 894/2006
                                        <?php
                                        }
                                        ?></b>
                                </span>

                            </h2>
                            <h1 class="text-center"><b><?php
                                                        if ($trust_id == "1") {
                                                        ?>
                                        HAKIMI TRUST
                                    <?php
                                                        } else {
                                    ?>
                                        MOHAMMEDI TANZEEM NIYAZ COMITTEE


                                    <?php
                                                        }
                                    ?></b></h1>
                            <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                            <br>
                            <h3 style="text-align:left;">
                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {
                                                                        echo "HT/MISC/" . $receipt_id;
                                                                    } else {
                                                                        echo "MTNC/MISC/" . $receipt_id;
                                                                    } ?></b></u>
                                <span style="float:right;">
                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                </span>
                            </h3>
                            <br>
                            <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                            <div style="float:right;">
                                <?php
                                if ($status == 3) {
                                ?>
                                    <img style="max-width:200px" src="images/deleted.png">

                                <?php
                                }
                                ?>

                            </div>

                            <p style="text-align:left;display:inline-block;font-size:18pt">



                                <?php
                                if ($pay_mode == 1) {
                                ?>
                                    By Cash &nbsp;&nbsp;</p><br>

                        <?php
                                } else {

                        ?>


                            By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>
                            <br>

                        <?php

                                }
                        ?>

                        <h3 style="text-align:left;">
                            against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                            <span>
                                on Date &nbsp;&nbsp;<u><b><?php echo $date0 ?></b></u>
                            </span>
                        </h3>
                        <h3>at &nbsp;&nbsp;<u><b><?php echo "Saify Nagar Jamaat Office" ?></b></u></h3>
                        <br>
                        <style>
                            .box_r {
                                width: 300px;
                                height: 100px;
                                border: 1px solid #000000;
                                word-wrap: break-word;
                                font-size: 40px;
                            }
                        </style>

                        <div class="box_r text-center">
                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>

                        </div>
                        <h3 style="text-align:center;margin-left:200px">
                            Donor's Sign
                            <span style="float:right;">
                                Receiver's Sign
                            </span>
                        </h3>

                        </div>
                    </div>
                </div>


            <?php

                    }


            ?>


            <?php


            if ($get_name == "Payment Voucher") {

                if (isset($_POST['generate'])) {
                    $debit = $_POST['debit'];
                    $bill = $_POST['bill'];
                    $bk_id = $_POST['bk_id'];
                    $trust_id = $_POST['trust_id'];

                    $mode = $_POST['mode'];
                    if ($mode == "Cash") {
                        $pay_mode = "1";
                    } else {
                        $pay_mode = "0";
                    }
                    $account = $_POST['account'];
                    $name = $_POST['name'];

                    date_default_timezone_set('Asia/kolkata');
                    $date = date('Y/m/d');
                    $time = date('H:i:s');
                    if ($trust_id == "1") {
                        if ($pay_mode == "1") {
                            $sql = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$debit',1,'','',$pay_mode,0,1,'$current_date','$time',1,'','$name',5)";
                        } else {
                            $cn = $_POST['cn'];
                            $sql = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$debit',1,'$cn','',$pay_mode,0,1,'$current_date','$time',1,'$current_date','$name',5)";
                        }
                    } else {
                        if ($pay_mode == "1") {
                            $sql = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$debit',2,'','',$pay_mode,0,1,'$current_date','$time',1,'','$name',5)";
                        } else {
                            $cn = $_POST['cn'];
                            $sql = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$debit',2,'$cn','',$pay_mode,0,1,'$current_date','$time',1,'$current_date','$name',5)";
                        }
                    }
                    if (mysqli_query($conn, $sql)) {

                        if ($trust_id == "1") {
                            $s0 = "SELECT c_date,id from ledger2 WHERE amount='$debit' AND bk_id=$bk_id  AND status=1 AND debit=0 AND c_date='$current_date' AND time='$time' AND type=5";
                        } else {
                            $s0 = "SELECT c_date,id from ledger3 WHERE amount='$debit' AND bk_id=$bk_id  AND status=1 AND debit=0 AND c_date='$current_date' AND time='$time' AND type=5";
                        }

                        $run0 = $conn->query($s0);
                        $row0 = $run0->fetch_assoc();
                        $ledger_id = $row0['id'];
                        $current_date = $row0['c_date'];
                        $s11 = "INSERT INTO voucher (`ledger_id`,`bill`,`account`,`trust_id`) VALUES ($ledger_id,'$bill','$account',$trust_id)";
                        mysqli_query($conn, $s11);

                        if($trust_id==1)
                        {
                            $d2 = "INSERT INTO voucher_ht (`ledger_id`) VALUES ($ledger_id)";
                            $e2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                        }
                        else
                        {
                            $d2 = "INSERT INTO voucher_mt (`ledger_id`) VALUES ($ledger_id)";
                            $e2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                        }

                       
                        mysqli_query($conn, $d2);
                      
                        $rund2 = $conn->query($e2);
                        if ($rund2->num_rows > 0) {
                            $rowd2 = $rund2->fetch_assoc();
                            $receipt_id = $rowd2['id'];
                        } else {
                            $receipt_id = "";
                        }
            ?>
                        <br>
                        <input type="button" class="btn btn-warning" onclick="printDiv('printableArea1')" value="Print" />

                        <br>
                        <div id="printableArea">
                            <div class="print-area1">
                                <div class="box_receipt1">
                                    <div class="row">
                                        <style>
                                            .upper_title {
                                                line-height: 5px;
                                            }
                                        </style>
                                        <div class="col-lg-6 upper_title">
                                            <?php
                                            if ($trust_id == "2") {
                                            ?>

                                                <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                                <p> Trust Reg. No. 894/2006,Indore</p>
                                            <?php

                                            } else {
                                            ?>
                                                <p> <u><b>HAKIMI TRUST</b></u></p>

                                                <p> Trust Reg. No. 986/2008,Indore</p>
                                            <?php
                                            }
                                            ?>

                                            <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                            <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <style>
                                                .box_r2 {
                                                    width: 150px;
                                                    height: 50px;
                                                    border: 1px solid #000000;
                                                    word-wrap: break-word;
                                                    float: right;
                                                }
                                            </style>
                                            <p style="text-align:left;">
                                                <span style="float:right;">
                                                    <div class="box_r2 text-center">
                                                        <b>Voucher</b>
                                                        <br>
                                                        <?php
                                                        if ($trust_id == "1") {
                                                        ?>
                                                            <b>No. HT <?php  } else {
                                                                        ?>
                                                                <b>No. MTNC
                                                                    <?php
                                                                    } ?>/<?php echo $bk_id; ?>/</b>
                                                                <?php echo $receipt_id; ?>
                                                    </div>
                                                </span>
                                            </p>
                                        </div>
                                    </div>




                                    <p style="text-align:left;">
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>
                                    <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></p>



                                    <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></p>
                                    <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                                    <p>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></p>


                                    <p style="text-align:left;">
                                        Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                        <span>
                                            on Dated &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>


                                    <style>
                                        .box_r1 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;

                                        }
                                    </style>


                                    <p style="text-align:left;">
                                        <?php
                                        if ($mode == "Cheque") {
                                        ?>
                                    <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                <?php

                                        } else {
                                ?>
                                    <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                <?php
                                        }
                                ?>
                                <span style="float: right;">
                                    <div class="box_r1 text-center">
                                        &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                                    </div>

                                </span>
                                </p>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p>Passed By</p>

                                    </div>
                                    <div class="col-lg-4">
                                        <p>Accountant</p>

                                    </div>
                                    <div class="col-lg-4">
                                        <p>Receiver's Signature</p>

                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>


                        <div id="printableArea1">
                            <div class="print-area">
                                <div class="box_receipt">

                                    <style>
                                        .upper_title1 {
                                            line-height: 5px;
                                        }
                                    </style>
                                    <div class="upper_title1" style="text-align:left;">

                                        <?php
                                        if ($trust_id == "2") {
                                        ?>

                                            <h2> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></h2>
                                        <?php

                                        } else {
                                        ?>
                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>

                                        <?php
                                        }
                                        ?>

                                        <style>
                                            .box_r21 {
                                                width: 250px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;

                                            }
                                        </style>

                                        <span style="float:right;">
                                            <h3>
                                                <div class="box_r21 text-center ">
                                                    <b>Voucher</b>
                                                    <br>
                                                    <?php
                                                    if ($trust_id == "1") {
                                                    ?>
                                                        <b>No. HT <?php  } else {
                                                                    ?>
                                                            <b>No. MTNC
                                                                <?php
                                                                } ?>/<?php echo $bk_id; ?>/</b>
                                                            <?php echo $receipt_id; ?>
                                                </div>
                                            </h3>
                                            <br>
                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                        </span>

                                        <?php
                                        if ($trust_id == "2") {
                                        ?>

                                            <h5> Trust Reg. No. 894/2006,Indore</h5>
                                        <?php

                                        } else {
                                        ?>

                                            <h5> Trust Reg. No. 986/2008,Indore</h5>
                                        <?php
                                        }
                                        ?>

                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                    </div>









                                    <br>
                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></h3>


                                    <br>
                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></h3>

                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></h3>


                                    <h3 style="text-align:left;">
                                        Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                        <span>
                                            on Dated &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>


                                    <style>
                                        .box_r1 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;

                                        }
                                    </style>

                                    <br>
                                    <h3 style="text-align:left;">
                                        <?php
                                        if ($mode == "Cheque") {
                                        ?>
                                            <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                        <?php

                                        } else {
                                        ?>
                                            <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                        <?php
                                        }
                                        ?>
                                        <span style="float: right;">
                                            <div class="box_r1 text-center">
                                                &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                                            </div>

                                        </span>
                                    </h3>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <h3>
                                        <div style="float: left">Passed By</div>
                                        <div style="float: right">Receiver's Signature</div>
                                        <div style="margin: 0 auto; width: 150px;">Accountant</div>
                                    </h3>
                                </div>
                                <br>
                                <div class="box_receipt">

                                    <style>
                                        .upper_title1 {
                                            line-height: 5px;
                                        }
                                    </style>
                                    <div class="upper_title1" style="text-align:left;">
                                        <?php
                                        if ($trust_id == "2") {
                                        ?>
                                            <h2> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></h2>

                                        <?php

                                        } else {
                                        ?>
                                            <h2> <u><b>HAKIMI TRUST</b></u></h2>

                                        <?php
                                        }
                                        ?>

                                        <style>
                                            .box_r21 {
                                                width: 250px;
                                                height: 100px;
                                                border: 1px solid #000000;
                                                word-wrap: break-word;

                                            }
                                        </style>

                                        <span style="float:right;">
                                            <h3>
                                                <div class="box_r21 text-center ">
                                                    <b>Voucher</b>
                                                    <br>
                                                    <?php
                                                    if ($trust_id == "1") {
                                                    ?>
                                                        <b>No. HT <?php  } else {
                                                                    ?>
                                                            <b>No. MTNC
                                                                <?php
                                                                } ?>/<?php echo $bk_id; ?>/</b>
                                                            <?php echo $receipt_id; ?>
                                                </div>
                                            </h3>
                                            <br>
                                            <h3>Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u></h3>
                                        </span>

                                        <h5> Trust Reg. No. 894/2006,Indore</h5>

                                        <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                        <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                                    </div>









                                    <br>
                                    <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></h3>

                                    <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></h3>

                                    <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                    <h3>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></h3>


                                    <h3 style="text-align:left;">
                                        Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                        <span>
                                            on Dated &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>


                                    <style>
                                        .box_r1 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;

                                        }
                                    </style>

                                    <br>
                                    <h3 style="text-align:left;">
                                        <?php
                                        if ($mode == "Cheque") {
                                        ?>
                                            <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                        <?php

                                        } else {
                                        ?>
                                            <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                        <?php
                                        }
                                        ?>
                                        <span style="float: right;">
                                            <div class="box_r1 text-center">
                                                &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                                            </div>

                                        </span>
                                    </h3>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <h3>
                                        <div style="float: left">Passed By</div>
                                        <div style="float: right">Receiver's Signature</div>
                                        <div style="margin: 0 auto; width: 150px;">Accountant</div>
                                    </h3>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
                <form method="POST">

                    <div class="form-group">
                        <label>Debit</label>
                        <input class="form-control" type="number" name="debit" placeholder="Enter Amount" required />
                    </div>
                    <div class="form-group">
                        <label>Amount Being Paid To</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Name" required />
                    </div>
                    <div class="form-group">
                        <label>on Account of</label>
                        <input class="form-control" type="text" name="account" placeholder="Enter Account" required />

                    </div>
                    <div class="form-group">
                        <label>Bill No.</label>
                        <input class="form-control" type="text" name="bill" placeholder="Enter Bill No." />

                    </div>
                    <div class="form-group">
                      
                        <input class="form-control" type="hidden" name="bk_id" placeholder="Enter Booking ID" value="0" required />

                    </div>
                    <div class="form-group">
                        <label>Trust</label>
                        <select name="trust_id" class="form-control" required>
                            <?php
                            $sql = "SELECT * from trust";
                            $run = $conn->query($sql);
                            while ($row = $run->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Mode</label>
                        <select name="mode" id="mode" onchange="change_mode_receipt()" class="form-control" required>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                    <div id="cheque">

                    </div>

                    <button name="generate" value="generate" class="btn btn-primary">Generate</button>

                </form>

            <?php
            }

            if ($get_name == "VOUCHER") {

                $ledger_id = $_GET['ledger_id'];
                $trust_id = $_GET['trust_id'];
                if ($trust_id == "1") {
                    $s0 = "SELECT c_date,pay_mode,name,amount,check_number,bk_id from ledger2 WHERE id=$ledger_id";
                } else {
                    $s0 = "SELECT c_date,pay_mode,name,amount,check_number,bk_id from ledger3 WHERE id=$ledger_id";
                }

                $run0 = $conn->query($s0);
                $row0 = $run0->fetch_assoc();
                $c_date = $row0['c_date'];
                $name = $row0['name'];
                $debit = $row0['amount'];
                $bk_id = $row0['bk_id'];
                $pay_mode = $row0['pay_mode'];
                $cn = $row0['check_number'];
                if ($pay_mode == "0") {
                    $mode = "Cheque";
                } else {
                    $mode = "Cash";
                }
                $s11 = "SELECT bill,account from voucher WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                $run11 = $conn->query($s11);
                $row11 = $run11->fetch_assoc();
                $bill = $row11['bill'];
                $account = $row11['account'];
                $d2 = "SELECT id from receipt_voucher WHERE ledger_id=$ledger_id";
                $rund2 = $conn->query($d2);
                if ($rund2->num_rows > 0) {
                    $rowd2 = $rund2->fetch_assoc();
                    $receipt_id = $rowd2['id'];
                } else {
                    $receipt_id = "";
                }
            ?>
                <br>
                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                <br>
                <div id="printableArea1">
                    <div class="print-area1">
                        <div class="box_receipt1">
                            <div class="row">
                                <style>
                                    .upper_title {
                                        line-height: 5px;
                                    }
                                </style>
                                <div class="col-lg-6 upper_title">

                                    <?php
                                    if ($trust_id == "2") {
                                    ?>

                                        <p> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></p>

                                        <p> Trust Reg. No. 894/2006,Indore</p>
                                    <?php

                                    } else {
                                    ?>
                                        <p> <u><b>HAKIMI TRUST</b></u></p>

                                        <p> Trust Reg. No. 986/2008,Indore</p>
                                    <?php
                                    }
                                    ?>
                                    <p>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</p>

                                    <p>Indore - 452014 - Tel.: 0731-4095836-37</p>
                                </div>
                                <div class="col-lg-6">
                                    <style>
                                        .box_r2 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;
                                            float: right;
                                        }
                                    </style>
                                    <p style="text-align:left;">
                                        <span style="float:right;">
                                            <div class="box_r2 text-center">
                                                <b>Voucher</b>
                                                <br>
                                                <b>No. <?php
                                                        if ($trust_id == "2") {
                                                        ?>

                                                        MTNC

                                                    <?php

                                                        } else {
                                                    ?>
                                                        HT

                                                        <?php
                                                        }
                                                        ?>/<?php echo $bk_id ?>/</b>
                                                <?php echo $receipt_id; ?>
                                            </div>
                                        </span>
                                    </p>
                                </div>
                            </div>




                            <p style="text-align:left;">
                                <span style="float:right;">
                                    Date &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u>
                                </span>
                            </p>
                            <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></p>



                            <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></p>
                            <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>
                            <p>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></p>


                            <p style="text-align:left;">
                                Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                <span>
                                    on Dated &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u>
                                </span>
                            </p>


                            <style>
                                .box_r1 {
                                    width: 150px;
                                    height: 50px;
                                    border: 1px solid #000000;
                                    word-wrap: break-word;

                                }
                            </style>


                            <p style="text-align:left;">
                                <?php
                                if ($mode == "Cheque") {
                                ?>
                            <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                        <?php

                                } else {
                        ?>
                            <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                        <?php
                                }
                        ?>
                        <span style="float: right;">
                            <div class="box_r1 text-center">
                                &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                            </div>

                        </span>
                        </p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <p>Passed By</p>

                            </div>
                            <div class="col-lg-4">
                                <p>Accountant</p>

                            </div>
                            <div class="col-lg-4">
                                <p>Receiver's Signature</p>

                            </div>
                        </div>
                        </div>
                    </div>
                </div>


                <div id="printableArea">
                    <div class="print-area">
                        <div class="box_receipt">

                            <style>
                                .upper_title1 {
                                    line-height: 5px;
                                }
                            </style>
                            <div class="upper_title1" style="text-align:left;">
                                <?php
                                if ($trust_id == "2") {
                                ?>

                                    <h2> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></h2>

                                <?php

                                } else {
                                ?>
                                    <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                <?php
                                }
                                ?>


                                <style>
                                    .box_r21 {
                                        width: 250px;
                                        height: 100px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;

                                    }
                                </style>

                                <span style="float:right;">
                                    <h3>
                                        <div class="box_r21 text-center ">
                                            <b>Voucher</b>
                                            <br>
                                            <b>No. <?php
                                                    if ($trust_id == "2") {
                                                    ?>

                                                    MTNC

                                                <?php

                                                    } else {
                                                ?>
                                                    HT

                                                    <?php
                                                    }
                                                    ?>/<?php echo $bk_id ?>/</b>
                                            <?php echo $receipt_id; ?>
                                        </div>
                                    </h3>
                                    <br>
                                    <h3>Date &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u></h3>
                                </span>

                                <?php
                                if ($trust_id == "2") {
                                ?>

                                    <h5> Trust Reg. No. 894/2006,Indore</h5>

                                <?php

                                } else {
                                ?>
                                    <h5> Trust Reg. No. 986/2008,Indore</h5>

                                <?php
                                }
                                ?>
                                <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                            </div>









                            <br>
                            <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></h3>

                            <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></h3>

                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                            <h3>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></h3>


                            <h3 style="text-align:left;">
                                Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                <span>
                                    on Dated &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u>
                                </span>
                            </h3>


                            <style>
                                .box_r1 {
                                    width: 150px;
                                    height: 50px;
                                    border: 1px solid #000000;
                                    word-wrap: break-word;

                                }
                            </style>

                            <br>
                            <h3 style="text-align:left;">
                                <?php
                                if ($mode == "Cheque") {
                                ?>
                                    <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                <?php

                                } else {
                                ?>
                                    <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                <?php
                                }
                                ?>
                                <span style="float: right;">
                                    <div class="box_r1 text-center">
                                        &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                                    </div>

                                </span>
                            </h3>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h3>
                                <div style="float: left">Passed By</div>
                                <div style="float: right">Receiver's Signature</div>
                                <div style="margin: 0 auto; width: 150px;">Accountant</div>
                            </h3>
                        </div>
                        <br>
                        <div class="box_receipt">

                            <style>
                                .upper_title1 {
                                    line-height: 5px;
                                }
                            </style>
                            <div class="upper_title1" style="text-align:left;">

                                <?php
                                if ($trust_id == "2") {
                                ?>

                                    <h2> <u><b>MOHAMMEDI TANZEEM NIYAZ COMITTEE</b></u></h2>

                                <?php

                                } else {
                                ?>
                                    <h2> <u><b>HAKIMI TRUST</b></u></h2>


                                <?php
                                }
                                ?>

                                <style>
                                    .box_r21 {
                                        width: 250px;
                                        height: 100px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;

                                    }
                                </style>

                                <span style="float:right;">
                                    <h3>
                                        <div class="box_r21 text-center ">
                                            <b>Voucher</b>
                                            <br>
                                            <b>No. <?php
                                                    if ($trust_id == "2") {
                                                    ?>

                                                    MTNC

                                                <?php

                                                    } else {
                                                ?>
                                                    HT

                                                    <?php
                                                    }
                                                    ?>/<?php echo $bk_id ?>/</b>
                                            <?php echo $receipt_id; ?>
                                        </div>
                                    </h3>
                                    <br>
                                    <h3>Date &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u></h3>
                                </span>



                                <?php
                                if ($trust_id == "2") {
                                ?>

                                    <h5> Trust Reg. No. 894/2006,Indore</h5>

                                <?php

                                } else {
                                ?>
                                    <h5> Trust Reg. No. 986/2008,Indore</h5>

                                <?php
                                }
                                ?>


                                <h5>Al-Masjid-us-Saifee,Saifee Nagar, Khatiwala Tank,</h5>

                                <h5>Indore - 452014 - Tel.: 0731-4095836-37</h5>
                            </div>









                            <br>
                            <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $debit ?></b></u></h3>

                            <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($debit) ?></b></u></h3>

                            <h3>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                            <h3>on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></h3>


                            <h3 style="text-align:left;">
                                Bill No. &nbsp;&nbsp;<u><b><?php echo $bill ?></b></u>
                                <span>
                                    on Dated &nbsp;&nbsp;<u><b><?php echo $c_date ?></b></u>
                                </span>
                            </h3>


                            <style>
                                .box_r1 {
                                    width: 150px;
                                    height: 50px;
                                    border: 1px solid #000000;
                                    word-wrap: break-word;

                                }
                            </style>

                            <br>
                            <h3 style="text-align:left;">
                                <?php
                                if ($mode == "Cheque") {
                                ?>
                                    <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                <?php

                                } else {
                                ?>
                                    <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                <?php
                                }
                                ?>
                                <span style="float: right;">
                                    <div class="box_r1 text-center">
                                        &#x20B9;&nbsp;<b><?php echo $debit ?></b>
                                    </div>

                                </span>
                            </h3>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h3>
                                <div style="float: left">Passed By</div>
                                <div style="float: right">Receiver's Signature</div>
                                <div style="margin: 0 auto; width: 150px;">Accountant</div>
                            </h3>
                        </div>
                    </div>
                </div>

            <?php
            }

            ?>


            <?php


            if ($get_name == "SD") {
            ?>
                <form method="POST">
                    <div class="row">
                        <!--
                        <div class="col-lg-3">

                            <select class="form-control" name="type">

                                <option value="booking_id">Booking ID</option>

                            </select>

                        </div> -->
                        <div class="col-lg-4">

                            <div class="search-box">

                                <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Booking ID/ Name..." required />

                                <div class="result"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-lg-6">
                                    <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                                </div>
                            </div>
                        </div>


                </form>
            </div>
            <?php
                if (isset($_POST['submit'])) {


                    $type = $_POST['type'];
                    $input = $_POST['input'];
                    if (strpos($input, '(') !== false) {
                        $first_index = stripos($input, "(") + 1;
                        $s_id_e = substr($input, $first_index);
                        $input = rtrim($s_id_e, ") ");
                    }

                    if ($type == "booking_id") {
                        $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,timings_id from booking_info WHERE  id=$input AND sc_deposit!=''";


                        $run2 = $conn->query($sql2); ?>
                    <?php if ($run2->num_rows > 0) {
                            $s0 = "SELECT c_date,id,amount from ledger2 WHERE  bk_id=$input  AND status=1 AND type=1";
                            $run0 = $conn->query($s0);
                            $row0 = $run0->fetch_assoc();
                            $ledger_id = $row0['id'];
                            $current_date = $row0['c_date'];
                            $sc_deposit = $row0['amount'];
                    ?>
                        <?php

                            while ($row = $run2->fetch_assoc()) {
                                $id = $row['id'];
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
                        <?php     }
                            $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                            $rund2 = $conn->query($d2);
                            if ($rund2->num_rows > 0) {
                                $rowd2 = $rund2->fetch_assoc();
                                $receipt_id = $rowd2['id'];
                            } else {
                                $receipt_id = "";
                            }

                        ?>


                        <br>
                        <div id="printableArea0">
                            <div class="print-area1">
                                <div class="box_receipt1">
                                    <p style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </p>
                                    <p class="text-center"><b>Hakimi Trust</b></p>
                                    <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                    <br>
                                    <p style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>

                                    <p>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></p>


                                    <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                    <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></p>


                                    <p style="text-align:left;">
                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </p>

                                    <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                    <style>
                                        .box_r1 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;

                                        }
                                    </style>

                                    <div class="box_r1 text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <p style="text-align:center">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                    </p>

                                </div>
                            </div>
                        </div>


                        <div id="printableArea">
                            <div class="print-area">
                                <div class="box_receipt">
                                    <h2 style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </h2>
                                    <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                    <br>
                                    <h3 style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>
                                    <br>
                                    <h3>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></h3>

                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                    <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>


                                    <h3 style="text-align:left;">
                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </h3>

                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                    <br>
                                    <style>
                                        .box_r {
                                            width: 300px;
                                            height: 100px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;
                                            font-size: 40px;
                                        }
                                    </style>

                                    <div class="box_r text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <h3 style="text-align:center;margin-left:200px">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                    </h3>

                                </div>
                                <br>
                                <div class="box_receipt">
                                    <h2 style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </h2>
                                    <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                    <br>
                                    <h3 style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>
                                    <br>
                                    <h3>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></h3>

                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>


                                    <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>


                                    <h3 style="text-align:left;">
                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </h3>

                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                    <br>
                                    <style>
                                        .box_r {
                                            width: 300px;
                                            height: 100px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;
                                            font-size: 40px;
                                        }
                                    </style>

                                    <div class="box_r text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <h3 style="text-align:center;margin-left:200px">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                    </h3>

                                </div>
                            </div>
                        </div>



                    <?php
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                           No Booking Found
                          </div>';
                        }
                    } else {
                        $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,timings_id from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


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




                                        echo '<div class="alert alert-success mt-2" role="alert">
                                               Success
                                              </div>';
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
        <?php
            }
            if ($get_name == "SDA") {
        ?>


            <?php
                if (isset($_GET['ID'])) {


                    $type = "booking_id";
                    $input = $_GET['ID'];

                    if ($type == "booking_id") {
                        $sql2 = "SELECT id,its,name,mobile,date,jk_id,timings_id,status from booking_info WHERE  id=$input AND sc_deposit!=''";


                        $run2 = $conn->query($sql2); ?>
                    <?php if ($run2->num_rows > 0) {

                    ?>
                        <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                        <?php

                            while ($row = $run2->fetch_assoc()) {
                                $id = $row['id'];
                                $its = $row['its'];
                                $name = $row['name'];
                                $mobile = $row['mobile'];
                                $date = $row['date'];

                                $jk_id = $row['jk_id'];

                                $ledger_id = $_GET['ledger_id'];
                                if ($ledger_id != 0) {
                                    $s0 = "SELECT c_date,id,status,amount from ledger2 WHERE bk_id=$input AND id=$ledger_id AND type=1 AND debit=1";
                                } else {
                                    $s0 = "SELECT c_date,id,status,amount from ledger2 WHERE bk_id=$input AND type=1 AND debit=1 and status!=3";
                                }

                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();
                                $ledger_id = $row0['id'];
                                $current_date = $row0['c_date'];
                                $status = $row0['status'];
                                $sc_deposit = $row0['amount'];
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
                        <?php     }
                            $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                            $rund2 = $conn->query($d2);
                            if ($rund2->num_rows > 0) {
                                $rowd2 = $rund2->fetch_assoc();
                                $receipt_id = $rowd2['id'];
                            } else {
                                $receipt_id = "";
                            }

                        ?>



                        <br>
                        <div id="printableArea0">
                            <div class="print-area1">
                                <div class="box_receipt1">
                                    <p style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </p>
                                    <p class="text-center"><b>Hakimi Trust</b></p>
                                    <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                    <br>
                                    <p style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/SD/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>
                                    <p>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></p>

                                    <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                    <div style="float:left;">
                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></p>
                                    </div>
                                    <div style="float:right;">
                                        <?php
                                        if ($status == 3) {
                                        ?>
                                            <img style="max-width:200px" src="images/deleted.png">

                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <p style="text-align:left;display:inline-block;">


                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </p>

                                    <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                    <style>
                                        .box_r1 {
                                            width: 150px;
                                            height: 50px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;

                                        }
                                    </style>

                                    <div class="box_r1 text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <p style="text-align:center;">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                        </hp>

                                </div>
                            </div>
                        </div>


                        <div id="printableArea">
                            <div class="print-area">
                                <div class="box_receipt">
                                    <h2 style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </h2>
                                    <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                    <br>
                                    <h3 style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/SD/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>
                                    <br>

                                    <h3>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></h3>

                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                    <div style="float:left;">
                                        <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>
                                    </div>
                                    <div style="float:right;">
                                        <?php
                                        if ($status == 3) {
                                        ?>
                                            <img style="max-width:200px" src="images/deleted.png">

                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <p style="text-align:left;display:inline-block;font-size:18pt">


                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </p>

                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                    <br>
                                    <style>
                                        .box_r {
                                            width: 300px;
                                            height: 100px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;
                                            font-size: 40px;
                                        }
                                    </style>

                                    <div class="box_r text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <h3 style="text-align:center;margin-left:200px">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                    </h3>

                                </div>
                                <br>
                                <div class="box_receipt">
                                    <h2 style="text-align:left;">
                                        <u><b>RECEIPT</b></u>
                                        <span style="float:right;">
                                            <b> Trust Reg. No. 986/2008</b>
                                        </span>

                                    </h2>
                                    <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                    <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                    <br>
                                    <h3 style="text-align:left;">
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/SD/" . $input . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </h3>
                                    <br>

                                    <h3>Booking ID &nbsp;&nbsp;<u><b><?php echo $input ?></b></u></h3>

                                    <h3>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                    <div style="float:left;">
                                        <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>
                                    </div>
                                    <div style="float:right;">
                                        <?php
                                        if ($status == 3) {
                                        ?>
                                            <img style="max-width:200px" src="images/deleted.png">

                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <p style="text-align:left;display:inline-block;font-size:18pt">
                                        against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
                                        <span>
                                            on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                        </span>
                                    </p>

                                    <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                    <br>
                                    <style>
                                        .box_r {
                                            width: 300px;
                                            height: 100px;
                                            border: 1px solid #000000;
                                            word-wrap: break-word;
                                            font-size: 40px;
                                        }
                                    </style>

                                    <div class="box_r text-center">
                                        &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                    </div>
                                    <h3 style="text-align:center;margin-left:200px">
                                        Donor's Sign
                                        <span style="float:right;">
                                            Receiver's Sign
                                        </span>
                                    </h3>

                                </div>
                            </div>
                        </div>



                    <?php
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                                       No Booking Found
                                      </div>';
                        }
                    } else {
                        $sql2 = "SELECT id,its,name,mobile,jk_id,date,status,timings_id from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


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




                                        echo '<div class="alert alert-success mt-2" role="alert">
                                                           Success
                                                          </div>';
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
        <?php
            }
            if ($get_name == "RSD") {
        ?>
            <form method="POST">
                <div class="row">

                    <!--  <div class="col-lg-3">

                        <select class="form-control" name="type">

                            <option value="booking_id">Booking ID</option>

                        </select>

                    </div> -->
                    <div class="col-lg-4">

                        <div class="search-box">

                            <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Booking ID/ Name..." required />

                            <div class="result"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <button value="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-lg-6">
                                <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                            </div>
                        </div>
                    </div>


            </form>
        </div>
        <?php
                if (isset($_POST['submit'])) {


                    $type = $_POST['type'];
                    $input = $_POST['input'];

                    if (strpos($input, '(') !== false) {
                        $first_index = stripos($input, "(") + 1;
                        $s_id_e = substr($input, $first_index);
                        $input = rtrim($s_id_e, ") ");
                    }


                    if ($type == "booking_id") {
                        $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,sc_deposit,timings_id from booking_info WHERE  id=$input AND refund_sc=1";


                        $run2 = $conn->query($sql2); ?>
                <?php if ($run2->num_rows > 0) {

                ?>
                    <?php

                            while ($row = $run2->fetch_assoc()) {
                                $id = $row['id'];
                                $its = $row['its'];
                                $name = $row['name'];
                                $mobile = $row['mobile'];
                                $date = $row['date'];
                                $status = $row['status'];
                                $jk_id = $row['jk_id'];
                                $sc_deposit = $row['sc_deposit'];
                                $s0 = "SELECT c_date,id from ledger2 WHERE amount='$sc_deposit' AND bk_id=$input AND type=2 AND debit=0";
                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();
                                $ledger_id = $row0['id'];
                                $current_date = $row0['c_date'];
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
                    <?php     }
                            $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                            $rund2 = $conn->query($d2);
                            if ($rund2->num_rows > 0) {
                                $rowd2 = $rund2->fetch_assoc();
                                $receipt_id = $rowd2['id'];
                            } else {
                                $receipt_id = "";
                            }

                    ?>


                    <br>
                    <div id="printableArea0">
                        <div class="print-area1">
                            <div class="box_receipt1">
                                <p style="text-align:left;">
                                    <u><b>RECEIPT</b></u>
                                    <span style="float:right;">
                                        <b> Trust Reg. No. 986/2008</b>
                                    </span>

                                </p>
                                <p class="text-center"><b>Hakimi Trust</b></p>
                                <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                <br>
                                <p style="text-align:left;">
                                    Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $input . "/" . $receipt_id ?></b></u>
                                    <span style="float:right;">
                                        Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                    </span>
                                </p>

                                <p>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                <p>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></p>


                                <p style="text-align:left;">
                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
                                    <span>
                                        on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                    </span>
                                </p>

                                <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                <style>
                                    .box_r1 {
                                        width: 150px;
                                        height: 50px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;

                                    }
                                </style>

                                <div class="box_r1 text-center">
                                    &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                </div>
                                <p style="text-align:center;margin-left:200px">
                                    Donor's Sign
                                    <span style="float:right;">
                                        Receiver's Sign
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div id="printableArea">
                        <div class="print-area">
                            <div class="box_receipt">
                                <h2 style="text-align:left;">
                                    <u><b>RECEIPT</b></u>
                                    <span style="float:right;">
                                        <b> Trust Reg. No. 986/2008</b>
                                    </span>

                                </h2>
                                <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                <br>
                                <h3 style="text-align:left;">
                                    Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/" . $input . "/" . $receipt_id ?></b></u>
                                    <span style="float:right;">
                                        Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                    </span>
                                </h3>
                                <br>
                                <h3>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                <h3>Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>


                                <h3 style="text-align:left;">
                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
                                    <span>
                                        on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                    </span>
                                </h3>

                                <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                <br>
                                <style>
                                    .box_r {
                                        width: 300px;
                                        height: 100px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;
                                        font-size: 40px;
                                    }
                                </style>

                                <div class="box_r text-center">
                                    &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                </div>
                                <h3 style="text-align:center;margin-left:200px">
                                    Donor's Sign
                                    <span style="float:right;">
                                        Receiver's Sign
                                    </span>
                                </h3>

                            </div>
                        </div>
                    </div>



                <?php
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                               No Booking Found
                              </div>';
                        }
                    } else {
                        $sql2 = "SELECT id,its,name,mobile,date,status,jk_id,timings_id from booking_info WHERE status=3 AND its=$input AND laagat='' AND thaals=''";


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




                                        echo '<div class="alert alert-success mt-2" role="alert">
                                                   Success
                                                  </div>';
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
    <?php
            }
            if ($get_name == "RSDA") {
    ?>


        <?php
                if (isset($_GET['ID'])) {


                    $type = "booking_id";
                    $input = $_GET['ID'];

                    if ($type == "booking_id") {
                        $sql2 = "SELECT id,its,name,mobile,date,jk_id,timings_id,sc_deposit from booking_info WHERE  id=$input AND (refund_sc=1 OR refund_sc=2)";


                        $run2 = $conn->query($sql2); ?>
                <?php if ($run2->num_rows > 0) {

                ?>
                    <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')" value="Print" />

                    <?php

                            while ($row = $run2->fetch_assoc()) {
                                $id = $row['id'];
                                $its = $row['its'];
                                $name = $row['name'];
                                $mobile = $row['mobile'];
                                $date = $row['date'];

                                $jk_id = $row['jk_id'];
                                $sc_deposit = $row['sc_deposit'];
                                $ledger_id = $_GET['ledger_id'];
                                if ($ledger_id != 0) {
                                    $s0 = "SELECT c_date,id,status from ledger2 WHERE bk_id=$input AND id=$ledger_id AND type=2 AND debit=0";
                                } else {
                                    $s0 = "SELECT c_date,id,status from ledger2 WHERE bk_id=$input AND type=2 AND debit=0 and status!=3";
                                }
                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();
                                $ledger_id = $row0['id'];
                                $status = $row0['status'];
                                $current_date = $row0['c_date'];
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
                    <?php     }
                            $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                            $rund2 = $conn->query($d2);
                            if ($rund2->num_rows > 0) {
                                $rowd2 = $rund2->fetch_assoc();
                                $receipt_id = $rowd2['id'];
                            } else {
                                $receipt_id = "";
                            }

                    ?>



                    <br>
                    <div id="printableArea0">
                        <div class="print-area1">
                            <div class="box_receipt1">
                                <p style="text-align:left;">
                                    <u><b>RECEIPT</b></u>
                                    <span style="float:right;">
                                        <b> Trust Reg. No. 986/2008</b>
                                    </span>

                                </p>
                                <p class="text-center"><b>Hakimi Trust</b></p>
                                <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                <br>
                                <p style="text-align:left;">
                                    Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/RSD/" . $input . "/" . $receipt_id ?></b></u>
                                    <span style="float:right;">
                                        Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                    </span>
                                </p>

                                <p>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                <div style="float:left;">
                                    <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></p>
                                </div>
                                <div style="float:right;">
                                    <?php
                                    if ($status == 3) {
                                    ?>
                                        <img style="max-width:200px" src="images/deleted.png">

                                    <?php
                                    }
                                    ?>

                                </div>


                                <p style="text-align:left;display:inline-block">
                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
                                    <span>
                                        on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                    </span>
                                </p>

                                <p>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></p>

                                <style>
                                    .box_r1 {
                                        width: 150px;
                                        height: 50px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;

                                    }
                                </style>

                                <div class="box_r1 text-center">
                                    &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                </div>
                                <p style="text-align:center;margin-left:200px">
                                    Donor's Sign
                                    <span style="float:right;">
                                        Receiver's Sign
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>


                    <div id="printableArea">
                        <div class="print-area">
                            <div class="box_receipt">
                                <h2 style="text-align:left;">
                                    <u><b>RECEIPT</b></u>
                                    <span style="float:right;">
                                        <b> Trust Reg. No. 986/2008</b>
                                    </span>

                                </h2>
                                <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                <br>
                                <h3 style="text-align:left;">
                                    Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/RSD/" . $input . "/" . $receipt_id ?></b></u>
                                    <span style="float:right;">
                                        Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                    </span>
                                </h3>
                                <br>
                                <h3>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                <div style="float:left;">
                                    <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>
                                </div>
                                <div style="float:right;">
                                    <?php
                                    if ($status == 3) {
                                    ?>
                                        <img style="max-width:200px" src="images/deleted.png">

                                    <?php
                                    }
                                    ?>

                                </div>

                                <p style="text-align:left;display:inline-block;font-size:18pt">


                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
                                    <span>

                                    </span>
                                </p>
                                <h3>on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u></h3>
                                <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                <br>
                                <style>
                                    .box_r {
                                        width: 300px;
                                        height: 100px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;
                                        font-size: 40px;
                                    }
                                </style>

                                <div class="box_r text-center">
                                    &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                </div>
                                <h3 style="text-align:center;margin-left:200px">
                                    Donor's Sign
                                    <span style="float:right;">
                                        Receiver's Sign
                                    </span>
                                </h3>

                            </div>

                        </div>
                        <br>
                        <div class="print-area">
                            <div class="box_receipt">
                                <h2 style="text-align:left;">
                                    <u><b>RECEIPT</b></u>
                                    <span style="float:right;">
                                        <b> Trust Reg. No. 986/2008</b>
                                    </span>

                                </h2>
                                <h1 class="text-center"><b>Hakimi Trust</b></h1>
                                <h3 class="text-center">Saify Nagar, Indore (M.P.)</h3>
                                <br>
                                <h3 style="text-align:left;">
                                    Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/RSD/" . $input . "/" . $receipt_id ?></b></u>
                                    <span style="float:right;">
                                        Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                    </span>
                                </h3>
                                <br>
                                <h3>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></h3>

                                <div style="float:left;">
                                    <h3> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($sc_deposit) ?></b></u></h3>
                                </div>
                                <div style="float:right;">
                                    <?php
                                    if ($status == 3) {
                                    ?>
                                        <img style="max-width:200px" src="images/deleted.png">

                                    <?php
                                    }
                                    ?>

                                </div>

                                <p style="text-align:left;display:inline-block;font-size:18pt">


                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
                                    <span>

                                    </span>
                                </p>
                                <h3>on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u></h3>
                                <h3>at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u></h3>
                                <br>
                                <style>
                                    .box_r {
                                        width: 300px;
                                        height: 100px;
                                        border: 1px solid #000000;
                                        word-wrap: break-word;
                                        font-size: 40px;
                                    }
                                </style>

                                <div class="box_r text-center">
                                    &#x20B9;&nbsp;<b><?php echo $sc_deposit ?></b>

                                </div>
                                <h3 style="text-align:center;margin-left:200px">
                                    Donor's Sign
                                    <span style="float:right;">
                                        Receiver's Sign
                                    </span>
                                </h3>

                            </div>

                        </div>
                    </div>



        <?php
                        } else {
                            echo '<div class="alert alert-info mt-2" role="alert">
                                               No Booking Found
                                              </div>';
                        }
                    } else {
                    }
                }
        ?>
    <?php
            }



    ?>


    </div>
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-group" id="row' + i + '"><br>  <div> <label>Label</label> <input name="label_name[]" class="form-control" placeholder="Enter Label" required> <label>Start Time</label> <div class="row"> <div class="col-lg-4"> <input name="start_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="start_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="start_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div> <label>End Time</label> <div class="row"> <div class="col-lg-4"> <input name="end_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="end_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="end_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div><br><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        $(document).ready(function() {

            $('input[type=number][max]:not([max=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max').length;
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });

        });
    </script>
    <script>

    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function change_type_receipt() {
            var xmlhttp = new XMLHttpRequest();
            var type = document.getElementById("type_id").value;
            if (type == "1") {
                document.getElementById("cn_div").innerHTML = '<input name="input" placeholder="Enter Cheque Number" class="form-control" required>';

            } else {
                document.getElementById("cn_div").innerHTML = "";
            }
        }

        function change_mode_receipt() {
            var xmlhttp = new XMLHttpRequest();
            var type = document.getElementById("mode").value;
            if (type == "Cheque") {
                document.getElementById("cheque").innerHTML = ' <div class="form-group"><label>Cheque No.</label><input class="form-control" type="text" name="cn" placeholder="Enter Cheque No." required/></div>';

            } else {
                document.getElementById("cheque").innerHTML = "";
            }
        }
    </script>

</body>

</html>