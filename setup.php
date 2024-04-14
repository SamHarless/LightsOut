<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$rows = isset($_GET['rows']) ? (int)$_GET['rows'] : 0;
$columns = isset($_GET['columns']) ? (int)$_GET['columns'] : 0;


$total_boxes = $rows * $columns;


$on_positions = [];

if ($total_boxes >= 10) {
    // If there are 10 or more boxes, select 10 random positions
    $chosen_positions = array_rand(range(0, $total_boxes - 1), 10); //returns ketys of the 10 random spots, range makes a array of [0,...,totalboxs-1]
    foreach ($chosen_positions as $pos) {
        $row = (int)($pos/$columns);
        $col = $pos % $columns;
        $on_positions[] = ['row' => $row, 'col' => $col];
    }
} else {
    // If there are less than 10 boxes, all lights should be on
    for ($i = 0; $i < $total_boxes; $i++) {
        $row = (int)($i/$columns);
        $col = $i % $columns;
        $on_positions[] = ['row' => $row, 'col' => $col];
    }
}

// Return the positions as a JSON object
header('Content-Type: application/json');
echo json_encode(['lightsOnPositions' => $on_positions]);
?>
