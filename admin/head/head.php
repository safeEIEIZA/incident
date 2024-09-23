<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" type="text/css" href="css/style-nav.css">
  <link rel="stylesheet" type="text/css" href="css/style-logout.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <nav>
    <ul>
      <li><a href="index.php"><i class="fa fa-home"></i>&nbsp;&nbsp;หน้าแรก</a></li>
      <a class="separator" style="color: white; "> |</a>
      <li class="dropdown" onmouseenter="showDelayedDropdown('dropdownContent')" onmouseleave="hideDelayedDropdown('dropdownContent')">
        <a><i class="fa fa-list"></i>&nbsp;&nbsp;ระบบ</a>
        <ul class="dropdown-menu" id="dropdownContent">
            <?php
            // Include db-config.php and retrieve system names from the database
            include "config/db-config.php";

            $sql = "SELECT system_name FROM table_system";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $system_name = urlencode($row["system_name"]);
                    echo '<li><a href="incident_details.php?systemname=' . $system_name . '">' . $row["system_name"] . '</a></li>';
                }
            }

            $connection->close();
            ?>
            
        </ul>
      </li>


      <li style="float: right;" >
		<?php
    session_start();
    if(isset($_SESSION['name'])) {
      echo '<a onclick="confirmLogout()">' . $_SESSION['name'] . '</a>';
    } else {
        echo '<a href="login/formlogin.php"><i class="fa fa-user"></i>&nbsp;&nbsp;เข้าสู่ระบบ</a>';
    }
    ?>
    </li>
      <li style="float: right;"><a href="dashbord.php"><i class="fa fa-tachometer " aria-hidden="true"></i>&nbsp;&nbsp;Dashbord</a></li>

    </ul>
  </nav>
</body>

<!-- Popup -->
<div class="popup" id="popup">
  <div class="popup-content">
    <p class="popup-message" style="font-weight: 600;">Logout</p>
    <div class="popup-buttons">
      <button class="btn-confirm" onclick="logoutConfirmed()">ใช่</button>
      <button class="btn-cancel" onclick="closePopup()">ยกเลิก</button>
    </div>
  </div>
</div>

<script>
  function confirmLogout() {
    showPopup();
  }

  function showPopup() {
    var popup = document.getElementById("popup");
    popup.classList.add("show");
  }

  function closePopup() {
  var popup = document.getElementById("popup");
  popup.classList.add("zoom-out"); // เพิ่มคลาส zoom-out เพื่อให้ทำ Animation ออก
  setTimeout(function () {
    popup.classList.remove("show", "zoom-out"); // นำคลาส zoom-out ออกเมื่อทำ Animation เสร็จสิ้น
  }, 300);
  }

  function logoutConfirmed() {
    setTimeout(function () {
      window.location.href = "../login/formlogin.php";
    }, 300);
    closePopup();
  }



  function showDelayedDropdown() {
  var dropdownMenu = document.querySelector(".dropdown-menu");
  dropdownMenu.classList.add("show");

  var timeout = setTimeout(function () {
    hideDropdownSlowly();
  }, 600);

  dropdownMenu.addEventListener("mouseenter", function () {
    clearTimeout(timeout); // ยกเลิกการรอเวลาหากผู้ใช้เลือกเมนู
  });

  dropdownMenu.addEventListener("mouseleave", function () {
    timeout = setTimeout(function () {
      hideDropdownSlowly();
    }, 800);
  });
}


var hideTimeout;
var timeout;

function hideDropdownSlowly() {
  var dropdownMenu = document.querySelector(".dropdown-menu");

  // เพิ่มคลาสที่ทำให้ Dropdown หายเร็ว
  dropdownMenu.classList.add("zoom-out");

  // เริ่มนับเวลาเพื่อทำการล้างคลาสและซ่อน Dropdown
  hideTimeout = setTimeout(function () {
    dropdownMenu.classList.remove("show", "zoom-out");
  }, 400); // ปรับเวลาให้เหมาะสม
}


</script>


</html>