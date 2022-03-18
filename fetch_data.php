<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM countries";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'name',
	2 => 'latitude',
	3 => 'longitude',
	4 => 'region',
	5 => 'subregion',
);

$where = array();
$whereCheck = "";
foreach($columns as $key => $column){
    if(isset($_POST['columns']) && $_POST['columns'][$key]['data'] == $column && $_POST['columns'][$key]['search']['value'] != ""){
        $search_value = $_POST['columns'][$key]['search']['value'];
        $column =$_POST['columns'][$key]['data'];
        if($whereCheck ==""){
            $whereCheck = "OK";
            $sql .= " WHERE ".$_POST['columns'][$key]['data']." like '%".$search_value."%'";
        }else{
            $sql .= " OR ".$_POST['columns'][$key]['data']." like '%".$search_value."%'";
        }

    }
}


    if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
{
	$search_value = $_POST['search']['value'];
    if($whereCheck ==""){
	$sql .= " WHERE name like '%".$search_value."%'";
    $sql .= " OR region like '%".$search_value."%'";
	$sql .= " OR subregion like '%".$search_value."%'";
    }else{
        $sql .= "  OR name like '%".$search_value."%'";
        $sql .= " OR region like '%".$search_value."%'";
        $sql .= " OR subregion like '%".$search_value."%'";
    }


}



if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
//var_dump($sql);
$data = array();
$countries = array();
while($row = mysqli_fetch_assoc($query))
{
	$countries[] = array_map('utf8_encode', $row);
}
foreach($countries as $row){
    $sub_array = array();
    $sub_array['id'] = $row['id'];
    $sub_array['name'] = $row['name'];
    $sub_array['latitude'] = $row['latitude'];
    $sub_array['longitude'] = $row['longitude'];
    $sub_array['region'] = $row['region'];
    $sub_array['subregion'] = $row['subregion'];
    $data[] = $sub_array;
}
//print_r($count_rows);
$output = array(
	'draw'=>intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
$result = json_encode($output);
//var_dump($result);
echo $result;


//switch (json_last_error()) {
//    case JSON_ERROR_NONE:
//        echo ' - No errors';
//        break;
//    case JSON_ERROR_DEPTH:
//        echo ' - Maximum stack depth exceeded';
//        break;
//    case JSON_ERROR_STATE_MISMATCH:
//        echo ' - Underflow or the modes mismatch';
//        break;
//    case JSON_ERROR_CTRL_CHAR:
//        echo ' - Unexpected control character found';
//        break;
//    case JSON_ERROR_SYNTAX:
//        echo ' - Syntax error, malformed JSON';
//        break;
//    case JSON_ERROR_UTF8:
//        echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
//        break;
//    default:
//        echo ' - Unknown error';
//        break;
//}
//
//echo PHP_EOL;