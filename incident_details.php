<?php


include "config/db-config.php";
include("head/head.php");

$systemname = $_REQUEST['systemname'];

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />

  <link rel="stylesheet" href="css/stylemd.css">
  <link rel="stylesheet" href="css/style-header-h2.css">
  <link rel="stylesheet" href="css/style-table.css">
  <link rel="stylesheet" href="css/style-background.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



  <!-- Add the flatpickr CSS and JS links in the head section of your HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

</head>

<body>

  <br>
  <h2 class="expand-on-hover"><?php echo $systemname ?></h2>
  <br>




  <div class="container">
    <div class="row">
      <div class="row well input-daterange">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-1">
        </div>


        <div class="col-sm-2">
          <label class="control-label">DATE Range</label>
          <input class="form-control datepicker" autocomplete="off" type="text" name="initial_date" id="initial_date" placeholder="DD-MM-YYYY" style="height: 40px;" />
        </div>


        <div class="col-sm-2">
          <label class="control-label">To Date</label>
          <input class="form-control datepicker" autocomplete="off" type="text" name="final_date" id="final_date" placeholder="DD-MM-YYYY" style="height: 40px;" />
        </div>



        <div class="col-sm-2">
          <label class="control-label">Type</label>
          <select class="form-control" name="Category" id="Category" style="height: 40px;">
            <option value="">All</option>
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
        </div>

        </form>


        <div class="col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;
          <button class="filter" type="filter" name="filter" id="filter" style="margin-top: 30px">
            <i class="fa fa-filter"></i> Filter
          </button>


        </div>

        <div class="col-sm-12 text-danger" id="error_log"></div>

      </div>


      <br>



      <table id="fetch_data" class="display" cellspacing="0" width="100%" align="center">
    <thead>
    <tr>
        <th>DATE</th>
        <th style="width:5%">Issue Start</th>
        <th style="width:5%">Issue End</th>
        <th style="width:5%">Issue Total</th>
        <th style="width:18%">Issue Case</th>
        <th style="width:18%">Resolve Cause</th>
		<?php if ($systemname === 'Boonterm'): ?>
        <th style="width:5%">Service name</th>
        <th style="width:5%">Service group</th>
		<?php endif; ?>
        <th>Type Case</th>
        <th>Issue Type</th>
        <th style="width:15%">Remark</th>
        <?php if ($systemname === 'Boonterm'): ?>
            <th style="width:5%">ค่าเสียโอกาส</th>
        <?php endif; ?>
        <th style="width:5%">ผู้รับเรื่อง</th>
        <th style="width:8%">Tool</th>
    </tr>
    </thead>
</table>

    </div>
  </div>



  <!-- Edit modal -->

  <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>DATE</label>
                <input class="form-control" type="text" name="date" id="date" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label for="startTime">Start Time</label>&nbsp;<label id="startTimeWarning" style="color: red;"></label>
                <input class="form-control" type="text" name="Issue_Start" id="Issue_Start" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label for="endTime">End Time</label>&nbsp;<label id="endTimeWarning" style="color: red;"></label>
                <input class="form-control" type="text" name="Issue_End" id="Issue_End" style="height: 40px;" />
              </div>

              <label for="total" style="display:none">Total</label>
              <input class="form-control" name="Issue_Total" type="text" id="Issue_Total" style="display:none" readonly>


              <div class="form-group col-md-6">
                <label>Issue Case</label>
                <textarea name="Issue_Case" id="Issue_Case" autocomplete="off" class="form-control" style="height: 40px;"></textarea>
              </div>

              <div class="form-group col-md-6">
                <label>Resolve Cause</label>
                <textarea name="Resolve_Cause" id="Resolve_Cause" autocomplete="off" class="form-control" style="height: 40px;"></textarea>
              </div>

                <div class="form-group col-md-6">
                    <label>Service Name</label>
                    <select name="Service_name" id="Service_name" class="form-control" style="height: 40px;" <?php if ($systemname !== 'Boonterm') echo 'disabled'; ?>>
                        <option value="-">กรุณาเลือก</option>
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
                </div>


              <div class="col-md-6" style="display: none;">
                  <div class="form-group">
                    <select name="service_group" id="service_group" class="form-control" >
                      <option value="-" selected>กรุณาเลือก</option>
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
                    <span class="select-arrow"></span>
                  </div>
                </div>
                

              <div class="form-group col-md-6">
                <label>Type Case</label>
                <select name="Category_edit" id="Category_edit" class="form-control" style="height: 40px;">
                  <option value="-">-</option>
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
              </div>

              <div class="form-group col-md-6">
                <label>State</label>
                <select name="State" id="State" class="form-control" style="height: 40px;">
                  <option value="-">-</option>
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
              </div>

              <div class="form-group col-md-6">
                <label>Remark</label>
                <input type="text" class="form-control" autocomplete="off" name="Remark" id="Remark" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label>ค่าเสียโอกาส</label>
                <textarea name="difference" id="difference" autocomplete="off" class="form-control" style="height: 40px;" <?php if ($systemname !== 'Boonterm') echo 'disabled'; ?>></textarea>
              </div>


              <div class="form-group col-md-6">
                <label>ผู้รับเรื่อง</label>
                <select name="ผู้รับเรื่อง" id="ผู้รับเรื่อง" class="form-control" style="height: 40px;">
                  <option value="-">กรุณาเลือก</option>
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
              </div>
            </div>
            <input type="hidden" id="id">

          </form>
        </div>

        <div class="form-group col-md-6"><br><br> </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="editRow()" class="btn btnSave">บันทึก</button>

      </div>
    </div>
  </div>


  <!-- Edit modal -->





  <script src="css/style.js"></script>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>





  <script type="text/javascript" language="javascript">
    load_data(); // first load

    function load_data(initial_date, final_date, Category) {

      var systemname = "<?php echo $_REQUEST['systemname']; ?>";

      var ajax_url = "jquery/jquery-data.php?systemname="+ encodeURIComponent(systemname);


      $('#fetch_data').DataTable({
        "language": {
          "sEmptyTable": "ไม่มีข้อมูลที่ค้นหา",
          "sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
          "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
          "sInfoFiltered": "(กรองข้อมูลทั้งหมด _MAX_ รายการ)",
          "sInfoPostFix": "",
          "sInfoThousands": ",",
          "sLengthMenu": "แสดง _MENU_ รายการต่อหน้า",
          "sLoadingRecords": "กำลังโหลด...",
          "sProcessing": "กำลังประมวลผล...",
          "sSearch": "ค้นหา: ",
          "oPaginate": {
            "sNext": "ถัดไป",
            "sPrevious": "ก่อนหน้า"
          }
        },
        "order": [
          [0, "desc"]
        ],
        dom: 'lBfrtip',
        buttons: [{
            extend: 'csv',
            text: 'Export to CSV',
            charset: 'UTF-8',
            className: 'csv-button',
            filename: '<?php echo $_GET["systemname"]; ?>',
            bom: true
          },
          {
            extend: 'copy',
            charset: 'UTF-8',
            text: 'Copy Data',
            className: 'copy-button',
            bom: true
          }
        ],
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [
          [10, 25, 50, 100, -1],
          [10, 25, 50, 100, "All"]
        ],
        "ajax": {
          "url": ajax_url,
          "dataType": "json",
          "type": "POST",
          "data": {
            "action": "fetch_data",
            "initial_date": initial_date,
            "final_date": final_date,
            "Category": Category,
            "system" : systemname
          },
          "dataSrc": "records"
        },
        "columns": [
          {
            "data": "date"
          },
          {
            "data": "Issue_Start"
          },
          {
            "data": "Issue_End"
          },
          {
            "data": "Issue_Total"
          },
          {
            "data": "Issue_Case"
          },
          {
            "data": "Resolve_Cause"
          },
		  <?php if ($systemname === 'Boonterm'): ?>
          {
            "data": "Service_name"
          },
          {
            "data": "service_group"
          },
		  <?php endif; ?>
          {
            "data": "Category"
          },
          {
            "data": "State"
          },
          {
            "data": "Remark"
          },
		  <?php if ($systemname === 'Boonterm'): ?>
          {
            "data": "difference"
          },
		  <?php endif; ?>
          {
            "data": "ผู้รับเรื่อง"
          },
          {
            "data": "id",
            "render": function($d) {
              return '<button type="button"  data-toggle="modal" data-target="#editModal" data-whatever="' + $d + '" class="btn btnEdit"></button>    <button type="button"  id="' + $d + '" class="btn btnDelete" ></button>';
            }
          }

        ],
        "drawCallback": function(settings) {
          // รีเรนเดอร์สไตล์หลังจากการกรองข้อมูล
          $('.csv-button').css({
            'border': 'none',
            'background-color': '#39E549',
            'color': 'white',
            'padding': '6px 8px',
            'text-decoration': 'none',
            'cursor': 'pointer',
            'box-shadow': '0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.19)',
            'border-radius': '10%',
            'transition': 'all 0.3s ease',
          });


          $('.copy-button').css({
            'border': 'none',
            'background-color': '#39E549',
            'color': 'white',
            'padding': '6px 8px',
            'text-decoration': 'none',
            'cursor': 'pointer',
            'box-shadow': '0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.19)',
            'border-radius': '10%',
            'transition': 'all 0.3s ease',
          });
        }
      })
    }


    // delete function

    $(document).on("click", ".btnDelete", function() {
      var id = $(this).attr("id");
      if (confirm("คุณต้องการลบข้อมูล ใช่ หรือ ไม่?") == true) {
        $.ajax({
          url: "delete/delete-incident.php",
          method: "POST",
          data: {
            id: id
          },
          success: function(data) {
            alert("ลบข้อมูลเสร็จเรียบร้อยแล้ว");
            $('#fetch_data').DataTable().draw()
          }
        });
      }

    });


//เปลี่ยน date จาก Y-m-d เป็น d-m-Y ก่อน

    function formatDate(date) {
      var parts = date.split("-");
      return parts[2] + "-" + parts[1] + "-" + parts[0];
    }

// edit function
$('#editModal').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id = button.data('whatever'); // Extract info from data-* attributes

  var modal = $(this);
  $('#id').val(id);

  $.ajax({
    url: 'selectdata/select-data-incident.php',
    method: 'POST',
    data: {
      id: id
    },
    success: function(data) {
      var json = $.parseJSON(data);
	  var formattedDate = formatDate(json[0].date);
      $("#date").val(formattedDate);
      $("#Issue_Start").val(json[0].Issue_Start);
      $("#Issue_End").val(json[0].Issue_End);
      $("#Issue_Total").val(json[0].Issue_Total);
      $("#Issue_Case").val(json[0].Issue_Case);
      $("#Resolve_Cause").val(json[0].Resolve_Cause);
      $("#Service_name").val(json[0].Service_name);
      $("#service_group").val(json[0].service_group);  
      $("#Category_edit").val(json[0].Category);
      $("#State").val(json[0].State);
      $("#Remark").val(json[0].Remark);
      $("#difference").val(json[0].difference);
      $("#ผู้รับเรื่อง").val(json[0].ผู้รับเรื่อง);

      // Initialize flatpickr for Start Time input
      flatpickr("#Issue_Start", {
        enableTime: true,
        dateFormat: "d-m-Y : H:i",
        altInput: true,
        altFormat: "d-m-Y : H:i",
        time_24hr: true,
      });

      // Initialize flatpickr for End Time input
      flatpickr("#Issue_End", {
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
		minDate: "2000-01-01",
		allowInput: true,
      });
    }
  });
});

    function editRow() {
      if (confirm("คุณต้องการบันทึกข้อมูล ใช่ หรือ ไม่?") == true) {

        var id = $('#id').val();
        var date = $('#date').val();
        var Issue_Start = $('#Issue_Start').val();
        var Issue_End = $('#Issue_End').val();
        var Issue_Total = $('#Issue_Total').val();
        var Issue_Case = $('#Issue_Case').val();
        var Resolve_Cause = $('#Resolve_Cause').val();
        var Service_name = $('#Service_name').val();
        var service_group = $('#service_group').val();
        var Category = $('#Category_edit').val();
        var State = $('#State').val();
        var Remark = $('#Remark').val();
        var ผู้รับเรื่อง = $('#ผู้รับเรื่อง').val();
        var difference = $('#difference').val();

        $.ajax({
          url: 'update/update-incident.php',
          method: 'POST',
          data: {
            id: id,
            date: date,
            Issue_Start: Issue_Start,
            Issue_End: Issue_End,
            Issue_Total: Issue_Total,
            Issue_Case: Issue_Case,
            Resolve_Cause: Resolve_Cause,
            Service_name: Service_name,
            service_group: service_group,
            Category: Category,
            State: State,
            Remark: Remark,
            difference :difference,
			ผู้รับเรื่อง: ผู้รับเรื่อง
          },
          success: function(data) {
			if (data === 'time_error') {
				alert("End time น้อยกว่า Start Time โปรดตรวจสอบความถูกต้อง");
			} else {
          alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
          $('#fetch_data').DataTable().draw();
          $('#editModal').modal('toggle');
        }
      }
    });
  }
}











    // daterage function

	$("#filter").click(function() {
	  var initial_date = $("#initial_date").val();
	  var final_date = $("#final_date").val();
	  var Category = $("#Category").val();
	  var system = $("#system").val();

	  if (initial_date == '' && final_date == '') {
		$('#fetch_data').DataTable().destroy();
		load_data("", "", Category); // filter immortalize only
	  } else {
		var date1 = new Date(initial_date);
		var date2 = new Date(final_date);
		var diffTime = Math.abs(date2 - date1);
		var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

		if (initial_date == '' || final_date == '') {
		  $("#error_log").html("Warning: You must select both (start and end) date.</span>");
		} else {
		  $("#error_log").html("");
		  $('#fetch_data').DataTable().destroy();
		  load_data(initial_date, final_date, Category, system);
		}
	  }
	});

	$('.input-daterange').datepicker({
	  todayBtn: 'linked',
	  format: "dd-mm-yyyy",
	  autoclose: true
	});





    // datetime function

    function calculateTimeDifference() {
      var startTimeInput = document.getElementById('Issue_Start');
      var endTimeInput = document.getElementById('Issue_End');
      var totalInput = document.getElementById('Issue_Total');

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
    var startTimeInput = document.getElementById('Issue_Start');
    startTimeInput.addEventListener('change', calculateTimeDifference);
    var endTimeInput = document.getElementById('Issue_End');
    endTimeInput.addEventListener('change', calculateTimeDifference);




    document.addEventListener("DOMContentLoaded", function() {
    const startTimeInput = document.getElementById("Issue_Start");
    const endTimeInput = document.getElementById("Issue_End");
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





document.addEventListener('DOMContentLoaded', function() {
  const serviceSelect = document.getElementById('Service_name');
  const groupSelect = document.getElementById('service_group');

  serviceSelect.addEventListener('change', function() {
    const selectedService = serviceSelect.value;
    if (selectedService === '-') {
      // Set the service_group select to the default option when Service_name is selected as '-'
      groupSelect.innerHTML = '<option value="-" selected>กรุณาเลือก</option>';
    } else {
      // Make an AJAX request to fetch service groups based on the selected service
      fetchServiceGroups(selectedService);
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
    groupSelect.innerHTML = ''; // Clear previous options
    groups.forEach(group => {
      const option = document.createElement('option');
      option.value = group;
      option.textContent = group;
      groupSelect.appendChild(option);
    });
  }
});



  document.addEventListener("DOMContentLoaded", function() {
  // สร้างตัวแปรเพื่ออ้างอิงถึง textarea
  const differenceTextarea = document.getElementById("difference");

  // เพิ่ม Event Listener เมื่อมีการปล่อยปุ่มแป้นคาดเครื่องหมาย (keyup)
  differenceTextarea.addEventListener("keyup", function() {
    // ตรวจสอบว่าข้อมูลที่กรอกเป็นตัวเลขหรือไม่
    if (!/^\d*$/.test(this.value)) {
      // ถ้าไม่ใช่ตัวเลข ให้ล้างข้อมูลใน textarea
      this.value = "";
    }
  });
});
  

  </script>
</body>

</html>