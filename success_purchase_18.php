<?php
session_start();
if (isset($_SESSION['access'])) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
   
} else {
    header('Location:main.php');
    die();
}
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
    <title>Successful Transaction</title>
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
                    if (isset($_POST['razorpay_payment_id'])) {
                   
                        $payment_id=$_POST['razorpay_payment_id'];
                       
                        $s1="SELECT * from web_login WHERE pay_id='$payment_id'";
                        $run1=$conn->query($s1);
                        if($run1->num_rows>0)
                        { ?>
                         <img src="photos/tick.png" class="center" style="width: 15%;">
                    <br>
                    <div class="alert alert-success text-center" role="alert">
                        <h3> Transaction Successful </h3>
                    </div>

                     <?php   }
                        else
                        {
                        $date=$_SESSION['exp_date'];
                       $effectiveDate = date('Y-m-d', strtotime("+18 months", strtotime($date)));
                       $_SESSION['exp_date']=$effectiveDate;
                        $sql="UPDATE web_login SET exp_date='$effectiveDate',pay_id='$payment_id'";
                        if(mysqli_query($conn,$sql))
                        {
                        ?>
                          <img src="photos/tick.png" class="center" style="width: 15%;">
                    <br>
                    <div class="alert alert-success text-center" role="alert">
                        <h3> Transaction Successful </h3>
                    </div>
                   

                 <?php   }
                    }
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