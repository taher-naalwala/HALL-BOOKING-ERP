<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "45" || $formid == "53") {
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
    <title>Voucher</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="modal_box.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .ui-datepicker-calendar {
            display: none;
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

    <?php
    require('search_name_css.php');
    ?>

</head>

<body id="page-top">
    <div id="wrong_modal" class="modal">


        <div class="modal-content">
            <span class="close">&times;</span>

            <img align="left" style="width:25%;height:25%;" src="images/wrong_caption_img.png"> &nbsp;
            &nbsp;<b>
                <p style="font-size: large">No Voucher Found</p>
            </b>
        </div>

    </div>
    <div id="wrapper">
        <?php
        require('style.php');
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
                    <h6 class="m-0 font-weight-bold text-primary">Voucher</h6>
                </div>
                <div class="card-body">
                    <form id="form1" method="GET">
                        <div class="row">

                            <div class="col-lg-2">


                                <select name="type" class="form-control" onChange="change_type()" id="type" required>
                                    <option value="" disabled>--Type--</option>
                                    <?php
                                    $check = 0;

                                    ?>
                                    <option value="0">Hall Rent</option>
                                    <option value="1">Voucher Number</option>
                                    <?php

                                    ?>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div id="1">
                                    <select class="form-control" name="br" id="br" onchange="change_br()" required>
                                        <option value="" disabled>--Select--</option>
                                        <option value="0">Booking ID</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="2">
                                    <div class="search-box">

                                        <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required />

                                        <div class="result"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="3">

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="4">
                                    <button id="submit_button" name="submit" class="btn btn-primary" value="submit">Submit</button>
                                </div>
                            </div>

                        </div>


                </div>
                </form>
                <div id="report_table">
                    <?php require('connectDB.php');
                    if (isset($_GET['type'])) {
                        //   include('ajax_report_receipt.php');
                        $type = $_GET['type'];

                        if ($type == 0) {

                            $br = $_GET['br'];
                            if ($br == 0) {
                                $input = $_GET['input'];
                                if (strpos($input, '(') !== false) {
                                    $first_index = stripos($input, "(") + 1;
                                    $s_id_e = substr($input, $first_index);
                                    $input = rtrim($s_id_e, ") ");
                                }
                                $bk_id = $input;

                                $sql = "SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=5 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=5 AND bk_id=$bk_id AND (status=1 OR status=3) ";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {

                                    while ($row = $run->fetch_assoc()) {

                                        $a = $row['amount'];
                                        $cn = $row['check_number'];
                                        $debit = $row['debit'];
                                        $c_c_date = $row['check_cleared_date'];
                                        $an = "";
                                        $current_date = $row['c_date'];
                                        $pay_mode = $row['pay_mode'];
                                        $ledger_id = $row['id'];
                                        $trust_id = $row['trust_id'];
                                        $status = $row['status'];
                                        $sql2 = "SELECT its,name,date,jk_id,purpose,timings_id from booking_info WHERE id=$bk_id";


                                        $run2 = $conn->query($sql2);
                                        $row2 = $run2->fetch_assoc();

                                        $its = $row2['its'];
                                        $name = $row2['name'];



                                        $date = $row2['date'];

                                        $purpose = $row2['purpose'];
                                        $date = $row2['date'];
                                        $jk_id = $row2['jk_id'];

                                        $s9 = "SELECT type  from jk_info where id=$jk_id";
                                        $run9 = $conn->query($s9);
                                        $row9 = $run9->fetch_assoc();
                                        $hall_type = $row9['type'];

                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];

                                        $timings_id = $row2['timings_id'];
                                        $s6 = "SELECT label,start_time,end_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();
                                        $label_name = $row6['label'];
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
                                        <input type="submit" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id . $trust_id ?>')" value="Print" />

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

                                                        <div style="float:left;">
                                                            <p>Amount being paid to &nbsp;&nbsp;<u><b><?php echo $name . " " ?></b></u></p>
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

                                                            &nbsp; on Account of &nbsp;&nbsp;<u><b><?php echo "Refund for JamaatKhana Booking" ?></b></u></p>


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

                                                        <h3 style="text-align:left;display:inline-block;">

                                                            &nbsp;on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


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

                                                        <h3 style="text-align:left;display:inline-block;">

                                                            &nbsp; on Account of &nbsp;&nbsp;<u><b><?php echo "Refund For JamaatKhana Booking" ?></b></u></h3>


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
                                    } ?>


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
                        } else {
                            $voucher_id = $_GET['voucher_id'];
                            $trust_id = $_GET['trust_id'];
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from voucher_ht where id=$voucher_id";
                            } else {
                                $s0 = "SELECT ledger_id from voucher_mt where id=$voucher_id";
                            }

                            $run0 = $conn->query($s0);
                            if ($run0->num_rows > 0) {
                                $row0 = $run0->fetch_assoc();
                            } else { ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Voucher Found
                                </div>
                            <?php  }




                            $ledger_id = $row0['ledger_id'];

                            if ($trust_id == 1) {
                                $s1 = "SELECT name,bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type from ledger2 WHERE id=$ledger_id";
                            } else {
                                $s1 = "SELECT name,bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type from ledger3 WHERE id=$ledger_id";
                            }
                            $run1 = $conn->query($s1);
                            $row1 = $run1->fetch_assoc();
                            $amount = $row1['amount'];
                            $bk_id = $row1['bk_id'];
                            $name = $row1['name'];
                            $trust_id = $row1['trust_id'];
                            $check_number = $row1['check_number'];
                            $account_number = "";
                            $pay_mode = $row1['pay_mode'];

                            $c_date = $row1['c_date'];
                            list($f_y, $f_m, $f_d) = explode('-', $c_date);
                            $f_first0 = $f_m . "/" . $f_d . "/" . $f_y;
                            $start_date = str_replace(' ', '', $f_first0);

                            $time = $row1['time'];
                            $status = $row1['status'];
                            $check_cl = $row1['check_cleared_date'];
                            if ($check_cl == "") {
                            } else {
                                list($f_y1, $f_m1, $f_d1) = explode('-', $check_cl);
                                $f_first01 = $f_m1 . "/" . $f_d1 . "/" . $f_y1;
                                $check_cl = str_replace(' ', '', $f_first01);
                            }
                            $type = $row1['type'];
                            if ($bk_id == 0) {
                                $s2 = "SELECT account,bill from voucher where trust_id=$trust_id and ledger_id=$ledger_id";
                                $run2 = $conn->query($s2);
                                $row2 = $run2->fetch_assoc();
                                $account = $row2['account'];
                                $bill = $row2['bill'];
                            } else {
                                $sql2 = "SELECT name from booking_info WHERE id=$bk_id";


                                $run2 = $conn->query($sql2);
                                $row = $run2->fetch_assoc();
                                $name = $row['name'];
                                $account = "Refund for JamaatKhana Booking";
                                $bill = "0";
                            }

                            $receipt_id = $voucher_id;
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
                                        <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $amount ?></b></u></p>



                                        <p>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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
                                        <br><br>
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
                                            if ($pay_mode == 0) {
                                            ?>
                                        <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>
                                    <?php

                                            } else {
                                    ?>
                                        <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                    <?php
                                            }
                                    ?>
                                    <span style="float: right;">
                                        <div class="box_r1 text-center">
                                            &#x20B9;&nbsp;<b><?php echo $amount ?></b>
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
                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $amount ?></b></u></h3>



                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></h3>

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
                                        <br>
                                        <br>
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
                                            if ($pay_mode == 0) {
                                            ?>
                                                <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>
                                            <?php

                                            } else {
                                            ?>
                                                <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                            <?php
                                            }
                                            ?>
                                            <span style="float: right;">
                                                <div class="box_r1 text-center">
                                                    &#x20B9;&nbsp;<b><?php echo $amount ?></b>
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
                                        <h3>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $amount ?></b></u></h3>

                                        <h3>Rs. in words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></h3>

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
                                        <br>
                                        <br>
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
                                            if ($pay_mode == 0) {
                                            ?>
                                                <p>Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>
                                            <?php

                                            } else {
                                            ?>
                                                <p>By &nbsp;&nbsp;<u><b><?php echo "Cash" ?></b></u></p>
                                            <?php
                                            }
                                            ?>
                                            <span style="float: right;">
                                                <div class="box_r1 text-center">
                                                    &#x20B9;&nbsp;<b><?php echo $amount ?></b>
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
                </div>

            </div>
        </div>




        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>


        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

        <script src="js/demo/datatables-demo.js"></script>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>





        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }


            function change_type() {
                $("#2").empty();
                $("#3").empty();

                $("#4").empty();
                var xmlhttp = new XMLHttpRequest();
                var type = document.getElementById("type").value;
                if (type == 1) {
                    document.getElementById("1").innerHTML = '<select name="trust_id" class="form-control" required> <?php $sql = "SELECT * from trust";
                                                                                                                        $run = $conn->query($sql);
                                                                                                                        while ($row = $run->fetch_assoc()) { ?> <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option> <?php } ?> </select>';
                    document.getElementById("2").innerHTML = '<input name="voucher_id" placeholder="Enter Voucher Number" class="form-control">';
                    document.getElementById("3").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

                } else {
                    document.getElementById("1").innerHTML = '  <select class="form-control" name="br" id="br" onchange="change_br()" required> <option value="" disabled>--Select--</option> <option value="0">Booking ID</option> </select>';

                    document.getElementById("2").innerHTML = ' <div class="search-box"><input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required/><div class="result"></div></div>';

                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

                }


                $('.search-box input[type="text"]').on("keyup input", function() {
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if (inputVal.length) {
                        $.get("search_name.php", {
                            term: inputVal
                        }).done(function(data) {
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else {
                        resultDropdown.empty();
                    }
                });

                // Set search input value on click of result item
                $(document).on("click", ".result p", function() {
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });



            }

            function change_br() {

                $("#3").empty();
                $("#4").empty();
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "ajax_receipt.php?br=" + document.getElementById("br").value, false);
                xmlhttp.send(null);
                document.getElementById("2").innerHTML = xmlhttp.responseText;
                if (document.getElementById("br").value == 0) {
                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
                } else {
                    document.getElementById("3").innerHTML = ' <input name="receipt_id" placeholder="Enter Receipt Number" class="form-control">';


                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

                }


                $('.search-box input[type="text"]').on("keyup input", function() {
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if (inputVal.length) {
                        $.get("search_name.php", {
                            term: inputVal
                        }).done(function(data) {
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else {
                        resultDropdown.empty();
                    }
                });

                // Set search input value on click of result item
                $(document).on("click", ".result p", function() {
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });





            }

            function change_br123() {

                $("#3").empty();
                $("#4").empty();
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "ajax_receipt.php?br123=" + document.getElementById("br123").value, false);
                xmlhttp.send(null);
                document.getElementById("2").innerHTML = xmlhttp.responseText;
                if (document.getElementById("br123").value == 0) {
                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
                } else {


                    document.getElementById("3").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

                }


                $('.search-box input[type="text"]').on("keyup input", function() {
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if (inputVal.length) {
                        $.get("search_name.php", {
                            term: inputVal
                        }).done(function(data) {
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else {
                        resultDropdown.empty();
                    }
                });

                // Set search input value on click of result item
                $(document).on("click", ".result p", function() {
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });





            }
        </script>
</body>

</html>