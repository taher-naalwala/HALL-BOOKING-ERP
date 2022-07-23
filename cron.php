<?php
 require('connectDB.php');
 $sql="SELECT * from ledger2 WHERE trust_id=2 AND status=1";
 $run=$conn->query($sql);
 while($row=$run->fetch_assoc())
 {
   
     $bk_id=$row['bk_id'];
     $amount=$row['amount'];
     $cn=$row['check_number'];
     $an=$row['account_number'];
     $pay_mode=$row['pay_mode'];
     $debit=$row['debit'];
     $credit=$row['credit'];
     $c_date=$row['c_date'];
     $status=$row['status'];
     $trust_id=$row['trust_id'];
     $check_cleared_date=$row['check_cleared_date'];
     $s1="INSERT INTO ledger3 (`bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`)  VALUES($bk_id,'$amount',$trust_id,'$cn','$an',$pay_mode,$debit,$credit,'$c_date','10:00:00',$status,'$check_cleared_date','',0)";
     if(mysqli_query($conn,$s1))
     {
        echo "Success";
     }
 }


?>