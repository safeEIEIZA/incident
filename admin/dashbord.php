<?php


include "config/db-config.php";
include("head/head.php");
?>

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
if ($level != 'Admin') {
    Header("Location: ../login/logout.php");
}

// Case Total
$query = "SELECT COUNT(*) as id FROM incident_report";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalCase = $row['id'];

// User Total
$query = "SELECT COUNT(*) as id FROM table_name";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['id'];

// System Total
$query = "SELECT COUNT(*) as id FROM table_system";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalSystem = $row['id'];

// TypeCase Total
$query = "SELECT COUNT(*) as id FROM type_case";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalTypeCase = $row['id'];

// State Total
$query = "SELECT COUNT(*) as id FROM table_state";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalState = $row['id'];

// Service Total
$query = "SELECT COUNT(*) as id FROM service_name";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalService = $row['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>

    .chart-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            
        }

        .chart-card:not(:hover) {
            opacity: 0.8; 
        }

        .chart-card:hover {
            transform: scale(1.05);
        }

    .card-header {
        background-color: black;
        color: #fff;
        padding: 10px;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .chart-container {
        width: 100%;
        height: 300px;
    }

    .card {
        height: 100%;
    }


/* user*/

.user-card {
    box-sizing: border-box;
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    width: 100%; /* Set width to 100% to make it fill the container */
    height: 200px;
    margin: 0 auto;
}

/* If you have a container for the cards, ensure it has enough width */
.container {
    display: flex;
    justify-content: space-between; /* or any other suitable value */
    /* Add additional styles as needed */
}

.user-card-body {
        padding: 40px;
        text-align: center;
    }
    .card-text {
        font-size: 60px;
        font-weight: bold;
        color: #28a745;
        text-align: center;
    }
    .user-card-header {
        background-color: #FF6363;
        color: #fff;
        padding: 10px;
        font-weight: bold;
    }

    /*icon ss*/
    .fa-cog:hover {
    transform: scale(2.0); /* 1.2 คือการขยายขนาด 20% เมื่อถูกเลือก */
    transition: transform 0.5s ease-in-out; /* 0.3s คือระยะเวลาของการทำ transition */
    }
</style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/style-index.css" />
    <link rel="stylesheet" href="css/style-header-h2.css">
    <link rel="stylesheet" href="css/style-table.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



    
</head>

<body>
<br>
<br>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card mt-4 chart-card user-card">
            <div class="user-card-header">Case Total</div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalCase; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card mt-4  chart-card user-card">
            <div class="user-card-header" style="text-align: right;">
                <span style="float: left;">User Total</span>
                <i class="fa fa-cog" aria-hidden="true" id="go-to-page1" style="display: inline-block;"></i>
            </div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalUsers; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card mt-4  chart-card user-card">
            <div class="user-card-header" style="text-align: right;">
                <span style="float: left;">System Total</span>
                <i class="fa fa-cog" aria-hidden="true" id="go-to-page2" style="display: inline-block;"></i>
            </div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalSystem; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart3"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card mt-4  chart-card user-card">
            <div class="user-card-header" style="text-align: right;">
                <span style="float: left;">TypeCase Total</span>
                <i class="fa fa-cog" aria-hidden="true" id="go-to-page3" style="display: inline-block;"></i>
            </div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalTypeCase; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card mt-4  chart-card user-card">
            <div class="user-card-header" style="text-align: right;">
                <span style="float: left;">State Total</span>
                <i class="fa fa-cog" aria-hidden="true" id="go-to-page4" style="display: inline-block;"></i>
            </div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalState; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart5"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card mt-4  chart-card user-card">
            <div class="user-card-header" style="text-align: right;">
                <span style="float: left;">Service Total</span>
                <i class="fa fa-cog" aria-hidden="true" id="go-to-page5" style="display: inline-block;"></i>
            </div>
                <!-- The updated card body with total users -->
                <div class="user-card-body">
                    <p class="card-text"><?php echo $totalService; ?></p>
                    <div class="chart-container pie-chart">
                        <canvas id="user_chart5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-4 chart-card">
                    <div class="card-header">System Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="system_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-4 chart-card">
                    <div class="card-header">Category Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="category_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mt-4 chart-card">
                    <div class="card-header">Recipient Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="recipient_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>




<script>
    $(document).ready(function() {
        makeCategoryChart();
        makeSystemChart();
        makeผู้รับเรื่องChart();

        function makeCategoryChart() {
            $.ajax({
                url: "dataquery/data_Category.php",
                method: "POST",
                data: {
                    action: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var categoryData = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        categoryData.push(data[count].Category);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var category_chart_data = {
                        labels: categoryData,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            color: '#fff',
                            data: total
                        }]
                    };

                    var category_chart = $('#category_chart');

                    var category_graph = new Chart(category_chart, {
                        type: "doughnut",
                        data: category_chart_data,
                        options: {
                            title: {
                                display: true,
                            },
                            legend: {
                                display: true,
                                position: 'right'
                            }
                        }
                    });
                }
            });
        }

        function makeผู้รับเรื่องChart() {
            $.ajax({
                url: "dataquery/data_ผู้รับเรื่อง.php",
                method: "POST",
                data: {
                    action: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var recipientData = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        recipientData.push(data[count].ผู้รับเรื่อง);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var recipient_chart_data = {
                        labels: recipientData,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            color: '#fff',
                            data: total
                        }]
                    };

                    var recipient_chart = $('#recipient_chart');

                    var recipient_graph = new Chart(recipient_chart, {
                        type: "doughnut",
                        data: recipient_chart_data,
                        options: {
                            title: {
                                display: true,
                            },
                            legend: {
                                display: true,
                                position: 'right'
                            }
                        }
                    });
                }
            });
        }

        function makeSystemChart() {
            $.ajax({
                url: "dataquery/data_system.php",
                method: "POST",
                data: {
                    action: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var systemData = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        systemData.push(data[count].system);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var system_chart_data = {
                        labels: systemData,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            color: '#fff',
                            data: total
                        }]
                    };

                    var system_chart = $('#system_chart');

                    var system_graph = new Chart(system_chart, {
                        type: "doughnut",
                        data: system_chart_data,
                        options: {
                            title: {
                                display: true,
                            },
                            legend: {
                                display: true,
                                position: 'right'
                            }

                        }
                    });
                }
            });
        }
    });


    document.getElementById('go-to-page1').addEventListener('click', function() {
        window.location.href = 'employee_manage.php';
    });
    document.getElementById('go-to-page2').addEventListener('click', function() {
        window.location.href = 'system_manage.php';
    });
    document.getElementById('go-to-page3').addEventListener('click', function() {
        window.location.href = 'typecase_manage.php';
    });
    document.getElementById('go-to-page4').addEventListener('click', function() {
        window.location.href = 'state_manage.php';
    });
    document.getElementById('go-to-page5').addEventListener('click', function() {
        window.location.href = 'service_manage.php';
    });
</script>
</body>

</html>


