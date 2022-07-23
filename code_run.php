<?php
require('connectDB.php');

$sql="SELECT * from timings";
$run=$conn->query($sql);
while($row=$run->fetch_assoc())
{
    $label=$row['label'];
    $start=$row['start_time'];
    $end=$row['end_time'];
    $s1="SELECT id from label where name='$label' AND start_time='$start' and end_time='$end'";
    $run1=$conn->query($s1);
    $row1=$run1->fetch_assoc();
    $label_id=$row1['id'];
    $s2="UPDATE timings SET label_id=$label_id WHERE label='$label' AND start_time='$start' and end_time='$end'";
    mysqli_query($conn,$s2);
}

?>