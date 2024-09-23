<?php

$connect = new PDO("mysql:host=localhost;dbname=incident", "root", "");

if (isset($_POST["action"])) {

    if ($_POST["action"] == 'fetch') {
        $query = "
        SELECT system,COUNT(id) AS Total 
        FROM incident_report 
        GROUP BY system
        ";

        $result = $connect->query($query);

        $data = array();

        foreach ($result as $row) {
            $data[] = array(
                'system'  => $row["system"],
                'total'     => $row["Total"],
                'color'     => '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
}

?>