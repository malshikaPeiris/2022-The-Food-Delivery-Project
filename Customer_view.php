<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Customer View</title>

<head>
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <link rel="stylesheet" type="text/css" href="css/cusview.css" />
 
</head>

<body>




<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Find More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="malki_speciality.php">Special menu</a>
          <a class="dropdown-item" href="malki_review.php">Reviews</a>
          <a class="dropdown-item" href="#">Flow Of System</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
 -->




  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="malki_index.php">Home</a>
      <!-- <a class="navbar-brand" href="malki_speciality_cust_view.php">Speciality</a> -->
      <!-- <a class="navbar-brand" href="malki_index.php">Popular</a> -->
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
<br><br>

  <div class="card_wrapper">
    <?php
    $sql = "Select * from `menuTable`";
    $result = mysqli_query($con, $sql);

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $category_name = $row['category_name'];
        $menu_name = $row['menu_name'];
        $menu_description = $row['menu_description'];
        $menu_unit_price = $row['menu_unit_price'];
        $image = $row['image'];
        echo '
                <div class="card">
                
               <center> <h6>$5-$20</h6>
                <img class="image" style="width:300px; height:200px" src="'.$image.'" alt="Avatar">
                <div class="card-title">' . $menu_name . '</div></center>

                <div class="card-body">
                <center>
                <div class="rate"">
                  <input type="radio" id="star5" name="rate" value="5" />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rate" value="4" />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rate" value="3" />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rate" value="2" />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rate" value="1" />
                  <label for="star1" title="text">1 stars</label>
                </div>
                <br/><br/>
                <button class="btn btn-light btn-sm"><a href="view_det.php? viewid=' . $id . ' " class="text-danger"style="text-decoration:none">View</a> </button>
                </div></center>
                
                </div>
                </div>
                ';
      }
    }
    ?>
  </div>






</body>

</html>