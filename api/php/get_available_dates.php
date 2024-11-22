<?php
require './config.php';

$query = $conn->prepare("SELECT sales_date FROM sales GROUP BY sales_date");
$query->execute();

$result = $query->get_result();
$dates = [];
foreach($result as $row) {
    $dates[] = $row['sales_date'];
}

echo json_encode($dates);
