<?php
session_start();

$forms_access = $_SESSION['forms_access'];
$flag = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
    <title>Transaction Status</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <?php require('connectDB.php');
                    require_once("paytm/PaytmKit/lib/config_paytm.php");
                    require_once("paytm/PaytmKit/lib/encdec_paytm.php");


                    $paytmChecksum = "";
                    $paramList = array();
                    $isValidChecksum = "FALSE";

                    $paramList = $_POST;
                    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

                  

                    //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
                    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

                    if ($isValidChecksum == "TRUE") {
                        echo "<b>Following are the transaction details:</b>" . "<br/>";
                        if ($_POST["STATUS"] == "TXN_SUCCESS") {
                            $payment_id = $_POST["TXNID"];
                            $s1 = "SELECT * from web_login WHERE pay_id='$payment_id'";
                            $run1 = $conn->query($s1);
                            if ($run1->num_rows > 0) {

                    ?>
                                <img src="photos/tick.png" class="center" style="width: 15%;">
                                <br>
                                <div class="alert alert-success text-center" role="alert">
                                    <h3> Transaction Successful </h3>
                                </div>

                                <?php   } else {
                                $date = $_SESSION['exp_date'];
                                $effectiveDate = date('Y-m-d', strtotime("+12 months", strtotime($date)));
                                $_SESSION['exp_date'] = $effectiveDate;
                                $sql = "UPDATE web_login SET exp_date='$effectiveDate',pay_id='$payment_id'";
                                if (mysqli_query($conn, $sql)) {
                                ?>
                                    <img src="photos/tick.png" class="center" style="width: 15%;">
                                    <br>
                                    <div class="alert alert-success text-center" role="alert">
                                        <h3> Transaction Successful </h3>
                                    </div>


                    <?php   }
                            }
                        } else {
                            echo "<b>Transaction Failed</b>" . "<br/>";
                        }
                        if (isset($_POST) && count($_POST) > 0) {
                            foreach ($_POST as $paramName => $paramValue) {
                                echo "<br/>" . $paramName . " = " . $paramValue;
                            }
                        }
                    } else {
                        echo "<b>Checksum mismatched.</b>";
                        //Process transaction as suspicious.
                    }



                    ?>


                </div>
            </div>
        </div>
    </div>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>