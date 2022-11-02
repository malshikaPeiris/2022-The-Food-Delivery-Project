<?php 
include('connection.php');
$id = $_POST['id'];
$category_name = $_POST['category_name'];
$menu_name = $_POST['menu_name'];
$menu_description = $_POST['menu_description'];
$menu_unit_price = $_POST['menu_unit_price'];
$menu_qty = $_POST['menu_qty'];

$sql = "UPDATE `menuTable` set  id=$id,category_name='$category_name',menu_name='$menu_name',menu_description='$menu_description',menu_unit_price='$menu_unit_price',menu_qty='$menu_qty'
where id=$id ";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    // $data = array(
    //     'status'=>'true',
       
    // );

    // echo json_encode($data);
    header('location:malki_index.php');
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>