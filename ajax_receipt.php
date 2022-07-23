<?php
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == "0") { ?>
        <select class="form-control" name="br" id="br" onchange="change_br()" required>
            <option value="" disabled>--Select--</option>
            <option value="0">Booking ID</option>
            <option value="1">Receipt Number</option>
            
        </select>
        
    <?php }
    if ($type == "1" || $type == "2" || $type == "3") { ?>
         <select class="form-control" name="br123" id="br123" onchange="change_br123()" required>
            <option value="" disabled>--Select--</option>
            <option value="0">Booking ID</option>
            <option value="1">Receipt Number</option>
            
        </select>
    <?php }
    if ($type == "4") { ?>
        <select class="form-control" name="br_trust" id="br_trust" required>
            <option value="" disabled>--Trust--</option>
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
    <?php }
}
if (isset($_GET['br'])) {
    $br = $_GET['br'];
    if ($br == "0") { ?>
        <div class="search-box">

            <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required />

            <div class="result"></div>
        </div>
    <?php

    } else { ?>
        <select class="form-control" name="br_trust" id="br_trust" required>
            <option value="" disabled>--Trust--</option>
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

if (isset($_GET['br123'])) {
    $br = $_GET['br123'];
    if ($br == "0") { ?>
        <div class="search-box">

            <input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." />

            <div class="result"></div>
        </div>
    <?php

    } else { ?>
        <input name="receipt_id" placeholder="Enter Receipt Number" class="form-control">
        
<?php

    }
}

?>