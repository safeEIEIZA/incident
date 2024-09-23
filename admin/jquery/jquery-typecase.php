<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_data'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Category = $_REQUEST['Category'];


    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }
    
    if($Category != ''){
        $Category = " AND Category = '$Category' ";
    }
    
    $columns = 'id,type_name';
    $table = ' type_case ';
    $where = " WHERE id!='' ".$date_range.$Category;

    $columns_order = array(
        0 => 'id',
        1 => 'type_name',
        2 => 'id'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;



    if( !empty($requestData['search']['value']) ) {
        $sql .= " AND ( id LIKE '%".$requestData['search']['value']."%' ";
        $sql .= " OR type_name LIKE '%".$requestData['search']['value']."%' )"; // เพิ่มนี้
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

        $nestedData['type_name'] = $row["type_name"];
        $nestedData['id'] = $row["id"];


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