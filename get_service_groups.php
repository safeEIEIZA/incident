<?php
include "config/db-config.php";

if (isset($_GET['service'])) {
  $selectedService = $_GET['service'];

  $sql = "SELECT service_group FROM service_name WHERE name_service = ?";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param("s", $selectedService);
  $stmt->execute();
  $result = $stmt->get_result();

  $groups = [];
  while ($row = $result->fetch_assoc()) {
    $groups[] = $row['service_group'];
  }

  echo json_encode($groups);
}

$connection->close();
?>