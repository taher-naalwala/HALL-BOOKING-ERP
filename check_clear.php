<?php
require('connectDB.php');
if (isset($_POST['pass'])) {
    $check_number = $_POST['cn'];
    $id = $_POST['pass'];
    $check_amount = $_POST['a'];
    $an = $_POST['an'];
    $first = $_POST['date'];
    list($f_m, $f_d, $f_y) = explode('/', $first);
    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
    $cl_date = str_replace(' ', '', $f_first0);
    $sql = "UPDATE ledger SET status=1,check_cleared_date='$cl_date' WHERE check_number='$check_number' AND account_number='$an'";
    if (mysqli_query($conn, $sql)) {
        $s0 = "SELECT * from booking_info WHERE id=$id AND status=2";
        $run0 = $conn->query($s0);
        if ($run0->num_rows > 0) {
            $s1 = "SELECT * from ledger WHERE status=0 AND booking_id=$id";
            $run1 = $conn->query($s1);
            if ($run1->num_rows > 0) {
                $s2 = "SELECT * from booking_info WHERE id=$id";
                $run2 = $conn->query($s2);
                $row2 = $run2->fetch_assoc();
                $mobile = $row2['mobile'];
                $its = $row2['its'];
                $name = $row2['name'];
                $date = $row2['date'];
                $jk_id = $row2['jk_id'];
                $s4 = "SELECT * from jk_info WHERE id=$jk_id";
                $run4 = $conn->query($s4);
                $row4 = $run4->fetch_assoc();
                $jk_name = $row4['name'];
                $s20 = "SELECT * from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                $run20 = $conn->query($s20);
                if ($run20->num_rows > 0) {
                    $row20 = $run20->fetch_assoc();
                    $amount = $row20['amount'];
                }
                $capacity = $row4['capacity'];
                $timings_id = $row2['timings_id'];
                $s6 = "SELECT * from timings WHERE id=$timings_id";
                $run6 = $conn->query($s6);
                $row6 = $run6->fetch_assoc();
                $label_name = $row6['label'];
                $start_time = $row6['start_time'];
                $end_time = $row6['end_time'];
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
                $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                $final_msg = str_replace(" ", "%20", $msg);
                $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                /* $ch = curl_init();

                                                        // set url 
                                                        curl_setopt($ch, CURLOPT_URL, $url);

                                                        //return the transfer as a string 
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                        // $output contains the output string 
                                                        $output = curl_exec($ch);


                                                        // close curl resource to free up system resources 
                                                        curl_close($ch); */

              
?>
               <script type="text/javascript">
                                                            window.location = 'receipt.php?name=CN&Number=<?php echo $check_number ?>';
                                                        </script>
                <?php     } else {
                $s2 = "UPDATE booking_info SET status=3 WHERE id=$id";
                if (mysqli_query($conn, $s2)) {
                    $s2 = "SELECT * from booking_info WHERE id=$id";
                    $run2 = $conn->query($s2);
                    $row2 = $run2->fetch_assoc();
                    $mobile = $row2['mobile'];
                    $its = $row2['its'];
                    $name = $row2['name'];
                    $date = $row2['date'];
                    $jk_id = $row2['jk_id'];
                    $s4 = "SELECT * from jk_info WHERE id=$jk_id";
                    $run4 = $conn->query($s4);
                    $row4 = $run4->fetch_assoc();
                    $jk_name = $row4['name'];
                    $s20 = "SELECT * from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                    $run20 = $conn->query($s20);
                    if ($run20->num_rows > 0) {
                        $row20 = $run20->fetch_assoc();
                        $amount = $row20['amount'];
                    }
                    $capacity = $row4['capacity'];
                    $timings_id = $row2['timings_id'];
                    $s6 = "SELECT * from timings WHERE id=$timings_id";
                    $run6 = $conn->query($s6);
                    $row6 = $run6->fetch_assoc();
                    $label_name = $row6['label'];
                    $start_time = $row6['start_time'];
                    $end_time = $row6['end_time'];
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
                    $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0AJamaat Khaana Booking Confirmed%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                    $final_msg = str_replace(" ", "%20", $msg);
                    $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                    /* $ch = curl_init();

                                                            // set url 
                                                            curl_setopt($ch, CURLOPT_URL, $url);

                                                            //return the transfer as a string 
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                            // $output contains the output string 
                                                            $output = curl_exec($ch);


                                                            // close curl resource to free up system resources 
                                                            curl_close($ch); */
                  


                ?>
                   <script type="text/javascript">
                                                            window.location = 'receipt.php?name=CN&Number=<?php echo $check_number ?>';
                                                        </script>
                <?php
                } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">
                                            Fail
                                           </div>';
                }
            }
        } else {
            $s1 = "SELECT * from ledger WHERE status=0 AND booking_id=$id";
            $run1 = $conn->query($s1);
            if ($run1->num_rows > 0) {
                $s2 = "SELECT * from booking_info WHERE id=$id";
                $run2 = $conn->query($s2);
                $row2 = $run2->fetch_assoc();
                $mobile = $row2['mobile'];
                $its = $row2['its'];
                $name = $row2['name'];
                $date = $row2['date'];
                $jk_id = $row2['jk_id'];
                $s4 = "SELECT * from jk_info WHERE id=$jk_id";
                $run4 = $conn->query($s4);
                $row4 = $run4->fetch_assoc();
                $jk_name = $row4['name'];
                $s20 = "SELECT * from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
                $run20 = $conn->query($s20);
                if ($run20->num_rows > 0) {
                    $row20 = $run20->fetch_assoc();
                    $amount = $row20['amount'];
                }
                $capacity = $row4['capacity'];
                $timings_id = $row2['timings_id'];
                $s6 = "SELECT * from timings WHERE id=$timings_id";
                $run6 = $conn->query($s6);
                $row6 = $run6->fetch_assoc();
                $label_name = $row6['label'];
                $start_time = $row6['start_time'];
                $end_time = $row6['end_time'];
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
                $msg = "Cheque of Rs." . $check_amount . " Cleared..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A Payment Details- %0D%0A" . "Receipt No.-" . $check_number . "BKIDHR" . $id;
                $final_msg = str_replace(" ", "%20", $msg);
                $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                /* $ch = curl_init();

                                                        // set url 
                                                        curl_setopt($ch, CURLOPT_URL, $url);

                                                        //return the transfer as a string 
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                        // $output contains the output string 
                                                        $output = curl_exec($ch);


                                                        // close curl resource to free up system resources 
                                                        curl_close($ch); */

            
                ?>
                <script type="text/javascript">
                                                            window.location = 'receipt.php?name=CN&Number=<?php echo $check_number ?>';
                                                        </script>
               
<?php
            }
        }
    }
}

if (isset($_POST['fail'])) {
    $check_number = $_GET['input'];
    $id = $_POST['fail'];
    $check_amount = $_POST['a'];
    $first = $_POST['date'];
    list($f_m, $f_d, $f_y) = explode('/', $first);
    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
    $cl_date = str_replace(' ', '', $f_first0);
    $sql = "UPDATE ledger SET status=2,check_cleared_date='$cl_date' WHERE check_number='$check_number'";
    if (mysqli_query($conn, $sql)) {
        $s2 = "SELECT * from booking_info WHERE id=$id";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $mobile = $row2['mobile'];
        $its = $row2['its'];
        $name = $row2['name'];
        $date = $row2['date'];
        $jk_id = $row2['jk_id'];
        $s4 = "SELECT * from jk_info WHERE id=$jk_id";
        $run4 = $conn->query($s4);
        $row4 = $run4->fetch_assoc();
        $jk_name = $row4['name'];
        $s20 = "SELECT * from rent WHERE jk_id=$jk_id AND date>='$date' ORDER BY date ASC LIMIT 1";
        $run20 = $conn->query($s20);
        if ($run20->num_rows > 0) {
            $row20 = $run20->fetch_assoc();
            $amount = $row20['amount'];
        }
        $capacity = $row4['capacity'];
        $timings_id = $row2['timings_id'];
        $s6 = "SELECT * from timings WHERE id=$timings_id";
        $run6 = $conn->query($s6);
        $row6 = $run6->fetch_assoc();
        $label_name = $row6['label'];
        $start_time = $row6['start_time'];
        $end_time = $row6['end_time'];
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
        $msg = "Cheque Clearance Failed..%0D%0ACheque of Rs." . $check_amount . " Failed to Clear..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $id . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0AVisit Jamaat Office and pay the amount";
        $final_msg = str_replace(" ", "%20", $msg);
        $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

        /* $ch = curl_init();

                                                // set url 
                                                curl_setopt($ch, CURLOPT_URL, $url);

                                                //return the transfer as a string 
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                // $output contains the output string 
                                                $output = curl_exec($ch);


                                                // close curl resource to free up system resources 
                                                curl_close($ch); */
?>
<script type="text/javascript">
                                                            window.location = 'receipt.php?name=CN&Number=<?php echo $check_number ?>';
                                                        </script>
<?php
    }
}
?>