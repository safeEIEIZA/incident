<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_data'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Category = $_REQUEST['Category'];
    $systemname = $_GET['systemname'];

    
    if (!empty($initial_date) && !empty($final_date)) {
        $initial_date_parts = explode('-', $initial_date);
        $final_date_parts = explode('-', $final_date);
    
        $initial_day = $initial_date_parts[0];
        $initial_month = $initial_date_parts[1];
        $initial_year = $initial_date_parts[2];
    
        $final_day = $final_date_parts[0];
        $final_month = $final_date_parts[1];
        $final_year = $final_date_parts[2];
    
        $formatted_initial_date = $initial_year . '-' . $initial_month . '-' . $initial_day;
        $formatted_final_date = $final_year . '-' . $final_month . '-' . $final_day;
    
        $date_range = " AND date BETWEEN '".$formatted_initial_date." 00:00:00' AND '".$formatted_final_date." 23:59:59' ";
    } else {
        $date_range = "";
    }
    
    if($Category != ''){
        $Category = " AND Category = '$Category' ";
    }


    
    $columns = 'id,date,Issue_Start,Issue_End,Issue_Total,Issue_Case,Resolve_Cause,Service_name,difference,service_group,Category,State,Remark,ผู้รับเรื่อง,system';
    $table = ' incident_report ';
    $where = " WHERE id != '' " . $date_range . $Category . " AND system = '$systemname' ";

    $columns_order = array(
        0 => 'id',
        1 => 'date',
        2 => 'Issue_Start',
        3 => 'Issue_End',
        4 => 'Issue_Total',
        5 => 'Issue_Case',
        6 => 'Resolve_Cause',
        7 => 'Service_name',
        14 => 'service_group',
        15 => 'difference',
        8 => 'Category',
        9 => 'State',
        10 => 'Remark',
        11 => 'ผู้รับเรื่อง',
        12 => 'id',
        13 => 'system'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;



    if( !empty($requestData['search']['value']) ) {
        
        $sql.=" AND ( Issue_Start LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR date_x LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR ผู้รับเรื่อง LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Issue_Case LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Resolve_Cause LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Service_name LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Category LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR State LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Remark LIKE '%".$requestData['search']['value']."%' )";                             
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    
    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];                                    
    }

    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;                                                                                                                                                                                                                                                                                                                                                                                                                
        $nestedData = array();
        $id =$row["id"];

        $nestedData['date'] = date('d-m-Y', strtotime($row["date"]));
        $nestedData['id'] = $row["id"];
        $nestedData['Issue_Start'] = $row["Issue_Start"];
        $nestedData['Issue_End'] = $row["Issue_End"];
        $nestedData['Issue_Total'] = $row["Issue_Total"];
        $nestedData['Issue_Case'] = $row["Issue_Case"];
        $nestedData['Resolve_Cause'] = $row["Resolve_Cause"];
        $nestedData['Service_name'] = $row["Service_name"];
        $nestedData['service_group'] = $row["service_group"];
        $nestedData['Category'] = $row["Category"];
        $nestedData['State'] = $row["State"];
        $nestedData['Remark'] = $row["Remark"];
        $nestedData['ผู้รับเรื่อง'] = $row["ผู้รับเรื่อง"];
        $nestedData['system'] = $row["system"];
        $nestedData['difference'] = $row["difference"];

        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>