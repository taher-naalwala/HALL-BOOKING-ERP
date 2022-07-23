<?php
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
session_start();
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];

    if ($_GET['name'] == "Access") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "32" || $formid == "31") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Rent") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "8" || $formid == "9") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Trust") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "12" || $formid == "13") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Jamaat Khana") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "2" || $formid == "1") {
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
    <style>
        @media (min-width: 768px) {
            .card {
                width: 50%;
            }
        }
    </style>


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
    <title>Add <?php echo $get_name;  ?></title>
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
            $("#datepicker").datepicker();
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
                    <h6 class="m-0 font-weight-bold text-primary">Add <?php echo $get_name  ?></h6>
                </div>
                <div class="card-body">

                    <?php
                    if ($get_name == "Jamaat Khana") {
                        require('connectDB.php');
                        if (isset($_POST['submit'])) {
                            $jk_name = $_POST['jk_name'];
                            $label_name = $_POST['label_name'];
                            $start_hour = $_POST['start_hour'];
                            $start_min = $_POST['start_min'];
                            $start_type = $_POST['start_type'];
                            $end_hour = $_POST['end_hour'];
                            $end_min = $_POST['end_min'];
                            $end_type = $_POST['end_type'];
                            $hall_type = $_POST['hall_type'];

                            $capacity = $_POST['capacity'];

                            $sql = "INSERT INTO jk_info ( `name`, `capacity`, `amount`, `combine`,`type`) VALUES('$jk_name','$capacity','',0,$hall_type)";
                            if (mysqli_query($conn, $sql)) {
                                foreach ($start_hour as $index => $s) {
                                    $start_time;

                                    if ($start_type[$index] == "AM" && $s != "12") {
                                        $start_time =  $s + ($start_min[$index] / 60);
                                    } else if ($start_type[$index] == "PM" && $s != "12") {

                                        $start_time =   $s + 12 + ($start_min[$index] / 60);
                                    } else if ($start_type[$index] == "PM" && $s == "12") {
                                        $start_time =   $s + ($start_min[$index] / 60);
                                    } else if ($start_type[$index] == "AM" && $s == "12") {
                                        $start_time =   $s - 12 + ($start_min[$index] / 60);
                                    }
                                    $end_time;
                                    if ($end_type[$index] == "AM" && $end_hour[$index] != "12") {
                                        $end_time =   $end_hour[$index]  + ($end_min[$index] / 60);
                                    } else if ($end_type[$index] == "PM" && $end_hour[$index]  != "12") {

                                        $end_time =   $end_hour[$index]  + 12 + ($end_min[$index] / 60);
                                    } else if ($end_type[$index] == "PM" && $end_hour[$index]  == "12") {
                                        $end_time =   $end_hour[$index]  + ($end_min[$index] / 60);
                                    } else if ($end_type[$index] == "AM" && $end_hour[$index]  == "12") {
                                        $end_time =   $end_hour[$index]  - 12 + ($end_min[$index] / 60);
                                    }


                                    $label = strtoupper($label_name[$index]);
                                    $s1 = "SELECT id from jk_info WHERE name='$jk_name' AND capacity='$capacity' and type=$hall_type ";
                                    $run1 = $conn->query($s1);
                                    $row1 = $run1->fetch_assoc();
                                    $jk_id = $row1['id'];
                                    $s2E = "INSERT INTO timings ( `jk_id`, `label`, `start_time`, `end_time`) VALUES($jk_id,'$label','$start_time','$end_time')";
                                    mysqli_query($conn, $s2E);
                                }


                                echo '<div class="alert alert-success mt-2">
                                        Success
                                        </div>';
                            } else {
                                echo '<div class="alert alert-danger mt-2">
                                        Fail
                                        </div>';
                            }
                        } ?>

                        <form method="POST">
                            <div class="container">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="hall_type" required>
                                        <option value="">--SELECT TYPE--</option>
                                        <option value="0">Jamaat Khana</option>
                                        <option value="1">Room</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="jk_name" class="form-control" placeholder="Enter Name" required>
                                </div>

                                <div class="form-group">
                                    <label>Capacity</label>
                                    <input name="capacity" type="number" class="form-control" placeholder="Enter Capacity" required>
                                </div>
                                <div class="form-group" id="dynamic_field">
                                    <label>Timings</label>

                                    <br>
                                    <div>
                                        <label>Label</label>
                                        <input name="label_name[]" class="form-control" placeholder="Enter Label" required>

                                        <label>Start Time</label>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input name="start_hour[]" class="form-control" placeholder="Hour" required>


                                            </div>
                                            <div class="col-lg-4">
                                                <input name="start_min[]" class="form-control" placeholder="Minutes" required>

                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control" name="start_type[]">
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>

                                        <label>End Time</label>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input name="end_hour[]" class="form-control" placeholder="Hour" required>


                                            </div>
                                            <div class="col-lg-4">
                                                <input name="end_min[]" class="form-control" placeholder="Minutes" required>

                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control" name="end_type[]">
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <form name="add_name" id="add_name">
                                        <br> <button name="add" id="add" class="btn btn-success">Add More</button>
                                    </form>
                                </div>


                                <br>
                                <button name="submit" type="submit" value="submit" class="btn btn-primary btn-block">Submit</button>


                            
                            </div>
                        </form>
                    <?php
                    }
                    if ($get_name == "Rent") { ?>

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

                                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                                <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
                                <div class="form-group">
                                    <label>DATERANGE</label>
                                    <input type="text" class="form-control" name="daterange" />
                                    <script>
                                        $(function() {
                                            $('input[name="daterange"]').daterangepicker({
                                                opens: 'left',

                                            }, function(start, end, label) {
                                                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Rent</label>
                                    <input name="rent" type="number" class="form-control" placeholder="Enter Rent" required>
                                </div>





                                <button name="submit" type="submit" value="submit" class="btn btn-primary btn-block">Add</button>
                                <?php require('connectDB.php');
                                if (isset($_POST['submit'])) {
                                    $jk_id = $_POST['jk_id'];
                                    $range = $_POST['daterange'];
                                    list($first, $second) = explode('-', $range);

                                    list($f_m, $f_d, $f_y) = explode('/', $first);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                    $f_first = str_replace(' ', '', $f_first0);

                                    list($s_m, $s_d, $s_y) = explode('/', $second);
                                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                                    $f_second = str_replace(' ', '', $f_second0);
                                    $rent = $_POST['rent'];


                                    $sql = "INSERT INTO rent (`jk_id`, `start_date`,`end_date`, `amount`,`type`) VALUES($jk_id,'$f_first','$f_second','$rent',2)";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
Success
</div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
Fail
</div>';
                                    }
                                }

                                ?>
                            </div>
                        </form>
                    <?php
                    }


                    if ($get_name == "Access") { ?>

                        <form method="POST">
                            <div class="form-group">
                                <select name="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="User">User</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <select name="powers[]" class="mdb-select md-form form-control" multiple required>
                                    <option value="" disabled selected>Choose Powers</option>
                                    <?php require('connectDB.php');
                                    $sql = "SELECT name,id from form ";
                                    $run = $conn->query($sql);
                                    while ($row = $run->fetch_assoc()) {
                                        $name = $row['name'];
                                        $id = $row['id'];
                                    ?>
                                        <option value='<?php echo $id  ?>'><?php echo $name ?></option>


                                    <?php   }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" max="99999999" placeholder="Enter ITS" name="its" required>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Password" name="pass" required>

                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" max="9999999999" placeholder="Enter Mobile" name="mobile" required>

                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Email" name="email" required>

                            </div>
                            <button name="addaccess" value="Add" class="btn btn-primary btn-block">Add</button>
                            <?php require('connectDB.php');

                            if (isset($_POST['addaccess'])) {
                                $powers = $_POST['powers'];
                                $name = $_POST['name'];
                                $its = $_POST['its'];
                                $pass = $_POST['pass'];
                                $role = $_POST['role'];
                                $email = $_POST['email'];
                                $mobile = $_POST['mobile'];
                                $sql = "SELECT COUNT(*) as c from web_login WHERE its='$its'";
                                $run = $conn->query($sql);
                                $row_c = $run->fetch_assoc();
                                $c = $row_c['c'];
                                if ($c > 0) {
                                    echo '<div class="alert alert-danger mt-2">
Account Already Exists
</div>';
                                } else {
                                    $a_id = $_SESSION['varname'];
                                    $s0 = "SELECT exp_date,pay_id FROM web_login WHERE id=$a_id";
                                    $run0 = $conn->query($s0);
                                    $row0 = $run0->fetch_assoc();
                                    $exp_date = $row0['exp_date'];
                                    $pay_id = $row0['pay_id'];
                                    $s1 = "INSERT INTO web_login ( `its`, `password`, `name`, `mobile`, `role`, `email`, `exp_date`, `pay_id`) VALUES('$its','$pass','$name','$mobile','$role','$email','$exp_date','$pay_id')";
                                    if (mysqli_query($conn, $s1)) {
                                        $s2 = "SELECT id from web_login WHERE its='$its'";
                                        $run1 = $conn->query($s2);
                                        $row = $run1->fetch_assoc();
                                        $id = $row['id'];
                                        $f = 0;
                                        $flag == 0;
                                        if (count($powers) == 0) {
                                        } else {
                                            foreach ($powers as $formid) {
                                                $s3 = "INSERT INTO access_web_login (`adminid`, `formid`) VALUES($id,$formid)";
                                                if (mysqli_query($conn, $s3)) {
                                                    $flag = 1;
                                                } else {
                                                    $flag = 0;
                                                }
                                            }
                                            if ($flag == 1) {
                                                echo '<div class="alert alert-success mt-2">
    Access Granted
    </div>';
                                            } else {
                                                echo '<div class="alert alert-danger mt-2">
    Fail
    </div>';
                                            }
                                        }
                                    }
                                }
                            }

                            ?>
                        </form>

                    <?php   }
                    if ($get_name == "Trust") {
                    ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-6">

                                    <input name="trust_name" class="form-control" placeholder="Enter Trust Name">
                                </div>
                                <div class="col-lg-6">
                                    <button name="submit" class="btn btn-primary" value="submit">Add</button>
                                </div>
                                <?php require('connectDB.php');
                                if (isset($_POST['submit'])) {
                                    $trust_name = $_POST['trust_name'];
                                    $sql = "INSERT INTO trust ( `name`) VALUES('$trust_name')";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
        Trust Added
        </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
        Fail
        </div>';
                                    }
                                }
                                ?>
                        </form>
                    <?php }
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


        function change_criteria_type() {
            var type = document.getElementById("criteria_type").value;
            if (type == 1) {
                document.getElementById("criteria_result").innerHTML = '<label>DAY</label> <select class="form-control" name="day" required> <option value="">--SELECT DAY--</option> <option value="MONDAY">MONDAY</option> <option value="TUESDAY">TUESDAY</option> <option value="WEDNESDAY">WEDNESDAY</option> <option value="THURSDAY">THURSDAY</option> <option value="FRIDAY">FRIDAY</option> <option value="SATURDAY">SATURDAY</option> <option value="SUNDAY">SUNDAY</option> </select> <label>Rent</label> <input name="criteria_rent" type="number" class="form-control" placeholder="Enter Criteria Rent" required> ';
            } else if (type == 0) {
                $('#criteria_result').empty();
            } else if ($type == 2) {

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