<?php
session_start();
if (isset($_SESSION['access'])) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "31" ) {
            $flag = 1;
        }
    }
} else {
    header("Location: main.php");
    die();
}

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
    <title>Block Jamaat Khana</title>
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
                    <h6 class="m-0 font-weight-bold text-primary">Public Booking</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">

                            <input type="text" placeholder="Date" name="date" class="form-control" id="datepicker">
                        </div>

                        <div class="form-group">

                            <select class="form-control" id="jk_id" onChange="change_jk()" name="jk_id">
                                <option value="">Select Jamaat Khaana</option>
                                <option value="0">All Jamaat Khaana</option>
                                <?php require('connectDB.php');
                                $sql = "SELECT name,id from jk_info";
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
                            <div id="timing_date">
                                <select class="form-control" name="timings_id[]" multiple>
                                    <option value="">Select Timing</option>

                                </select>
                            </div>
                        </div>
                       


                        <div class="form-group">

                            <input type="text" placeholder="Enter Name" name="name" class="form-control">
                        </div>

                        <div class="form-group">

                            <input type="number" placeholder="Enter ITS" max="99999999" name="its" class="form-control">
                        </div>

                        <div class="form-group">

                            <input type="number" max="9999999999" placeholder="Enter Mobile Number" name="mobile" class="form-control">
                        </div>

                        <div class="form-group">
                            <button name="sub" value="sub" class="btn btn-primary">Submit</button>
                        </div>
                        <?php
                        if (isset($_POST['sub'])) {
                            $first = $_POST['date'];
                            $jk_id = $_POST['jk_id'];
                            $timings_id = $_POST['timings_id'];
                            $its = $_POST['its'];
                            $name = $_POST['name'];
                            $mobile = $_POST['mobile'];
                          
                          $c=date('Y-m-d');
                            if (strlen($its) == 8 && strlen($mobile) == 10) {


                                list($f_m, $f_d, $f_y) = explode('/', $first);
                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                $date = str_replace(' ', '', $f_first0);

                                if ($jk_id == "0") {
                                    $sql = "SELECT * from jk_info";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        while ($row = $run->fetch_assoc()) {
                                            $id = $row['id'];
                                            foreach ($timings_id as $timing) {
                                                if ($timing == "0") {
                                                    $s3 = "SELECT * FROM timings WHERE jk_id=$id";
                                                    $run3 = $conn->query($s3);
                                                    if ($run3->num_rows > 0) {
                                                        while ($row3 = $run3->fetch_assoc()) {
                                                            $timing = $row3['id'];
                                                            $s_check = "SELECT * from booking_info WHERE date='$date' AND jk_id=$id AND timings_id=$timing";
                                                            $run_c = $conn->query($s_check);
                                                            if ($run_c->num_rows > 0) {
                                                                echo "Already Booked on this date" . $date;
                                                            } else {
                                                                $s2 = "INSERT INTO booking_info VALUES('','$its','$name','$mobile','$date',$id,$timing,1,'','',0,0,'$c',4,'',0,'',0,'','')";
                                                                mysqli_query($conn, $s2);
                                                            }
                                                        }
                                                        break;
                                                    }
                                                } else {
                                                    list($label, $start_time, $end_time) = explode(',', $timing);

                                                    $s1 = "SELECT * from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                                    $run1 = $conn->query($s1);
                                                    if ($run1->num_rows > 0) {
                                                        $row1 = $run1->fetch_assoc();
                                                        $timing_id = $row1['id'];
                                                        $s_check = "SELECT * from booking_info WHERE date='$date' AND jk_id=$id AND timings_id=$timing";
                                                        $run_c = $conn->query($s_check);
                                                        if ($run_c->num_rows > 0) {
                                                            echo "Already Booked on this date" . $date;
                                                        } else {
                                                            $s2 = "INSERT INTO booking_info VALUES('','$its','$name','$mobile','$date',$id,$timing_id,1,'','',0,0,'$c',4,'',0,'',0,'','')";
                                                            mysqli_query($conn, $s2);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $id = $jk_id;
                                    foreach ($timings_id as $timing) {
                                        if ($timing == "0") {
                                            $s3 = "SELECT * FROM timings WHERE jk_id=$id";
                                            $run3 = $conn->query($s3);
                                            if ($run3->num_rows > 0) {
                                                while ($row3 = $run3->fetch_assoc()) {
                                                    $timing = $row3['id'];
                                                    $s_check = "SELECT * from booking_info WHERE date='$date' AND jk_id=$id AND timings_id=$timing";
                                                    $run_c = $conn->query($s_check);
                                                    if ($run_c->num_rows > 0) {
                                                        echo "Already Booked on this date" . $date;
                                                    } else {
                                                        $s2 = "INSERT INTO booking_info VALUES('','$its','$name','$mobile','$date',$id,$timing,1,'','',0,0,'$c',4,'',0,'',0,'','')";
                                                        mysqli_query($conn, $s2);
                                                    }
                                                }
                                                break;
                                            }
                                        } else {
                                            list($label, $start_time, $end_time) = explode(',', $timing);

                                            $s1 = "SELECT * from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                            $run1 = $conn->query($s1);
                                            if ($run1->num_rows > 0) {
                                                $row1 = $run1->fetch_assoc();
                                                $timing_id = $row1['id'];
                                                $s_check = "SELECT * from booking_info WHERE date='$date' AND jk_id=$id AND timings_id=$timing";
                                                $run_c = $conn->query($s_check);
                                                if ($run_c->num_rows > 0) {
                                                    echo "Already Booked on this date" . $date;
                                                } else {
                                                    $s2 = "INSERT INTO booking_info VALUES('','$its','$name','$mobile','$date',$id,$timing_id,1,'','',0,0,'$c',4,'',0,'',0,'','')";
                                                    mysqli_query($conn, $s2);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="select.js"></script>
</body>

</html>