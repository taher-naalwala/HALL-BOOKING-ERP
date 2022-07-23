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
    <title>Edit Voucher</title>

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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Voucher</h6>
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
                                    $s1 = "UPDATE voucher SET bill='$bill',account='$account_of' WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                                    if (mysqli_query($conn, $s1)) {


                                        echo '<div class="alert alert-success mt-2" role="alert">
                                                    Success  &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                                    ' .
                                            '</div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                                    Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                                    ' .
                                            '</div>';
                                    }
                                }
                            } else {
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
                                                    Success  &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                                    ' .
                                                        '</div>';
                                                } else {
                                                    echo '<div class="alert alert-danger mt-2" role="alert">
                                                    Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                                    ' .
                                                        '</div>';
                                                }
                                            }
                                        }
                                    }
                                }
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
                            <input name="name" value="<?php echo $name ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>on Account of</label>
                            <input name="account" value="<?php echo $account ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Bill No.</label>
                            <input type="number" name="bill" value="<?php echo $bill ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Booking ID</label>
                            <input name="bk_id" value="<?php echo $bk_id ?>" class="form-control" required />
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
                                <option value='' disabled>TRUST</option>
                                <?php
                                $sql = "SELECT name,id from trust WHERE id!=$trust_id";
                                $run = $conn->query($sql);
                                while ($row = $run->fetch_assoc()) {
                                    $trust_name = $row['name'];
                                    $trust_id0 = $row['id'];
                                ?>
                                    <option value='<?php echo $trust_id0 ?>'><?php echo $trust_name ?></option>
                                <?php
                                }
                                ?>

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
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
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
    <?php
    require('footer.php');
    ?>

</body>

</html>