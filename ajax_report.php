<?php
session_start();
$forms_access = $_SESSION['forms_access'];
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require('connectDB.php');
if (isset($_GET['its']) && $_GET['type'] == "1") {
    $its = $_GET['its'];
    $checkbox = $_GET['checkbox'];

    $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE its='$its' ORDER BY date ASC";
    $run = $conn->query($sql);
    $total_booking = $run->num_rows;
    $sql1 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=1 AND its='$its' ORDER BY date ASC";
    $run1 = $conn->query($sql1);
    $total_payment_pending = $run1->num_rows;
    $sql2 = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=2 AND its='$its' ORDER BY date ASC";
    $run2 = $conn->query($sql2);
    $total_clearance_pending = $run2->num_rows;

?>
    <div class="card">
        <div class="card-body">
            <div class="row mt-4 ml-2 mr-2">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary  h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_booking ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success  h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_payment_pending ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success  h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clearance Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_clearance_pending ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                        if ($col == "bkid") {
                                            echo "#";
                                        }
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
                                        if ($col == "pdf") {
                                            echo "Pdf/Images";
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

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = $run->fetch_assoc()) {
                                    $id = $row['id'];

                                    foreach ($checkbox as $col) {
                                        if ($col == "bkid") {
                                            $id = $row['id'];
                                        }
                                        if ($col == "its") {
                                            $its = $row['its'];
                                        }
                                        if ($col == "name") {
                                            $name = $row['name'];
                                        }
                                        if ($col == "mobile") {
                                            $mobile = $row['mobile'];
                                        }

                                        if ($col == "jk") {
                                            $jk_id = $row['jk_id'];
                                            $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $jk_name = $row4['name'];
                                        }
                                        if ($col == "date") {
                                            $date = $row['date'];
                                        }
                                        if ($col == "timing") {
                                            $timings_id = $row['timings_id'];
                                            $s6 = "SELECT label from timings WHERE id=$timings_id";
                                            $run6 = $conn->query($s6);
                                            $row6 = $run6->fetch_assoc();
                                            $label_name = $row6['label'];
                                        }
                                        if ($col == "start_time") {
                                            $timings_id = $row['timings_id'];
                                            $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                            $run6 = $conn->query($s6);
                                            $row6 = $run6->fetch_assoc();

                                            $start_time = $row6['start_time'];
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
                                        }
                                        if ($col == "end_time") {
                                            $timings_id = $row['timings_id'];
                                            $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                            $run6 = $conn->query($s6);
                                            $row6 = $run6->fetch_assoc();

                                            $end_time = $row6['end_time'];

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
                                        }
                                        if ($col == "capacity") {
                                            $jk_id = $row['jk_id'];
                                            $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                            $run4 = $conn->query($s4);
                                            $row4 = $run4->fetch_assoc();
                                            $capacity = $row4['capacity'];
                                        }
                                        if ($col == "rent") {
                                            $amount = $row['jk_rent'];
                                        }
                                        if ($col == "rentp") {
                                            $amount = $row['jk_rent'];
                                            $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                            $run7 = $conn->query($s7);
                                            $total_rent_paid = 0;
                                            if ($run7->num_rows > 0) {
                                                while ($row7 = $run7->fetch_assoc()) {
                                                    $a = $row7['amount'];
                                                    $debit = $row7['debit'];
    
                                                    if ($debit == "1") {
                                                        $total_rent_paid = $total_rent_paid + $a;
                                                    } else {
                                                        $total_rent_paid = $total_rent_paid - $a;
                                                    }
                                                }
                                            }
                                        }
                                        if ($col == "rentc") {

                                            $amount = $row['jk_rent'];
                                            $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                            $run8 = $conn->query($s8);
                                            $total_rent_cleared = 0;
    
                                            if ($run8->num_rows > 0) {
    
                                                while ($row8 = $run8->fetch_assoc()) {
                                                    $a = $row8['amount'];
                                                    $debit = $row8['debit'];
                                                    if ($debit == "1") {
                                                        $total_rent_cleared = $total_rent_cleared + $a;
                                                    } else {
                                                        $total_rent_cleared = $total_rent_cleared - $a;
                                                    }
                                                }
                                            }
                                        }
                                        if ($col == "admin") {
                                            $adminid = $row['adminid'];
                                            $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                            $runq = $conn->query($sqlq);
                                            $rowq = $runq->fetch_assoc();
                                            $admin_name = $rowq['name'];
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
                                        if ($col == "m") {
                                            $manager_approval = $row['manager_approval'];
                                        }
                                        if ($col == "rs") {
                                            $rs = $row['refund_sc'];
                                        }
                                        if ($col == "bks") {
                                            $status = $row['status'];
                                        }
                                        if ($col == "formid") {
                                            $formid = $row['formid'];
                                        }
                                        if ($col == "garbage") {
                                            $fgarbage = $row['garbage'];
                                        }
                                        if ($col == "pdf") {
                                            $file = '';
                                            $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                            $runr = $conn->query($sr);
                                            if ($runr->num_rows > 0) {
                                                $rowr = $runr->fetch_assoc();
                                                $file = $rowr['file'];
                                            }
                                        }
                                    }









                                ?>
                                    <tr>
                                        <?php
                                        foreach ($checkbox as $col) {
                                            echo "<td>";
                                            if ($col == "bkid") {
                                                echo $id;
                                            }
                                            if ($col == "its") {
                                                echo $its;
                                            }
                                            if ($col == "name") {
                                                echo $name;
                                            }
                                            if ($col == "mobile") {
                                                echo $mobile;
                                            }
                                            if ($col == "jk") {
                                                echo $jk_name;
                                            }
                                            if ($col == "date") {
                                                echo $date;
                                            }
                                            if ($col == "timing") {
                                                echo $label_name;
                                            }
                                            if ($col == "start_time") {
                                                echo $final_start_time;
                                            }
                                            if ($col == "end_time") {
                                                echo $final_end_time;
                                            }
                                            if ($col == "capacity") {
                                                echo $capacity;
                                            }
                                            if ($col == "rent") {
                                                echo $amount;
                                            }
                                            if ($col == "rentp") {
                                                echo $total_rent_paid;
                                            }
                                            if ($col == "rentc") {
                                                echo $total_rent_cleared;
                                            }
                                            if ($col == "admin") {
                                                echo $admin_name;
                                            }
                                            if ($col == "laagat") {
                                                echo $laagat;
                                            }
                                            if ($col == "thaals") {
                                                echo $thaals;
                                            }
                                            if ($col == "purpose") {
                                                echo $purpose;
                                            }
                                            if ($col == "scd") {
                                                echo $scd;
                                            }
                                            if ($col == "m") {
                                                if ($manager_approval == "0") {
                                                    echo "In Progress";
                                                }
                                                if ($manager_approval == "1") {
                                                    echo "Approved";
                                                }

                                                if ($manager_approval == "2") {
                                                    echo "Denied";
                                                }
                                            }
                                            if ($col == "rs") {
                                                if ($rs == "0") {
                                                    echo "In Progress";
                                                }
                                                if ($rs == "1") {
                                                    echo "Refunded";
                                                }

                                                if ($rs == "2") {
                                                    echo "Not Refunded";
                                                }
                                            }
                                            if ($col == "bks") {
                                                if ($status == "1") {
                                                    echo "Payment Pending";
                                                }
                                                if ($status == "2") {
                                                    echo "Clearance Pending";
                                                }
                                                if ($status == "3") {
                                                    echo "Booked";
                                                }
                                                if ($status == "4") {
                                                    echo "Cancelled";
                                                }
                                                if ($status == "5") {
                                                    echo "Deleted";
                                                }
                                            }
                                            if ($col == "formid") {
                                                echo $formid;
                                            }
                                            if ($col == "garbage") {
                                                echo $garbage;
                                            }
                                            if ($col == "pdf") {
                                                if (empty($file)) {
                                                } else {
                                        ?>
                                                    <a href='<?php echo $file ?>' target="_blank">View</a>
                                        <?php  }
                                            }

                                            echo "</td>";
                                        }


                                        ?>


                                    </tr>
                                <?php     }

                                ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            <!--

            <div class="row">
                <div class="card ml-4 mb-4" style="width: 100%;">
                    <div class=" card-header">Ledger</div>
                    <div class=" card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Mode</th>

                                        <th>Debit</th>

                                        <th>Credit</th>
                                        <th>Check Number</th>
                                        <th>Status</th>
                                        <th>Clearance Date</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    /*
                                    $sql = "SELECT id from booking_info WHERE its='$its'";
                                    $run = $conn->query($sql);
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['id'];
                                        $s1 = "SELECT amount,check_number,account_number,debit,status,credit,pay_mode,c_date,check_cleared_date from ledger WHERE booking_id=$id";
                                        $run1 = $conn->query($s1);
                                        if ($run1->num_rows > 0) {
                                            while ($row1 = $run1->fetch_assoc()) {
                                                $amount = $row1['amount'];
                                                $cn = $row1['check_number'];
                                                $an = $row1['account_number'];
                                                $status = $row1['status'];
                                                $debit = $row1['debit'];
                                                $credit = $row1['credit'];
                                                $pay_mode = $row1['pay_mode'];
                                                $date = $row1['c_date'];
                                                $cl_date = $row1['check_cleared_date'];


                                    ?>
                                                <tr>
                                                    <td><?php echo $date ?></td>
                                                    <td><?php if ($pay_mode == "0") {
                                                            echo "Cheque";
                                                        } else {
                                                            echo "Cash";
                                                        } ?></td>

                                                    <td><?php if ($debit == "1") {
                                                            echo $amount;
                                                        } else {
                                                            echo "-";
                                                        } ?></td>
                                                    <td><?php if ($credit == "1") {
                                                            echo $amount;
                                                        } else {
                                                            echo "-";
                                                        } ?></td>

                                                    <td><?php echo $cn ?></td>

                                                    <td><?php
                                                        if ($status == "0") {
                                                            echo "Clearance Pending";
                                                        }
                                                        if ($status == "1") {
                                                            echo "Cleared";
                                                        }
                                                        if ($status == "2") {
                                                            echo "Failed";
                                                        }
                                                        if ($status == "3") {
                                                            echo "Deleted";
                                                        }

                                                        ?></td>
                                                    <td><?php echo $cl_date ?></td>


                                                </tr>
                                    <?php     }
                                        }
                                    } */

                                    ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div> -->
    <?php
}
if (isset($_GET['name']) && $_GET['type'] == "2") {
    $name = $_GET['name'];
    $checkbox = $_GET['checkbox'];

    $sql = "SELECT jk_rent,id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE name LIKE '%$name%' ORDER BY date ASC";
    $run = $conn->query($sql);
    $total_booking = $run->num_rows;
    $sql1 = "SELECT jk_rent,id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=1 AND name LIKE '%$name%' ORDER BY date ASC";
    $run1 = $conn->query($sql1);
    $total_payment_pending = $run1->num_rows;
    $sql2 = "SELECT jk_rent,id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=2 AND name LIKE '%$name%' ORDER BY date ASC";
    $run2 = $conn->query($sql2);
    $total_clearance_pending = $run2->num_rows;

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
                                    if ($col == "bkid") {
                                        echo "#";
                                    }
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
                                    if ($col == "pdf") {
                                        echo "Pdf/Images";
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

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = $run->fetch_assoc()) {
                                $id = $row['id'];

                                foreach ($checkbox as $col) {
                                    if ($col == "bkid") {
                                        $id = $row['id'];
                                    }
                                    if ($col == "its") {
                                        $its = $row['its'];
                                    }
                                    if ($col == "name") {
                                        $name = $row['name'];
                                    }
                                    if ($col == "mobile") {
                                        $mobile = $row['mobile'];
                                    }
                                    if ($col == "jk") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                    }
                                    if ($col == "date") {
                                        $date = $row['date'];
                                    }
                                    if ($col == "timing") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();
                                        $label_name = $row6['label'];
                                    }
                                    if ($col == "start_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $start_time = $row6['start_time'];
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
                                    }
                                    if ($col == "end_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $end_time = $row6['end_time'];

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
                                    }
                                    if ($col == "capacity") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $capacity = $row4['capacity'];
                                    }
                                    if ($col == "rent") {
                                       $amount=$row['jk_rent'];
                                    }
                                    if ($col == "rentp") {
                                        $amount = $row['jk_rent'];
                                        $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                        $run7 = $conn->query($s7);
                                        $total_rent_paid = 0;
                                        if ($run7->num_rows > 0) {
                                            while ($row7 = $run7->fetch_assoc()) {
                                                $a = $row7['amount'];
                                                $debit = $row7['debit'];

                                                if ($debit == "1") {
                                                    $total_rent_paid = $total_rent_paid + $a;
                                                } else {
                                                    $total_rent_paid = $total_rent_paid - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "rentc") {
                                        $amount=$row['jk_rent'];

                                        $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                        $run8 = $conn->query($s8);
                                        $total_rent_cleared = 0;

                                        if ($run8->num_rows > 0) {
                                            
                                            while ($row8 = $run8->fetch_assoc()) {
                                                $a = $row8['amount'];
                                                $debit = $row8['debit'];
                                                if ($debit == "1") {
                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                } else {
                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "admin") {
                                        $adminid = $row['adminid'];
                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                        $runq = $conn->query($sqlq);
                                        $rowq = $runq->fetch_assoc();
                                        $admin_name = $rowq['name'];
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
                                    if ($col == "m") {
                                        $manager_approval = $row['manager_approval'];
                                    }
                                    if ($col == "rs") {
                                        $rs = $row['refund_sc'];
                                    }
                                    if ($col == "bks") {
                                        $status = $row['status'];
                                    }
                                    if ($col == "formid") {
                                        $formid = $row['formid'];
                                    }
                                    if ($col == "garbage") {
                                        $garbage = $row['garbage'];
                                    }
                                    if ($col == "pdf") {
                                        $file = '';
                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                        $runr = $conn->query($sr);
                                        if ($runr->num_rows > 0) {
                                            $rowr = $runr->fetch_assoc();
                                            $file = $rowr['file'];
                                        }
                                    }
                                }








                            ?>
                                <tr>
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";
                                        if ($col == "bkid") {
                                            echo $id;
                                        }
                                        if ($col == "its") {
                                            echo $its;
                                        }
                                        if ($col == "name") {
                                            echo $name;
                                        }
                                        if ($col == "mobile") {
                                            echo $mobile;
                                        }
                                        if ($col == "jk") {
                                            echo $jk_name;
                                        }
                                        if ($col == "date") {
                                            echo $date;
                                        }
                                        if ($col == "timing") {
                                            echo $label_name;
                                        }
                                        if ($col == "start_time") {
                                            echo $final_start_time;
                                        }
                                        if ($col == "end_time") {
                                            echo $final_end_time;
                                        }
                                        if ($col == "capacity") {
                                            echo $capacity;
                                        }
                                        if ($col == "rent") {
                                            echo $amount;
                                        }
                                        if ($col == "rentp") {
                                            echo $total_rent_paid;
                                        }
                                        if ($col == "rentc") {
                                            echo $total_rent_cleared;
                                        }
                                        if ($col == "admin") {
                                            echo $admin_name;
                                        }
                                        if ($col == "laagat") {
                                            echo $laagat;
                                        }
                                        if ($col == "thaals") {
                                            echo $thaals;
                                        }
                                        if ($col == "purpose") {
                                            echo $purpose;
                                        }
                                        if ($col == "scd") {
                                            echo $scd;
                                        }
                                        if ($col == "m") {
                                            if ($manager_approval == "0") {
                                                echo "In Progress";
                                            }
                                            if ($manager_approval == "1") {
                                                echo "Approved";
                                            }

                                            if ($manager_approval == "2") {
                                                echo "Denied";
                                            }
                                        }
                                        if ($col == "rs") {
                                            if ($rs == "0") {
                                                echo "In Progress";
                                            }
                                            if ($rs == "1") {
                                                echo "Refunded";
                                            }

                                            if ($rs == "2") {
                                                echo "Not Refunded";
                                            }
                                        }
                                        if ($col == "bks") {
                                            if ($status == "1") {
                                                echo "Payment Pending";
                                            }
                                            if ($status == "2") {
                                                echo "Clearance Pending";
                                            }
                                            if ($status == "3") {
                                                echo "Booked";
                                            }

                                            if ($status == "4") {
                                                echo "Cancelled";
                                            }
                                            if ($status == "5") {
                                                echo "Deleted";
                                            }
                                        }
                                        if ($col == "formid") {
                                            echo $formid;
                                        }
                                        if ($col == "garbage") {
                                            echo $garbage;
                                        }
                                        if ($col == "pdf") {
                                            if (empty($file)) {
                                            } else {
                                    ?>
                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                    <?php  }
                                        }

                                        echo "</td>";
                                    }


                                    ?>


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

    $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE mobile='$mobile' ORDER BY date ASC";
    $run = $conn->query($sql);
    $total_booking = $run->num_rows;


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
                                if ($col == "bkid") {
                                    echo "#";
                                }
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
                                if ($col == "pdf") {
                                    echo "Pdf/Images";
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

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {
                                if ($col == "bkid") {
                                    $id = $row['id'];
                                }
                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }
                                if ($col == "jk") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $jk_name = $row4['name'];
                                }
                                if ($col == "date") {
                                    $date = $row['date'];
                                }
                                if ($col == "timing") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT label from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();
                                    $label_name = $row6['label'];
                                }
                                if ($col == "start_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $start_time = $row6['start_time'];
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
                                }
                                if ($col == "end_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $end_time = $row6['end_time'];

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
                                }
                                if ($col == "capacity") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $capacity = $row4['capacity'];
                                }
                                if ($col == "rent") {
                                    $amount = $row['jk_rent'];
                                }
                                if ($col == "rentp") {
                                    $amount = $row['jk_rent'];
                                    $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                    $run7 = $conn->query($s7);
                                    $total_rent_paid = 0;
                                    if ($run7->num_rows > 0) {
                                        while ($row7 = $run7->fetch_assoc()) {
                                            $a = $row7['amount'];
                                            $debit = $row7['debit'];

                                            if ($debit == "1") {
                                                $total_rent_paid = $total_rent_paid + $a;
                                            } else {
                                                $total_rent_paid = $total_rent_paid - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "rentc") {

                                    $amount = $row['jk_rent'];
                                    $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                    $run8 = $conn->query($s8);
                                    $total_rent_cleared = 0;

                                    if ($run8->num_rows > 0) {

                                        while ($row8 = $run8->fetch_assoc()) {
                                            $a = $row8['amount'];
                                            $debit = $row8['debit'];
                                            if ($debit == "1") {
                                                $total_rent_cleared = $total_rent_cleared + $a;
                                            } else {
                                                $total_rent_cleared = $total_rent_cleared - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "admin") {
                                    $adminid = $row['adminid'];
                                    $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                    $runq = $conn->query($sqlq);
                                    $rowq = $runq->fetch_assoc();
                                    $admin_name = $rowq['name'];
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
                                if ($col == "m") {
                                    $manager_approval = $row['manager_approval'];
                                }
                                if ($col == "rs") {
                                    $rs = $row['refund_sc'];
                                }
                                if ($col == "bks") {
                                    $status = $row['status'];
                                }
                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                                if ($col == "pdf") {
                                    $file = '';
                                    $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                    $runr = $conn->query($sr);
                                    if ($runr->num_rows > 0) {
                                        $rowr = $runr->fetch_assoc();
                                        $file = $rowr['file'];
                                    }
                                }
                            }








                        ?>
                            <tr>
                                <?php
                                foreach ($checkbox as $col) {
                                    echo "<td>";
                                    if ($col == "bkid") {
                                        echo $id;
                                    }
                                    if ($col == "its") {
                                        echo $its;
                                    }
                                    if ($col == "name") {
                                        echo $name;
                                    }
                                    if ($col == "mobile") {
                                        echo $mobile;
                                    }
                                    if ($col == "jk") {
                                        echo $jk_name;
                                    }
                                    if ($col == "date") {
                                        echo $date;
                                    }
                                    if ($col == "timing") {
                                        echo $label_name;
                                    }
                                    if ($col == "start_time") {
                                        echo $final_start_time;
                                    }
                                    if ($col == "end_time") {
                                        echo $final_end_time;
                                    }
                                    if ($col == "capacity") {
                                        echo $capacity;
                                    }
                                    if ($col == "rent") {
                                        echo $amount;
                                    }
                                    if ($col == "rentp") {
                                        echo $total_rent_paid;
                                    }
                                    if ($col == "rentc") {
                                        echo $total_rent_cleared;
                                    }
                                    if ($col == "admin") {
                                        echo $admin_name;
                                    }
                                    if ($col == "laagat") {
                                        echo $laagat;
                                    }
                                    if ($col == "thaals") {
                                        echo $thaals;
                                    }
                                    if ($col == "purpose") {
                                        echo $purpose;
                                    }
                                    if ($col == "scd") {
                                        echo $scd;
                                    }
                                    if ($col == "m") {
                                        if ($manager_approval == "0") {
                                            echo "In Progress";
                                        }
                                        if ($manager_approval == "1") {
                                            echo "Approved";
                                        }

                                        if ($manager_approval == "2") {
                                            echo "Denied";
                                        }
                                    }
                                    if ($col == "rs") {
                                        if ($rs == "0") {
                                            echo "In Progress";
                                        }
                                        if ($rs == "1") {
                                            echo "Refunded";
                                        }

                                        if ($rs == "2") {
                                            echo "Not Refunded";
                                        }
                                    }
                                    if ($col == "bks") {
                                        if ($status == "1") {
                                            echo "Payment Pending";
                                        }
                                        if ($status == "2") {
                                            echo "Clearance Pending";
                                        }
                                        if ($status == "3") {
                                            echo "Booked";
                                        }

                                        if ($status == "4") {
                                            echo "Cancelled";
                                        }
                                        if ($status == "5") {
                                            echo "Deleted";
                                        }
                                    }
                                    if ($col == "formid") {
                                        echo $formid;
                                    }
                                    if ($col == "garbage") {
                                        echo $garbage;
                                    }
                                    if ($col == "pdf") {
                                        if (empty($file)) {
                                        } else {
                                ?>
                                            <a href='<?php echo $file ?>' target="_blank">View</a>
                                <?php  }
                                    }

                                    echo "</td>";
                                }


                                ?>


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
        $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=1 ORDER BY date ASC";
    } else {
        $range = $_GET['daterange'];
        list($first, $second) = explode('-', $range);

        list($f_m, $f_d, $f_y) = explode('/', $first);
        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
        $f_first = str_replace(' ', '', $f_first0);

        list($s_m, $s_d, $s_y) = explode('/', $second);
        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
        $f_second = str_replace(' ', '', $f_second0);
        $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=1 AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
    }
    $run = $conn->query($sql);
    $total_booking = $run->num_rows;


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
                                if ($col == "bkid") {
                                    echo "#";
                                }
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
                                if ($col == "pdf") {
                                    echo "Pdf/Images";
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

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $run->fetch_assoc()) {
                            $id = $row['id'];

                            foreach ($checkbox as $col) {
                                if ($col == "bkid") {
                                    $id = $row['id'];
                                }
                                if ($col == "its") {
                                    $its = $row['its'];
                                }
                                if ($col == "name") {
                                    $name = $row['name'];
                                }
                                if ($col == "mobile") {
                                    $mobile = $row['mobile'];
                                }
                                if ($col == "jk") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $jk_name = $row4['name'];
                                }
                                if ($col == "date") {
                                    $date = $row['date'];
                                }
                                if ($col == "timing") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT label from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();
                                    $label_name = $row6['label'];
                                }
                                if ($col == "start_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $start_time = $row6['start_time'];
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
                                }
                                if ($col == "end_time") {
                                    $timings_id = $row['timings_id'];
                                    $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                    $run6 = $conn->query($s6);
                                    $row6 = $run6->fetch_assoc();

                                    $end_time = $row6['end_time'];

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
                                }
                                if ($col == "capacity") {
                                    $jk_id = $row['jk_id'];
                                    $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                    $run4 = $conn->query($s4);
                                    $row4 = $run4->fetch_assoc();
                                    $capacity = $row4['capacity'];
                                }
                                if ($col == "rent") {
                                    $amount = $row['jk_rent'];
                                   
                                }
                                if ($col == "rentp") {
                                    $amount = $row['jk_rent'];
                                    $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                    $run7 = $conn->query($s7);
                                    $total_rent_paid = 0;
                                    if ($run7->num_rows > 0) {
                                        while ($row7 = $run7->fetch_assoc()) {
                                            $a = $row7['amount'];
                                            $debit = $row7['debit'];

                                            if ($debit == "1") {
                                                $total_rent_paid = $total_rent_paid + $a;
                                            } else {
                                                $total_rent_paid = $total_rent_paid - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "rentc") {

                                    $amount = $row['jk_rent'];
                                    $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                    $run8 = $conn->query($s8);
                                    $total_rent_cleared = 0;

                                    if ($run8->num_rows > 0) {

                                        while ($row8 = $run8->fetch_assoc()) {
                                            $a = $row8['amount'];
                                            $debit = $row8['debit'];
                                            if ($debit == "1") {
                                                $total_rent_cleared = $total_rent_cleared + $a;
                                            } else {
                                                $total_rent_cleared = $total_rent_cleared - $a;
                                            }
                                        }
                                    }
                                }
                                if ($col == "admin") {
                                    $adminid = $row['adminid'];
                                    $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                    $runq = $conn->query($sqlq);
                                    $rowq = $runq->fetch_assoc();
                                    $admin_name = $rowq['name'];
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
                                if ($col == "m") {
                                    $manager_approval = $row['manager_approval'];
                                }
                                if ($col == "rs") {
                                    $rs = $row['refund_sc'];
                                }
                                if ($col == "bks") {
                                    $status = $row['status'];
                                }
                                if ($col == "formid") {
                                    $formid = $row['formid'];
                                }
                                if ($col == "garbage") {
                                    $garbage = $row['garbage'];
                                }
                                if ($col == "pdf") {
                                    $file = '';
                                    $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                    $runr = $conn->query($sr);
                                    if ($runr->num_rows > 0) {
                                        $rowr = $runr->fetch_assoc();
                                        $file = $rowr['file'];
                                    }
                                }
                            }








                        ?>
                            <tr>
                                <?php
                                foreach ($checkbox as $col) {
                                    echo "<td>";
                                    if ($col == "bkid") {
                                        echo $id;
                                    }
                                    if ($col == "its") {
                                        echo $its;
                                    }
                                    if ($col == "name") {
                                        echo $name;
                                    }
                                    if ($col == "mobile") {
                                        echo $mobile;
                                    }
                                    if ($col == "jk") {
                                        echo $jk_name;
                                    }
                                    if ($col == "date") {
                                        echo $date;
                                    }
                                    if ($col == "timing") {
                                        echo $label_name;
                                    }
                                    if ($col == "start_time") {
                                        echo $final_start_time;
                                    }
                                    if ($col == "end_time") {
                                        echo $final_end_time;
                                    }
                                    if ($col == "capacity") {
                                        echo $capacity;
                                    }
                                    if ($col == "rent") {
                                        echo $amount;
                                    }
                                    if ($col == "rentp") {
                                        echo $total_rent_paid;
                                    }
                                    if ($col == "rentc") {
                                        echo $total_rent_cleared;
                                    }
                                    if ($col == "admin") {
                                        echo $admin_name;
                                    }
                                    if ($col == "laagat") {
                                        echo $laagat;
                                    }
                                    if ($col == "thaals") {
                                        echo $thaals;
                                    }
                                    if ($col == "purpose") {
                                        echo $purpose;
                                    }
                                    if ($col == "scd") {
                                        echo $scd;
                                    }
                                    if ($col == "m") {
                                        if ($manager_approval == "0") {
                                            echo "In Progress";
                                        }
                                        if ($manager_approval == "1") {
                                            echo "Approved";
                                        }

                                        if ($manager_approval == "2") {
                                            echo "Denied";
                                        }
                                    }
                                    if ($col == "rs") {
                                        if ($rs == "0") {
                                            echo "In Progress";
                                        }
                                        if ($rs == "1") {
                                            echo "Refunded";
                                        }

                                        if ($rs == "2") {
                                            echo "Not Refunded";
                                        }
                                    }
                                    if ($col == "bks") {
                                        if ($status == "1") {
                                            echo "Payment Pending";
                                        }
                                        if ($status == "2") {
                                            echo "Clearance Pending";
                                        }
                                        if ($status == "3") {
                                            echo "Booked";
                                        }

                                        if ($status == "4") {
                                            echo "Cancelled";
                                        }
                                        if ($status == "5") {
                                            echo "Deleted";
                                        }
                                    }
                                    if ($col == "formid") {
                                        echo $formid;
                                    }
                                    if ($col == "garbage") {
                                        echo $garbage;
                                    }
                                    if ($col == "pdf") {
                                        if (empty($file)) {
                                        } else {
                                ?>
                                            <a href='<?php echo $file ?>' target="_blank">View</a>
                                <?php  }
                                    }

                                    echo "</td>";
                                }


                                ?>


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
if (isset($_GET['jk_id']) and $_GET['type'] == "5") {
    $jk_id = $_GET['jk_id'];
    if ($jk_id == "0") {
        $sql = "SELECT jk_id,timings_id,date,label from blocked";
    } else {
        $sql = "SELECT jk_id,timings_id,date,label from blocked WHERE jk_id=$jk_id";
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
                            <th>Jamaat Khaana Name</th>
                            <th>Block Date</th>
                            <th>Timing</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $run->fetch_assoc()) {
                            $jk = $row['jk_id'];
                            $timings_id = $row['timings_id'];
                            $date = $row['date'];
                            $reason = $row['label'];
                            $s4 = "SELECT name from jk_info WHERE id=$jk";
                            $run4 = $conn->query($s4);
                            $row4 = $run4->fetch_assoc();
                            $jk_name = $row4['name'];

                            $s6 = "SELECT label,start_time,end_time from timings WHERE id=$timings_id";
                            $run6 = $conn->query($s6);
                            $row6 = $run6->fetch_assoc();
                            $label_name = $row6['label'];

                            $start_time = $row6['start_time'];
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

                            $end_time = $row6['end_time'];

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
                            <tr>
                                <td><?php echo $jk_name ?></td>
                                <td><?php echo $date ?></td>
                                <td><?php echo $label_name ?></td>
                                <td><?php echo $final_start_time ?></td>
                                <td><?php echo $final_end_time ?></td>
                                <td><?php echo $reason ?></td>
                            </tr>
                        <?php   }
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
                            $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                        } else if ($jk_id != "0" && $status == "0") {

                            $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE jk_id=$jk_id AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                        } else if ($jk_id == "0" && $status != "0") {

                            if ($status == "5") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=3 AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "6") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE (status!=4 AND status!=5) AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "7") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=5 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=$status AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            }
                        } else if ($jk_id != "0" && $status != "0") {
                            if ($status == "5") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=3 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "6") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE (status!=4 AND status!=5) AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else  if ($status == "7") {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=5 AND jk_id=$jk_id AND laagat='' AND thaals='' AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
                            } else {
                                $sql = "SELECT id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage,jk_rent from booking_info WHERE status=$status AND jk_id=$jk_id  AND (date>='$f_first' AND date<='$f_second') ORDER BY date ASC";
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
                                                    if ($col == "bkid") {
                                                        echo "#";
                                                    }
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
                                                    if ($col == "pdf") {
                                                        echo "Pdf/Images";
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

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];

                                                foreach ($checkbox as $col) {
                                                    if ($col == "bkid") {
                                                        $id = $row['id'];
                                                    }
                                                    if ($col == "its") {
                                                        $its = $row['its'];
                                                    }
                                                    if ($col == "name") {
                                                        $name = $row['name'];
                                                    }
                                                    if ($col == "mobile") {
                                                        $mobile = $row['mobile'];
                                                    }
                                                    if ($col == "jk") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $jk_name = $row4['name'];
                                                    }
                                                    if ($col == "date") {
                                                        $date = $row['date'];
                                                    }
                                                    if ($col == "timing") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();
                                                        $label_name = $row6['label'];
                                                    }
                                                    if ($col == "start_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $start_time = $row6['start_time'];
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
                                                    }
                                                    if ($col == "end_time") {
                                                        $timings_id = $row['timings_id'];
                                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                                        $run6 = $conn->query($s6);
                                                        $row6 = $run6->fetch_assoc();

                                                        $end_time = $row6['end_time'];

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
                                                    }
                                                    if ($col == "capacity") {
                                                        $jk_id = $row['jk_id'];
                                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                                        $run4 = $conn->query($s4);
                                                        $row4 = $run4->fetch_assoc();
                                                        $capacity = $row4['capacity'];
                                                    }
                                                    if ($col == "rent") {
                                                        $amount = $row['jk_rent'];
                                                    }
                                                    if ($col == "rentp") {
                                                        $amount = $row['jk_rent'];
                                                        $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                                        $run7 = $conn->query($s7);
                                                        $total_rent_paid = 0;
                                                        if ($run7->num_rows > 0) {
                                                            while ($row7 = $run7->fetch_assoc()) {
                                                                $a = $row7['amount'];
                                                                $debit = $row7['debit'];
                
                                                                if ($debit == "1") {
                                                                    $total_rent_paid = $total_rent_paid + $a;
                                                                } else {
                                                                    $total_rent_paid = $total_rent_paid - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "rentc") {

                                                        $amount = $row['jk_rent'];
                                                        $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                                        $run8 = $conn->query($s8);
                                                        $total_rent_cleared = 0;
                
                                                        if ($run8->num_rows > 0) {
                
                                                            while ($row8 = $run8->fetch_assoc()) {
                                                                $a = $row8['amount'];
                                                                $debit = $row8['debit'];
                                                                if ($debit == "1") {
                                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                                } else {
                                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($col == "admin") {
                                                        $adminid = $row['adminid'];
                                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                                        $runq = $conn->query($sqlq);
                                                        $rowq = $runq->fetch_assoc();
                                                        $admin_name = $rowq['name'];
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
                                                    if ($col == "m") {
                                                        $manager_approval = $row['manager_approval'];
                                                    }
                                                    if ($col == "rs") {
                                                        $rs = $row['refund_sc'];
                                                    }
                                                    if ($col == "bks") {
                                                        $status = $row['status'];
                                                    }
                                                    if ($col == "formid") {
                                                        $formid = $row['formid'];
                                                    }
                                                    if ($col == "garbage") {
                                                        $garbage = $row['garbage'];
                                                    }
                                                    if ($col == "pdf") {
                                                        $file = '';
                                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                                        $runr = $conn->query($sr);
                                                        if ($runr->num_rows > 0) {
                                                            $rowr = $runr->fetch_assoc();
                                                            $file = $rowr['file'];
                                                        }
                                                    }
                                                }








                                            ?>
                                                <tr>
                                                    <?php
                                                    foreach ($checkbox as $col) {
                                                        echo "<td>";
                                                        if ($col == "bkid") {
                                                            echo $id;
                                                        }
                                                        if ($col == "its") {
                                                            echo $its;
                                                        }
                                                        if ($col == "name") {
                                                            echo $name;
                                                        }
                                                        if ($col == "mobile") {
                                                            echo $mobile;
                                                        }
                                                        if ($col == "jk") {
                                                            echo $jk_name;
                                                        }
                                                        if ($col == "date") {
                                                            echo $date;
                                                        }
                                                        if ($col == "timing") {
                                                            echo $label_name;
                                                        }
                                                        if ($col == "start_time") {
                                                            echo $final_start_time;
                                                        }
                                                        if ($col == "end_time") {
                                                            echo $final_end_time;
                                                        }
                                                        if ($col == "capacity") {
                                                            echo $capacity;
                                                        }
                                                        if ($col == "rent") {
                                                            echo $amount;
                                                        }
                                                        if ($col == "rentp") {
                                                            echo $total_rent_paid;
                                                        }
                                                        if ($col == "rentc") {
                                                            echo $total_rent_cleared;
                                                        }
                                                        if ($col == "admin") {
                                                            echo $admin_name;
                                                        }
                                                        if ($col == "laagat") {
                                                            echo $laagat;
                                                        }
                                                        if ($col == "thaals") {
                                                            echo $thaals;
                                                        }
                                                        if ($col == "purpose") {
                                                            echo $purpose;
                                                        }
                                                        if ($col == "scd") {
                                                            echo $scd;
                                                        }
                                                        if ($col == "m") {
                                                            if ($manager_approval == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($manager_approval == "1") {
                                                                echo "Approved";
                                                            }

                                                            if ($manager_approval == "2") {
                                                                echo "Denied";
                                                            }
                                                        }
                                                        if ($col == "rs") {
                                                            if ($rs == "0") {
                                                                echo "In Progress";
                                                            }
                                                            if ($rs == "1") {
                                                                echo "Refunded";
                                                            }

                                                            if ($rs == "2") {
                                                                echo "Not Refunded";
                                                            }
                                                        }
                                                        if ($col == "bks") {
                                                            if ($status == "1") {
                                                                echo "Payment Pending";
                                                            }
                                                            if ($status == "2") {
                                                                echo "Clearance Pending";
                                                            }
                                                            if ($status == "3") {
                                                                echo "Booked";
                                                            }

                                                            if ($status == "4") {
                                                                echo "Cancelled";
                                                            }
                                                            if ($status == "5") {
                                                                echo "Deleted";
                                                            }
                                                        }
                                                        if ($col == "formid") {
                                                            echo $formid;
                                                        }
                                                        if ($col == "garbage") {
                                                            echo $garbage;
                                                        }
                                                        if ($col == "pdf") {
                                                            if (empty($file)) {
                                                            } else {
                                                    ?>
                                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                                    <?php  }
                                                        }

                                                        echo "</td>";
                                                    }


                                                    ?>


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
                    if (isset($_GET['id']) && $_GET['type'] == "7") {
                        $id = $_GET['id'];
                        $checkbox = $_GET['checkbox'];

                        $sql = "SELECT jk_rent,id,its,name,mobile,jk_id,date,timings_id,adminid,laagat,thaals,purpose,sc_deposit,manager_approval,refund_sc,status,formid,garbage from booking_info WHERE id=$id ORDER BY date ASC";
                        $run = $conn->query($sql);
                        $total_booking = $run->num_rows;


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
                                    if ($col == "bkid") {
                                        echo "#";
                                    }
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
                                    if ($col == "pdf") {
                                        echo "Pdf/Images";
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

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = $run->fetch_assoc()) {
                                $id = $row['id'];

                                foreach ($checkbox as $col) {
                                    if ($col == "bkid") {
                                        $id = $row['id'];
                                    }
                                    if ($col == "its") {
                                        $its = $row['its'];
                                    }
                                    if ($col == "name") {
                                        $name = $row['name'];
                                    }
                                    if ($col == "mobile") {
                                        $mobile = $row['mobile'];
                                    }
                                    if ($col == "jk") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT name from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $jk_name = $row4['name'];
                                    }
                                    if ($col == "date") {
                                        $date = $row['date'];
                                    }
                                    if ($col == "timing") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT label from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();
                                        $label_name = $row6['label'];
                                    }
                                    if ($col == "start_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT start_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $start_time = $row6['start_time'];
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
                                    }
                                    if ($col == "end_time") {
                                        $timings_id = $row['timings_id'];
                                        $s6 = "SELECT end_time from timings WHERE id=$timings_id";
                                        $run6 = $conn->query($s6);
                                        $row6 = $run6->fetch_assoc();

                                        $end_time = $row6['end_time'];

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
                                    }
                                    if ($col == "capacity") {
                                        $jk_id = $row['jk_id'];
                                        $s4 = "SELECT capacity from jk_info WHERE id=$jk_id";
                                        $run4 = $conn->query($s4);
                                        $row4 = $run4->fetch_assoc();
                                        $capacity = $row4['capacity'];
                                    }
                                    if ($col == "rent") {
                                        $jk_rent = $row['jk_rent'];
                                    }
                                    if ($col == "rentp") {
                                        $amount = $row['jk_rent'];
                                        $s7 = "SELECT amount,debit from ledger2 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id  AND (status=0 OR status=1) AND (type=0 OR type=5)";
                                        $run7 = $conn->query($s7);
                                        $total_rent_paid = 0;
                                        if ($run7->num_rows > 0) {
                                            while ($row7 = $run7->fetch_assoc()) {
                                                $a = $row7['amount'];
                                                $debit = $row7['debit'];

                                                if ($debit == "1") {
                                                    $total_rent_paid = $total_rent_paid + $a;
                                                } else {
                                                    $total_rent_paid = $total_rent_paid - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "rentc") {
                                        $amount = $row['jk_rent'];
                                        $s8 = "SELECT amount,debit from ledger2 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) UNION ALL SELECT amount,debit from ledger3 WHERE bk_id=$id AND status=1 AND (type=0 OR type=5) ";
                                        $run8 = $conn->query($s8);
                                        $total_rent_cleared = 0;

                                        if ($run8->num_rows > 0) {

                                            while ($row8 = $run8->fetch_assoc()) {
                                                $a = $row8['amount'];
                                                $debit = $row8['debit'];
                                                if ($debit == "1") {
                                                    $total_rent_cleared = $total_rent_cleared + $a;
                                                } else {
                                                    $total_rent_cleared = $total_rent_cleared - $a;
                                                }
                                            }
                                        }
                                    }
                                    if ($col == "admin") {
                                        $adminid = $row['adminid'];
                                        $sqlq = "SELECT name from web_login WHERE id=$adminid ";
                                        $runq = $conn->query($sqlq);
                                        $rowq = $runq->fetch_assoc();
                                        $admin_name = $rowq['name'];
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
                                    if ($col == "m") {
                                        $manager_approval = $row['manager_approval'];
                                    }
                                    if ($col == "rs") {
                                        $rs = $row['refund_sc'];
                                    }
                                    if ($col == "bks") {
                                        $status = $row['status'];
                                    }
                                    if ($col == "formid") {
                                        $formid = $row['formid'];
                                    }
                                    if ($col == "garbage") {
                                        $garbage = $row['garbage'];
                                    }
                                    if ($col == "pdf") {
                                        $file = '';
                                        $sr = "SELECT file from ledger WHERE booking_id=$id AND file!=''";
                                        $runr = $conn->query($sr);
                                        if ($runr->num_rows > 0) {
                                            $rowr = $runr->fetch_assoc();
                                            $file = $rowr['file'];
                                        }
                                    }
                                }








                            ?>
                                <tr>
                                    <?php
                                    foreach ($checkbox as $col) {
                                        echo "<td>";
                                        if ($col == "bkid") {
                                            echo $id;
                                        }
                                        if ($col == "its") {
                                            echo $its;
                                        }
                                        if ($col == "name") {
                                            echo $name;
                                        }
                                        if ($col == "mobile") {
                                            echo $mobile;
                                        }
                                        if ($col == "jk") {
                                            echo $jk_name;
                                        }
                                        if ($col == "date") {
                                            echo $date;
                                        }
                                        if ($col == "timing") {
                                            echo $label_name;
                                        }
                                        if ($col == "start_time") {
                                            echo $final_start_time;
                                        }
                                        if ($col == "end_time") {
                                            echo $final_end_time;
                                        }
                                        if ($col == "capacity") {
                                            echo $capacity;
                                        }
                                        if ($col == "rent") {
                                            echo $jk_rent;
                                        }
                                        if ($col == "rentp") {
                                            echo $total_rent_paid;
                                        }
                                        if ($col == "rentc") {
                                            echo $total_rent_cleared;
                                        }
                                        if ($col == "admin") {
                                            echo $admin_name;
                                        }
                                        if ($col == "laagat") {
                                            echo $laagat;
                                        }
                                        if ($col == "thaals") {
                                            echo $thaals;
                                        }
                                        if ($col == "purpose") {
                                            echo $purpose;
                                        }
                                        if ($col == "scd") {
                                            echo $scd;
                                        }
                                        if ($col == "m") {
                                            if ($manager_approval == "0") {
                                                echo "In Progress";
                                            }
                                            if ($manager_approval == "1") {
                                                echo "Approved";
                                            }

                                            if ($manager_approval == "2") {
                                                echo "Denied";
                                            }
                                        }
                                        if ($col == "rs") {
                                            if ($rs == "0") {
                                                echo "In Progress";
                                            }
                                            if ($rs == "1") {
                                                echo "Refunded";
                                            }

                                            if ($rs == "2") {
                                                echo "Not Refunded";
                                            }
                                        }
                                        if ($col == "bks") {
                                            if ($status == "1") {
                                                echo "Payment Pending";
                                            }
                                            if ($status == "2") {
                                                echo "Clearance Pending";
                                            }
                                            if ($status == "3") {
                                                echo "Booked";
                                            }

                                            if ($status == "4") {
                                                echo "Cancelled";
                                            }
                                            if ($status == "5") {
                                                echo "Deleted";
                                            }
                                        }
                                        if ($col == "formid") {
                                            echo $formid;
                                        }
                                        if ($col == "garbage") {
                                            echo $garbage;
                                        }
                                        if ($col == "pdf") {
                                            if (empty($file)) {
                                            } else {
                                    ?>
                                                <a href='<?php echo $file ?>' target="_blank">View</a>
                                    <?php  }
                                        }

                                        echo "</td>";
                                    }


                                    ?>


                                </tr>
                            <?php     }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="card ml-4 mb-4" style="width: 100%;">
                <div class=" card-header">Ledger</div>
                <div class=" card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Trust</th>
                                    <th>Mode</th>

                                    <th>Debit</th>

                                    <th>Credit</th>
                                    <th>Check Number</th>
                                    <th>Status</th>
                                    <th>Clearance Date</th>
                                    <th>View</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $s1 = "SELECT id,amount,check_number,account_number,debit,status,credit,pay_mode,c_date,check_cleared_date,trust_id,type from ledger2 WHERE bk_id=$id UNION ALL SELECT id,amount,check_number,account_number,debit,status,credit,pay_mode,c_date,check_cleared_date,trust_id,type from ledger3 WHERE bk_id=$id ORDER BY c_date DESC";
                                $run1 = $conn->query($s1);
                                if ($run1->num_rows > 0) {
                                    while ($row1 = $run1->fetch_assoc()) {
                                        $amount = $row1['amount'];
                                        $cn = $row1['check_number'];
                                        $an = $row1['account_number'];
                                        $status = $row1['status'];
                                        $debit = $row1['debit'];
                                        $credit = $row1['credit'];
                                        $pay_mode = $row1['pay_mode'];
                                        $date = $row1['c_date'];
                                        $trust_id = $row1['trust_id'];
                                        $cl_date = $row1['check_cleared_date'];
                                        $type = $row1['type'];
                                        $bk_id = $id;
                                        $ledger_id = $row1['id'];
                                        $counter = 1;



                                ?>
                                        <tr>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $trust_id ?></td>
                                            <td><?php if ($pay_mode == "0") {
                                                    echo "Cheque";
                                                } else {
                                                    echo "Cash";
                                                } ?></td>

                                            <td><?php if ($debit == "1") {
                                                    echo $amount;
                                                } else {
                                                    echo "-";
                                                } ?></td>
                                            <td><?php if ($credit == "1") {
                                                    echo $amount;
                                                } else {
                                                    echo "-";
                                                } ?></td>

                                            <td><?php echo $cn ?></td>

                                            <td><?php
                                                if ($status == "0") {
                                                    echo "Clearance Pending";
                                                }
                                                if ($status == "1") {
                                                    echo "Cleared";
                                                }
                                                if ($status == "2") {
                                                    echo "Failed";
                                                }
                                                if ($status == "3") {
                                                    echo "Deleted";
                                                }

                                                ?></td>
                                            <td><?php echo $cl_date ?></td>
                                            <td><a href="<?php
                                                            if ($type == "0") {
                                                                if ($trust_id == 1) {
                                                                    $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $counter = 0;
                                                                    }
                                                                } else {
                                                                    $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        $counter = 0;
                                                                    }
                                                                }
                                                                if ($counter == 1) {
                                                                    echo "receipt_view.php?type=0&br=1&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                                }
                                                            }
                                                            if ($type == "1") {
                                                                if ($trust_id == 1) {
                                                                    $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        // $counter = 0;
                                                                    }
                                                                } else {
                                                                    $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        //  $counter = 0;
                                                                    }
                                                                }
                                                                echo "receipt_view.php?type=1&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                            }
                                                            if ($type == "2") {
                                                                if ($trust_id == 1) {
                                                                    $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        // $counter = 0;
                                                                    }
                                                                } else {
                                                                    $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        //  $counter = 0;
                                                                    }
                                                                }
                                                                echo "receipt_view.php?type=2&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                            }
                                                            if ($type == "3") {
                                                                if ($trust_id == 1) {
                                                                    $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        // $counter = 0;
                                                                    }
                                                                } else {
                                                                    $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        //  $counter = 0;
                                                                    }
                                                                }
                                                                echo "receipt_view.php?type=3&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                            }
                                                            if ($type == "4") {
                                                                if ($trust_id == 1) {
                                                                    $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        // $counter = 0;
                                                                    }
                                                                } else {
                                                                    $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2 = $conn->query($d2);
                                                                    if ($rund2->num_rows > 0) {
                                                                        $rowd2 = $rund2->fetch_assoc();
                                                                        $receipt_id = $rowd2['id'];
                                                                    } else {
                                                                        // $counter = 0;
                                                                    }
                                                                }
                                                                $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                                                                $run12 = $conn->query($s12);
                                                                $row12 = $run12->fetch_assoc();
                                                                $purpose_misc = $row12['purpose'];
                                                                echo "receipt_view.php?type=4&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                            }
                                                            if ($type == "5") {
                                                                if ($trust_id == 1) {
                                                                    $d2q = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                                                    $rund2q = $conn->query($d2q);
                                                                    if ($rund2q->num_rows > 0) {
                                                                        $rowd2q = $rund2q->fetch_assoc();
                                                                        $voucher_id = $rowd2q['id'];
                                                                    } else {
                                                                    }
                                                                } else {
                                                                    $d2q = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                                                    $rund2q = $conn->query($d2q);
                                                                    if ($rund2q->num_rows > 0) {
                                                                        $rowd2q = $rund2q->fetch_assoc();
                                                                        $voucher_id = $rowd2q['id'];
                                                                    } else {
                                                                    }
                                                                }
                                                                echo "voucher_view.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit";
                                                            }

                                                            ?>" target="_blank">View</a></td>

                                        </tr>
                                <?php     }
                                }


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
                    if (isset($_GET['type']) && $_GET['type'] == "8") {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);

                        $c_ledger = $_GET['c_ledger'];
                        $c_ledger1 = $_GET['c_ledger_1'];
                        if ($c_ledger1 == "2") {

                            if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1  AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=2 AND  (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1 AND type=$c_ledger1   AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        } else {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1  AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=1 AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=1 AND type=$c_ledger1 AND type!=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=1 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        }
                        $flag = 0;
                        if (in_array(38, $forms_access) || in_array(49, $forms_access)) {
                            $flag = 1;
                        }
                        $run = $conn->query($sql);
?>

    <div class="row">
        <div class="card ml-4 mb-4" style="width: 100%;">
            <div class=" card-header">Cash Ledger</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Debit</th>

                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Receipt</th>
                                <?php
                                if ($flag == 1) {
                                ?>
                                    <th>Edit</th>
                                <?php

                                }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = $run->fetch_assoc()) {
                                $amount = $row['amount'];
                                $time = $row['time'];
                                $name = $row['name'];
                                $ledger_id = $row['id'];
                                $bk_id = $row['bk_id'];
                                $debit = $row['debit'];
                                $credit = $row['credit'];
                                $date = $row['c_date'];
                                $type = $row['type'];
                                $id = $row['id'];
                                $trust_id = $row['trust_id'];
                                $status = $row['status'];

                                if ($type == 5) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                }


                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php if ($bk_id == "0" || $type == "5") {
                                            echo $name . " (" . $bk_id . ")";
                                        } else {
                                            $s1 = "SELECT name from booking_info WHERE id=$bk_id";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $name1 = $row1['name'] . " (" . $bk_id . ")";
                                        } ?></td>
                                    <td><?php
                                        if ($type == "0") {
                                            $s11 = "SELECT purpose from booking_info WHERE id=$bk_id";
                                            $run11 = $conn->query($s11);
                                            $row11 = $run11->fetch_assoc();
                                            echo $purpose = $row11['purpose'];
                                        }
                                        if ($type == "1") {
                                            echo "Security Deposit";
                                        }
                                        if ($type == "2") {
                                            echo "Refund Security Deposit";
                                        }
                                        if ($type == "3") {
                                            echo "Garbage";
                                        }
                                        if ($type == "4") {
                                            echo "Miscellaneous";
                                        }
                                        if ($type == "5") {
                                            echo "Payment Voucher";
                                        }

                                        ?></td>

                                    <td style="color: #000000;"><b><?php if ($credit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>
                                    <td style="color: #000000;"><b><?php if ($debit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>

                                    <td style="color: #000000;"><b><?php
                                                                    if ($status == "3") {
                                                                        echo "Deleted";
                                                                    } else if ($status == "4") {
                                                                        echo "Previous Entry";
                                                                    } else {

                                                                        if ($debit == "1") {
                                                                            echo $sum = $sum + $amount;
                                                                        } else {
                                                                            echo $sum = $sum - $amount;
                                                                        }
                                                                    }

                                                                    ?></b></td>
                                    <td><a href="<?php
                                                    if ($type == "0") {
                                                        echo "receipt.php?name=Cash&bk_id=" . $bk_id;
                                                    }
                                                    if ($type == "1") {
                                                        echo "receipt.php?name=SDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "2") {
                                                        echo "receipt.php?name=RSDA&ID=" . $bk_id;
                                                    }
                                                    if ($type == "3") {
                                                        echo "receipt.php?name=G&ID=" . $bk_id;
                                                    }
                                                    if ($type == "4") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt.php?name=MISC&date=" . $date . "&time=" . $time . "&name_user=" . $name . "&amount=" . $amount . "&purpose=" . $purpose_misc . "&trust_id=" . $trust_id;
                                                    }
                                                    if ($type == "5") {

                                                        echo "voucher_view.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit";
                                                    }

                                                    ?>" target="_blank">View</a></td>
                                    <?php
                                    if ($flag == 1) {
                                        if ($type != 5) { ?>
                                            <td><a href="<?php echo "receipt_edit.php?trust_id=" . $trust_id . "&type=" . $type . "&receipt_id=" . $receipt_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                        <?php
                                        } else {
                                        ?>
                                            <td><a href="<?php echo "voucher_edit.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                    <?php
                                        }
                                    }
                                    ?>

                                </tr>
                            <?php     }



                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
                    }
                    if (isset($_GET['type']) && $_GET['type'] == "9") {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);
                        $c_ledger = $_GET['c_ledger'];
                        $c_ledger1 = $_GET['c_ledger_1'];

                        if ($c_ledger1 == "2") {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger2
                            WHERE pay_mode=0 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger3
                            WHERE pay_mode=0  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger2
                            WHERE pay_mode=0 AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger3
                            WHERE pay_mode=0 AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            }
                        } else {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger2
                            WHERE pay_mode=0 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger3
                            WHERE pay_mode=0  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger2
                            WHERE pay_mode=0 AND type=$c_ledger1 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            UNION ALL
                            SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id FROM ledger3
                            WHERE pay_mode=0 AND type=$c_ledger1  AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second') AND type!=2  AND status!=4
                            ORDER BY check_cleared_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger2 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,check_cleared_date,debit,credit,amount,name,time,check_number,account_number,type,status,trust_id from ledger3 WHERE pay_mode=0 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (check_cleared_date>='$f_first' AND check_cleared_date<='$f_second')  AND status!=4 ORDER BY check_cleared_date,time ASC";
                                }
                            }
                        }
                        $flag = 0;
                        if (in_array(38, $forms_access) || in_array(49, $forms_access)) {
                            $flag = 1;
                        }
                        $run = $conn->query($sql);
?>

    <div class="row">
        <div class="card ml-4 mb-4" style="width: 100%;">
            <div class=" card-header">Cheque Ledger</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Cheque Number</th>
                                <th>Account Number</th>
                                <th>Debit</th>

                                <th>Credit</th>

                                <th>Balance</th>
                                <th>Receipt</th>
                                <?php
                                if ($flag == 1) { ?>
                                    <th>Edit</th>
                                <?php

                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = $run->fetch_assoc()) {
                                $amount = $row['amount'];
                                $time = $row['time'];
                                $name = $row['name'];
                                $bk_id = $row['bk_id'];
                                $debit = $row['debit'];
                                $credit = $row['credit'];
                                $date = $row['check_cleared_date'];
                                $cn = $row['check_number'];
                                $an = $row['account_number'];
                                $ledger_id = $row['id'];
                                $type = $row['type'];
                                $status = $row['status'];
                                $trust_id = $row['trust_id'];

                                if ($type == 0) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                            $counter = 0;
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                            $counter = 0;
                                        }
                                    }
                                } else if ($type == 1) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 2) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 3) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 4) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 5) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                }



                            ?>
                                <tr>
                                    <td><?php echo $receipt_id ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php if ($bk_id == "0" || $type == "5") {
                                            echo $name . " (" . $bk_id . ")";
                                        } else {
                                            $s1 = "SELECT name from booking_info WHERE id=$bk_id";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $name1 = $row1['name'] . " (" . $bk_id . ")";
                                        } ?></td>
                                    <td><?php if ($type == "0") {
                                            $s11 = "SELECT purpose from booking_info WHERE id=$bk_id";
                                            $run11 = $conn->query($s11);
                                            $row11 = $run11->fetch_assoc();
                                            echo $purpose = $row11['purpose'];
                                        }
                                        if ($type == "1") {
                                            echo "Security Deposit";
                                        }
                                        if ($type == "2") {
                                            echo "Refund Security Deposit";
                                        }
                                        if ($type == "3") {
                                            echo "Garbage";
                                        }
                                        if ($type == "4") {
                                            echo "Miscellaneous";
                                        }
                                        if ($type == "5") {
                                            echo "Payment Voucher";
                                        } ?></td>

                                    <td><?php echo $cn ?></td>
                                    <td><?php echo $an  ?></td>
                                    <td style="color: #000000;"><b><?php if ($credit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>
                                    <td style="color: #000000;"><b><?php if ($debit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>
                                    <td style="color: #000000;"><b><?php
                                                                    if ($status == "3") {
                                                                        echo "Deleted";
                                                                    } else if ($status == "4") {
                                                                        echo "Previous Entry";
                                                                    } else {
                                                                        if ($debit == "1") {
                                                                            echo $sum = $sum + $amount;
                                                                        } else {
                                                                            echo $sum = $sum - $amount;
                                                                        }
                                                                    }

                                                                    ?></b></td>
                                    <td><a href="<?php
                                                    if ($type == "0") {
                                                        echo "receipt_view.php?type=0&br=1&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "1") {
                                                        echo "receipt_view.php?type=1&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "2") {
                                                        echo "receipt_view.php?type=2&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "3") {
                                                        echo "receipt_view.php?type=3&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "4") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt_view.php?type=4&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "5") {

                                                        echo "voucher_view.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit";
                                                    }
                                                    ?>" target="_blank">View</a></td>
                                    <?php
                                    if ($flag == 1) {
                                        if ($type != 5) { ?>
                                            <td><a href="<?php echo "receipt_edit.php?trust_id=" . $trust_id . "&type=" . $type . "&receipt_id=" . $receipt_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                        <?php
                                        } else {
                                        ?>
                                            <td><a href="<?php echo "voucher_edit.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                    <?php
                                        }
                                    }

                                    ?>

                                </tr>
                            <?php     }



                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
                    }
                    if (isset($_GET['type']) && $_GET['type'] == "10") {
                        $range = $_GET['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);

                        $c_ledger = $_GET['c_ledger'];
                        $c_ledger1 = $_GET['c_ledger_1'];
                        if ($c_ledger1 == "2") {

                            if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND type=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=2 AND  (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=2 AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=2 AND type=$c_ledger1   AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=$c_ledger1  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        } else {

                            if ($c_ledger == "0" && $c_ledger1 == "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND type!=2 AND status!=4
                            ORDER BY c_date,time ASC";
                            } else if ($c_ledger != "0" && $c_ledger1 == "6") {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=2 AND trust_id=$c_ledger  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=2 AND trust_id=$c_ledger  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            } else if ($c_ledger == "0" && $c_ledger1 != "6") {
                                $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger2
                            WHERE pay_mode=2 AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            UNION ALL
                            SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status FROM ledger3
                            WHERE pay_mode=2 AND type=$c_ledger1 AND type!=2  AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4
                            ORDER BY c_date,time ASC";
                            } else {
                                if ($c_ledger == "1") {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger2 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                } else {
                                    $sql = "SELECT id,bk_id,c_date,debit,credit,amount,name,time,type,trust_id,status from ledger3 WHERE pay_mode=2 AND trust_id=$c_ledger AND type=$c_ledger1 AND type!=2 AND (c_date>='$f_first' AND c_date<='$f_second') AND status!=4 ORDER BY c_date,time ASC";
                                }
                            }
                        }
                        $flag = 0;
                        if (in_array(38, $forms_access) || in_array(49, $forms_access)) {
                            $flag = 1;
                        }
                        $run = $conn->query($sql);
?>

    <div class="row">
        <div class="card ml-4 mb-4" style="width: 100%;">
            <div class=" card-header">Online Txn Ledger</div>
            <div class=" card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="5px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Debit</th>

                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Receipt</th>
                                <?php
                                if ($flag == 1) {
                                ?>
                                    <th>Edit</th>
                                <?php

                                }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = $run->fetch_assoc()) {
                                $amount = $row['amount'];
                                $time = $row['time'];
                                $name = $row['name'];
                                $ledger_id = $row['id'];
                                $bk_id = $row['bk_id'];
                                $debit = $row['debit'];
                                $credit = $row['credit'];
                                $date = $row['c_date'];
                                $type = $row['type'];
                                $ledger_id = $row['id'];
                                $trust_id = $row['trust_id'];
                                $status = $row['status'];


                                if ($type == 0) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_hr_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                            $counter = 0;
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_hr_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                            $counter = 0;
                                        }
                                    }
                                } else if ($type == 1) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_sd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 2) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_rsd WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 3) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_garbage WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 4) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from receipt_misc_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from receipt_misc_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $receipt_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                } else if ($type == 5) {
                                    if ($trust_id == 1) {
                                        $d2 = "SELECT id from voucher_ht WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    } else {
                                        $d2 = "SELECT id from voucher_mt WHERE ledger_id=$ledger_id";
                                        $rund2 = $conn->query($d2);
                                        if ($rund2->num_rows > 0) {
                                            $rowd2 = $rund2->fetch_assoc();
                                            $voucher_id = $rowd2['id'];
                                        } else {
                                        }
                                    }
                                }



                            ?>
                                <tr>
                                    <td><?php echo $receipt_id ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td><?php if ($bk_id == "0" || $type == "5") {
                                            echo $name . " (" . $bk_id . ")";
                                        } else {
                                            $s1 = "SELECT name from booking_info WHERE id=$bk_id";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $name1 = $row1['name'] . " (" . $bk_id . ")";
                                        } ?></td>
                                    <td><?php
                                        if ($type == "0") {
                                            $s11 = "SELECT purpose from booking_info WHERE id=$bk_id";
                                            $run11 = $conn->query($s11);
                                            $row11 = $run11->fetch_assoc();
                                            echo $purpose = $row11['purpose'];
                                        }
                                        if ($type == "1") {
                                            echo "Security Deposit";
                                        }
                                        if ($type == "2") {
                                            echo "Refund Security Deposit";
                                        }
                                        if ($type == "3") {
                                            echo "Garbage";
                                        }
                                        if ($type == "4") {
                                            echo "Miscellaneous";
                                        }
                                        if ($type == "5") {
                                            echo "Payment Voucher";
                                        }

                                        ?></td>

                                    <td style="color: #000000;"><b><?php if ($credit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>
                                    <td style="color: #000000;"><b><?php if ($debit == "1") {
                                                                        echo $amount;
                                                                    } else {
                                                                        echo "-";
                                                                    } ?></b></td>

                                    <td style="color: #000000;"><b><?php
                                                                    if ($status == "3") {
                                                                        echo "Deleted";
                                                                    } else if ($status == "4") {
                                                                        echo "Previous Entry";
                                                                    } else {

                                                                        if ($debit == "1") {
                                                                            echo $sum = $sum + $amount;
                                                                        } else {
                                                                            echo $sum = $sum - $amount;
                                                                        }
                                                                    }

                                                                    ?></b></td>
                                    <td><a href="<?php
                                                    if ($type == "0") {
                                                        echo "receipt_view.php?type=0&br=1&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "1") {
                                                        echo "receipt_view.php?type=1&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "2") {
                                                        echo "receipt_view.php?type=2&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "3") {
                                                        echo "receipt_view.php?type=3&br123=1&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "4") {
                                                        $s12 = "SELECT purpose from misc WHERE ledger_id=$ledger_id AND trust_id=$trust_id";
                                                        $run12 = $conn->query($s12);
                                                        $row12 = $run12->fetch_assoc();
                                                        $purpose_misc = $row12['purpose'];
                                                        echo "receipt_view.php?type=4&br_trust=" . $trust_id . "&receipt_id=" . $receipt_id . "&submit=submit";
                                                    }
                                                    if ($type == "5") {

                                                        echo "voucher_view.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit";
                                                    }


                                                    ?>" target="_blank">View</a></td>
                                    <?php
                                    if ($flag == 1) {
                                        if ($type != 5) { ?>
                                            <td><a href="<?php echo "receipt_edit.php?trust_id=" . $trust_id . "&type=" . $type . "&receipt_id=" . $receipt_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                        <?php
                                        } else {
                                        ?>
                                            <td><a href="<?php echo "voucher_edit.php?type=1&trust_id=" . $trust_id . "&voucher_id=" . $voucher_id . "&submit=submit" ?>" target="_blank">Edit</a></td>

                                    <?php
                                        }
                                    }
                                    ?>

                                </tr>
                            <?php     }



                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
                    }

?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>


<script src="select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>