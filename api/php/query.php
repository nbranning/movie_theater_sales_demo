<?php
require './config.php';

$returnJson = [
    'success' => false,
];

$date = $_GET['date'] ?? null;
if ($date && !DateTime::createFromFormat('Y-m-d', $date)) {
    $returnJson['message'] = 'Invalid date format';
    echo json_encode($returnJson);
    exit;
}

if ($date) {
    $query = $conn->prepare("SELECT theater_id, SUM(sales_amount) as total_sales FROM sales WHERE sales_date = ? GROUP BY theater_id ORDER BY total_sales DESC LIMIT 1");
    $query->bind_param('s', $date);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $theaterId = $row['theater_id'];
        $sales = $row['total_sales'];

        $theaterResult = $conn->query("SELECT * FROM theaters WHERE id = $theaterId");
        $theater = $theaterResult->fetch_assoc();
        $returnJson['success'] = true;
        $returnJson['data'] = [
            'theater' => $theater,
            'total_sales' => $sales
        ];

    } else {
        $returnJson['message'] = 'No data found';
    }
} else {
    $returnJson['message'] = 'Invalid date';
}

echo json_encode($returnJson);
?>
