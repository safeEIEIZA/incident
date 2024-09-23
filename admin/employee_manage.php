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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />

  <link rel="stylesheet" href="css/stylemd.css">
  <link rel="stylesheet" href="css/style-header-h2.css">
  <link rel="stylesheet" href="css/style-table.css">
  <link rel="stylesheet" href="css/style-manage.css">
  <link rel="stylesheet" href="css/style-background.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>

  <br>
  <h2 class="expand-on-hover">&nbsp;EMPLOYEE MANAGE</h2>
  <br>




  <div class="container">
    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-1">
      </div>

      <button type="button" style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#employee_addModal">เพิ่มผู้รับเรื่อง <i class="fa fa-plus"></i> </button>
      <br><br>



      <table id="fetch_data" class="display" cellspacing="0" width="100%" align="center">
        <thead>

          <tr>
            <th style="width:3%">#</th>
            <th style="width:10%">Employee Name</th>
            <th style="width:3%">Level</th>
            <th style="width:3%">Tool</th>
          </tr>
        </thead>

      </table>

    </div>
  </div>



  <!-- Edit modal -->

  <div class="modal" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">แก้ไขชื่อผู้รับเรื่อง</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Employee Name</label>
                <labeld style="font-size: 15px;" class="flashing-textd">&nbsp;*ชื่อที่แสดงในตัวเลือก</labeld>
                <input type="text" class="form-control" autocomplete="off" name="name" id="name" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label>Sername</label>
                <input type="text" class="form-control" autocomplete="off" name="sername" id="sername" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label>Username</label>
                <labeld style="font-size: 15px;" class="flashing-textd">&nbsp;*Username Login</labeld>
                <input type="text" class="form-control" autocomplete="off" name="username" id="username" style="height: 40px;" />
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" class="form-control" autocomplete="off" name="password" id="password" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label>Level</label>
                <select name="level" id="level" class="form-control" style="height: 40px;">
                  <option value="-">กรุณาเลือก</option>
                  <?php

                  include "config/db-config.php";


                  $sql = "SELECT level FROM table_level";
                  $result = $connection->query($sql);


                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row["level"] . '">' . $row["level"] . '</option>';
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="editRow()" class="btn btnSave">บันทึก</button>

      </div>
    </div>
  </div>


  <!-- Edit modal -->

  <!-- add modal -->

  <div class="modal" id="employee_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">เพิ่มผู้รับเรื่อง</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Employee Name</label>
                <labeld style="font-size: 15px;" class="flashing-textd">&nbsp;*ชื่อที่แสดงในตัวเลือก</labeld>
                <input type="text" class="form-control" autocomplete="off" name="add_name" id="add_name" style="height: 40px;" />
              </div>
              <div class="form-group col-md-6">
                <label>Sername</label>
                <input type="text" class="form-control" autocomplete="off" name="add_sername" id="add_sername" style="height: 40px;" />
              </div>


              <div class="form-group col-md-6">
                <label>Username</label>
                <labeld style="font-size: 15px;" class="flashing-textd">&nbsp;*Username Login</labeld>
                <input type="text" class="form-control" autocomplete="off" name="add_username" id="add_username" style="height: 40px;" />
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" class="form-control" autocomplete="off" name="add_password" id="add_password" style="height: 40px;" />
              </div>

              <div class="form-group col-md-6">
                <label>Level</label>
                <select name="add_level" id="add_level" class="form-control" style="height: 40px;">
                  <option value=" ">กรุณาเลือก</option>
                  <?php

                  include "config/db-config.php";


                  $sql = "SELECT level FROM table_level";
                  $result = $connection->query($sql);


                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row["level"] . '">' . $row["level"] . '</option>';
                    }
                  }


                  $connection->close();
                  ?>
                </select>
              </div>

              <div class="form-group col-md-6"> </div>

            </div>
            <input type="hidden" id="id">

          </form>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="saveData()" class="btn btnSave">บันทึก</button>

      </div>
    </div>
  </div>


  <!-- Edit modal -->



  <!-- view modal -->

  <div class="modal" id="employee_viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">รายละเอียดผู้รับเรื่อง</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Employee Name</label>
                <input type="text" class="form-control" autocomplete="off" name="view_name" id="view_name" style="height: 40px;" disabled />
              </div>
              <div class="form-group col-md-6">
                <label>Sername</label>
                <input type="text" class="form-control" autocomplete="off" name="view_sername" id="view_sername" style="height: 40px;" disabled />
              </div>


              <div class="form-group col-md-6">
                <label>Username</label>
                <input type="text" class="form-control" autocomplete="off" name="view_username" id="view_username" style="height: 40px;" disabled />
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" class="form-control" autocomplete="off" name="view_password" id="view_password" style="height: 40px;" disabled />
              </div>

              <div class="form-group col-md-6">
                <label>Level</label>
                <input type="text" class="form-control" autocomplete="off" name="view_level" id="view_level" style="height: 40px;" disabled />
              </div>

              <div class="form-group col-md-6"> </div>

            </div>
            <input type="hidden" id="id">

          </form>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ปิด</button>

      </div>
    </div>
  </div>


  <!-- view modal -->






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
      var ajax_url = "jquery/jquery-employee.php";

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
            "Category": Category
          },
          "dataSrc": "records"
        },
        "columns": [{
            "data": "id"
          },
          {
            "data": "name"
          },
          {
            "data": "level"
          },
          {
            "data": "id",
            "render": function($d) {
              return '<button type="button"  data-toggle="modal" data-target="#employee_viewModal" data-whatever="' + $d + '" class="btn btnView"></button> <button type="button"  data-toggle="modal" data-target="#employeeModal" data-whatever="' + $d + '" class="btn btnEdit"></button>    <button type="button"  id="' + $d + '" class="btn btnDelete" ></button>';
            }
          }

        ]
      })
    }


    // view function

    $('#employee_viewModal').on('show.bs.modal', function(event) {

      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      // modal.find('.modal-body input').val(recipient)

      $('#id').val(id);

      $.ajax({
        url: 'selectdata/select-data-employee.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {

          var json = $.parseJSON(data);
          $("#view_name").val(json[0].name);
          $("#view_sername").val(json[0].sername);
          $("#view_username").val(json[0].username);
          $("#view_password").val(json[0].password);
          $("#view_level").val(json[0].level);
        }
      })

    })




    // delete function

    $(document).on("click", ".btnDelete", function() {
      var id = $(this).attr("id");
      if (confirm("คุณต้องการลบข้อมูล ใช่ หรือ ไม่?") == true) {
        $.ajax({
          url: "delete/delete-employee.php",
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





    // edit function
    $('#employeeModal').on('show.bs.modal', function(event) {


      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      // modal.find('.modal-body input').val(recipient)

      $('#id').val(id);

      $.ajax({
        url: 'selectdata/select-data-employee.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {

          var json = $.parseJSON(data);
          $("#name").val(json[0].name);
          $("#sername").val(json[0].sername);
          $("#username").val(json[0].username);
          $("#password").val(json[0].password);
          $("#level").val(json[0].level);
        }
      })


    })

    function editRow() {
      if (confirm("คุณต้องการบันทึกข้อมูล ใช่ หรือ ไม่?") == true) {

        var id = $('#id').val();
        var name = $('#name').val();
        var sername = $('#sername').val();
        var username = $('#username').val();
        sername
        var password = $('#password').val();
        var level = $('#level').val();
        $.ajax({
          url: 'update/update-employee.php',
          method: 'POST',
          data: {
            id: id,
            name: name,
            sername: sername,
            username: username,
            password: password,
            level: level
          },
          success: function(data) {

            alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว')
            $('#fetch_data').DataTable().draw()
            $('#employeeModal').modal('toggle');

          }
        })
      }

    }



    function saveData() {
      var add_name = $('#add_name').val();
      var add_username = $('#add_username').val();
      var add_password = $('#add_password').val();
      var add_level = $('#add_level').val();
      var add_sername = $('#add_sername').val();
      // เช็คว่าเลือก level หรือไม่
      if (add_level === " ") {
        alert("กรุณาเลือก level");
        return;
      }

      // เช็คว่ากรอกรหัสผ่านหรือไม่
      if (add_password.trim() === "") {
        alert("กรุณากรอกรหัสผ่าน");
        return;
      }

      if (confirm("คุณต้องการบันทึกข้อมูล ใช่ หรือ ไม่?") == true) {
        $.ajax({
          url: 'insert/insert-employee.php',
          method: 'POST',
          data: {
            add_name: add_name,
            add_username: add_username,
            add_password: add_password,
            add_level: add_level,
            add_sername: add_sername
          },
          success: function(data) {
            alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
            $('#fetch_data').DataTable().draw();
            $('#add_name').val(''); // เคลียร์ข้อมูลในช่อง
            $('#add_username').val(''); // เคลียร์ข้อมูลในช่อง
            $('#add_password').val(''); // เคลียร์ข้อมูลในช่อง
            $('#add_sername').val(''); // เคลียร์ข้อมูลในช่อง
            $('#employee_addModal').modal('toggle');
          }
        });
      }
    }


















    // daterage function

    $("#filter").click(function() {
      var initial_date = $("#initial_date").val();
      var final_date = $("#final_date").val();
      var Category = $("#Category").val();

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
          if (date1 > date2) {
            $("#error_log").html("Warning: End date should be greater then start date.");
          } else {
            $("#error_log").html("");
            $('#fetch_data').DataTable().destroy();
            load_data(initial_date, final_date, Category);


          }
        }
      }
    });

    $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: "yyyy-mm-dd",
      autoclose: true
    });
  </script>
</body>

</html>