<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<title>View Details</title>

<head>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <link rel="stylesheet" type="text/css" href="css/cusview.css" />
</head>

<body>

    <div class="container">
        <?php
        include 'connection.php';
        $id = $_GET['viewid'];
        $sql = "Select * from `menutable` where id=$id";
        $result = mysqli_query($con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $category_name = $row['category_name'];
                $menu_name = $row['menu_name'];
                $menu_description = $row['menu_description'];
                $menu_unit_price = $row['menu_unit_price'];
                $menu_qty = $row['menu_qty'];
                $image = $row['image'];
                echo '
            
                <center><div>
                <table>
                    <tr>
                        <td style="width:250px;">
                            <center><img class="img" width="80px" height="80px" src="./images/popular/step-1.jpg" alt="">
                                <h6>choose your favorite food</h6>
                            </center>
                        </td>
                        <td style="width:250px;">
                            <center><img class="img" width="80px" height="80px" src="./images/popular/step-2.jpg" alt="">
                                <h6>free and fast delivery</h6>
                            </center>
                        </td>
                        <td style="width:250px;">
                            <center><img class="img" width="80px" height="80px" src="./images/popular/step-3.jpg" alt="">
                                <h6>easy payments methods</h6>
                            </center>
                        </td>
                        <td style="width:250px;">
                            <center><img class="img" width="80px" height="80px" src="./images/popular/step-4.jpg" alt="">
                                <h6>and finally, enjoy your food</h6>
                            </center>
                        </td>
                    </tr>
                </table>
                </div></center>
                <div class="card" style="width: 30rem; margin-left:400px; margin-top:120px;"><br>
                <center>
            <img class="image" style="width:400px;" src="' . $image . '" />  
            </center>
                <div class="card-body">
                  <center><h5 class="card-title">All The Details Of The Menu</h5></center><br>
                  <h6>Category Name: ' . $category_name . '</h6>
                  <h6>Menu Name: ' . $menu_name . '</h6>
                  <h6>Description: ' . $menu_description . '</h6>
                  <h6>Menu Unit Price: ' . $menu_unit_price . '</h6>
                  <h6>Menu Quantity: ' . $menu_qty . '</h6>
                  <center><a href="#" class="btn btn-danger">Add to Cart</a></center>
                </div>
              </div>

            ';
            }
        }
        ?>
    </div>
    
</body>

</html>