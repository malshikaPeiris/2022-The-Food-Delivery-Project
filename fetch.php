
<?php

//fetch.php

include('connection.php');

$column = array('id', 'image','category_name','menu_name','menu_description','menu_item_price','menu_qty');

$query = "SELECT * FROM menuTable";

if(isset($_POST['search']['value']))
{
 $query .= '
 WHERE image LIKE "%'.$_POST['search']['value'].'%" 
 OR category_name LIKE "%'.$_POST['search']['value'].'%" 
 OR menu_name LIKE "%'.$_POST['search']['value'].'%" 
 OR menu_description LIKE "%'.$_POST['search']['value'].'%" 
 OR menu_item_price LIKE "%'.$_POST['search']['value'].'%" 
 OR menu_qty LIKE "%'.$_POST['search']['value'].'%" 

 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY menu_name DESC ';
}

$query1 = '';

if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
//  $sub_array[] = $row['image'];
 $sub_array[] = $row['category_name'];
 $sub_array[] = $row['menu_name'];
 $sub_array[] = $row['menu_description'];
 $sub_array[] = $row['menu_unit_price'];
 $sub_array[] = $row['menu_qty'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM menuTable";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);

echo json_encode($output);

?>
