<?php
/*

require('connectDB.php');
date_default_timezone_set('Asia/Kolkata');


$sql="SELECT date from booking_info where jk_id=41";
$run=$conn->query($sql);
while($row=$run->fetch_assoc())
{
$date=$row['date'];
$timestamp = strtotime($date);

 $day = date('l', $timestamp);
 if($day=="Sunday")
 {
    // echo $date;
    
   $s1="UPDATE booking_info set jk_rent='12000' where jk_id=41 and date='$date'";
    if(mysqli_query($conn,$s1))
    {
        echo "success";
    }   
     
 }
}

?>