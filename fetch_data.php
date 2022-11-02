<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM menuTable";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'category_name',
	2 => 'menu_name',
	3 => 'menu_description',
	4 => 'menu_unit_price',
	5 => 'image',
	6 => 'menu_qty',

	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE image like '%".$search_value."%'";
	$sql .= " OR category_name like '%".$search_value."%'";
	$sql .= " OR menu_name like '%".$search_value."%'";
	$sql .= " OR menu_description like '%".$search_value."%'";
	$sql .= " OR menu_unit_price like '%".$search_value."%'";
	$sql .= " OR menu_qty like '%".$search_value."%'";
	
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

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['category_name'];
	$sub_array[] = $row['menu_name'];
	$sub_array[] = $row['menu_description'];
	$sub_array[] = $row['menu_unit_price'];
	$sub_array[] = '<img style ="width : 80px;" src ="'.$row['image'].'"/>';
	$sub_array[] = $row['menu_qty'];

	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'" class="btn btn-info btn-sm editbtn" >Edit</a> <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a> <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm viewBtn" >View</a>';
	// javascript:void();
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
