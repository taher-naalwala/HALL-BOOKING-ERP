<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamaat Khana Booking</title>
    <style>
        .row {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php require('style_user.php');

    require('connectDB.php');
    $jk_id = $_POST['jk_id'];
    $date = $_POST['date'];
    $timings_id = $_POST['timings_id'];
    $_SESSION['date'] = $date;
    $_SESSION['jk_id'] = $jk_id;
    $_SESSION['timings_id'] = $timings_id;
    $sql = "SELECT name,capacity from jk_info WHERE id=$jk_id";
    $run = $conn->query($sql);
    $row = $run->fetch_assoc();
    $jk_name = $row['name'];
    $capacity = $row['capacity'];
    $latest_date = $date;
    $s0 = "SELECT label from timings where id=$timings_id";
    $run0 = $conn->query($s0);
    $row0 = $run0->fetch_assoc();
    $label = $row0['label'];
    $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date='$latest_date' AND end_date='$latest_date')  AND status=0 ";
    $run2 = $conn->query($s2);
    if ($run2->num_rows > 0) {
        $row2 = $run2->fetch_assoc();
        $amount = $row2['amount'];
        $_SESSION['amount'] = $amount;
    } else {
        $timestamp = strtotime($latest_date);

        $day = date('l', $timestamp);
        $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND day='$day' AND status=0 ";
        $run2 = $conn->query($s2);

        if ($run2->num_rows > 0) {

            $row2 = $run2->fetch_assoc();
            $amount = $row2['amount'];
            $_SESSION['amount'] = $amount;
        } else {

            $s2 = "SELECT amount from rent WHERE jk_id=$jk_id AND (start_date<='$latest_date' AND end_date>='$latest_date') AND status=0";
            $run2 = $conn->query($s2);
            if ($run2->num_rows > 0) {
                $row2 = $run2->fetch_assoc();
                $amount = $row2['amount'];
                $_SESSION['amount'] = $amount;
            }
        }
    }

    ?>


    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">
            <?php echo $jk_name ?>
        </div>
        <div class="card-body" style="background-color: #F7F5E6;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        Booking Date: <?php echo $date ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        Timing: <?php echo $label ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        Capacity: <?php echo $capacity ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        Amount: <?php echo $amount ?>
                    </div>
                </div>



            </div>
            <form method="POST" action="check_booking_admin.php">
                <div class="form-group">
                    <input class="form-control" type="text" name="formid" placeholder="Enter Safai Chitti Form ID" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" max="99999999" name="its" placeholder="Enter ITS" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Enter Name" name="name" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" max="9999999999" placeholder="Enter Mobile" name="mobile" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Enter Purpose" name="purpose" required>
                </div>
                <input type="hidden" name="jk_rent" value="<?php echo $amount ?>" />
                <button name="submit" value="submit" class="btn btn-primary btn-block">BOOK NOW</button>
            </form>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php
    require('footer.php');
    ?>
</body>

</html>