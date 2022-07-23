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
        if ($formid == "49" || $formid == "38") {
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
    <title>Edit Receipt</title>

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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Receipt</h6>
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
                                <button name="submit" class="btn btn-primary" value='submit'>Submit</button>

                            </div>

                        </div>
                    </form>
                    <?php
                    if (isset($_GET['submit'])) {
                        $receipt_id = $_GET['receipt_id'];
                        $trust_id = $_GET['trust_id'];
                        $type_id = $_GET['type'];
                        if ($trust_id == 1) {
                            if ($type_id == 0) {
                                $s0 = "SELECT ledger_id from receipt_hr_ht where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else if ($type_id == 1) {
                                $s0 = "SELECT ledger_id from receipt_sd where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else if ($type_id == 2) {
                                $s0 = "SELECT ledger_id from receipt_rsd where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else if ($type_id == 3) {
                                $s0 = "SELECT ledger_id from receipt_garbage where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else if ($type_id == 4) {
                                $s0 = "SELECT ledger_id from receipt_misc_ht where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            } else {
                                $s0 = "SELECT ledger_id from receipt_voucher where id=$receipt_id AND trust_id=$trust_id";
                                $run0 = $conn->query($s0);
                                if ($run->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                                    <div class="alert alert-info mt-2" role="alert">
                                        No Receipt Found
                                    </div>
                                <?php  }
                            }


                            $ledger_id = $row0['ledger_id'];


                            $sql = "SELECT COUNT(*) as c FROM ledger2 WHERE id=$ledger_id";
                            $run = $conn->query($sql);
                            $row = $run->fetch_assoc();
                            $c = $row['c'];
                            if ($c > 0) {
                                $s1 = "SELECT name,bk_id,amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type from ledger2 WHERE id=$ledger_id";
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
                                ?>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Receipt Number: <?php echo $receipt_id  ?></h6>
                </div>
                <div class="card-body">

                    <?php
                                if (isset($_POST['sub'])) {
                                    $ledger_id = $_POST['sub'];
                                    $amount = $_POST['amt'];
                                    $trust_id = $_POST['trust_id'];
                                    $check_number = $_POST['cn'];
                                    $bk_id = $_POST['bk_id0'];

                                    $amount0 = $_POST['amt0'];
                                    $trust_id0 = $_POST['trust_id0'];
                                    $check_number0 = $_POST['cn0'];

                                    $account_number = "";
                                    $pay_mode = $_POST['pay_mode'];
                                    $debit = $_POST['debit'];

                                    $pay_mode0 = $_POST['pay_mode0'];
                                    $debit0 = $_POST['debit0'];

                                    $credit = 0;
                                    if ($debit == 0) {
                                        $credit = 1;
                                    }
                                    $c_date = $_POST['c_date'];
                                    $c_date0 = $_POST['c_date0'];

                                    $time = $_POST['time'];
                                    $status = $_POST['status'];
                                    $check_cl = $_POST['check_cl'];
                                    $type = $_POST['type'];
                                    list($f_m, $f_d, $f_y) = explode('/', $c_date);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                    $start_date = str_replace(' ', '', $f_first0);

                                    list($f_m0, $f_d0, $f_y0) = explode('/', $c_date0);
                                    $f_first00 = $f_y0 . "-" . $f_m0 . "-" . $f_d0;
                                    $start_date0 = str_replace(' ', '', $f_first00);

                                    $check_cl_date = "";
                                    if ($check_cl != "") {
                                        list($f_m1, $f_d1, $f_y1) = explode('/', $check_cl);
                                        $f_first1 = $f_y1 . "-" . $f_m1 . "-" . $f_d1;
                                        $check_cl_date = str_replace(' ', '', $f_first1);
                                    }
                                    $name = $_POST['name'];

                                    if ($pay_mode == "mode_change_hr") {
                                        $sql = "UPDATE ledger2 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=1,debit=$debit,credit=$credit,c_date='$start_date',time='$time',status=1,type=$type,check_cleared_date='$check_cl_date' WHERE id=$ledger_id";
                                        if (mysqli_query($conn, $sql)) {
                                            $f2 = "INSERT INTO receipt_hr_ht(`ledger_id`) VALUES ($ledger_id)";
                                            mysqli_query($conn, $f2);


                                            echo '<div class="alert alert-success mt-2" role="alert">
                                    Success
                                   </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                    Fail
                                   </div>';
                                        }
                    ?>
                            <script type="text/javascript">
                                window.location = 'receipt.php?name=Cash&bk_id=<?php echo $bk_id ?>';
                            </script>


                    <?php

                                    } else {

                                        $sql = "UPDATE ledger2 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=$pay_mode,debit=$debit,credit=$credit,c_date='$start_date',time='$time',status=$status,type=$type,check_cleared_date='$check_cl_date',name='$name' WHERE id=$ledger_id";

                                        if (mysqli_query($conn, $sql)) {
                                            if ($type == 4) {
                                                $purpose = $_POST['purpose'];
                                                $s1 = "UPDATE misc SET purpose='$purpose' WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
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
                                            } else {


                                                echo '<div class="alert alert-success mt-2" role="alert">
                                            Success &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                            ' .
                                                    '</div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                            Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                            ' .
                                                '</div>';
                                        }
                                    }
                                }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="type" required>
                                <?php
                                if ($type == 0) {
                                ?>
                                    <option value='0'><?php echo "Hall Rent" ?></option>
                                <?php
                                }
                                if ($type == 1) {
                                ?>
                                    <option value='1'><?php echo "Security Deposit" ?></option>
                                <?php
                                }
                                if ($type == 2) {
                                ?>
                                    <option value='2'><?php echo "Refund Security Deposit" ?></option>
                                <?php
                                }
                                if ($type == 3) {
                                ?>
                                    <option value='3'><?php echo "Garbage" ?></option>
                                <?php
                                }
                                if ($type == 4) {
                                ?>
                                    <option value='4'><?php echo "Miscellaneous" ?></option>
                                <?php
                                }
                                if ($type == 5) {
                                ?>
                                    <option value='5'><?php echo "Payment Voucher" ?></option>
                                <?php
                                }
                                ?>

                                <!--   <option value="" disabled>------</option>
                                <option value="0">Hall Rent</option>
                                <option value="1">Security Deposit</option>
                                <option value="2">Refund Security Deposit</option>
                                <option value="3">Garbage</option>
                                <option value="4">Miscellaneous</option>
                                <option value="5">Payment Voucher</option>  -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <?php
                                if ($status == 0) {
                                ?>
                                    <option value='0'><?php echo "Clearance Pending" ?></option>
                                <?php
                                }
                                if ($status == 1) {
                                ?>
                                    <option value='1'><?php echo "Cleared" ?></option>
                                <?php
                                }
                                if ($status == 2) {
                                ?>
                                    <option value='2'><?php echo "Failed" ?></option>
                                <?php
                                }
                                if ($status == 3) {
                                ?>
                                    <option value='3'><?php echo "Deleted" ?></option>
                                <?php
                                }




                                ?>
                                <!--  <option value="" disabled>------</option>

                                <option value="1">Cleared</option>
                                <option value="2">Failed</option>
                                <option value="3">Deleted</option> -->


                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trust</label>
                            <select class="form-control" name="trust_id" required>
                                <?php
                                $sql = "SELECT name,id from trust WHERE id=$trust_id";
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
                            <label>Mode (Jamaat Account)</label>
                            <select class="form-control" name="debit" required>
                                <?php
                                if ($debit == 0) {
                                ?>
                                    <option value='0'><?php echo "Debit From" ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value='1'><?php echo "Credit in" ?></option>
                                <?php
                                }
                                ?>
                                <option value="" disabled>--MODE--</option>
                                <option value="0">Debit From</option>
                                <option value="1">Credit In</option> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Payment Mode</label>
                            <select class="form-control" name="pay_mode" required>
                                <?php
                                if ($pay_mode == 0) {
                                ?>
                                    <option value='0'><?php echo "Cheque" ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value='1'><?php echo "Cash" ?></option>
                                <?php
                                }
                                ?>

                                <?php if ($pay_mode == 0 && $status == 0 && $type == 0) {
                                ?>
                                    <option value="" disabled>------</option>
                                    <option value="mode_change_hr">Cash</option>
                                <?php
                                }

                                ?>
                                <?php if ($type == 4) {
                                ?>
                                    <option value="" disabled>------</option>
                                    <option value="1">Cash</option>
                                    <option value="0">Cheque</option>
                                <?php
                                }
                                ?>
                                <!-- <option value="0">Cheque</option> -->
                            </select>
                        </div>
                        <input name="amt0" type="hidden" value="<?php echo $amount ?>" class="form-control" required />
                        <input name="cn0" type="hidden" value="<?php echo $check_number ?>" class="form-control" />
                        <input name="an0" type="hidden" value="<?php echo $account_number ?>" class="form-control" />
                        <input type="hidden" placeholder="Receiving Date" value='<?php echo $start_date ?>' name="c_date0" class="form-control datepicker">
                        <input type="hidden" value='<?php echo $trust_id ?>' name="trust_id0">
                        <input type="hidden" value='<?php echo $pay_mode ?>' name="pay_mode0">
                        <input type="hidden" value='<?php echo $debit ?>' name="debit0">
                        <input type="hidden" value='<?php echo $bk_id ?>' name="bk_id0">
                        <?php if ($type == 4) {
                                } else { ?>
                            <input type="hidden" value='<?php echo $name ?>' name="name">
                        <?php   }
                        ?>

                        <div class="form-group">
                            <label>Amount</label>
                            <input name="amt" value="<?php echo $amount ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Cheque Number</label>
                            <input name="cn" value="<?php echo $check_number ?>" class="form-control" />
                        </div>
                        <?php
                                if ($type == 4) {
                                    $sql = "SELECT purpose from misc where ledger_id=$ledger_id AND trust_id=$trust_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $purpose = $row['purpose'];

                        ?>
                            <div class="form-group">
                                <label>Purpose</label>
                                <textarea class="form-control" type="text" name="purpose" placeholder="Enter Purpose"><?php echo $purpose; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" value="<?php echo $name ?>" class="form-control" />
                            </div>
                        <?php
                                }
                        ?>

                        <div class="form-group">
                            <label>Receiving Date</label>
                            <input type="text" placeholder="Receiving Date" value='<?php echo $start_date ?>' name="c_date" class="form-control datepicker">

                        </div>
                        <div class="form-group">
                            <label>Receiving Time</label>
                            <input name="time" value="<?php echo $time ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Cheque Clearance Date</label>
                            <input name="check_cl" value="<?php echo $check_cl ?>" class="form-control datepicker" />
                        </div>
                        <button class="btn btn-primary" name="sub" value="<?php echo $ledger_id ?>">Submit</button>
                    </form>

                </div>
            </div>

        <?php
                            } else { ?>
            <div class="alert alert-info mt-2" role="alert">
                No Entry Found
            </div>
            <?php  }
                        } else {

                            if ($type_id == 0) {
                                $s0 = "SELECT ledger_id from receipt_hr_mt where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                <div class="alert alert-info mt-2" role="alert">
                    No Receipt Found
                </div>
            <?php  }
                            } else if ($type_id == 1) {
            ?>
            <div class="alert alert-info mt-2" role="alert">
                No Receipt Found
            </div>
        <?php
                            } else if ($type_id == 2) {
        ?>
            <div class="alert alert-info mt-2" role="alert">
                No Receipt Found
            </div>
        <?php
                            } else if ($type_id == 3) {
        ?>
            <div class="alert alert-info mt-2" role="alert">
                No Receipt Found
            </div>
            <?php
                            } else if ($type_id == 4) {
                                $s0 = "SELECT ledger_id from receipt_misc_mt where id=$receipt_id";
                                $run0 = $conn->query($s0);
                                if ($run0->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                <div class="alert alert-info mt-2" role="alert">
                    No Receipt Found
                </div>
            <?php  }
                            } else {
                                $s0 = "SELECT ledger_id from receipt_voucher where id=$receipt_id AND trust_id=$trust_id";
                                $run0 = $conn->query($s0);
                                if ($run->num_rows > 0) {
                                    $row0 = $run0->fetch_assoc();
                                } else { ?>
                <div class="alert alert-info mt-2" role="alert">
                    No Receipt Found
                </div>
            <?php  }
                            }


                            $ledger_id = $row0['ledger_id'];
                            $sql = "SELECT COUNT(*) as c FROM ledger3 WHERE id=$ledger_id";
                            $run = $conn->query($sql);
                            $row = $run->fetch_assoc();
                            $c = $row['c'];
                            if ($c > 0) {
                                $s1 = "SELECT amount,trust_id,check_number,pay_mode,debit,c_date,time,status,check_cleared_date,type,name from ledger3 WHERE id=$ledger_id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $amount = $row1['amount'];
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
            ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ledger ID: <?php echo $ledger_id  ?></h6>
        </div>
        <div class="card-body">

            <?php
                                if (isset($_POST['sub'])) {
                                    $ledger_id = $_POST['sub'];
                                    $amount = $_POST['amt'];
                                    $trust_id = $_POST['trust_id'];
                                    $check_number = $_POST['cn'];
                                    $account_number = "";
                                    $pay_mode = $_POST['pay_mode'];
                                    $debit = $_POST['debit'];
                                    $credit = 0;
                                    if ($debit == 0) {
                                        $credit = 1;
                                    }
                                    $name = $_POST['name'];
                                    $c_date = $_POST['c_date'];
                                    $time = $_POST['time'];
                                    $status = $_POST['status'];
                                    $check_cl = $_POST['check_cl'];
                                    $type = $_POST['type'];
                                    list($f_m, $f_d, $f_y) = explode('/', $c_date);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                    $start_date = str_replace(' ', '', $f_first0);
                                    $check_cl_date = "";
                                    if ($check_cl != "") {
                                        list($f_m1, $f_d1, $f_y1) = explode('/', $check_cl);
                                        $f_first1 = $f_y1 . "-" . $f_m1 . "-" . $f_d1;
                                        $check_cl_date = str_replace(' ', '', $f_first1);
                                    }

                                    if ($pay_mode == "mode_change") {
                                        $sql = "UPDATE ledger3 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=1,debit=$debit,credit=$credit,c_date='$start_date',time='$time',status=1,type=$type,check_cleared_date='$check_cl_date' WHERE id=$ledger_id";
                                        if (mysqli_query($conn, $sql)) {
                                            $f2 = "INSERT INTO receipt_hr_mt(`ledger_id`) VALUES ($ledger_id)";
                                            mysqli_query($conn, $f2);


                                            echo '<div class="alert alert-success mt-2" role="alert">
                                    Success
                                   </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                    Fail
                                   </div>';
                                        }
            ?>
                    <script type="text/javascript">
                        window.location = 'receipt.php?name=Cash&bk_id=<?php echo $bk_id ?>';
                    </script>


            <?php

                                    } else {

                                        $sql = "UPDATE ledger3 SET name='$name',amount='$amount',trust_id=$trust_id,check_number='$check_number',pay_mode=$pay_mode,debit=$debit,credit=$credit,c_date='$start_date',time='$time',status=$status,type=$type,check_cleared_date='$check_cl_date' WHERE id=$ledger_id";

                                        if (mysqli_query($conn, $sql)) {
                                            if ($type == 4) {
                                                $purpose = $_POST['purpose'];
                                                $s1 = "UPDATE misc SET purpose='$purpose' WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
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
                                            } else {


                                                echo '<div class="alert alert-success mt-2" role="alert">
                                            Success &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                            ' .
                                                    '</div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger mt-2" role="alert">
                                            Fail &nbsp; <a href="' . $_SERVER["REQUEST_URI"] . '">Click Me to Edit this Receipt Again</a>
                                            ' .
                                                '</div>';
                                        }
                                    }

                                    /*   $sql = "UPDATE ledger3 SET amount='$amount',trust_id=$trust_id,check_number='$check_number',account_number='$account_number',pay_mode=$pay_mode,debit=$debit,credit=$credit,c_date='$start_date',time='$time',status=$status,type=$type,check_cleared_date='$check_cl_date' WHERE id=$ledger_id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2" role="alert">
                                        Success
                                       </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                        Fail
                                       </div>';
                                    } */
                                }
            ?>
            <form method="POST">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="type" required>
                        <?php
                                if ($type == 0) {
                        ?>
                            <option value='0'><?php echo "Hall Rent" ?></option>
                        <?php
                                }
                                if ($type == 1) {
                        ?>
                            <option value='1'><?php echo "Security Deposit" ?></option>
                        <?php
                                }
                                if ($type == 2) {
                        ?>
                            <option value='2'><?php echo "Refund Security Deposit" ?></option>
                        <?php
                                }
                                if ($type == 3) {
                        ?>
                            <option value='3'><?php echo "Garbage" ?></option>
                        <?php
                                }
                                if ($type == 4) {
                        ?>
                            <option value='4'><?php echo "Miscellaneous" ?></option>
                        <?php
                                }
                                if ($type == 5) {
                        ?>
                            <option value='5'><?php echo "Payment Voucher" ?></option>
                        <?php
                                }
                        ?>
                        <!-- <option value="">------</option>
                        <option value="0">Hall Rent</option>
                        <option value="1">Security Deposit</option>
                        <option value="2">Refund Security Deposit</option>
                        <option value="3">Garbage</option>
                        <option value="4">Miscellaneous</option>
                        <option value="5">Payment Voucher</option> -->
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <?php
                                if ($status == 0) {
                        ?>
                            <option value='1'><?php echo "Clearance Pending" ?></option>
                        <?php
                                }
                                if ($status == 1) {
                        ?>
                            <option value='1'><?php echo "Cleared" ?></option>
                        <?php
                                }
                                if ($status == 2) {
                        ?>
                            <option value='2'><?php echo "Failed" ?></option>
                        <?php
                                }
                                if ($status == 3) {
                        ?>
                            <option value='3'><?php echo "Deleted" ?></option>
                        <?php
                                }


                        ?>
                        <!--   <option value="">------</option>
                        <option value="0">Clearance Pending</option>
                        <option value="1">Cleared</option>
                        <option value="2">Failed</option>
                        <option value="3">Deleted</option> -->

                    </select>
                </div>
                <div class="form-group">
                    <label>Trust</label>
                    <select class="form-control" name="trust_id" required>
                        <?php
                                $sql = "SELECT name,id from trust WHERE id=$trust_id";
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
                    <label>Mode (Jamaat Account)</label>
                    <select class="form-control" name="debit" required>
                        <?php
                                if ($debit == 0) {
                        ?>
                            <option value='0'><?php echo "Debit From" ?></option>
                        <?php
                                } else {
                        ?>
                            <option value='1'><?php echo "Credit in" ?></option>
                        <?php
                                }
                        ?>
                        <option value="" disabled>--MODE--</option>
                                <option value="0">Debit From</option>
                                <option value="1">Credit In</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label>Payment Mode</label>
                    <select class="form-control" name="pay_mode" required>
                        <?php
                                if ($pay_mode == 0) {
                        ?>
                            <option value='0'><?php echo "Cheque" ?></option>
                        <?php
                                } else {
                        ?>
                            <option value='1'><?php echo "Cash" ?></option>
                        <?php
                                }
                        ?>
                        <?php if ($pay_mode == 0 && $status == 0) {
                        ?>
                            <option value="" disabled>------</option>
                            <option value="mode_change">Cash</option>
                        <?php
                                }
                        ?>

                        <?php if ($type == 4) {
                        ?>
                            <option value="" disabled>------</option>
                            <option value="1">Cash</option>
                            <option value="0">Cheque</option>
                        <?php
                                }
                        ?>
                        <!-- <option value="">------</option>
                        <option value="1">Cash</option>
                        <option value="0">Cheque</option> -->
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input name="amt" value="<?php echo $amount ?>" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Cheque Number</label>
                    <input name="cn" value="<?php echo $check_number ?>" class="form-control" />
                </div>
                <?php
                                if ($type == 4) {
                                    $sql = "SELECT purpose from misc where ledger_id=$ledger_id AND trust_id=$trust_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $purpose = $row['purpose'];

                ?>
                    <div class="form-group">
                        <label>Purpose</label>
                        <textarea class="form-control" type="text" name="purpose" placeholder="Enter Purpose"><?php echo $purpose; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="<?php echo $name ?>" class="form-control" />
                    </div>
                <?php
                                }
                ?>


                <div class="form-group">
                    <label>Receiving Date</label>
                    <input type="text" placeholder="Receiving Date" value='<?php echo $start_date ?>' name="c_date" class="form-control datepicker">

                </div>
                <div class="form-group">
                    <label>Receiving Time</label>
                    <input name="time" value="<?php echo $time ?>" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Cheque Clearance Date</label>
                    <input name="check_cl" value="<?php echo $check_cl ?>" class="form-control datepicker" />
                </div>
                <button class="btn btn-primary" name="sub" value="<?php echo $ledger_id ?>">Submit</button>
            </form>

        </div>
    </div>

<?php
                            } else { ?>
    <div class="alert alert-info mt-2" role="alert">
        No Entry Found
    </div>
<?php  }
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