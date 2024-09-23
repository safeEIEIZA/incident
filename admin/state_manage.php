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
<h2 class="expand-on-hover">&nbsp;STATE MANAGE</h2>
  <br>

  


  <div class="container">
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-1">
        </div>

        <button type="button" style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#state_addModal" >เพิ่ม State <i class="fa fa-plus"></i> </button>
        <br><br>



      <table id="fetch_data" class="display" cellspacing="0" width="100%" align="center">
        <thead>

        <tr>
            <th style="width:3%">#</th>
            <th style="width:7%">State Name</th>
            <th style="width:3%">Tool</th>
          </tr>
        </thead>

      </table>

    </div>
  </div>



  <!-- Edit modal -->

  <div class="modal" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">แก้ไขชื่อ State</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
            <div class="form-group col-md-3"></div>
            <div class="form-group col-md-6">
                <label>State Name</label>
                <input type="text" class="form-control" autocomplete="off" name="state_name" id="state_name" style="height: 40px;" />
              </div>

            </div>
            <input type="hidden" id="id">

          </form>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="editRow()" class="btn btnSave">บันทึก</button>

      </div>
    </div>
  </div>


  <!-- Edit modal -->

    <!-- add modal -->

    <div class="modal" id="state_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="text-align:center" class="modal-title" id="exampleModalLabel">เพิ่ม State</h2>
        </div>
        <br>
        <div class="modal-body">
          <form>
            <div class="form-row">
            <div class="form-group col-md-3"></div>
            <div class="form-group col-md-6">
                <label>State Name</label><labeld style="font-size: 15px;" class="flashing-textd">&nbsp;*ระบุชื่อ State ที่จะเพิ่ม</labeld>
                <input type="text" class="form-control" autocomplete="off" name="addstate_name" id="addstate_name" style="height: 40px;" />
              </div>

            </div>
            <input type="hidden" id="id">

          </form>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="saveData()" class="btn btnSave">บันทึก</button>

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
      var ajax_url = "jquery/jquery-state.php";

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
        "columns": [
          {
            "data": "id"
          },
          {
            "data": "state_name"
          },
          {
            "data": "id",
            "render": function($d) {
              return '<button type="button"  data-toggle="modal" data-target="#stateModal" data-whatever="' + $d + '" class="btn btnEdit"></button>    <button type="button"  id="' + $d + '" class="btn btnDelete" ></button>';
            }
          }

        ]
      })
    }


    // delete function

    $(document).on("click", ".btnDelete", function() {
      var id = $(this).attr("id");
      if (confirm("คุณต้องการลบข้อมูล ใช่ หรือ ไม่?") == true) {
        $.ajax({
          url: "delete/delete-state.php",
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
    $('#stateModal').on('show.bs.modal', function(event) {


      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      // modal.find('.modal-body input').val(recipient)

      $('#id').val(id);

      $.ajax({
        url: 'selectdata/select-data-state.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {

          var json = $.parseJSON(data);
          $("#state_name").val(json[0].state_name);
        }
      })


    })

    function editRow() {
      if (confirm("คุณต้องการบันทึกข้อมูล ใช่ หรือ ไม่?") == true) {

        var id = $('#id').val();
        var state_name = $('#state_name').val();

        $.ajax({
          url: 'update/update-state.php',
          method: 'POST',
          data: {
            id: id,
            state_name: state_name
          },
          success: function(data) {

            alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว')
            $('#fetch_data').DataTable().draw()
            $('#stateModal').modal('toggle');

          }
        })
      }

    }



    function saveData() {
      if (confirm("คุณต้องการบันทึกข้อมูล ใช่ หรือ ไม่?") == true) {

          var addstate_name = $('#addstate_name').val();

          $.ajax({
            url: 'insert/insert-state.php',
            method: 'POST',
            data: {
              addstate_name: addstate_name
            },
            success: function(data) {

              alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว')
              $('#fetch_data').DataTable().draw()
              $('#addstate_name').val(''); // เคลียร์ข้อมูลในช่อง
              $('#state_addModal').modal('toggle');

            }
          })
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