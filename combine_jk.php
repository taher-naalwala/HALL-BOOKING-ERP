<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "3" || $formid == "1") {
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
    <style>
        @media (min-width: 768px) {
            .card {
                width: 50%;
            }
        }
    </style>




    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combine Jamaat Khaana</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }
    </style>
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
                removeItemButton: true,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });


        });
    </script>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>

        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Combine Jamaat Khaana</h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">
                            <div class="col-lg-6">


                                <select name="type" class="form-control">
                                    <option value="1">Add to Previous Combined JamaatKhana</option>
                                    <option value="2">Create New Combined JamaatKhana</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <button name="btn" value="sub" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET['type'])) {
                        if ($_GET['type'] == "2") {



                    ?>
                            <br>
                            <form method="POST">

                                <div class="form-group">
                                    <label>Jamaat Khana</label>
                                    <select class="choices-multiple-remove-button" name="jk_id[]" placeHolder="Select Multiple JamaatKhana" required multiple>

                                        <?php require('connectDB.php');
                                        $sql = "SELECT id,name from jk_info WHERE combine=0";
                                        $run = $conn->query($sql);
                                        if ($run->num_rows > 0) {
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                        ?>
                                                <option value='<?php echo $id ?>'><?php echo $name ?></option>
                                        <?php }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="jk_name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="capacity" placeholder="Enter Capacity (Thaals)" required>
                                </div>
                                <button class="btn btn-primary btn-block" name="sub" value="sub">Submit</button>
                                <?php require('connectDB.php');

                                if (isset($_POST['sub'])) {
                                    $jk_name = $_POST['jk_name'];
                                    $capacity = $_POST['capacity'];
                                    $m_jk_id = $_POST['jk_id'];
                                    $sql = "INSERT INTO jk_info ( `name`, `capacity`, `amount`, `combine`) VALUES('','$jk_name','$capacity','',1)";
                                    if (mysqli_query($conn, $sql)) {
                                        $s3 = "SELECT id from jk_info WHERE name='$jk_name' AND capacity='$capacity' ";
                                        $run3 = $conn->query($s3);
                                        $row3 = $run3->fetch_assoc();
                                        $jk_id = $row3['id'];
                                        $o_jk_id = $m_jk_id[0];
                                        $s1 = "SELECT label,start_time,end_time FROM timings WHERE jk_id=$o_jk_id";
                                        $run1 = $conn->query($s1);
                                        if ($run1->num_rows > 0) {
                                            while ($row1 = $run1->fetch_assoc()) {
                                                $label = $row1['label'];
                                                $start_time = $row1['start_time'];
                                                $end_time = $row1['end_time'];
                                                $s2 = "INSERT INTO timings ( `jk_id`, `label`, `start_time`, `end_time`) VALUES($jk_id,'$label','$start_time','$end_time')";
                                                mysqli_query($conn, $s2);
                                            }

                                            foreach ($m_jk_id as $j) {
                                                $s4 = "INSERT INTO combine_jk (`o_jk_id`, `c_jk_id`) VALUES($j,$jk_id)";
                                                mysqli_query($conn, $s4);
                                            }

                                            foreach ($m_jk_id as $j) {
                                                $s4 = "INSERT INTO combine_jk (`o_jk_id`, `c_jk_id`) VALUES($jk_id,$j)";
                                                mysqli_query($conn, $s4);
                                            }

                                            echo '<div class="alert alert-success mt-2">
                                    Success
                                    </div>';
                                        }
                                    }
                                }

                                ?>
                            </form>
                        <?php
                        } else {
                        ?>

                            <br>
                            <form method="POST">

                                <div class="form-group">
                                    <label> Jamaat Khana</label>
                                    <select class="form-control" name="o_jk_id" placeHolder="Select JamaatKhana" required>

                                        <?php require('connectDB.php');
                                        $sql = "SELECT id,name from jk_info WHERE combine=0";
                                        $run = $conn->query($sql);
                                        if ($run->num_rows > 0) {
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                        ?>
                                                <option value='<?php echo $id ?>'><?php echo $name ?></option>
                                        <?php }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Combined To</label>
                                    <select class="form-control" name="c_jk_id" placeHolder="Select JamaatKhana" required>

                                        <?php require('connectDB.php');
                                        $sql = "SELECT id,name from jk_info WHERE combine=1";
                                        $run = $conn->query($sql);
                                        if ($run->num_rows > 0) {
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                        ?>
                                                <option value='<?php echo $id ?>'><?php echo $name ?></option>
                                        <?php }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <button class="btn btn-primary" name="submit" value="submit">Submit</button>
                                <?php
                                if (isset($_POST['submit'])) {
                                    $o_jk_id = $_POST['o_jk_id'];
                                    $c_jk_id = $_POST['c_jk_id'];
                                    $sql = "INSERT INTO combine_jk (`o_jk_id`, `c_jk_id`) VALUES ($o_jk_id,$c_jk_id)";
                                    if (mysqli_query($conn, $sql)) {
                                        $s1 = "INSERT INTO combine_jk (`o_jk_id`, `c_jk_id`) VALUES ($c_jk_id,$o_jk_id)";
                                        if (mysqli_query($conn, $s1)) {
                                            echo '<div class="alert alert-success mt-2">
                                    Success
                                    </div>';
                                        }
                                    }
                                }
                                ?>
                            </form>
                    <?php

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