<?php
// Load the database configuration file
include_once 'connection.php';

// Filter the excel data
function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download
$fileName = "countries-data_" . date('Y-m-d') . ".xls";

// Column names
$fields = array('ID', 'NAME', 'Latitude', 'Longitude', 'Region', 'Subregion');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
$query = $con->query("SELECT * FROM countries ORDER BY id ASC");
if($query->num_rows > 0){
    // Output each row of the data
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['name'], $row['latitude'], $row['longitude'], $row['region'], $row['subregion']);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else{
    $excelData .= 'No records found...'. "\n";
}

// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data
echo $excelData;

exit;