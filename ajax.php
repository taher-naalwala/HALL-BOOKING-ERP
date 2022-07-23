<?php require('connectDB.php');

if (isset($_GET['jk_id'])) {
    $jk_id = $_GET['jk_id'];
    if ($jk_id == 0) { ?>
        <select class="form-control" name="timings_id[]" multiple>
            <option value="">Select Timings</option>
            <option value="0">All Timings</option>
            <?php require('connectDB.php');
            $sql = "SELECT DISTINCT label,start_time,end_time from timings";
            $run = $conn->query($sql);
            if ($run->num_rows > 0) {
                while ($row = $run->fetch_assoc()) {
                    $label = $row['label'];
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];

                    $whole = floor($start_time);
                    $fraction = $start_time - $whole;

                    if ($start_time < 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 AM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " AM";
                        }
                    } else  if ($start_time > 12) {
                        $whole = floor($start_time) - 12;
                        $fraction = ($start_time - ($whole + 12)) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    } else if ($start_time == 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    }

                    $whole_end = floor($end_time);
                    $fraction_end = $end_time - $whole_end;

                    if ($end_time < 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 AM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                        }
                    } else  if ($end_time > 12) {
                        $whole_end = floor($end_time) - 12;
                        $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    } else if ($end_time == 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    }



            ?>
                    <option value='<?php echo $label . "," . $start_time . "," . $end_time ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
            <?php }
            }

            ?>
        </select>
    <?php   } else { ?>
        <select class="form-control" name="timings_id[]" multiple>
            <option value="">Select Timings</option>
            <option value="0">All Timings</option>
            <?php require('connectDB.php');
            $sql = "SELECT DISTINCT label,start_time,end_time from timings WHERE jk_id=$jk_id";
            $run = $conn->query($sql);
            if ($run->num_rows > 0) {
                while ($row = $run->fetch_assoc()) {
                    $label = $row['label'];
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];

                    $whole = floor($start_time);
                    $fraction = $start_time - $whole;

                    if ($start_time < 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 AM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " AM";
                        }
                    } else  if ($start_time > 12) {
                        $whole = floor($start_time) - 12;
                        $fraction = ($start_time - ($whole + 12)) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    } else if ($start_time == 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    }

                    $whole_end = floor($end_time);
                    $fraction_end = $end_time - $whole_end;

                    if ($end_time < 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 AM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                        }
                    } else  if ($end_time > 12) {
                        $whole_end = floor($end_time) - 12;
                        $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    } else if ($end_time == 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    }



            ?>
                    <option value='<?php echo $label . "," . $start_time . "," . $end_time ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
            <?php }
            }

            ?>
        </select>
    <?php }
}

if (isset($_GET['jk_id_transfer'])) {
    $jk_id = $_GET['jk_id_transfer']; ?>
    <select class="form-control" name="timings_id" required>
        <option value="">Select Timings</option>

        <?php require('connectDB.php');
        $sql = "SELECT id,label,start_time,end_time from timings WHERE jk_id=$jk_id";
        $run = $conn->query($sql);
        if ($run->num_rows > 0) {
            while ($row = $run->fetch_assoc()) {
                $t_id = $row['id'];
                $label = $row['label'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];

                $whole = floor($start_time);
                $fraction = $start_time - $whole;

                if ($start_time < 12) {
                    $whole = floor($start_time);
                    $fraction = ($start_time - $whole) * 60;
                    if ($fraction == "0") {
                        $final_start_time = $whole . ":00 AM";
                    } else {
                        $final_start_time = $whole . ":" . $fraction . " AM";
                    }
                } else  if ($start_time > 12) {
                    $whole = floor($start_time) - 12;
                    $fraction = ($start_time - ($whole + 12)) * 60;
                    if ($fraction == "0") {
                        $final_start_time = $whole . ":00 PM";
                    } else {
                        $final_start_time = $whole . ":" . $fraction . " PM";
                    }
                } else if ($start_time == 12) {
                    $whole = floor($start_time);
                    $fraction = ($start_time - $whole) * 60;
                    if ($fraction == "0") {
                        $final_start_time = $whole . ":00 PM";
                    } else {
                        $final_start_time = $whole . ":" . $fraction . " PM";
                    }
                }

                $whole_end = floor($end_time);
                $fraction_end = $end_time - $whole_end;

                if ($end_time < 12) {
                    $whole_end = floor($end_time);
                    $fraction_end = ($end_time - $whole_end) * 60;
                    if ($fraction_end == "0") {
                        $final_end_time = $whole_end . ":00 AM";
                    } else {
                        $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                    }
                } else  if ($end_time > 12) {
                    $whole_end = floor($end_time) - 12;
                    $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                    if ($fraction_end == "0") {
                        $final_end_time = $whole_end . ":00 PM";
                    } else {
                        $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                    }
                } else if ($end_time == 12) {
                    $whole_end = floor($end_time);
                    $fraction_end = ($end_time - $whole_end) * 60;
                    if ($fraction_end == "0") {
                        $final_end_time = $whole_end . ":00 PM";
                    } else {
                        $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                    }
                }



        ?>
                <option value='<?php echo $t_id ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
        <?php }
        }

        ?>
    </select>
    <?php }


if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == "1") {
        echo '<input class="form-control" type="number"  name="its" placeholder="Enter ITS">';
    }
    if ($type == "2") {
        echo '<input class="form-control" type="text" name="name" placeholder="Enter Name">';
    }
    if ($type == "3") {
        echo '<input class="form-control" type="number" name="mobile" placeholder="Enter Mobile">';
    }
    if ($type == "7") {
        echo '<input class="form-control" type="number" name="id" placeholder="Enter Booking ID">';
    }
    if ($type == "4") {
        echo '<select name="option_pp" class="form-control" id="pp" onChange="change_pp()" >
        <option value="0">Full List</option>
        <option value="1">DateRange</option>
        </select>';
    }
    if ($type == "5") { ?>
        <select class="form-control" name="jk_id">
            <option value="">Select Jamaat Khaana</option>
            <option value="0">All Jamaat Khaana</option>
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
    <?php }
    if ($type == "6") { ?>
        <select class="form-control" name="jk_id" id="jk_id_report" onchange="change_timing_report()" required>
            <option value="">Select Jamaat Khaana</option>
            <option value="0">All Jamaat Khaana</option>
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
    <?php }
    if ($type == "8" || $type=="10") {
    ?>
        <select class="form-control" name="c_ledger" id="c_ledger" onchange="change_ledger_report()" required>
            <option value="">Select Trust</option>
            <option value="0">Both</option>
            <?php require('connectDB.php');
            $sql = "SELECT id,name from trust";
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
    <?php
    }
    if ($type == "9") {
    ?>
        <select class="form-control" name="c_ledger" id="c_ledger" onchange="change_ledger_report()" required>
            <option value="">Select Trust</option>
            <option value="0">Both</option>
            <?php require('connectDB.php');
            $sql = "SELECT id,name from trust";
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
    <?php
    }
}
if (isset($_GET['pp'])) {
    $pp = $_GET['pp'];
    if ($pp == "1") {
        echo '<input type="text" class="form-control" name="daterange" />';
    }
}

if (isset($_GET['jk_id_report'])) {
    $jk_id = $_GET['jk_id_report'];
    if ($jk_id == 0) { ?>
        <select class="form-control" name="timings_id" onchange="change_timing_report()" required>
            <option value="">Select Timings</option>
            <option value="0">All Timings</option>
            <?php require('connectDB.php');
            $sql = "SELECT DISTINCT label,start_time,end_time from timings";
            $run = $conn->query($sql);
            if ($run->num_rows > 0) {
                while ($row = $run->fetch_assoc()) {
                    $label = $row['label'];
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];

                    $whole = floor($start_time);
                    $fraction = $start_time - $whole;

                    if ($start_time < 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 AM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " AM";
                        }
                    } else  if ($start_time > 12) {
                        $whole = floor($start_time) - 12;
                        $fraction = ($start_time - ($whole + 12)) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    } else if ($start_time == 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    }

                    $whole_end = floor($end_time);
                    $fraction_end = $end_time - $whole_end;

                    if ($end_time < 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 AM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                        }
                    } else  if ($end_time > 12) {
                        $whole_end = floor($end_time) - 12;
                        $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    } else if ($end_time == 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    }



            ?>
                    <option value='<?php echo $label . "," . $start_time . "," . $end_time ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
            <?php }
            }

            ?>
        </select>
    <?php   } else { ?>
        <select class="form-control" name="timings_id" onchange="change_timing_report()" required>
            <option value="">Select Timings</option>
            <option value="0">All Timings</option>
            <?php require('connectDB.php');
            $sql = "SELECT DISTINCT label,start_time,end_time from timings WHERE jk_id=$jk_id";
            $run = $conn->query($sql);
            if ($run->num_rows > 0) {
                while ($row = $run->fetch_assoc()) {
                    $label = $row['label'];
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];

                    $whole = floor($start_time);
                    $fraction = $start_time - $whole;

                    if ($start_time < 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 AM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " AM";
                        }
                    } else  if ($start_time > 12) {
                        $whole = floor($start_time) - 12;
                        $fraction = ($start_time - ($whole + 12)) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    } else if ($start_time == 12) {
                        $whole = floor($start_time);
                        $fraction = ($start_time - $whole) * 60;
                        if ($fraction == "0") {
                            $final_start_time = $whole . ":00 PM";
                        } else {
                            $final_start_time = $whole . ":" . $fraction . " PM";
                        }
                    }

                    $whole_end = floor($end_time);
                    $fraction_end = $end_time - $whole_end;

                    if ($end_time < 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 AM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                        }
                    } else  if ($end_time > 12) {
                        $whole_end = floor($end_time) - 12;
                        $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    } else if ($end_time == 12) {
                        $whole_end = floor($end_time);
                        $fraction_end = ($end_time - $whole_end) * 60;
                        if ($fraction_end == "0") {
                            $final_end_time = $whole_end . ":00 PM";
                        } else {
                            $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                        }
                    }



            ?>
                    <option value='<?php echo $label . "," . $start_time . "," . $end_time ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
            <?php }
            }

            ?>
        </select>
    <?php }
}

if (isset($_GET['jk_id_rent'])) {
    $jk_id = $_GET['jk_id_rent'];
    ?>
    <select class="form-control" name="date" required>
        <option value="">Select Date</option>

        <?php require('connectDB.php');
        $sql = "SELECT id,amount,start_date,end_date from rent WHERE jk_id=$jk_id and status=0 and day=''";
        $run = $conn->query($sql);
        if ($run->num_rows > 0) {
            while ($row = $run->fetch_assoc()) {
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $id = $row['id'];
                $rent = $row['amount'];
        ?>
                <option value='<?php echo $id ?>'><?php echo $start_date . " - " . $end_date . " (Rs." . $rent . ")" ?></option>
            <?php }
        }
        $sql = "SELECT id,amount,day from rent WHERE jk_id=$jk_id and status=0 and day!=''";
        $run = $conn->query($sql);
        if ($run->num_rows > 0) {
            while ($row = $run->fetch_assoc()) {
                $day = $row['day'];

                $id = $row['id'];
                $rent = $row['amount'];
            ?>
                <option value='<?php echo $id ?>'><?php echo $day . " (Rs." . $rent . ")" ?></option>
        <?php }
        }

        ?>
    </select>
    <?php }

if (isset($_GET['choice_id'])) {
    $choice_id = $_GET['choice_id'];
    if ($choice_id == "0") {
    ?>
        <div class="form-group"> <select class="form-control" name="jk_id" required>
                <option value=''>Select Jamaat Khaana</option>
                <?php require('connectDB.php');
                $sql = "SELECT id,name from jk_info ";
                $run = $conn->query($sql);
                while ($row = $run->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                <?php   }


                ?>
            </select>

        </div>
    <?php } else if ($choice_id == "1") {
    ?>
        <div class="form-group"> <select class="form-control" onchange="change_edit_jk()" id="jk_id" name="jk_id" required>
                <option value=''>Select Jamaat Khaana</option>
                <?php require('connectDB.php');
                $sql = "SELECT id,name from jk_info ";
                $run = $conn->query($sql);
                while ($row = $run->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                <?php   }


                ?>
            </select>

        </div>
    <?php
    } else if ($choice_id == "2") {
    ?>
        <div class="form-group"> <select class="form-control" name="jk_id" required>
                <option value=''>Select Jamaat Khaana</option>
                <?php require('connectDB.php');
                $sql = "SELECT id,name from jk_info ";
                $run = $conn->query($sql);
                while ($row = $run->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                <?php   }


                ?>
            </select>

        </div>
    <?php
    }
}

if (isset($_GET['jk_id_edit'])) {
    $jk_id = $_GET['jk_id_edit'];

    ?>
    <div class="form-group"> <select class="form-control" name="timing_id" required>
            <option value=''>Select Timing</option>
            <?php
            $sql = "SELECT id,label,start_time,end_time from timings WHERE jk_id=$jk_id";
            $run = $conn->query($sql);
            while ($row = $run->fetch_assoc()) {
                $label = $row['label'];
                $id = $row['id'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];
                if ($start_time >= 12 && $start_time < 13) {
                    $start_whole = "12";
                    $start_fraction = floor(($start_time - $start_whole) * 60);
                    $start_type = "PM";
                } else if ($start_time >= 0 && $start_time < 1) {
                    $start_whole = "12";
                    $start_fraction = floor(($start_time) * 60);
                    $start_type = "AM";
                } else if ($start_time < 12) {
                    $start_whole = floor($start_time);
                    $start_fraction = floor(($start_time - $start_whole) * 60);
                    $start_type = "AM";
                } else  if ($start_time > 12) {
                    $start_whole = floor($start_time) - 12;
                    $start_fraction = floor(($start_time - ($start_whole + 12)) * 60);
                    $start_type = "PM";
                }

                if ($start_fraction == "0") {
                    $start_fraction = "00";
                }

                if ($end_time >= 12 && $end_time < 13) {
                    $end_whole = "12";
                    $end_fraction = floor(($end_time - $end_whole) * 60);
                    $end_type = "PM";
                } else if ($end_time >= 0 && $end_time < 1) {
                    $end_whole = "12";
                    $end_fraction = floor(($end_time) * 60);
                    $end_type = "AM";
                } else if ($end_time < 12) {
                    $end_whole = floor($end_time);
                    $end_fraction = floor(($end_time - $end_whole) * 60);
                    $end_type = "AM";
                } else  if ($end_time > 12) {
                    $end_whole = floor($end_time) - 12;
                    $end_fraction = floor(($end_time - ($end_whole + 12)) * 60);
                    $end_type = "PM";
                }


                if ($end_fraction == "0") {
                    $end_fraction = "00";
                }
            ?>
                <option value="<?php echo $id; ?>"><?php echo $label . " (" . $start_whole . ":" . $start_fraction . " " . $start_type . " - " . $end_whole . ":" . $end_fraction . " " . $end_type . " )"; ?></option>

            <?php   }


            ?>

        </select>
    </div>
<?php
}
?>