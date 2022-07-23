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
        if ($formid == "45" || $formid == "54") {
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

                                    <option value="1">Voucher Number</option>
                                    <?php

                                    ?>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div id="1">
                                    <select name="trust_id" class="form-control" required> <?php $sql = "SELECT * from trust";
                                                                                            $run = $conn->query($sql);
                                                                                            while ($row = $run->fetch_assoc()) { ?> <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option> <?php } ?> </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="2">
                                    <input name="voucher_id" placeholder="Enter Voucher Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="3">
                                    <button id="submit_button" name="submit" class="btn btn-primary" value="submit">Submit</button>

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="4">
                                </div>
                            </div>

                        </div>


                </div>
                </form>
            </div>

            <?php
            if (isset($_GET['submit'])) {
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

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Voucher Number: <?php echo $voucher_id  ?></h6>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_POST['sub'])) {
                            $ledger_id = $_POST['sub'];
                            $amount = $_POST['amt'];
                            $trust_id = $_POST['trust_id'];
                            $trust_id0 = $_POST['trust_id0'];
                            $account_of = $_POST['account'];
                            $bill = $_POST['bill'];
                            $bk_id = $_POST['bk_id'];
                            $pay_mode = $_POST['pay_mode'];
                            if (isset($_POST['cn'])) {
                                $check_number = $_POST['cn'];
                            } else {
                                $check_number = "";
                            }



                            $c_date = $_POST['c_date'];


                            list($f_m, $f_d, $f_y) = explode('/', $c_date);
                            $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                            $start_date = str_replace(' ', '', $f_first0);



                            $name = $_POST['name'];

                            if ($trust_id == $trust_id0) {
                                if ($trust_id == 1) {
                                    $sql = "UPDATE ledger2 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=$pay_mode,c_date='$start_date',check_cleared_date='$start_date',name='$name',bk_id=$bk_id WHERE id=$ledger_id";
                                } else {
                                    $sql = "UPDATE ledger3 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=$pay_mode,c_date='$start_date',check_cleared_date='$start_date',name='$name',bk_id=$bk_id WHERE id=$ledger_id";
                                }

                                if (mysqli_query($conn, $sql)) {
                                    if($bk_id==0)
                                    {
                                        $s1 = "UPDATE voucher SET bill='$bill',account='$account_of' WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                              

                                    }
                                    else
                                    {

                                    }
                                       if (mysqli_query($conn, $s1)) {


                                        echo '<div class="alert alert-success mt-2" role="alert">
                                                    Success  &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Voucher Again</a>
                                                    ' .
                                            '</div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                                    Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Voucher Again</a>
                                                    ' .
                                            '</div>';
                                    }
                                }
                            } else {
                                /*
                                date_default_timezone_set('Asia/kolkata');

                                $time = date('H:i:s');
                                if ($trust_id0 == 1) {
                                    $sql = "UPDATE ledger2 SET status=3 WHERE id=$ledger_id";
                                } else {
                                    $sql = "UPDATE ledger3 SET status=3 WHERE id=$ledger_id";
                                }

                                if (mysqli_query($conn, $sql)) {
                                    if ($trust_id == 1) {

                                        $s1 = "INSERT INTO ledger2 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$amount',1,'$check_number','',$pay_mode,0,1,'$start_date','$time',1,'','$name',5)";
                                    } else {
                                        $s1 = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$amount',2,'$check_number','',$pay_mode,0,1,'$start_date','$time',1,'','$name',5)";
                                    }


                                    if (mysqli_query($conn, $s1)) {
                                        if ($trust_id == 1) {
                                            $s2 = "SELECT id from ledger2 WHERE status=1 AND type=5 AND time='$time' AND bk_id=$bk_id AND amount='$amount' AND trust_id=$trust_id AND pay_mode=$pay_mode AND debit=0 AND c_date='$start_date' AND name='$name'";
                                        } else {
                                            $s2 = "SELECT id from ledger3 WHERE status=1 AND type=5 AND time='$time' AND bk_id=$bk_id AND amount='$amount' AND trust_id=$trust_id AND pay_mode=$pay_mode AND debit=0 AND c_date='$start_date' AND name='$name'";
                                        }
                                        $run2 = $conn->query($s2);
                                        $row2 = $run2->fetch_assoc();
                                        $ledger_id_new = $row2['id'];
                                        $s3 = "UPDATE voucher SET bill='$bill',account='$account_of',ledger_id=$ledger_id_new,trust_id=$trust_id WHERE ledger_id=$ledger_id AND trust_id=$trust_id0";
                                        if (mysqli_query($conn, $s3)) {
                                            $s4 = "UPDATE voucher SET ledger_id=$ledger_id_new,trust_id=$trust_id WHERE ledger_id=$ledger_id and trust_id=$trust_id0";
                                            if (mysqli_query($conn, $s4)) {
                                                $s5 = "UPDATE receipt_voucher SET ledger_id=$ledger_id_new,trust_id=$trust_id where ledger_id=$ledger_id and trust_id=$trust_id0";
                                                if (mysqli_query($conn, $s5)) {
                                                    echo '<div class="alert alert-success mt-2" role="alert">
                                                    Success  &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Voucher Again</a>
                                                    ' .
                                                        '</div>';
                                                } else {
                                                    echo '<div class="alert alert-danger mt-2" role="alert">
                                                    Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Voucher Again</a>
                                                    ' .
                                                        '</div>';
                                                }
                                            }
                                        }
                                    }
                                } */
                            }
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Debit</label>
                                <input name="amt" value="<?php echo $amount ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Amount Being Paid To</label>
                                <input name="name" value="<?php echo $name ?>" class="form-control" required <?php if($bk_id!=0){echo "readonly";} ?>/>
                            </div>
                            <div class="form-group">
                                <label>on Account of</label>
                                <input name="account" value="<?php echo $account ?>" class="form-control" required <?php if($bk_id!=0){echo "readonly";} ?> />
                            </div>
                            <div class="form-group">
                                <label>Bill No.</label>
                                <input type="number" name="bill" value="<?php echo $bill ?>" class="form-control" <?php if($bk_id!=0){echo "readonly";} ?> />
                            </div>
                            <div class="form-group">
                              
                                <input type="hidden" name="bk_id" value="<?php echo $bk_id ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Trust</label>
                                <select class="form-control" name="trust_id" required>
                                    <?php
                                    $sql = "SELECT name,id from trust WHERE id=$trust_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $trust_name = $row['name'];
                                    $trust_id0 = $row['id'];
                                    ?>
                                    <option value='<?php echo $trust_id0 ?>'><?php echo $trust_name ?></option>
                                   
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control" name="pay_mode" id="mode" onchange="change_mode_receipt()" required>
                                    <?php
                                    if ($pay_mode == 0) {
                                    ?>
                                        <option value='0'><?php echo "Cheque" ?></option>
                                        <option value='' disabled>MODE</option>
                                        <option value='1'><?php echo "Cash" ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value='1'><?php echo "Cash" ?></option>
                                        <option value='' disabled>MODE</option>
                                        <option value='0'><?php echo "Cheque" ?></option>
                                    <?php
                                    }
                                    ?>


                                    <!-- <option value="0">Cheque</option> -->
                                </select>
                            </div>

                            <div id="cheque">
                                <?php
                                if ($pay_mode == 0) {
                                ?>
                                    <div class="form-group"><label>Cheque No.</label><input class="form-control" type="text" name="cn" placeholder="Enter Cheque No." value="<?php echo $check_number; ?>" required /></div>
                                <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" value='<?php echo $trust_id ?>' name="trust_id0">






                            <div class="form-group">
                                <label>Receiving Date</label>
                                <input type="text" placeholder="Receiving Date" value='<?php echo $start_date ?>' name="c_date" class="form-control datepicker">

                            </div>

                            <button class="btn btn-primary" name="sub" value="<?php echo $ledger_id ?>">Submit</button>
                        </form>

                    </div>
                </div>

            <?php

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

        function change_mode_receipt() {
            var xmlhttp = new XMLHttpRequest();
            var type = document.getElementById("mode").value;
            if (type == "0") {
                document.getElementById("cheque").innerHTML = ' <div class="form-group"><label>Cheque No.</label><input class="form-control" type="text" name="cn" placeholder="Enter Cheque No." /></div>';

            } else {
                document.getElementById("cheque").innerHTML = "";
            }
        }
    </script>
</body>

</html>