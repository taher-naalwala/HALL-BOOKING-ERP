<?php
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
session_start();
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];

    if ($_GET['name'] == "All") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "43" || $formid == "42") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }


    if ($_GET['name'] == "Individual") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "41" || $formid == "42") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
} else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");

    die();
} else {
    header("Location: login.php");
    die();
}
$get_name = $_GET['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garbage Charge <?php echo $get_name;  ?></title>
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
                padding-bottom: 30px;
                height: 800px;
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
            $("#datepicker").datepicker();
        });
    </script>
    <?php
    require('search_name_css.php');
    ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        require('connectDB.php');
        date_default_timezone_set('Asia/kolkata');
        $current_date = date('Y-m-d');

        ?>

        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Garbage Charge <?php echo $get_name  ?></h6>
                </div>
                <div class="card-body">
                    <?php

                    if ($get_name == "All") {
                        $sql = "SELECT amount from garbage";
                        $run = $conn->query($sql);
                        $row = $run->fetch_assoc();
                        $amount = $row['amount'];

                    ?>
                        <form method="POST">
                            <div class="row">

                                <div class="col-lg-4">
                                    <input name="amount" placeholder="Enter Garbage Charge Per Thaal" class="form-control" value="<?php echo $amount ?>" required>
                                </div>
                                <div class="col-lg-3">
                                    <button name="sub" value="sub" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['sub'])) {
                                $amount = $_POST['amount'];

                                $sql = "UPDATE garbage SET amount='$amount' WHERE bk_id=0";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="alert alert-success mt-2" role="alert">
                                   Garbage Charge Updated
                                  </div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-2" role="alert">
                               Fail
                               </div>';
                                }
                            }

                            ?>
                        </form>
                    <?php
                    }
                    if ($get_name == "Individual") {
                        $sql = "SELECT amount from garbage WHERE bk_id=0";
                        $run = $conn->query($sql);
                        $row = $run->fetch_assoc();
                        $amount = $row['amount'];

                    ?>
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="search-box">

                                        <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Booking ID..." required />

                                        <div class="result"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <input name="amount" placeholder="Enter Garbage Charge Per Thaal" class="form-control" value="<?php echo $amount ?>" required>
                                </div>
                                <div class="col-lg-3">
                                    <button name="sub" value="sub" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['sub'])) {
                                $amount = $_POST['amount'];
                                $bk_id = $_POST['input'];
                                if (strpos($bk_id, '(') !== false) {
                                    $first_index = stripos($bk_id, "(") + 1;
                                    $s_id_e = substr($bk_id, $first_index);
                                    $bk_id = rtrim($s_id_e, ") ");
                                }

                                $s1 = "SELECT COUNT(*) as c from garbage WHERE bk_id=$bk_id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $c = $row1['c'];
                                if ($c > 0) {

                                    $sql = "UPDATE garbage SET amount='$amount' WHERE bk_id=$bk_id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2" role="alert">
                                   Success
                                  </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                               Fail
                               </div>';
                                    }
                                } else {
                                    $sql = "INSERT INTO garbage (`bk_id`, `amount`) VALUES($bk_id,'$amount')";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2" role="alert">
                                   Success
                                  </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                               Fail
                               </div>';
                                    }
                                }
                            }

                            ?>
                        </form>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-group" id="row' + i + '"><br>  <div> <label>Label</label> <input name="label_name[]" class="form-control" placeholder="Enter Label" required> <label>Start Time</label> <div class="row"> <div class="col-lg-4"> <input name="start_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="start_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="start_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div> <label>End Time</label> <div class="row"> <div class="col-lg-4"> <input name="end_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="end_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="end_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div><br><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        $(document).ready(function() {

            $('input[type=number][max]:not([max=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max').length;
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });

        });
    </script>
    <script>

    </script>

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