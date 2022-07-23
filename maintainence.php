<?php
session_start();

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintainence</title>
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

    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .razorpay-payment-button {
            color: #fff;
            background-color: #4e73df;
            border-radius: 3px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
    </style>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        $forms_access = $_SESSION['forms_access'];
        if (isset($_SESSION['access']) && (($_SESSION['role'] == "Super Admin") || in_array("36", $forms_access))) {
        ?>
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Maintainence</div>
                            </div>
                        </div>
                        <?php

                        echo '<div class="alert alert-info ml-2 mr-2 mt-2" role="alert">
Maintainence Date : ' . $_SESSION['exp_date'] . '
</div>';
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="card mb-4 mt-3">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">12 months Maintainence</h6>
                                    </div>
                                    <div class="card-body">
                                        <!--
                                        <form action="success_purchase_6.php" method="POST">

                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_live_B28lUNVqIcvKrf" // Enter the Key ID generated from the Dashboard data-amount="600000" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise data-currency="INR" data-buttontext="Pay Now (Rs.6,000)" data-name="Maintainence" data-description="6 months Maintainence of Jamaat Khaana Booking Software" data-theme.color="#F37254"></script><input type="hidden" custom="Hidden Element" name="hidden">
                                        </form>

        -->

                                        <form method="post" action="paytm/PaytmKit/pgRedirect.php">


                                            <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000, 99999999) ?>">
                                            <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">
                                            <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
                                            <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                                            <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="12000">
                                            <input value="Pay Now (Rs.12,000)" class="btn btn-primary" type="submit" onclick="">

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        <?php
        } else {
            echo '<div class="alert alert-danger ml-2 mr-2 mt-2" role="alert">
            <h5>You are not allowed to access this page. Ask Your Admin to Pay the Maintainence Charge to Continue..</h5>
           </div>';
        }
        ?>
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