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
        if ($formid == "45" || $formid == "51") {
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
    <title>View Voucher</title>

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
                    <h6 class="m-0 font-weight-bold text-primary">View Voucher</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input name="voucher_id" type="number" placeholder="Enter Voucher Number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button name="submit" class="btn btn-primary" value='submit'>Submit</button>

                            </div>

                        </div>
                    </form>
                    <?php
                    if (isset($_GET['submit'])) {
                        $voucher_id = $_GET['voucher_id'];


                        $s0 = "SELECT ledger_id,trust_id from receipt_voucher where id=$voucher_id";
                        $run0 = $conn->query($s0);
                        if ($run0->num_rows > 0) {
                            $row0 = $run0->fetch_assoc();
                        } else { ?>
                            <div class="alert alert-info mt-2" role="alert">
                                No Receipt Found
                            </div>
                        <?php  }




                        $ledger_id = $row0['ledger_id'];
                        $trust_id = $row0['trust_id'];


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

                        $s2 = "SELECT account,bill from voucher where trust_id=$trust_id and ledger_id=$ledger_id";
                        $run2 = $conn->query($s2);
                        $row2 = $run2->fetch_assoc();
                        $account = $row2['account'];
                        $bill = $row2['bill'];
                        ?>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Voucher Number: <?php echo $voucher_id  ?></h6>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this receipt?');">
                        <input type="hidden" name="ledger_id" value="<?php echo $ledger_id ?>" />
                       
                        <input type="button" class="btn btn-warning float-right mr-4" onclick="printDiv('printableArea1')" value="Print" />

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


                        date_default_timezone_set('Asia/Kolkata');

                        $current_date = date('Y-m-d');
                        ?>

                    </form>
               

                </div>
                <div class="card-body">

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

                                            <p> <u><b>DAWOODI BOHRA JAMAAT</b></u></p>

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
                                                            <?php echo $voucher_id; ?>
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
                                <p>Debit &nbsp;&nbsp;<u><b><?php echo "Rs." . $amount; ?></b></u></p>



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
                                <p> on Account of &nbsp;&nbsp;<u><b><?php echo $account ?></b></u></p>


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
                                                <?php
                                                if ($trust_id == "1") {
                                                ?>
                                                    <b>No. HT <?php  } else {
                                                                ?>
                                                        <b>No. MTNC
                                                            <?php
                                                            } ?>/<?php echo $bk_id; ?>/</b>
                                                        <?php echo $voucher_id; ?>
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


                                <br>
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
                                                <?php
                                                if ($trust_id == "1") {
                                                ?>
                                                    <b>No. HT <?php  } else {
                                                                ?>
                                                        <b>No. MTNC
                                                            <?php
                                                            } ?>/<?php echo $bk_id; ?>/</b>
                                                        <?php echo $voucher_id; ?>
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
    require('footer.php');
    ?>

</body>

</html>