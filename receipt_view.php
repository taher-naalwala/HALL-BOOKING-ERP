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
        if ($formid == "39" || $formid == "38" || $formid == "40" || $formid == "44" || $formid == "46" || $formid == "47" ) {
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
    <title>Report</title>

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
    <title>Receipt</title>
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
                <p style="font-size: large">No Receipt Found</p>
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
                    <h6 class="m-0 font-weight-bold text-primary">Receipt</h6>
                </div>
                <div class="card-body">
                    <form id="form1" method="GET">
                        <div class="row">

                            <div class="col-lg-2">


                                <select name="type" class="form-control" onChange="change_type()" id="type" required>
                                    <option value="" disabled>--Type--</option>
                                    <?php
                                    $check = 0;
                                    if (in_array("38", $forms_access) || in_array("39", $forms_access)) {
                                    ?>
                                        <option value="0">Hall Rent</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (in_array("38", $forms_access) || in_array("46", $forms_access)) {

                                    ?>
                                        <option value="1">Security Deposit</option>
                                    <?php
                                    }
                                    if (in_array("38", $forms_access) || in_array("47", $forms_access)) {
                                    ?>
                                        <option value="2">Refund Security Deposit</option>
                                    <?php
                                    }
                                    if (in_array("38", $forms_access) || in_array("40", $forms_access)) {
                                    ?>
                                        <option value="3">Garbage</option>
                                    <?php
                                    }
                                    if (in_array("38", $forms_access) || in_array("44", $forms_access)) {

                                    ?>
                                        <option value="4">Miscellaneous</option>
                                    <?php
                                    }
                                    ?>


                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div id="1">
                                    <select class="form-control" name="br" id="br" onchange="change_br()" required>
                                        <option value="" disabled>--Select--</option>
                                        <option value="0">Booking ID</option>
                                        <option value="1">Receipt Number</option>

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

                                $sql = "SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) ";
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

                                                        <p style="text-align:left;display:inline-block;">

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

                                                        <p style="text-align:left;display:inline-block;">

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
                                                                    }  ?></b>
                                                            </span>

                                                        </p>
                                                        <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                        <br>
                                                        <p style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else if ($pay_mode == 0) {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            } else {
                                                    ?>
                                                        &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php

                                                            }
                                                    ?>

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
                                                    <?php
                                                    if ($hall_type == 1) {
                                                    ?>
                                                        <br>
                                                        <div style="float:left;">
                                                            <p><b>Note: No Refund and No Cancellation</b></p>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else if ($pay_mode == 0) {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            } else {
                                                    ?>
                                                        &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php

                                                            }
                                                    ?>
                                                   

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
                                                    <?php
                                                    if ($hall_type == 1) {
                                                    ?>
                                                        <br>

                                                        <h4><b>Note: No Refund and No Cancellation</b></h4>

                                                    <?php
                                                    }
                                                    ?>

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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else if ($pay_mode == 0) {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            } else {
                                                    ?>
                                                        &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php

                                                            }
                                                    ?>
                                                   

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
                                                    <?php
                                                    if ($hall_type == 1) {
                                                    ?>
                                                        <br>

                                                        <h4><b>Note: No Refund and No Cancellation</b></h4>

                                                    <?php
                                                    }
                                                    ?>
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
                            } else {
                                $receipt_id = $_GET['receipt_id'];
                                $trust_id = $_GET['br_trust'];
                                if ($trust_id == 1) {
                                    $sql = "SELECT ledger_id from receipt_hr_ht WHERE id=$receipt_id";
                                } else {
                                    $sql = "SELECT ledger_id from receipt_hr_mt WHERE id=$receipt_id";
                                }
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    $row = $run->fetch_assoc();
                                  $ledger_id = $row['ledger_id'];


                                    $sql = "SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger2 WHERE type=0  AND  (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id UNION ALL SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger3 WHERE type=0 AND (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id";


                                    $run__1 = $conn->query($sql);
                                    if ($run__1->num_rows > 0) {

                                        while ($row = $run__1->fetch_assoc()) {

                                            $a = $row['amount'];
                                            $cn = $row['check_number'];
                                            $debit = $row['debit'];
                                            $bk_id = $row['bk_id'];
                                            $c_c_date = $row['check_cleared_date'];
                                            $an = "";
                                            $current_date = $row['c_date'];
                                            $pay_mode = $row['pay_mode'];

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
                                            $s4 = "SELECT name,type from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                            $hall_type = $row4['type'];

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

                                                            <h3 style="text-align:left;display:inline-block;">

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

                                                            <h3 style="text-align:left;display:inline-block;">

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


                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        }  ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                    if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else if ($pay_mode == 0) {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                } else {
                                                        ?>
                                                            &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php

                                                                }
                                                        ?>
                                                       

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
                                                        <?php
                                                        if ($hall_type == 1) {
                                                        ?>
                                                            <br>
                                                            <div style="float:left;">
                                                                <p><b>Note: No Refund and No Cancellation</b></p>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else if ($pay_mode == 0) {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                } else {
                                                        ?>
                                                            &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php

                                                                }
                                                        ?>
                                                      

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
                                                        <?php
                                                        if ($hall_type == 1) {
                                                        ?>
                                                            <br>

                                                            <h4><b>Note: No Refund and No Cancellation</b></h4>

                                                        <?php
                                                        }
                                                        ?>

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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else if ($pay_mode == 0) {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                } else {
                                                        ?>
                                                            &nbsp; By Online TXN ID &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php

                                                                }
                                                        ?>
                                                      

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
                                                        <?php
                                                        if ($hall_type == 1) {
                                                        ?>
                                                            <br>

                                                            <h4><b>Note: No Refund and No Cancellation</b></h4>

                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                </div>


                                        <?php
                                            }
                                        } ?>



                                    <?php
                                    } else {
                                        echo "Not Found";
                                    }
                                } else {
                                    echo "Not found";
                                }
                            }
                        }
                        if ($type == 1) {
                            $br = $_GET['br123'];
                            if ($br == 0) {
                                $input = $_GET['input'];
                                if (strpos($input, '(') !== false) {
                                    $first_index = stripos($input, "(") + 1;
                                    $s_id_e = substr($input, $first_index);
                                    $input = rtrim($s_id_e, ") ");
                                }
                                $bk_id = $input;

                                $sql = "SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=1 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=1 AND bk_id=$bk_id AND (status=1 OR status=3) ";
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
                                        $s4 = "SELECT name,type from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                        $hall_type = $row4['type'];

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

                                                        <p style="text-align:left;display:inline-block;">

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

                                                        <p style="text-align:left;display:inline-block;">

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
                                                </div>
                                            </div>

                                        <?php
                                        } else {
                                            $purpose = "Security Deposit";

                                        ?>
                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                    echo "Not Found";
                                }
                            } else {
                                $receipt_id = $_GET['receipt_id'];

                                $trust_id = 1;
                                if ($trust_id == 1) {
                                    $sql = "SELECT ledger_id from receipt_sd WHERE id=$receipt_id";
                                } else {
                                    // $sql = "SELECT ledger_id from receipt_hr_mt WHERE id=$receipt_id";
                                }
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    $row = $run->fetch_assoc();
                                    $ledger_id = $row['ledger_id'];


                                    $sql = "SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger2 WHERE type=1 AND  (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id UNION ALL SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger3 WHERE type=1 AND (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id";


                                    $run__1 = $conn->query($sql);
                                    if ($run__1->num_rows > 0) {

                                        while ($row = $run__1->fetch_assoc()) {

                                            $a = $row['amount'];
                                            $cn = $row['check_number'];
                                            $debit = $row['debit'];
                                            $bk_id = $row['bk_id'];
                                            $c_c_date = $row['check_cleared_date'];
                                            $an = "";
                                            $current_date = $row['c_date'];
                                            $pay_mode = $row['pay_mode'];

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

                                                            <p style="text-align:left;display:inline-block;">

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

                                                            <p style="text-align:left;display:inline-block;">

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
                                                    </div>
                                                </div>

                                            <?php
                                            } else {
                                                $purpose = "Security Deposit";

                                            ?>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {


                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        }  ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                    if ($trust_id == 1) {

                                                                                                        echo "HT/SD/";
                                                                                                    } else {
                                                                                                        echo "MTNC/SD/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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


                                                <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                        } ?>



                                    <?php
                                    } else {
                                        echo "Not Found";
                                    }
                                } else {
                                    echo "Not found";
                                }
                            }
                        }
                        if ($type == 2) {
                            $br = $_GET['br123'];
                            if ($br == 0) {
                                $input = $_GET['input'];
                                if (strpos($input, '(') !== false) {
                                    $first_index = stripos($input, "(") + 1;
                                    $s_id_e = substr($input, $first_index);
                                    $input = rtrim($s_id_e, ") ");
                                }
                                $bk_id = $input;

                                $sql = "SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=2 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=2 AND bk_id=$bk_id AND (status=1 OR status=3) ";
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
                                        if ($debit == 1) {
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

                                                        <p style="text-align:left;display:inline-block;">

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

                                                        <p style="text-align:left;display:inline-block;">

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
                                                </div>
                                            </div>

                                        <?php
                                        } else {
                                            $purpose = "Refund Security Deposit";

                                        ?>
                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                if ($trust_id == 1) {

                                                                                                    echo "HT/RSD/";
                                                                                                } else {
                                                                                                    echo "MTNC/RSD/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
                                                            <span style="float:right;">
                                                                Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                            </span>
                                                        </p>

                                                        <p>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/HR/";
                                                                                                } else {
                                                                                                    echo "MTNC/HR/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                    echo "Not Found";
                                }
                            } else {
                                $receipt_id = $_GET['receipt_id'];

                                $trust_id = 1;
                                if ($trust_id == 1) {
                                    $sql = "SELECT ledger_id from receipt_rsd WHERE id=$receipt_id";
                                } else {
                                    // $sql = "SELECT ledger_id from receipt_hr_mt WHERE id=$receipt_id";
                                }
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    $row = $run->fetch_assoc();
                                    $ledger_id = $row['ledger_id'];


                                    $sql = "SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger2 WHERE type=2 AND  (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id UNION ALL SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger3 WHERE type=2 AND (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id";


                                    $run__1 = $conn->query($sql);
                                    if ($run__1->num_rows > 0) {

                                        while ($row = $run__1->fetch_assoc()) {

                                            $a = $row['amount'];
                                            $cn = $row['check_number'];
                                            $debit = $row['debit'];
                                            $bk_id = $row['bk_id'];
                                            $c_c_date = $row['check_cleared_date'];
                                            $an = "";
                                            $current_date = $row['c_date'];
                                            $pay_mode = $row['pay_mode'];

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
                                            if ($debit == 1) {
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

                                                            <p style="text-align:left;display:inline-block;">

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

                                                            <p style="text-align:left;display:inline-block;">

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
                                                    </div>
                                                </div>

                                            <?php
                                            } else {
                                                $purpose = "Refund Security Deposit";

                                            ?>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {


                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        }  ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                    if ($trust_id == 1) {

                                                                                                        echo "HT/RSD/";
                                                                                                    } else {
                                                                                                        echo "MTNC/RSD/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
                                                                <span style="float:right;">
                                                                    Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                                                </span>
                                                            </p>

                                                            <p>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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


                                                <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/HR/";
                                                                                                    } else {
                                                                                                        echo "MTNC/HR/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                        } ?>



                                    <?php
                                    } else {
                                        echo "Not Found";
                                    }
                                } else {
                                    echo "Not found";
                                }
                            }
                        }
                        if ($type == 3) {
                            $br = $_GET['br123'];
                            if ($br == 0) {
                                $input = $_GET['input'];
                                if (strpos($input, '(') !== false) {
                                    $first_index = stripos($input, "(") + 1;
                                    $s_id_e = substr($input, $first_index);
                                    $input = rtrim($s_id_e, ") ");
                                }
                                $bk_id = $input;

                                $sql = "SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=3 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=3 AND bk_id=$bk_id AND (status=1 OR status=3) ";
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

                                                        <p style="text-align:left;display:inline-block;">

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

                                                        <p style="text-align:left;display:inline-block;">

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
                                                </div>
                                            </div>

                                        <?php
                                        } else {
                                            $purpose = "Garbage Charge";

                                        ?>
                                            <div id="printableArea">
                                                <div class="print-area1">
                                                    <div class="box_receipt1">
                                                        <p style="text-align:left;">
                                                            <u><b>RECEIPT</b></u>
                                                            <span style="float:right;">
                                                                <b><?php
                                                                    if ($trust_id == "1") {
                                                                        $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
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
                                                                    }  ?></b>
                                                            </span>

                                                        </p>
                                                        <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                        <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                        <br>
                                                        <p style="text-align:left;">
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                if ($trust_id == 1) {

                                                                                                    echo "HT/G/";
                                                                                                } else {
                                                                                                    echo "MTNC/G/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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


                                            <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/G/";
                                                                                                } else {
                                                                                                    echo "MTNC/G/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                                            Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                    echo "HT/G/";
                                                                                                } else {
                                                                                                    echo "MTNC/G/";
                                                                                                }
                                                                                                echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                            <?php if ($pay_mode == 1) {
                                                            ?>
                                                                &nbsp; By Cash &nbsp;&nbsp;</p>

                                                    <?php
                                                            } else {
                                                    ?>

                                                        &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                    <?php
                                                            }
                                                    ?>

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
                                    echo "Not Found";
                                }
                            } else {
                                $receipt_id = $_GET['receipt_id'];

                                $trust_id = 1;
                                if ($trust_id == 1) {
                                    $sql = "SELECT ledger_id from receipt_garbage WHERE id=$receipt_id";
                                } else {
                                    // $sql = "SELECT ledger_id from receipt_hr_mt WHERE id=$receipt_id";
                                }
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    $row = $run->fetch_assoc();
                                    $ledger_id = $row['ledger_id'];


                                    $sql = "SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger2 WHERE type=3 AND  (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id UNION ALL SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id from ledger3 WHERE type=3 AND (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id";


                                    $run__1 = $conn->query($sql);
                                    if ($run__1->num_rows > 0) {

                                        while ($row = $run__1->fetch_assoc()) {

                                            $a = $row['amount'];
                                            $cn = $row['check_number'];
                                            $debit = $row['debit'];
                                            $bk_id = $row['bk_id'];
                                            $c_c_date = $row['check_cleared_date'];
                                            $an = "";
                                            $current_date = $row['c_date'];
                                            $pay_mode = $row['pay_mode'];

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

                                                            <p style="text-align:left;display:inline-block;">

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

                                                            <p style="text-align:left;display:inline-block;">

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
                                                    </div>
                                                </div>

                                            <?php
                                            } else {
                                                $purpose = "Garbage Charge";

                                            ?>
                                                <div id="printableArea">
                                                    <div class="print-area1">
                                                        <div class="box_receipt1">
                                                            <p style="text-align:left;">
                                                                <u><b>RECEIPT</b></u>
                                                                <span style="float:right;">
                                                                    <b><?php
                                                                        if ($trust_id == "1") {


                                                                            echo "Trust Reg. No. 986/2008";
                                                                        } else {
                                                                            echo "Trust Reg. No. 894/2006";
                                                                        }  ?></b>
                                                                </span>

                                                            </p>
                                                            <p class="text-center"><b><?php echo $trust_name ?></b></p>
                                                            <p class="text-center">Saify Nagar, Indore (M.P.)</p>
                                                            <br>
                                                            <p style="text-align:left;">
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                                    if ($trust_id == 1) {

                                                                                                        echo "HT/G/";
                                                                                                    } else {
                                                                                                        echo "MTNC/G/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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


                                                <div id="printableArea<?php echo $ledger_id . $trust_id ?>">
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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/G/";
                                                                                                    } else {
                                                                                                        echo "MTNC/G/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                                                Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                        echo "HT/G/";
                                                                                                    } else {
                                                                                                        echo "MTNC/G/";
                                                                                                    }
                                                                                                    echo $bk_id . "/" . $receipt_id ?></b></u>
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

                                                                <?php if ($pay_mode == 1) {
                                                                ?>
                                                                    &nbsp; By Cash &nbsp;&nbsp;</p>

                                                        <?php
                                                                } else {
                                                        ?>

                                                            &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                        <?php
                                                                }
                                                        ?>

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
                                        } ?>



                                    <?php
                                    } else {
                                        echo "Not Found";
                                    }
                                } else {
                                    echo "Not found";
                                }
                            }
                        }
                        if ($type == 4) {
                            $receipt_id = $_GET['receipt_id'];
                            $trust_id = $_GET['br_trust'];
                            if ($trust_id == 1) {
                                $sql = "SELECT ledger_id from receipt_misc_ht WHERE id=$receipt_id";
                            } else {
                                $sql = "SELECT ledger_id from receipt_misc_mt WHERE id=$receipt_id";
                            }
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {
                                $row = $run->fetch_assoc();
                                $ledger_id = $row['ledger_id'];


                                $sql = "SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id,name from ledger2 WHERE type=4 AND  (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id UNION ALL SELECT amount,c_date,check_number,pay_mode,status,check_cleared_date,trust_id,debit,bk_id,name from ledger3 WHERE type=4 AND (status=1 OR status=3) AND id=$ledger_id AND trust_id=$trust_id";


                                $run__1 = $conn->query($sql);
                                if ($run__1->num_rows > 0) {

                                    while ($row = $run__1->fetch_assoc()) {

                                        $a = $row['amount'];
                                        $cn = $row['check_number'];
                                        $debit = $row['debit'];
                                        $bk_id = $row['bk_id'];
                                        $c_c_date = $row['check_cleared_date'];
                                        $an = "";
                                        $current_date1 = $row['c_date'];
                                        $pay_mode = $row['pay_mode'];

                                        $trust_id = $row['trust_id'];
                                        $status = $row['status'];
                                        $name = $row['name'];

                                        $sql2 = "SELECT purpose from misc WHERE ledger_id=$ledger_id AND trust_id=$trust_id";


                                        $run2 = $conn->query($sql2);
                                        $row2 = $run2->fetch_assoc();
                                        $purpose = $row2['purpose'];


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
                                        <div id="printableArea">
                                            <div class="print-area1">
                                                <div class="box_receipt1">
                                                    <p style="text-align:left;">
                                                        <u><b>RECEIPT</b></u>
                                                        <span style="float:right;">
                                                            <b><?php
                                                                if ($trust_id == "1") {
                                                                    $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id";
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
                                                                    $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id";
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
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php
                                                                                            if ($trust_id == 1) {

                                                                                                echo "HT/MISC/";
                                                                                            } else {
                                                                                                echo "MTNC/MISC/";
                                                                                            }
                                                                                            echo  $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date1 ?></b></u>
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

                                                        <?php if ($pay_mode == 1) {
                                                        ?>
                                                            &nbsp; By Cash &nbsp;&nbsp;</p>

                                                <?php
                                                        } else {
                                                ?>

                                                    &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                <?php
                                                        }
                                                ?>

                                                <p style="text-align:left;">
                                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                    <span>
                                                        on Date &nbsp;&nbsp;<u><b><?php echo  $current_date1 ?></b></u>
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
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                echo "HT/MISC/";
                                                                                            } else {
                                                                                                echo "MTNC/MISC/";
                                                                                            }
                                                                                            echo  $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date1 ?></b></u>
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

                                                        <?php if ($pay_mode == 1) {
                                                        ?>
                                                            &nbsp; By Cash &nbsp;&nbsp;</p>

                                                <?php
                                                        } else {
                                                ?>

                                                    &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                <?php
                                                        }
                                                ?>

                                                <h3 style="text-align:left;">
                                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                    <span>
                                                        on Date &nbsp;&nbsp;<u><b><?php echo $current_date1 ?></b></u>
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
                                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php if ($trust_id == 1) {

                                                                                                echo "HT/MISC/";
                                                                                            } else {
                                                                                                echo "MTNC/MISC/";
                                                                                            }
                                                                                            echo  $receipt_id ?></b></u>
                                                        <span style="float:right;">
                                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date1 ?></b></u>
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

                                                        <?php if ($pay_mode == 1) {
                                                        ?>
                                                            &nbsp; By Cash &nbsp;&nbsp;</p>

                                                <?php
                                                        } else {
                                                ?>

                                                    &nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $cn ?></b></u></p>
                                                <?php
                                                        }
                                                ?>

                                                <h3 style="text-align:left;">
                                                    against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                                    <span>
                                                        on Date &nbsp;&nbsp;<u><b><?php echo $current_date1 ?></b></u>
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
                xmlhttp.open("GET", "ajax_receipt.php?type=" + document.getElementById("type").value, false);
                xmlhttp.send(null);
                document.getElementById("1").innerHTML = xmlhttp.responseText;
                if (document.getElementById("type").value == 0) {
                    document.getElementById("2").innerHTML = ' <div class="search-box"><input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required/><div class="result"></div></div>';

                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
                }
                if (document.getElementById("type").value == 1 || document.getElementById("type").value == 2 || document.getElementById("type").value == 3) {
                    document.getElementById("2").innerHTML = ' <div class="search-box"><input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required/><div class="result"></div></div>';

                    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

                }
                if (document.getElementById("type").value == 4) {
                    document.getElementById("2").innerHTML = '<input name="receipt_id" placeholder="Enter Receipt Number" class="form-control">';

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