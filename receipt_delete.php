<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');

$current_date = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "51" || $formid == "38") {
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
    <title>Delete Receipt</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
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
            $(".datepicker").datepicker();
        });
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        require('connectDB.php');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Delete Receipt</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">
                            <div class="col-lg-3">

                                <select class="form-control" name="trust_id" required>
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
                            <div class="col-lg-3">

                                <select name="type" class="form-control" required>
                                    <option disabled>--Select--</option>
                                    <option value="0">Hall Rent</option>
                                    <option value="1">Security Deposit</option>

                                    <option value="2">Refund Security Deposit</option>
                                    <option value="3">Garbage</option>
                                    <option value="4">Miscellaneous</option>



                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input name="receipt_id" type="number" placeholder="Enter Receipt Number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button name="submit" class="btn btn-primary" value='submit'>Open</button>

                            </div>

                        </div>
                    </form>
                    <?php
                    if (isset($_GET['submit'])) {
                        $receipt_id = $_GET['receipt_id'];
                        $trust_id = $_GET['trust_id'];
                        $type_id = $_GET['type'];
                        if ($type_id == 0) {
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_hr_ht where id=$receipt_id";
                            } else {
                                $s0 = "SELECT ledger_id from receipt_hr_mt where id=$receipt_id";
                            }
                            $run0 = $conn->query($s0);
                            if ($run0->num_rows > 0) {
                                $row0 = $run0->fetch_assoc();
                            } else { ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Receipt Found
                                </div>
                                <?php  }
                        }
                        if ($type_id == 1) {
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_sd where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else {
                                ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Receipt Found
                                </div>
                                <?php

                            }
                        }
                        if ($type_id == 2) {
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_rsd where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else {
                                ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Receipt Found
                                </div>
                                <?php

                            }
                        }
                        if ($type_id == 3) {
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_garbage where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else {
                                ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Receipt Found
                                </div>
                            <?php

                            }
                        }
                        if ($type_id == 4) {
                            if ($trust_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_misc_ht where id=$receipt_id";
                            } else {
                                $s0 = "SELECT ledger_id from receipt_misc_mt where id=$receipt_id";
                            }
                            $run0 = $conn->query($s0);
                            if ($run0->num_rows > 0) {
                                $row0 = $run0->fetch_assoc();
                            } else { ?>
                                <div class="alert alert-info mt-2" role="alert">
                                    No Receipt Found
                                </div>
                        <?php  }
                        }



                        $ledger_id = $row0['ledger_id'];

                        if ($trust_id == 1) {
                            $sql = "SELECT COUNT(*) as c FROM ledger2 WHERE id=$ledger_id";
                        } else {
                            $sql = "SELECT COUNT(*) as c FROM ledger3 WHERE id=$ledger_id";
                        }
                        $run = $conn->query($sql);
                        $row = $run->fetch_assoc();
                        $c = $row['c'];
                        if ($c > 0) {
                            if ($trust_id == 1) {
                                $s1 = "SELECT name,bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type from ledger2 WHERE id=$ledger_id";
                            } else {
                                $s1 = "SELECT name,bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type from ledger3 WHERE id=$ledger_id";
                            }

                            $run1 = $conn->query($s1);
                            $row1 = $run1->fetch_assoc();
                            $amount = $row1['amount'];
                            $a = $amount;
                            $bk_id = $row1['bk_id'];
                            $name = $row1['name'];
                            $trust_id = $row1['trust_id'];
                            $check_number = $row1['check_number'];
                            $account_number = "";
                            $pay_mode = $row1['pay_mode'];
                            $debit = $row1['debit'];
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
                        }

                        ?>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Receipt Number: <?php echo $receipt_id  ?></h6>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this receipt?');">
                        <input type="hidden" name="ledger_id" value="<?php echo $ledger_id ?>" />
                        <?php
                        if ($status == 3) { ?>
                            <button name="delete" class="btn btn-danger float-right" disabled>DELETED</button>
                        <?php

                        } else {
                        ?>
                            <button name="delete" class="btn btn-danger float-right">DELETE</button>
                        <?php
                        }
                        ?>


                        <?php
                        if ($type_id == 0 && $pay_mode == 1) {
                            $url = "?name=Cash&bk_id=" . $bk_id . "&ledger_id=" . $ledger_id . "&trust_id=" . $trust_id;
                        }
                        if ($type_id == 0 && $pay_mode == 2) {
                            $url = "?name=Online&bk_id=" . $bk_id . "&ledger_id=" . $ledger_id . "&trust_id=" . $trust_id;
                        }
                        if ($type_id == 0 && $pay_mode == 0) {
                            $url = "?name=CN&bk_id=" . $bk_id . "&Number=" . $check_number . "&trust_id=" . $trust_id . "&ledger_id=" . $ledger_id;
                        }
                        if ($type_id == 1) {
                            $url = "?name=SDA&ID=" . $bk_id . "&ledger_id=" . $ledger_id;
                        }
                        if ($type_id == 2) {
                            $url = "?name=RSDA&ID=" . $bk_id . "&ledger_id=" . $ledger_id;
                        }
                        if ($type_id == 3) {
                            $url = "?name=G&ledger_id=" . $ledger_id;
                        }
                        if ($type_id == 4) {
                            $url = "?name=MISC&ledger_id=" . $ledger_id . "&trust_id=" . $trust_id;
                        }
                        if (isset($_POST['delete'])) {
                            $ledger_id = $_POST['ledger_id'];

                            if ($trust_id == 1) {
                                $sql = "UPDATE ledger2 SET status=3 WHERE id=$ledger_id";
                            } else {
                                $sql = "UPDATE ledger3 SET status=3 WHERE id=$ledger_id";
                            }

                            if (mysqli_query($conn, $sql)) {
                                if ($type_id == 2) {
                                    $s1 = "UPDATE booking_info SET refund_sc=2 WHERE id=$bk_id AND sc_deposit!=''";
                                    if (mysqli_query($conn, $s1)) {


                        ?>
                                        <script type="text/javascript">
                                            window.location = 'receipt.php<?php echo $url ?>';
                                        </script>

                                    <?php
                                    }
                                } else if ($type_id == 3) {
                                    $s1 = "UPDATE booking_info SET garbage='' WHERE id=$bk_id AND sc_deposit!=''";
                                    if (mysqli_query($conn, $s1)) {
                                    ?>
                                        <script type="text/javascript">
                                            window.location = 'receipt.php<?php echo $url ?>';
                                        </script>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <script type="text/javascript">
                                        window.location = 'receipt.php<?php echo $url ?>';
                                    </script>
                        <?php
                                }
                            }
                        }

                        ?>
                    </form>

                    <button onclick=" window.open('receipt.php<?php echo $url; ?>','_blank')" class="btn btn-warning float-right mr-4">PRINT</button>

                </div>

                <div class="card-body">
                    <?php

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
                        $st = "SELECT name from trust WHERE id=$trust_id";
                        $rt = $conn->query($st);
                        $rowt = $rt->fetch_assoc();
                        $trust_name = $rowt['name'];
                        if ($type_id != 4) {
                            $sql2 = "SELECT name,date ,purpose,timings_id,jk_id from booking_info WHERE id=$bk_id";


                            $run2 = $conn->query($sql2);
                            $row = $run2->fetch_assoc();
                            $name = $row['name'];
                            $timings_id = $row['timings_id'];
                            $date = $row['date'];
                            $jk_id = $row['jk_id'];
                            $purpose = $row['purpose'];
                            $s6 = "SELECT label from timings WHERE id=$timings_id";
                            $run6 = $conn->query($s6);
                            $row6 = $run6->fetch_assoc();
                            $label_name = $row6['label'];
                            $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                            $run4 = $conn->query($s4);
                            $row4 = $run4->fetch_assoc();
                            $jk_name = $row4['name'];
                        }

                        if ($type == 0) {

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
                                            <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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
                                        <?php
                                        if ($pay_mode == 0) {
                                        ?>
                                            <p>&nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>

                                        <?php

                                        }
                                        ?>
                                        <p style="text-align:left;display:inline-block">
                                            &nbsp; against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo $purpose ?></b></u>
                                            <span>
                                                on Date &nbsp;&nbsp;<u><b><?php echo $date . " (" . $label_name . ")" ?></b></u>
                                            </span>
                                        </p>


                                        <p> at &nbsp;&nbsp;<u><b><?php echo $jk_name ?></b></u>

                                        </p>

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
                        <?php

                            }
                        }
                        if ($type_id == 1) {
                        ?>
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
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/SD/" . $bk_id . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>



                                    <p>Received with Thanks from &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                    <div style="float:left;">
                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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
                                        &nbsp;against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Security Deposit" ?></b></u>
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
                                        &#x20B9;&nbsp;<b><?php echo $amount ?></b>

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


                    <?php
                        }
                        if ($type_id == 2) {

                    ?>
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
                                        Receipt No. &nbsp;&nbsp;&nbsp;<u><b><?php echo "HT/RSD/" . $bk_id . "/" . $receipt_id ?></b></u>
                                        <span style="float:right;">
                                            Date &nbsp;&nbsp;<u><b><?php echo $current_date ?></b></u>
                                        </span>
                                    </p>

                                    <p>Issued To &nbsp;&nbsp;<u><b><?php echo $name ?></b></u></p>



                                    <div style="float:left;">
                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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
                                    <p style="text-align:left;display:inline-block">
                                        &nbsp; against Purpose (Hall Booking) &nbsp;&nbsp;<u><b><?php echo "Refund Security Deposit" ?></b></u>
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

                    <?php
                        }
                        if ($type_id == 3) {
                    ?>
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
                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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
                                        &#x20B9;&nbsp;<b><?php echo $amount ?></b>

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

                    <?php
                        }
                        if ($type_id == 4) {

                    ?>
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

                                    <div style="float:left;">
                                        <p> Rupees in Words &nbsp;&nbsp;<u><b><?php echo getIndianCurrency($amount) ?></b></u></p>
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

                                    <?php
                                    if ($pay_mode == 1) {
                                    ?>
                                        <p style="display: inline-block;">&nbsp; By Cash &nbsp;&nbsp;</p>

                                    <?php
                                    } else {

                                    ?>


                                        <p style="display: inline-block;">&nbsp; By Cheque No. &nbsp;&nbsp;<u><b><?php echo $check_number ?></b></u></p>

                                    <?php

                                    }
                                    ?>


                                    <p style="text-align:left;display:inline-block">
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

                    <?php
                        }
                    ?>
                </div>
            </div>

        <?php

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