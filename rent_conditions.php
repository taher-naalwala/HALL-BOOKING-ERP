<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "50" || $formid == "8") {
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
    <title>Rent Conditions</title>

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


    <style>
        @media (min-width: 768px) {
            .card {
                width: 50%;
            }
        }
    </style>





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
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
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
                    <h6 class="m-0 font-weight-bold text-primary">Rent Conditions</h6>
                </div>
                <div class="card-body">


                    <form method="POST">
                        <div class="container">
                            <div class="form-group">
                                <label>Jamaat Khana</label>
                                <select class="form-control" name="jk_id" required>
                                    <option value="">Select Jamaat Khaana</option>

                                    <?php require('connectDB.php');
                                    $sql = "SELECT id,name from jk_info";
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
                                <label>Criteria</label>
                                <select class="form-control" onchange="change_criteria_type()" id="criteria_type" name="criteria_type" required>

                                    <!--  <option value="1">DAY</option> -->
                                    <option value="2">DATES</option>


                                </select>

                            </div>
                            <div class="form-group">
                                <div id="criteria_result">
                                    <label>DATES</label> <input type="text" name="date" class="form-control date" id="datepicker" placeholder="Pick the Date"><label>Rent</label> <input name="criteria_rent" type="number" class="form-control" placeholder="Enter Criteria Rent" required>
                                    <script>
                                        $(document).ready(function() {
                                            $('#datepicker').datepicker({
                                                startDate: new Date(),
                                                multidate: true,
                                                format: "dd/mm/yyyy",
                                                daysOfWeekHighlighted: "5,6",
                                                datesDisabled: ['31/08/2017'],
                                                language: 'en'
                                            }).on('changeDate', function(e) {
                                                // `e` here contains the extra attributes
                                                $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
                                            });
                                        });
                                    </script>
                                    <!--
                                    <label>DAY</label> <select class="form-control" name="day" required>
                                        <option value="">--SELECT DAY--</option>
                                        <option value="MONDAY">MONDAY</option>
                                        <option value="TUESDAY">TUESDAY</option>
                                        <option value="WEDNESDAY">WEDNESDAY</option>
                                        <option value="THURSDAY">THURSDAY</option>
                                        <option value="FRIDAY">FRIDAY</option>
                                        <option value="SATURDAY">SATURDAY</option>
                                        <option value="SUNDAY">SUNDAY</option>
                                    </select> <label>Rent</label> <input name="criteria_rent" type="number" class="form-control" placeholder="Enter Criteria Rent" required>

                                -->

                                </div>

                            </div>






                            <br>



                            <button name="submit" type="submit" value="submit" class="btn btn-primary btn-block">Add</button>
                            <?php
                            if (isset($_POST['submit'])) {
                                $jk_id = $_POST['jk_id'];

                                $rent = $_POST['criteria_rent'];
                                $criteria_type = $_POST['criteria_type'];
                                if ($criteria_type == 1) {
                                    $day = $_POST['day'];
                                } else {
                                    $first = $_POST['date'];
                                }


                                if ($criteria_type == 1) {

                                    $sql = "INSERT INTO rent (`jk_id`, `day`, `amount`,`status`) VALUES($jk_id,'$day','$rent',0)";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
    Success
    </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
    Fail
    </div>';
                                    }
                                } else {
                                    $tags = explode(',', $first);

                                    foreach ($tags as $date) {


                                        list($f_d, $f_m, $f_y) = explode('/', $date);
                                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                        $date1 = str_replace(' ', '', $f_first0);
                                        $sql = "INSERT INTO rent (`jk_id`, `start_date`,`end_date`, `amount`,`status`) VALUES($jk_id,'$date1','$date1','$rent',0)";
                                        mysqli_query($conn, $sql);
                                    }
                                    echo '<div class="alert alert-success mt-2">
                                    Success
                                    </div>';
                                }
                            }

                            ?>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        function change_criteria_type() {
            var type = document.getElementById("criteria_type").value;
            if (type == 1) {
                document.getElementById("criteria_result").innerHTML = '<label>DAY</label> <select class="form-control" name="day" required> <option value="">--SELECT DAY--</option> <option value="MONDAY">MONDAY</option> <option value="TUESDAY">TUESDAY</option> <option value="WEDNESDAY">WEDNESDAY</option> <option value="THURSDAY">THURSDAY</option> <option value="FRIDAY">FRIDAY</option> <option value="SATURDAY">SATURDAY</option> <option value="SUNDAY">SUNDAY</option> </select> <label>Rent</label> <input name="criteria_rent" type="number" class="form-control" placeholder="Enter Criteria Rent" required> ';
            } else if (type == 0) {
                $('#criteria_result').empty();
            } else if (type == 2) {
                document.getElementById("criteria_result").innerHTML = '<label>DATES</label>  <input type="text" name="date" class="form-control date" id="datepicker" placeholder="Pick the Date"><label>Rent</label> <input name="criteria_rent" type="number" class="form-control" placeholder="Enter Criteria Rent" required> ';
                $(document).ready(function() {
                    $('#datepicker').datepicker({
                        startDate: new Date(),
                        multidate: true,
                        format: "dd/mm/yyyy",
                        daysOfWeekHighlighted: "5,6",
                        datesDisabled: ['31/08/2017'],
                        language: 'en'
                    }).on('changeDate', function(e) {
                        // `e` here contains the extra attributes
                        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
                    });
                });
            }
        }
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