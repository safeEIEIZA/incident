<?php

$connect = new PDO("mysql:host=localhost;dbname=incident", "root", "");

if (isset($_POST["action"])) {

    if ($_POST["action"] == 'fetch') {
        $query = "
        SELECT ผู้รับเรื่อง,COUNT(id) AS Total 
        FROM incident_report 
        GROUP BY ผู้รับเรื่อง
        ";

        $result = $connect->query($query);

        $data = array();

        foreach ($result as $row) {
            $data[] = array(
                'ผู้รับเรื่อง'  => $row["ผู้รับเรื่อง"],
                'total'     => $row["Total"],
                'color'     => '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
}

?>