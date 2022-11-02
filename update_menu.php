<?php
include 'connection.php';
$id = $_GET['updateid'];
$sql = "Select * from `menu_table` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$image = $row['image'];
$category_name = $row['category_name'];
$menu_name = $row['menu_name'];
$menu_description = $row['menu_description'];
$menu_unit_price = $row['menu_unit_price'];
$menu_qty = $row['menu_qty'];

if (isset($_POST['submit'])) {
    $image = $_POST['image'];
    $category_name = $_POST['category_name'];
    $menu_name = $_POST['menu_name'];
    $menu_description = $_POST['menu_description'];
    $menu_unit_price = $_POST['menu_unit_price'];
    $menu_qty = $_POST['menu_qty'];

    $sql = "update `menu_table` set id=$id,image='$image', category_name='$category_name',menu_name='$menu_name',menu_description ='$menu_description',menu_unit_price ='$menu_unit_price',menu_qty ='$menu_qty'
    where id=$id ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "data Updated successfully";
        header('location:malki_index.php');
    } else {
        die(mysqli_error($con));
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Page</title>
</head>

<body>
    <div class="container">
        <form>
            <title>Update</title>

            <div class="mb-3 row">
                <label for="CategoryName">Category Name</label>
                <div class="col-md-9">
                    <select name="" value=<?php echo $category_name;?> id="" class="form-control chosenSelect">
                        <?php include('inc/category.html'); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="addMenu_nameField" class="col-md-3 form-label">Menu Name</label></br>
                <div class="col-md-9">
                    <input type="text" value=<?php echo $menu_name;?> class="form-control" id="" name="">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="menu_descriptionField" class="col-md-3 form-label">Menu description</label></br>
                <div class="col-md-9">
                    <textarea rows="4" value=<?php echo $menu_description;?> class="form-control" id="" name=""></textarea>
                </div>
            </div>


            <div class="mb-3 row">
                <label for="addMenu_unit_priceField" class="col-md-3 form-label">Menu Unit Price</label></br>
                <div class="col-md-9">
                    <input type="number" value=<?php echo $menu_unit_price;?> class="form-control" id="" name="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addMenu_qtyField" class="col-md-3 form-label">Menu Quantity</label></br>
                <div class="col-md-9">
                    <input type="number" value=<?php echo $menu_qty;?> class="form-control" id="" name="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addMenu_qtyField" class="col-md-3 form-label">Menu Image</label></br>
                <div class="col-md-9">
                <img style ="width : 80px;" src =<?php echo $image;?>/>
                    <input type="file" class="form-control"value=<?php echo $image;?> id="" name="">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="submitupdate">Submit</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</body>

</html>