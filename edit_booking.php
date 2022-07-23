<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];


    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "18" || $formid == "16") {
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
$get_name = "Booking";
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
    <title>Edit <?php echo $get_name;  ?></title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }
    </style>
    <?php
    require('search_name_css.php');
    ?>
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit <?php echo $get_name  ?></h6>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">

                            <div class="col-lg-3">


                                <select name="type" class="form-control" onChange="change_type()" id="type" required>
                                    <!--   <option>Select Report By</option>
                                       <option value="6">Jamaat Khaana</option>
                                    <option value="1">ITS</option> -->
                                    <option value="7">Booking ID</option>
                                    <!--  <option value="2">Name</option>
                                    <option value="3">Mobile</option>
                                    <option value="4">Payment Pending</option> -->

                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="search-box">

                                    <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." />

                                    <div class="result"></div>
                                </div>
                            </div>


                        </div>
                        <div class="row mt-4">

                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="its" checked>
                                <label class="form-check-label" for="its">ITS</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="name" checked>
                                <label class="form-check-label" for="name">Name</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="mobile" name="checkbox[]" value="mobile">
                                <label class="form-check-label" for="mobile">Mobile</label>
                            </div>

                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="date" name="checkbox[]" value="date" checked>
                                <label class="form-check-label" for="date">Booking Date</label>
                            </div>

                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="laagat" name="checkbox[]" value="laagat">
                                <label class="form-check-label" for="laagat">Laagat</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="thaals" name="checkbox[]" value="thaals">
                                <label class="form-check-label" for="thaals">Thaals</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="purpose" name="checkbox[]" value="purpose">
                                <label class="form-check-label" for="purpose">Purpose</label>
                            </div>
                           

                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="formid" name="checkbox[]" value="formid">
                                <label class="form-check-label" for="formid">Form ID</label>
                            </div>
                           
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="status" name="checkbox[]" value="status" checked>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                        </div>
                        <button name="submit" class="btn btn-primary ml-2 mt-2" value="submit">Submit</button>

                </div>

                </form>

                <?php require('connectDB.php');
                if (isset($_GET['its']) && $_GET['type'] == "1") {
                    $its = $_GET['its'];
                    $checkbox = $_GET['checkbox'];

                    $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage,status from booking_info WHERE its='$its'";
                    $run = $conn->query($sql);


                ?>


                    <div class="row ml-2 mr-2">
                        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
                        <div class=" card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                    <thead>
                                        <tr>
                                            <?php
                                            foreach ($checkbox as $col) {
                                                echo "<th>";

                                                if ($col == "its") {
                                                    echo "ITS";
                                                }
                                                if ($col == "name") {
                                                    echo "Name";
                                                }
                                                if ($col == "mobile") {
                                                    echo "Mobile";
                                                }
                                                if ($col == "jk") {
                                                    echo "Jamaat Khaana";
                                                }
                                                if ($col == "date") {
                                                    echo "Booking Date";
                                                }
                                                if ($col == "timing") {
                                                    echo "Timing";
                                                }
                                                if ($col == "start_time") {
                                                    echo "Start Time";
                                                }
                                                if ($col == "end_time") {
                                                    echo "End Time";
                                                }
                                                if ($col == "capacity") {
                                                    echo "Capacity";
                                                }
                                                if ($col == "rent") {
                                                    echo "Rent";
                                                }
                                                if ($col == "rentp") {
                                                    echo "Rent Paid";
                                                }
                                                if ($col == "rentc") {
                                                    echo "Rent Cleared";
                                                }
                                                if ($col == "admin") {
                                                    echo "Admin";
                                                }
                                                if ($col == "laagat") {
                                                    echo "Laagat";
                                                }
                                                if ($col == "thaals") {
                                                    echo "Thaals";
                                                }
                                                if ($col == "purpose") {
                                                    echo "Purpose";
                                                }
                                                if ($col == "scd") {
                                                    echo "Security Deposit";
                                                }
                                                if ($col == "m") {
                                                    echo "Manager Status";
                                                }
                                                if ($col == "rs") {
                                                    echo "Refund Status";
                                                }
                                                if ($col == "bks") {
                                                    echo "Booking Status";
                                                }
                                                if ($col == "formid") {
                                                    echo "Form ID";
                                                }
                                                if ($col == "garbage") {
                                                    echo "Garbage Charge";
                                                }
                                                if ($col == "status") {
                                                    echo "Status";
                                                }

                                                echo "</th>";
                                            }


                                            ?>
                                            <th>EDIT</th>
                                            <!--      <th>ID</th>
                                                <th>ITS</th>
                                                <th>Name</th>
                                                <th>Mobile</th>

                                                <th>Jamaat Khana</th>
                                                <th>Date</th>
                                                <th>Label</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Capacity</th>
                                                <th>Rent</th>
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($row = $run->fetch_assoc()) {
                                            $id = $row['id'];

                                            foreach ($checkbox as $col) {

                                                if ($col == "its") {
                                                    $its = $row['its'];
                                                }
                                                if ($col == "name") {
                                                    $name = $row['name'];
                                                }
                                                if ($col == "mobile") {
                                                    $mobile = $row['mobile'];
                                                }

                                                if ($col == "date") {
                                                    $date = $row['date'];
                                                }





                                                if ($col == "laagat") {
                                                    $laagat = $row['laagat'];
                                                }
                                                if ($col == "thaals") {
                                                    $thaals = $row['thaals'];
                                                }
                                                if ($col == "purpose") {
                                                    $purpose = $row['purpose'];
                                                }
                                                if ($col == "scd") {
                                                    $scd = $row['sc_deposit'];
                                                }

                                                if ($col == "formid") {
                                                    $formid = $row['formid'];
                                                }
                                                if ($col == "garbage") {
                                                    $garbage = $row['garbage'];
                                                }
                                                if ($col == "status") {
                                                    $status = $row['status'];
                                                }
                                            }









                                        ?>
                                            <tr>
                                                <form method="POST">

                                                    <?php

                                                    foreach ($checkbox as $col) {
                                                        echo "<td>";

                                                        if ($col == "its") {
                                                            echo "<input name='its' value='$its' class='form-control' >";
                                                        }
                                                        if ($col == "name") {
                                                            echo "<input name='name' value='$name' class='form-control' >";
                                                        }
                                                        if ($col == "mobile") {
                                                            echo "<input name='mobile' value='$mobile' class='form-control' >";
                                                        }

                                                        if ($col == "date") {
                                                            list($y, $m, $d) = explode('-', $date);
                                                            $f_first0 = $m . "/" . $d . "/" . $y;
                                                            $final = str_replace(' ', '', $f_first0);

                                                            echo   "<input type='text'  value='$final' name='date' class='form-control datepicker'>";
                                                        }

                                                        if ($col == "laagat") {
                                                            echo "<input name='laagat' value='$laagat' class='form-control' >";
                                                        }
                                                        if ($col == "thaals") {
                                                            echo "<input name='thaals' value='$thaals' class='form-control' >";
                                                        }
                                                        if ($col == "purpose") {
                                                            echo "<input name='purpose' value='$purpose' class='form-control' >";
                                                        }
                                                        if ($col == "scd") {
                                                            echo "<input name='scd' value='$scd' class='form-control' >";
                                                        }

                                                        if ($col == "formid") {
                                                            echo "<input name='formid' value='$formid' class='form-control' >";
                                                        }
                                                        if ($col == "garbage") {
                                                            echo "<input name='garbage' value='$garbage' class='form-control' >";
                                                        }
                                                        if ($col == "status") {
                                                    ?>
                                                            <select class="form-control" name="status" required>
                                                                <?php

                                                                if ($status == 1) {
                                                                ?>
                                                                    <option value='1'><?php echo "Payment Pending" ?></option>
                                                                <?php
                                                                }
                                                                if ($status == 2) {
                                                                ?>
                                                                    <option value='2'><?php echo "Clearance Pending" ?></option>
                                                                <?php
                                                                }
                                                                if ($status == 3) {
                                                                ?>
                                                                    <option value='3'><?php echo "Booked" ?></option>
                                                                <?php
                                                                }
                                                                if ($status == 4) {
                                                                ?>
                                                                    <option value='4'><?php echo "Cancelled" ?></option>
                                                                <?php
                                                                }
                                                                if ($status == 5) {
                                                                ?>
                                                                    <option value='5'><?php echo "Deleted" ?></option>
                                                                <?php
                                                                }


                                                                ?>


                                                                <option value="1">Payment Pending</option>
                                                                <option value="2">Clearance Pending</option>
                                                                <option value="3">Booked</option>
                                                                <option value="4">Cancelled</option>
                                                                <option value="5">Deleted</option>

                                                            </select>
                                                    <?php
                                                        }

                                                        echo "</td>";
                                                    }


                                                    ?>
                                                    <td><button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>EDIT</button></td>
                                                    <?php
                                                    $l = "submit" . $id;
                                                    if (isset($_POST[$l])) {
                                                        $id;
                                                        $checkbox = $_GET['checkbox'];
                                                        foreach ($checkbox as $col) {
                                                            if ($col == "its") {
                                                                $its = $_POST['its'];
                                                                $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "name") {
                                                                $name = $_POST['name'];
                                                                $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "mobile") {
                                                                $mobile = $_POST['mobile'];
                                                                $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "date") {
                                                                $first = $_POST['date'];
                                                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                                                $date = str_replace(' ', '', $f_first0);

                                                                $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "laagat") {
                                                                $laagat = $_POST['laagat'];
                                                                $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "thaals") {
                                                                $thaals = $_POST['thaals'];
                                                                $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "purpose") {
                                                                $purpose = $_POST['purpose'];
                                                                $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "scd") {
                                                                $scd = $_POST['scd'];
                                                                $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "formid") {
                                                                $formid = $_POST['formid'];
                                                                $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                            if ($col == "garbage") {
                                                                $garbage = $_POST['garbage'];
                                                                $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                                                mysqli_query($conn, $sql);
                                                            }
                                                        }
                                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                                        echo "<script>window.location='$actual_link'</script>";
                                                    }

                                                    ?>

                                                </form>
                                            </tr>
                                        <?php     }

                                        ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>


            </div>
        </div>
    </div>
<?php
                }
                if (isset($_GET['name']) && $_GET['type'] == "2") {
                    $name = $_GET['name'];
                    $checkbox = $_GET['checkbox'];

                    $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE name LIKE '%$name%'";
                    $run = $conn->query($sql);


?>

    <div class="row ml-2">
        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <?php
                            foreach ($checkbox as $col) {
                                echo "<th>";

                                if ($col == "its") {
                                    echo "ITS";
                                }
                                if ($col == "name") {
                                    echo "Name";
                                }
                                if ($col == "mobile") {
                                    echo "Mobile";
                                }

                                if ($col == "date") {
                                    echo "Booking Date";
                                }

                                if ($col == "laagat") {
                                    echo "Laagat";
                                }
                                if ($col == "thaals") {
                                    echo "Thaals";
                                }
                                if ($col == "purpose") {
                                    echo "Purpose";
                                }
                                if ($col == "scd") {
                                    echo "Security Deposit";
                                }

                                if ($col == "formid") {
                                    echo "Form ID";
                                }
                                if ($col == "garbage") {
                                    echo "Garbage Charge";
                                }

                                echo "</th>";
                            }

                            ?>
                            <th>EDIT</th>
                            <!--      <th>ID</th>
                                                <th>ITS</th>
                                                <th>Name</th>
                                                <th>Mobile</th>

                                                <th>Jamaat Khana</th>
                                                <th>Date</th>
                                                <th>Label</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Capacity</th>
                                                <th>Rent</th>
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {

                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }

                                if ($col == "date") {
                                    $date = $row['date'];
                                }

                                if ($col == "laagat") {
                                    $laagat = $row['laagat'];
                                }
                                if ($col == "thaals") {
                                    $thaals = $row['thaals'];
                                }
                                if ($col == "purpose") {
                                    $purpose = $row['purpose'];
                                }
                                if ($col == "scd") {
                                    $scd = $row['sc_deposit'];
                                }

                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                            }








                        ?>
                            <tr>
                                <form method="POST">
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";

                                        if ($col == "its") {
                                            echo "<input name='its' value='$its' class='form-control' >";
                                        }
                                        if ($col == "name") {
                                            echo "<input name='name' value='$name' class='form-control' >";
                                        }
                                        if ($col == "mobile") {
                                            echo "<input name='mobile' value='$mobile' class='form-control' >";
                                        }

                                        if ($col == "date") {
                                            list($y, $m, $d) = explode('-', $date);
                                            $f_first0 = $m . "/" . $d . "/" . $y;
                                            $final = str_replace(' ', '', $f_first0);

                                            echo   "<input type='text'  value='$final' name='date' class='form-control datepicker' >";
                                        }

                                        if ($col == "laagat") {
                                            echo "<input name='laagat' value='$laagat' class='form-control' >";
                                        }
                                        if ($col == "thaals") {
                                            echo "<input name='thaals' value='$thaals' class='form-control' >";
                                        }
                                        if ($col == "purpose") {
                                            echo "<input name='purpose' value='$purpose' class='form-control' >";
                                        }
                                        if ($col == "scd") {
                                            echo "<input name='scd' value='$scd' class='form-control' >";
                                        }

                                        if ($col == "formid") {
                                            echo "<input name='formid' value='$formid' class='form-control' >";
                                        }
                                        if ($col == "garbage") {
                                            echo "<input name='garbage' value='$garbage' class='form-control' >";
                                        }

                                        echo "</td>";
                                    }


                                    ?>
                                    <td><button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>EDIT</button></td>
                                    <?php
                                    $l = "submit" . $id;
                                    if (isset($_POST[$l])) {
                                        $id;
                                        $checkbox = $_GET['checkbox'];
                                        foreach ($checkbox as $col) {
                                            if ($col == "its") {
                                                $its = $_POST['its'];
                                                $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "name") {
                                                $name = $_POST['name'];
                                                $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "mobile") {
                                                $mobile = $_POST['mobile'];
                                                $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "date") {
                                                $first = $_POST['date'];
                                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                                $date = str_replace(' ', '', $f_first0);

                                                $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "laagat") {
                                                $laagat = $_POST['laagat'];
                                                $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "thaals") {
                                                $thaals = $_POST['thaals'];
                                                $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "purpose") {
                                                $purpose = $_POST['purpose'];
                                                $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "scd") {
                                                $scd = $_POST['scd'];
                                                $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "formid") {
                                                $formid = $_POST['formid'];
                                                $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "garbage") {
                                                $garbage = $_POST['garbage'];
                                                $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                        }
                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo "<script>window.location='$actual_link'</script>";
                                    }

                                    ?>

                                </form>

                            </tr>
                        <?php     }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>
    </div>
<?php
                }
                if (isset($_GET['mobile']) && $_GET['type'] == "3") {
                    $mobile = $_GET['mobile'];
                    $checkbox = $_GET['checkbox'];

                    $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE mobile='$mobile'";
                    $run = $conn->query($sql);

?>

    <div class="row ml-2 mr-2">
        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <?php
                            foreach ($checkbox as $col) {
                                echo "<th>";

                                if ($col == "its") {
                                    echo "ITS";
                                }
                                if ($col == "name") {
                                    echo "Name";
                                }
                                if ($col == "mobile") {
                                    echo "Mobile";
                                }

                                if ($col == "date") {
                                    echo "Booking Date";
                                }

                                if ($col == "laagat") {
                                    echo "Laagat";
                                }
                                if ($col == "thaals") {
                                    echo "Thaals";
                                }
                                if ($col == "purpose") {
                                    echo "Purpose";
                                }
                                if ($col == "scd") {
                                    echo "Security Deposit";
                                }

                                if ($col == "formid") {
                                    echo "Form ID";
                                }
                                if ($col == "garbage") {
                                    echo "Garbage Charge";
                                }

                                echo "</th>";
                            }

                            ?>
                            <th>EDIT</th>
                            <!--      <th>ID</th>
                                                <th>ITS</th>
                                                <th>Name</th>
                                                <th>Mobile</th>

                                                <th>Jamaat Khana</th>
                                                <th>Date</th>
                                                <th>Label</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Capacity</th>
                                                <th>Rent</th>
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {

                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }

                                if ($col == "date") {
                                    $date = $row['date'];
                                }

                                if ($col == "laagat") {
                                    $laagat = $row['laagat'];
                                }
                                if ($col == "thaals") {
                                    $thaals = $row['thaals'];
                                }
                                if ($col == "purpose") {
                                    $purpose = $row['purpose'];
                                }
                                if ($col == "scd") {
                                    $scd = $row['sc_deposit'];
                                }

                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                            }








                        ?>
                            <tr>
                                <form method="POST">
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";

                                        if ($col == "its") {
                                            echo "<input name='its' value='$its' class='form-control' >";
                                        }
                                        if ($col == "name") {
                                            echo "<input name='name' value='$name' class='form-control' >";
                                        }
                                        if ($col == "mobile") {
                                            echo "<input name='mobile' value='$mobile' class='form-control' >";
                                        }

                                        if ($col == "date") {
                                            list($y, $m, $d) = explode('-', $date);
                                            $f_first0 = $m . "/" . $d . "/" . $y;
                                            $final = str_replace(' ', '', $f_first0);

                                            echo   "<input type='text'  value='$final' name='date' class='form-control datepicker'>";
                                        }

                                        if ($col == "laagat") {
                                            echo "<input name='laagat' value='$laagat' class='form-control' >";
                                        }
                                        if ($col == "thaals") {
                                            echo "<input name='thaals' value='$thaals' class='form-control' >";
                                        }
                                        if ($col == "purpose") {
                                            echo "<input name='purpose' value='$purpose' class='form-control' >";
                                        }
                                        if ($col == "scd") {
                                            echo "<input name='scd' value='$scd' class='form-control' >";
                                        }

                                        if ($col == "formid") {
                                            echo "<input name='formid' value='$formid' class='form-control' >";
                                        }

                                        if ($col == "garbage") {
                                            echo "<input name='garbage' value='$garbage' class='form-control' >";
                                        }

                                        echo "</td>";
                                    }


                                    ?>
                                    <td><button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>EDIT</button></td>
                                    <?php
                                    $l = "submit" . $id;
                                    if (isset($_POST[$l])) {
                                        $id;
                                        $checkbox = $_GET['checkbox'];
                                        foreach ($checkbox as $col) {
                                            if ($col == "its") {
                                                $its = $_POST['its'];
                                                $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "name") {
                                                $name = $_POST['name'];
                                                $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "mobile") {
                                                $mobile = $_POST['mobile'];
                                                $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "date") {
                                                $first = $_POST['date'];
                                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                                $date = str_replace(' ', '', $f_first0);

                                                $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "laagat") {
                                                $laagat = $_POST['laagat'];
                                                $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "thaals") {
                                                $thaals = $_POST['thaals'];
                                                $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "purpose") {
                                                $purpose = $_POST['purpose'];
                                                $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "scd") {
                                                $scd = $_POST['scd'];
                                                $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "formid") {
                                                $formid = $_POST['formid'];
                                                $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "garbage") {
                                                $garbage = $_POST['garbage'];
                                                $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                        }
                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo "<script>window.location='$actual_link'</script>";
                                    }

                                    ?>

                                </form>


                            </tr>
                        <?php     }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>
    </div>
<?php
                }
                if (isset($_GET['option_pp']) && $_GET['type'] == "4") {
                    $pp = $_GET['option_pp'];
                    $checkbox = $_GET['checkbox'];
                    if ($pp == "0") {
                        $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=1";
                    } else {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);
                        $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=1 AND (date>='$f_first' AND date<='$f_second')";
                    }
                    $run = $conn->query($sql);


?>

    <div class="row ml-2 mr-2">
        <div class="card ml-2 mb-4"">
                                <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <?php
                            foreach ($checkbox as $col) {
                                echo "<th>";

                                if ($col == "its") {
                                    echo "ITS";
                                }
                                if ($col == "name") {
                                    echo "Name";
                                }
                                if ($col == "mobile") {
                                    echo "Mobile";
                                }

                                if ($col == "date") {
                                    echo "Booking Date";
                                }

                                if ($col == "laagat") {
                                    echo "Laagat";
                                }
                                if ($col == "thaals") {
                                    echo "Thaals";
                                }
                                if ($col == "purpose") {
                                    echo "Purpose";
                                }
                                if ($col == "scd") {
                                    echo "Security Deposit";
                                }

                                if ($col == "formid") {
                                    echo "Form ID";
                                }

                                if ($col == "garbage") {
                                    echo "Garbage Charge";
                                }

                                echo "</th>";
                            }

                            ?>
                            <!--      <th>ID</th>
                                                <th>ITS</th>
                                                <th>Name</th>
                                                <th>Mobile</th>

                                                <th>Jamaat Khana</th>
                                                <th>Date</th>
                                                <th>Label</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Capacity</th>
                                                <th>Rent</th>
                                                <th>Rent Paid</th>
                                                <th>Rent Cleared</th>
                                                <th>Status</th> -->
                            <th>EDIT</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {

                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }

                                if ($col == "date") {
                                    $date = $row['date'];
                                }

                                if ($col == "laagat") {
                                    $laagat = $row['laagat'];
                                }
                                if ($col == "thaals") {
                                    $thaals = $row['thaals'];
                                }
                                if ($col == "purpose") {
                                    $purpose = $row['purpose'];
                                }
                                if ($col == "scd") {
                                    $scd = $row['sc_deposit'];
                                }

                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }

                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                            }








                        ?>
                            <tr>
                                <form method="POST">
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";

                                        if ($col == "its") {
                                            echo "<input name='its' value='$its' class='form-control' >";
                                        }
                                        if ($col == "name") {
                                            echo "<input name='name' value='$name' class='form-control' >";
                                        }
                                        if ($col == "mobile") {
                                            echo "<input name='mobile' value='$mobile' class='form-control' >";
                                        }

                                        if ($col == "date") {
                                            list($y, $m, $d) = explode('-', $date);
                                            $f_first0 = $m . "/" . $d . "/" . $y;
                                            $final = str_replace(' ', '', $f_first0);

                                            echo   "<input type='text'  value='$final' name='date' class='form-control datepicker' >";
                                        }

                                        if ($col == "laagat") {
                                            echo "<input name='laagat' value='$laagat' class='form-control' >";
                                        }
                                        if ($col == "thaals") {
                                            echo "<input name='thaals' value='$thaals' class='form-control' >";
                                        }
                                        if ($col == "purpose") {
                                            echo "<input name='purpose' value='$purpose' class='form-control' >";
                                        }
                                        if ($col == "scd") {
                                            echo "<input name='scd' value='$scd' class='form-control' >";
                                        }

                                        if ($col == "formid") {
                                            echo "<input name='formid' value='$formid' class='form-control' >";
                                        }
                                        if ($col == "garbage") {
                                            echo "<input name='garbage' value='$garbage' class='form-control' >";
                                        }

                                        echo "</td>";
                                    }


                                    ?>
                                    <td><button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>EDIT</button></td>
                                    <?php
                                    $l = "submit" . $id;
                                    if (isset($_POST[$l])) {
                                        $id;
                                        $checkbox = $_GET['checkbox'];
                                        foreach ($checkbox as $col) {
                                            if ($col == "its") {
                                                $its = $_POST['its'];
                                                $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "name") {
                                                $name = $_POST['name'];
                                                $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "mobile") {
                                                $mobile = $_POST['mobile'];
                                                $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "date") {
                                                $first = $_POST['date'];
                                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                                $date = str_replace(' ', '', $f_first0);

                                                $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "laagat") {
                                                $laagat = $_POST['laagat'];
                                                $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "thaals") {
                                                $thaals = $_POST['thaals'];
                                                $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "purpose") {
                                                $purpose = $_POST['purpose'];
                                                $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "scd") {
                                                $scd = $_POST['scd'];
                                                $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "formid") {
                                                $formid = $_POST['formid'];
                                                $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "garbage") {
                                                $garbage = $_POST['garbage'];
                                                $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                        }
                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo "<script>window.location='$actual_link'</script>";
                                    }

                                    ?>

                                </form>


                            </tr>
                        <?php     }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>
    </div>
<?php
                }

                if (isset($_GET['jk_id']) && ($_GET['type'] == "6")  && isset($_GET['status']) && isset($_GET['daterange'])) {
                    $jk_id = $_GET['jk_id'];

                    $status = $_GET['status'];
                    $range = $_GET['daterange'];
                    $checkbox = $_GET['checkbox'];
                    list($first, $second) = explode('-', $range);

                    list($f_m, $f_d, $f_y) = explode('/', $first);
                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                    $f_first = str_replace(' ', '', $f_first0);

                    list($s_m, $s_d, $s_y) = explode('/', $second);
                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                    $f_second = str_replace(' ', '', $f_second0);

                    if ($jk_id == "0" && $status == "0") {
                        $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE (date>='$f_first' AND date<='$f_second')";
                    } else if ($jk_id != "0" && $status == "0") {

                        $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE jk_id=$jk_id AND (date>='$f_first' AND date<='$f_second')";
                    } else if ($jk_id == "0" && $status != "0") {

                        if ($status == "5") {
                            $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=3 AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second')";
                        } else {
                            $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=$status AND (date>='$f_first' AND date<='$f_second')";
                        }
                    } else if ($jk_id != "0" && $status != "0") {
                        if ($status == "5") {
                            $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=3 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second')";
                        } else {
                            $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage from booking_info WHERE status=$status AND jk_id=$jk_id  AND (date>='$f_first' AND date<='$f_second')";
                        }
                    }
                    $run = $conn->query($sql);


?>

    <div class="row ml-2">
        <div class="card ml-2 mb-4"">
                                        <div class=" card-header">Info</div>
        <div class=" card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                    <thead>
                        <tr>
                            <?php
                            foreach ($checkbox as $col) {
                                echo "<th>";

                                if ($col == "its") {
                                    echo "ITS";
                                }
                                if ($col == "name") {
                                    echo "Name";
                                }
                                if ($col == "mobile") {
                                    echo "Mobile";
                                }

                                if ($col == "date") {
                                    echo "Booking Date";
                                }

                                if ($col == "laagat") {
                                    echo "Laagat";
                                }
                                if ($col == "thaals") {
                                    echo "Thaals";
                                }
                                if ($col == "purpose") {
                                    echo "Purpose";
                                }
                                if ($col == "scd") {
                                    echo "Security Deposit";
                                }

                                if ($col == "formid") {
                                    echo "Form ID";
                                }
                                if ($col == "garbage") {
                                    echo "Garbage Charge";
                                }

                                echo "</th>";
                            }

                            ?>
                            <!--      <th>ID</th>
                                                        <th>ITS</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>
        
                                                        <th>Jamaat Khana</th>
                                                        <th>Date</th>
                                                        <th>Label</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Capacity</th>
                                                        <th>Rent</th>
                                                        <th>Rent Paid</th>
                                                        <th>Rent Cleared</th>
                                                        <th>Status</th> -->
                            <th>EDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {

                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }

                                if ($col == "date") {
                                    $date = $row['date'];
                                }

                                if ($col == "laagat") {
                                    $laagat = $row['laagat'];
                                }
                                if ($col == "thaals") {
                                    $thaals = $row['thaals'];
                                }
                                if ($col == "purpose") {
                                    $purpose = $row['purpose'];
                                }
                                if ($col == "scd") {
                                    $scd = $row['sc_deposit'];
                                }

                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                            }








                        ?>
                            <tr>
                                <form method="POST">
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";

                                        if ($col == "its") {
                                            echo "<input name='its' value='$its' class='form-control' >";
                                        }
                                        if ($col == "name") {
                                            echo "<input name='name' value='$name' class='form-control' >";
                                        }
                                        if ($col == "mobile") {
                                            echo "<input name='mobile' value='$mobile' class='form-control' >";
                                        }

                                        if ($col == "date") {
                                            list($y, $m, $d) = explode('-', $date);
                                            $f_first0 = $m . "/" . $d . "/" . $y;
                                            $final = str_replace(' ', '', $f_first0);

                                            echo   "<input type='text'  value='$final' name='date' class='form-control datepicker'>";
                                        }

                                        if ($col == "laagat") {
                                            echo "<input name='laagat' value='$laagat' class='form-control' >";
                                        }
                                        if ($col == "thaals") {
                                            echo "<input name='thaals' value='$thaals' class='form-control' >";
                                        }
                                        if ($col == "purpose") {
                                            echo "<input name='purpose' value='$purpose' class='form-control' >";
                                        }
                                        if ($col == "scd") {
                                            echo "<input name='scd' value='$scd' class='form-control' >";
                                        }

                                        if ($col == "formid") {
                                            echo "<input name='formid' value='$formid' class='form-control' >";
                                        }
                                        if ($col == "garbage") {
                                            echo "<input name='garbage' value='$garbage' class='form-control' >";
                                        }

                                        echo "</td>";
                                    }


                                    ?>
                                    <td><button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>EDIT</button></td>
                                    <?php
                                    $l = "submit" . $id;
                                    if (isset($_POST[$l])) {
                                        $id;
                                        $checkbox = $_GET['checkbox'];
                                        foreach ($checkbox as $col) {
                                            if ($col == "its") {
                                                $its = $_POST['its'];
                                                $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "name") {
                                                $name = $_POST['name'];
                                                $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "mobile") {
                                                $mobile = $_POST['mobile'];
                                                $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "date") {
                                                $first = $_POST['date'];
                                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                                $date = str_replace(' ', '', $f_first0);

                                                $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "laagat") {
                                                $laagat = $_POST['laagat'];
                                                $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "thaals") {
                                                $thaals = $_POST['thaals'];
                                                $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "purpose") {
                                                $purpose = $_POST['purpose'];
                                                $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "scd") {
                                                $scd = $_POST['scd'];
                                                $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "formid") {
                                                $formid = $_POST['formid'];
                                                $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                            if ($col == "garbage") {
                                                $garbage = $_POST['garbage'];
                                                $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                                mysqli_query($conn, $sql);
                                            }
                                        }
                                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo "<script>window.location='$actual_link'</script>";
                                    }

                                    ?>

                                </form>

                            </tr>
                        <?php     }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>
    </div>
<?php
                }
                if (isset($_GET['input']) && $_GET['type'] == "7") {
                    $id = $_GET['input'];
                    if (strpos($id, '(') !== false) {
                        $first_index = stripos($id, "(") + 1;
                        $s_id_e = substr($id, $first_index);
                        $id = rtrim($s_id_e, ") ");
                    }
                    $checkbox = $_GET['checkbox'];

                    $sql = "SELECT id,its,name,mobile,jk_id,date,laagat,thaals,purpose,sc_deposit,formid,garbage,status from booking_info WHERE id=$id";
                    $run = $conn->query($sql);


?>
    </div>
   
        <div class="card ml-2 mb-4"">
                                    <div class=" card-header">Info</div>
        <div class=" card-body">


            <?php

                    while ($row = $run->fetch_assoc()) {
                        $id = $row['id'];

                        foreach ($checkbox as $col) {

                            if ($col == "its") {
                                $its = $row['its'];
                            }
                            if ($col == "name") {
                                $name = $row['name'];
                            }
                            if ($col == "mobile") {
                                $mobile = $row['mobile'];
                            }

                            if ($col == "date") {
                                $date = $row['date'];
                            }

                            if ($col == "laagat") {
                                $laagat = $row['laagat'];
                            }
                            if ($col == "thaals") {
                                $thaals = $row['thaals'];
                            }
                            if ($col == "purpose") {
                                $purpose = $row['purpose'];
                            }
                            if ($col == "scd") {
                                $scd = $row['sc_deposit'];
                            }

                            if ($col == "formid") {
                                $formid = $row['formid'];
                            }
                            if ($col == "garbage") {
                                $garbage = $row['garbage'];
                            }
                            if ($col == "status") {
                                $status = $row['status'];
                            }
                        }








            ?>
             
                    <form method="POST">
                        <?php
                        foreach ($checkbox as $col) {
                            echo "<div class='form-group'>";

                            if ($col == "its") {
                                echo "<lable>ITS</label><input name='its' value='$its' class='form-control' >";
                            }
                            if ($col == "name") {
                                echo "<lable>Name</label><input name='name' value='$name' class='form-control' >";
                            }
                            if ($col == "mobile") {
                                echo "<lable>Mobile</label><input name='mobile' value='$mobile' class='form-control' >";
                            }

                            if ($col == "date") {
                                list($y, $m, $d) = explode('-', $date);
                                $f_first0 = $m . "/" . $d . "/" . $y;
                                $final = str_replace(' ', '', $f_first0);

                                echo   "<lable>Booking Date</label><input type='text'  value='$final' name='date' class='form-control datepicker'>";
                            }

                            if ($col == "laagat") {
                                echo "<lable>Laagat</label><input name='laagat' value='$laagat' class='form-control' >";
                            }
                            if ($col == "thaals") {
                                echo "<lable>Thaals</label><input name='thaals' value='$thaals' class='form-control' >";
                            }
                            if ($col == "purpose") {
                                echo "<lable>Purpose</label><input name='purpose' value='$purpose' class='form-control' >";
                            }
                            if ($col == "scd") {
                                echo "<lable>Security Deposit</label><input type='number' name='scd' value='$scd' class='form-control' >";
                            }

                            if ($col == "formid") {
                                echo "<lable>Form ID</label><input name='formid' value='$formid' class='form-control' >";
                            }
                            if ($col == "garbage") {
                                echo "<lable>Garbage</label><input name='garbage' type='number' value='$garbage' class='form-control' >";
                            }

                            if ($col == "status") {
                        ?>
                                <lable>Status</label> <select class="form-control" name="status" required>
                                        <?php

                                        if ($status == 1) {
                                        ?>
                                            <option value='1'><?php echo "Payment Pending" ?></option>
                                        <?php
                                        }
                                        if ($status == 2) {
                                        ?>
                                            <option value='2'><?php echo "Clearance Pending" ?></option>
                                        <?php
                                        }
                                        if ($status == 3) {
                                        ?>
                                            <option value='3'><?php echo "Booked" ?></option>
                                        <?php
                                        }
                                        if ($status == 4) {
                                        ?>
                                            <option value='4'><?php echo "Cancelled" ?></option>
                                        <?php
                                        }
                                        if ($status == 5) {
                                        ?>
                                            <option value='5'><?php echo "Deleted" ?></option>
                                        <?php
                                        }


                                        ?>


                                        <option value="1">Payment Pending</option>

                                        <option value="3">Booked</option>
                                        <option value="4">Cancelled</option>
                                        <option value="5">Deleted</option>

                                    </select>
                            <?php
                            }

                            echo "</div>";
                        }


                            ?>
                            <button name='submit<?php echo $id ?>' class="btn btn-primary" value='<?php echo $id ?>'>Submit</button>
                            <?php
                            $l = "submit" . $id;
                            if (isset($_POST[$l])) {
                                $id;
                                $checkbox = $_GET['checkbox'];
                                foreach ($checkbox as $col) {
                                    if ($col == "its") {
                                        $its = $_POST['its'];
                                        $sql = "UPDATE booking_info SET its='$its' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "name") {
                                        $name = $_POST['name'];
                                        $sql = "UPDATE booking_info SET name='$name' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "mobile") {
                                        $mobile = $_POST['mobile'];
                                        $sql = "UPDATE booking_info SET mobile='$mobile' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "date") {
                                        $first = $_POST['date'];
                                        list($f_m, $f_d, $f_y) = explode('/', $first);
                                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                        $date = str_replace(' ', '', $f_first0);

                                        $sql = "UPDATE booking_info SET date='$date' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "laagat") {
                                        $laagat = $_POST['laagat'];
                                        $sql = "UPDATE booking_info SET laagat='$laagat' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "thaals") {
                                        $thaals = $_POST['thaals'];
                                        $sql = "UPDATE booking_info SET thaals='$thaals' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "purpose") {
                                        $purpose = $_POST['purpose'];
                                        $sql = "UPDATE booking_info SET purpose='$purpose' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "scd") {
                                        $scd = $_POST['scd'];
                                        $sql = "UPDATE booking_info SET scd='$scd' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "formid") {
                                        $formid = $_POST['formid'];
                                        $sql = "UPDATE booking_info SET formid='$formid' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "garbage") {
                                        $garbage = $_POST['garbage'];
                                        $sql = "UPDATE booking_info SET garbage='$garbage' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                    if ($col == "status") {
                                        $status = $_POST['status'];
                                        $sql = "UPDATE booking_info SET status='$status' WHERE id=$id";
                                        mysqli_query($conn, $sql);
                                    }
                                }
                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                echo "<script>window.location='$actual_link'</script>";
                            }

                            ?>

                    </form>


            <?php     }

            ?>
         

        </div>

    </div>
    </div>

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
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>


<script src="select.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

</body>

</html>