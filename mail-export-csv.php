<?php
session_start();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

if(isset($_SESSION['export_data_csv'])){
    $data = $_SESSION['export_data_csv'];
}else{
    $data = "N/A";
}

$fp = fopen('php://output', 'wb');
foreach ( $data as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);

//unset($_SESSION['export_data_csv']);


?>