<?php
include('config/db-config.php');
session_start();
if (!isset($_SESSION['expiration']) || $_SESSION['expiration'] < time()) {
  // หากหมดอายุให้ทำการล็อกเอาท์และเปลี่ยนเส้นทางไปหน้าล็อกอิน
  session_destroy();
  Header("Location: ../login/logout.php");
  exit();
}
 
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='Admin'){
    Header("Location: ../login/logout.php");  
  }  
?>




<?php


include "config/db-config.php";
include("head/head.php");
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="css/style-index.css" />
  <link rel="stylesheet" href="css/style-header-h2.css">
  <link rel="stylesheet" href="css/style-table.css">

<!-- Add the flatpickr CSS and JS links in the head section of your HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>



</head>

<body>


  <form action="insert/insert.php" method="POST">
    <div id="booking" class="section">
      <br>

      <h2 class="expand-on-hover">&nbsp;&nbsp;INCIDENT REPORT</h2>

      <br><br>
      <div class="container">
        <div class="row">
          <div class="booking-form">
            <form>
              <div class="row justify-content-md-center">

                <div class="col-md-4">
                  <div class="form-group">
                    <labeld for="date" style="color: white;">Date</labeld>
                    <input id="date" class="form-control" name="date" type="text" placeholder="DD-MM-YYYY" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <labeld for="startTime" style="color: white;">Start Time</labeld>&nbsp;<labeld id="startTimeWarning" style="color: red;"></labeld>
                    <input class="form-control" name="Issue_Start" id="startTime" type="text" placeholder="DD-MM-YYYY : HH:mm" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <labeld for="endTime" style="color: white;">End Time</labeld>&nbsp;<labeld id="endTimeWarning" style="color: red;"></labeld>
                    <input class="form-control" name="Issue_End" id="endTime" type="text" placeholder="DD-MM-YYYY : HH:mm" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <labeld for="total" style='display:none'>Total</labeld>
                    <input class="form-control" name="Issue_Total" type="text" id="total" style='display:none' readonly>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <labeld style="color: white;">Issue Case</labeld>
                    <textarea class="form-control" style="padding: 8px;" autocomplete="off" name="Issue_Case" type="text" placeholder="&nbsp;&nbsp;ระบุปัญหาที่เกิด" required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <labeld style="color: white;">Resolve Case</labeld>
                    <textarea class="form-control" style="padding: 8px;" autocomplete="off" name="Resolve_Cause" type="text" placeholder="&nbsp;&nbsp;ระบุการแก้ปัญหา" required></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <labeld style="color: white;">Remark</labeld>
                    <textarea class="form-control" style="padding: 8px;" autocomplete="off" name="Remark" type="text" placeholder="&nbsp;&nbsp;ข้อสังเกตุของปัญหา" required></textarea>
                  </div>
                </div>

                <div class="col-md-6" style="width: 30%;">
                  <div class="form-group">
                    <labeld style="color: white;">Service name</labeld>
                    <labeld class="flashing-text">*ระบบ Boonterm</labeld>
                    <select name="Service name" id="serviceSelect" class="form-control" disabled>
                      <option value="-" selected>กรุณาเลือก</option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT name_service FROM service_name";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["name_service"] . '">' . $row["name_service"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>

                <div class="col-md-6" style="width: 20%;" >
                  <div class="form-group">
                  <labeld style="color: white;">Service Group</labeld>
                    <select name="service_group" id="groupSelect" class="form-control" disabled>
                      <option value="-" selected></option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT service_group FROM service_name";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["service_group"] . '">' . $row["service_group"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <labeld style="color: white;">Type Case</labeld>
                    <select name="Category"  id="category" class="form-control">
                      <option value="">-</option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT type_name FROM type_case";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["type_name"] . '">' . $row["type_name"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <labeld style="color: white;">State</labeld>
                    <select name="State" id="state" class="form-control">
                      <option value="">-</option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT state_name FROM table_state";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["state_name"] . '">' . $row["state_name"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <labeld style="color: white;">ผู้รับเรื่อง</labeld>
                    <select name="ผู้รับเรื่อง" class="form-control">
                      <option value="-" selected="">กรุณาเลือก</option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT name FROM table_name";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <labeld style="color: white;">ระบบ</labeld>&nbsp;&nbsp;
                    <labeld class="flashing-text">*กรุณาเลือกระบบ</labeld>
                    <select name="system" id="system" class="form-control">
                      <option value="" selected="">กรุณาเลือก</option>
                      <?php

                      include "config/db-config.php";


                      $sql = "SELECT system_name FROM table_system";
                      $result = $connection->query($sql);


                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["system_name"] . '">' . $row["system_name"] . '</option>';
                        }
                      }


                      $connection->close();
                      ?>
                    </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                  <div class="form-btn">
                    <button type="reset" class="reset-btn">CLEAR <i class="fa fa-times"></i></button>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-btn">
                    <button type="submit" name="save_data" class="submit-btn" onclick="return confirmSave()">SAVE <i class="fa fa-save"></i></button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </form>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>


function confirmSave() {
  var system = document.getElementById("system").value;
  var state = document.getElementById("state").value;
  var category = document.getElementById("category").value;
  var recipient = document.getElementsByName("ผู้รับเรื่อง")[0].value; // เลือกค่าจาก dropdown ผู้รับเรื่อง
  var startTime = document.getElementById("startTime").value;
  var endTime = document.getElementById("endTime").value;
  var date = document.getElementById("date").value;

  if (system === "") {
    alert("กรุณาเลือกระบบ");
    return false; // ไม่บันทึกข้อมูลเมื่อไม่ได้เลือกระบบ
  }

  if (state === "") {
    alert("กรุณาเลือกState");
    return false; // ไม่บันทึกข้อมูลเมื่อไม่ได้เลือก State
  }

  if (category === "") {
    alert("กรุณาเลือกType Case");
    return false; // ไม่บันทึกข้อมูลเมื่อไม่ได้เลือก Type Case
  }

  if (recipient === "-") {
    alert("กรุณาเลือกผู้รับเรื่อง");
    return false; // ไม่บันทึกข้อมูลเมื่อไม่ได้เลือกผู้รับเรื่อง
  }

  // ตรวจสอบว่า startTime และ endTime ถูกกรอกให้ครบ
  if (startTime === "" || endTime === "") {
    alert("กรุณากรอกทั้ง Start Time และ End Time");
    return false;
  }
  
   if (date === "") {
    alert("กรุณากรอก DATE");
    return false; // ไม่บันทึกข้อมูลเมื่อไม่ได้เลือกผู้รับเรื่อง
  }


  return true; // บันทึกข้อมูลเมื่อทุกอย่างถูกต้อง
}


  document.addEventListener("DOMContentLoaded", function() {
  // Initialize flatpickr for Start Time input
  flatpickr("#startTime", {
    enableTime: true,
    dateFormat: "d-m-Y : H:i",
    altInput: true,
    altFormat: "d-m-Y : H:i",
    time_24hr: true,

  });

  // Initialize flatpickr for End Time input
  flatpickr("#endTime", {
    enableTime: true,
    dateFormat: "d-m-Y : H:i",
    altInput: true,
    altFormat: "d-m-Y : H:i",
    time_24hr: true,
  });

  flatpickr("#date", {
    dateFormat: "d-m-Y", // Format the date as "dd-mm-yyyy"
    altInput: true, // Display the selected date in the input field
    altFormat: "d-m-Y", // Display the selected date in the format "dd-mm-yyyy"
    defaultDate: "today", // Set the default date to today
	allowInput: true,
  });
});




  // datetime function
  function calculateTimeDifference() {
    var startTimeInput = document.getElementById('startTime');
    var endTimeInput = document.getElementById('endTime');
    var totalInput = document.getElementById('total');

    // Parse the date and time values from the inputs using flatpickr's format
    var startTime = flatpickr.parseDate(startTimeInput.value, "d-m-Y : H:i");
    var endTime = flatpickr.parseDate(endTimeInput.value, "d-m-Y : H:i");

    // Calculate the time difference in milliseconds
    var timeDiff = Math.abs(endTime - startTime);

    // Adjust the time difference if it crosses midnight
    if (endTime < startTime) {
      endTime.setDate(endTime.getDate() + 1);
      timeDiff = Math.abs(endTime - startTime);
    }

    // Calculate the number of days, hours, and minutes
    var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

    // Convert days to hours and add to the total hours
    hours += days * 24;

    // Format hours and minutes with leading zeros
    var formattedHours = hours.toString().padStart(2, '0');
    var formattedMinutes = minutes.toString().padStart(2, '0');

    // Format the total time string
    var totalTime = formattedHours + ":" + formattedMinutes;

    // Set the value of the "total" input
    totalInput.value = totalTime;
  }

  // Add event listeners to start time and end time inputs
  var startTimeInput = document.getElementById('startTime');
  startTimeInput.addEventListener('change', calculateTimeDifference);
  var endTimeInput = document.getElementById('endTime');
  endTimeInput.addEventListener('change', calculateTimeDifference);






  document.addEventListener("DOMContentLoaded", function() {
    const startTimeInput = document.getElementById("startTime");
    const endTimeInput = document.getElementById("endTime");
    const startTimeWarning = document.getElementById("startTimeWarning");
    const endTimeWarning = document.getElementById("endTimeWarning");

    // Function to parse date and time input to Date object
    function parseDateTime(input) {
      const [datePart, timePart] = input.value.split(" : ");
      const [day, month, year] = datePart.split("-");
      const [hour, minute] = timePart.split(":");
      return new Date(`${year}-${month}-${day}T${hour}:${minute}`);
    }

    // Function to show or hide warnings
    function toggleWarnings() {
      const startTime = parseDateTime(startTimeInput);
      const endTime = parseDateTime(endTimeInput);

      if (endTime < startTime) {
        startTimeWarning.textContent = "โปรดตรวจสอบความถูกต้อง";
        endTimeWarning.textContent = "โปรดตรวจสอบความถูกต้อง";
        alert("End Time น้อยกว่า Start Time โปรดตรวจสอบความถูกต้องอีกครั้ง");
      } else {
        startTimeWarning.textContent = "";
        endTimeWarning.textContent = "";
      }
    }

    startTimeInput.addEventListener("input", toggleWarnings);
    endTimeInput.addEventListener("input", toggleWarnings);
  });








  document.getElementById("system").addEventListener("change", function() {
  // เช็คว่าเลือกระบบหรือไม่
  if (this.value === "Boonterm") {
    // ถ้าเลือกระบบ Boonterm ให้เปิดการเลือก Service name
    document.getElementById("serviceSelect").removeAttribute("disabled");
    // ถ้าเลือกระบบ Boonterm ให้เปลี่ยนค่าของ Service name เป็นค่าว่าง
    document.getElementById("serviceSelect").value = "";
    
    // ถ้าเลือกระบบ Boonterm ให้เปิดการเลือก Group name
    document.getElementById("groupSelect").removeAttribute("disabled");
    // ถ้าเลือกระบบ Boonterm ให้เปลี่ยนค่าของ Group name เป็นค่าว่าง
    document.getElementById("groupSelect").value = "";
  } else {
    // ถ้าไม่ได้เลือกระบบ Boonterm ปิดการเลือก Service name
    document.getElementById("serviceSelect").setAttribute("disabled", "disabled");
    // ถ้าไม่ได้เลือกระบบ Boonterm ให้เปลี่ยนค่าของ Service name เป็นค่าว่าง
    document.getElementById("serviceSelect").value = "";

    // ถ้าไม่ได้เลือกระบบ Boonterm ปิดการเลือก Group name
    document.getElementById("groupSelect").setAttribute("disabled", "disabled");
    // ถ้าไม่ได้เลือกระบบ Boonterm ให้เปลี่ยนค่าของ Group name เป็นค่าว่าง
    document.getElementById("groupSelect").value = "";
  }
});








  $(document).ready(function() {
  $('#serviceSelect').select2();

  // Event เมื่อมีการเลือกค่าใน Select2
  $('#serviceSelect').on('select2:select', function (e) {
    const selectedService = e.params.data.id;
    if (selectedService !== '-') {
      fetchServiceGroups(selectedService);
    } else {
      // ถ้าถูกเลือกเป็นค่าว่าง ให้ groupSelect เปลี่ยนเป็นค่าว่าง
      $('#groupSelect').val('-').trigger('change');
    }
  });

  function fetchServiceGroups(serviceName) {
    // Make an AJAX request to fetch service groups based on the selected service
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `get_service_groups.php?service=${serviceName}`, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        updateGroupSelectOptions(response);
      }
    };
    xhr.send();
  }

  function updateGroupSelectOptions(groups) {
    const groupSelect = document.getElementById('groupSelect');
    groupSelect.innerHTML = ''; // Clear previous options
    groups.forEach(group => {
      const option = document.createElement('option');
      option.value = group;
      option.textContent = group;
      groupSelect.appendChild(option);
    });
  }
});
</script>

</html>