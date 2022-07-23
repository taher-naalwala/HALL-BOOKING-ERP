<html>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
    <div class="sidebar-brand-icon rotate-n-15">

    </div>
    <div class="sidebar-brand-text mx-3">Jamaat Khaana Booking</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">


  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="main.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">



  <?php
  $forms_access = $_SESSION['forms_access'];
  if (in_array("1", $forms_access) || in_array("2", $forms_access) || in_array("3", $forms_access) || in_array("4", $forms_access) || in_array("5", $forms_access) || in_array("6", $forms_access) || in_array("7", $forms_access)) {

  ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" id="c1" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-building"></i>
        <span>Jamaat Khaana</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Jamaat Khana Powers:</h6>
          <?php



          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "2" || $formid == "1") {
            ?>
              <a class="collapse-item" href="add.php?name=Jamaat Khana">Add</a>

              <hr>
            <?php
            }
            if ($formid == "3" || $formid == "1") {
            ?>
              <a class="collapse-item" href="combine_jk.php">Combine</a>
              <hr>
            <?php
            }
            ?>
            <?php
            if ($formid == "4" || $formid == "1") {
            ?>
              <a class="collapse-item" href="edit.php?name=Jamaat Khaana">Edit</a>
              <hr>
            <?php
            }
            ?>
            <?php
            if ($formid == "5" || $formid == "1") {
            ?>
              <a class="collapse-item" href="remove.php?name=Jamaat Khaana">Remove</a>
              <hr>
            <?php
            }
            if ($formid == "6" || $formid == "1") {
            ?>
              <a class="collapse-item" href="block.php">Block</a>
              <hr>
            <?php
            }
            if ($formid == "7" || $formid == "1") {
            ?>
              <a class="collapse-item" href="unblock.php">Unblock</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>


  <?php
  if (in_array("11", $forms_access) || in_array("8", $forms_access) || in_array("9", $forms_access) || in_array("10", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwore" aria-expanded="true" aria-controls="collapseTwore">
        <i class="fas fa-rupee-sign"></i>
        <span>Rent</span>
      </a>
      <div id="collapseTwore" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Rent Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "9" || $formid == "8") {
            ?>
              <a class="collapse-item" href="add.php?name=Rent">Add</a>
              <hr>
            <?php
            }

            if ($formid == "50" || $formid == "8") {
            ?>
              <a class="collapse-item" href="rent_conditions.php">Conditions</a>
              <hr>
            <?php
            }
            if ($formid == "10" || $formid == "8") {
            ?>
              <a class="collapse-item" href="edit.php?name=Rent">Edit</a>
              <hr>
            <?php
            }
            if ($formid == "11" || $formid == "8") {
            ?>
              <a class="collapse-item" href="remove.php?name=Rent">Remove</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>

  <?php
  if (in_array("11", $forms_access) || in_array("12", $forms_access) || in_array("13", $forms_access)  || in_array("14", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwot" aria-expanded="true" aria-controls="collapseTwot">
        <i class="fas fa-building"></i>
        <span>Trust</span>
      </a>
      <div id="collapseTwot" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Trust Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "13" || $formid == "12") {
            ?>
              <a class="collapse-item" href="add.php?name=Trust">Add</a>
              <hr>
            <?php
            }
            if ($formid == "14" || $formid == "12") {
            ?>
              <a class="collapse-item" href="edit.php?name=Trust">Edit</a>
              <hr>
            <?php
            }
            if ($formid == "15" || $formid == "12") {
            ?>
              <a class="collapse-item" href="remove.php?name=Trust">Remove</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>
  <?php
  if (in_array("22", $forms_access) || in_array("16", $forms_access) || in_array("17", $forms_access) || in_array("18", $forms_access) || in_array("19", $forms_access) || in_array("20", $forms_access) || in_array("21", $forms_access) || in_array("23", $forms_access) || in_array("24", $forms_access) || in_array("25", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwob" aria-expanded="true" aria-controls="collapseTwob">
        <i class="fas fa-book"></i>
        <span>Booking</span>
      </a>
      <div id="collapseTwob" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Booking Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "17" || $formid == "16") {
            ?>
              <a class="collapse-item" href="add_booking_admin.php" target="_blank">Add</a>
              <hr>
            <?php
            }
            if ($formid == "18" || $formid == "16") {
            ?>
              <a class="collapse-item" href="edit_booking.php">Edit</a>
              <hr>
            <?php
            }
            if ($formid == "19" || $formid == "16") {
            ?>
              <a class="collapse-item" href="partial_payment.php">Partial Payment</a>
              <hr>
            <?php
            }
            if ($formid == "20" || $formid == "16") {
            ?>
              <a class="collapse-item" href="check_clearance.php">Cheque Clearance</a>
              <hr>
            <?php
            }
            ?>
            <?php
            if ($formid == "21" || $formid == "16") {
            ?>
              <a class="collapse-item" href="laagat_booking_admin.php">Laagat</a>
              <hr>
            <?php
            }
            if ($formid == "37" || $formid == "16") {
            ?>
              <a class="collapse-item" href="add_garbage.php">Garbage</a>
              <hr>
            <?php
            }
            if ($formid == "22" || $formid == "16") {
            ?>
              <a class="collapse-item" href="cancel_booking.php">Cancel</a>
              <hr>
            <?php
            }
            if ($formid == "23" || $formid == "16") {
            ?>
              <a class="collapse-item" href="transfer.php">Transfer</a>
              <hr>
            <?php
            }
            if ($formid == "24" || $formid == "16") {
            ?>
              <a class="collapse-item" href="refund_booking.php">Refund</a>
              <hr>
            <?php
            }
            if ($formid == "25" || $formid == "16") {
            ?>
              <a class="collapse-item" href="delete_booking.php">Delete</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>


  <?php
  if (in_array("41", $forms_access) || in_array("42", $forms_access) || in_array("43", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwog" aria-expanded="true" aria-controls="collapseTwoa">
        <i class="fas fa-trash"></i>
        <span>Garbage Charge</span>
      </a>
      <div id="collapseTwog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Garbage Charge Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "43" || $formid == "42") {
            ?>
              <a class="collapse-item" href="garbage.php?name=All">All</a>
              <hr>
            <?php
            }
            ?>
            <?php
            if ($formid == "41" || $formid == "42") {
            ?>
              <a class="collapse-item" href="garbage.php?name=Individual">Individual (Booking ID)</a>

          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>

  <?php
  }
  ?>

  <?php
  if (in_array("38", $forms_access) || in_array("39", $forms_access) || in_array("40", $forms_access) || in_array("46", $forms_access) || in_array("47", $forms_access) || in_array("44", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwor" aria-expanded="true" aria-controls="collapseTwoa">
        <i class="fas fa-receipt"></i>
        <span>Receipt</span>
      </a>
      <div id="collapseTwor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Receipt Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];
          if (in_array("38", $forms_access) || in_array("39", $forms_access) || in_array("40", $forms_access) || in_array("46", $forms_access) || in_array("47", $forms_access) || in_array("44", $forms_access)) {
          ?>
            <a class="collapse-item" href="receipt_view.php">View</a>
            <hr>
            <?php
          }


          foreach ($forms_access as $formid) {

            if ($formid == "56" || $formid == "38") {
            ?>
              <a class="collapse-item" href="receipt.php?name=Miscellaneous">Miscellaneous</a>
              <hr>
            <?php
            }


            if ($formid == "49" || $formid == "38") {
            ?>
              <a class="collapse-item" href="receipt_edit.php">Edit</a>
              <hr>
            <?php
            }


            if ($formid == "51" || $formid == "38") {
            ?>
              <a class="collapse-item" href="receipt_delete.php">Delete</a>

          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>

  <?php
  }
  ?>


  <?php
  if (in_array("45", $forms_access) || in_array("52", $forms_access) || in_array("53", $forms_access) || in_array("54", $forms_access) || in_array("55", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwopv" aria-expanded="true" aria-controls="collapseTwopv">
        <i class="fas fa-coins"></i>
        <span>Payment Voucher</span>
      </a>
      <div id="collapseTwopv" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Voucher Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          ?>


          <?php
          if (in_array("45", $forms_access) || in_array("52", $forms_access)) {
          ?>
            <a class="collapse-item" href="receipt.php?name=Payment Voucher">Add</a>
            <hr>
          <?php
          }
          if (in_array("45", $forms_access) || in_array("53", $forms_access)) {
          ?>
            <a class="collapse-item" href="voucher_view.php">View</a>
            <hr>
          <?php
          }
          if (in_array("45", $forms_access) || in_array("54", $forms_access)) {
          ?>
            <a class="collapse-item" href="voucher_edit.php">Edit</a>
            <hr>
          <?php
          }
          if (in_array("45", $forms_access) || in_array("55", $forms_access)) {
          ?>
            <a class="collapse-item" href="voucher_delete.php">Delete</a>
          <?php
          }


          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>

  <?php
  if (in_array("26", $forms_access) || in_array("27", $forms_access) || in_array("28", $forms_access) || in_array("29", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwos" aria-expanded="true" aria-controls="collapseTwos">
        <i class="fas fa-coins"></i>
        <span>Security Deposit</span>
      </a>
      <div id="collapseTwos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Security Deposit Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "27" || $formid == "26") {
            ?>
              <a class="collapse-item" href="add_security_deposit.php">Add</a>
              <hr>
            <?php
            }
            if ($formid == "28" || $formid == "26") {
            ?>
              <a class="collapse-item" href="security_deposit.php">Approve</a>
              <hr>
            <?php
            }
            if ($formid == "29" || $formid == "26") {
            ?>
              <a class="collapse-item" href="refund_security_deposit.php">Refund</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>


  <?php
  if (in_array("30", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php


    foreach ($forms_access as $formid) {
    ?>


      <?php
      if ($formid == "30") {
      ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="alerts.php">
            <i class="fas fa-user-clock"></i>
            <span>Alerts</span></a>
        </li>
  <?php
      }
    }
  }
  ?>
  <?php
  if (in_array("31", $forms_access) || in_array("32", $forms_access) || in_array("33", $forms_access) || in_array("34", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoa" aria-expanded="true" aria-controls="collapseTwoa">
        <i class="fas fa-key"></i>
        <span>Access</span>
      </a>
      <div id="collapseTwoa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Access Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "32" || $formid == "31") {
            ?>
              <a class="collapse-item" href="add.php?name=Access">Add</a>
              <hr>
            <?php
            }
            ?>
            <?php
            if ($formid == "33" || $formid == "31") {
            ?>
              <a class="collapse-item" href="edit.php?name=Access">Edit</a>
              <hr>
            <?php
            }
            if ($formid == "34" || $formid == "31") {
            ?>
              <a class="collapse-item" href="remove.php?name=Access">Remove</a>
          <?php
            }
          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>



  <?php
  if (in_array("35", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php


    foreach ($forms_access as $formid) {
    ?>


      <?php
      if ($formid == "35") {
      ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="report.php">
            <i class="fas fa-clipboard"></i>
            <span>Reports</span></a>
        </li>
  <?php
      }
    }
  }
  ?>


  <?php
  if (in_array("48", $forms_access)) {

  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php


    foreach ($forms_access as $formid) {
    ?>


      <?php
      if ($formid == "48") {
      ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="backup.php">
            <i class="fas fa-download"></i>
            <span>Backup Data</span></a>
        </li>
  <?php
      }
    }
  }
  ?>



  <?php
  if ($_SESSION['role'] == "Super Admin" || in_array("36", $forms_access)) {
  ?>

    <hr class="sidebar-divider">
    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="maintainence.php">
        <i class="fas fa-tools"></i>
        <span>Maintainence</span></a>
    </li>
  <?php
  }
  ?>

  <hr class="sidebar-divider">
  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="logout.php">
      <i class="fas fa-sign-out-alt"></i>
      <span>LogOut</span></a>
  </li>



  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">




        <div class="topbar-divider d-none d-sm-block"></div>


        <a class="nav-link">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Full_Name']  ?></span>
        </a>



      </ul>

    </nav>
    <!-- End of Topbar -->
    <script>
      $(document).click(function(e) {

        if (!$(e.target).is('.nav-link')) {
          $('#collapseTwo').removeClass("show");
          $('#collapseTwore').removeClass("show");
          $('#collapseTwot').removeClass("show");
          $('#collapseTwob').removeClass("show");
          $('#collapseTwog').removeClass("show");
          $('#collapseTwor').removeClass("show");
          $('#collapseTwos').removeClass("show");
          $('#collapseTwoa').removeClass("show");
        }
      });
    </script>


</html>