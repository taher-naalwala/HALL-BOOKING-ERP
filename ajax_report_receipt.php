<?php
$type = $_GET['type'];
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

        $sql = "SELECT id,amount,c_date,check_number,account_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,account_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) ";
        $run = $conn->query($sql);
        if ($run->num_rows > 0) {

            while ($row = $run->fetch_assoc()) {

                $a = $row['amount'];
                $cn = $row['check_number'];
                $debit = $row['debit'];
                $c_c_date = $row['check_cleared_date'];
                $an = $row['account_number'];
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
                <input type="submit" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id.$trust_id ?>')" value="Print" />

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


                    <div id="printableArea<?php echo $ledger_id.$trust_id ?>">
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


                    <div id="printableArea<?php echo $ledger_id .$trust_id?>">
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

        $sql = "SELECT id,amount,c_date,check_number,account_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger2 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) UNION ALL SELECT id,amount,c_date,check_number,account_number,pay_mode,status,check_cleared_date,trust_id,debit from ledger3 WHERE type=0 AND bk_id=$bk_id AND (status=1 OR status=3) ";
        $run = $conn->query($sql);
        if ($run->num_rows > 0) {

            while ($row = $run->fetch_assoc()) {

                $a = $row['amount'];
                $cn = $row['check_number'];
                $debit = $row['debit'];
                $c_c_date = $row['check_cleared_date'];
                $an = $row['account_number'];
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
                <input type="submit" class="btn btn-warning" onclick="printDiv('printableArea<?php echo $ledger_id.$trust_id ?>')" value="Print" />

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


                    <div id="printableArea<?php echo $ledger_id.$trust_id ?>">
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


                    <div id="printableArea<?php echo $ledger_id .$trust_id?>">
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
            echo "Not found";
        }
    }

    $run_0 = $conn->query($s_0);
    $row_0 = $run_0->fetch_assoc();
}
?>