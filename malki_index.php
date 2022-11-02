<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <link rel="stylesheet" type="text/css" href="css/drag.css" />

  <title>Server Side CRUD Ajax Operations</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 100%;
      margin-bottom: 20px;
    }
  </style>
  <script>
    function validateForm() {
      let x = document.forms["addMenu"]["menu_name"].value;
      let y = document.forms["addMenu"]["menu_description"].value;
      let z = document.forms["addMenu"]["menu_unit_price"].value;
      let a = document.forms["addMenu"]["menu_qty"].value;
      let b = document.forms["addMenu"]["addImage"].value;
      if (x == "") {
        alert("Name must be filled out");
        return false;
      }
      if (y == "") {
        alert("description must be filled out");
        return false;
      }
      if (z == "") {
        alert("unit price must be filled out");
        return false;
      }
      if (a == "") {
        alert("quantity must be filled out");
        return false;
      }
      if (b == "") {
        alert("an image must be added");
        return false;
      }
    }

    function validateUpdateForm(){
      let a = document.forms["updateForm"]["menu_name"].value;
      let b = document.forms["updateForm"]["menu_description"].value;
      let c = document.forms["updateForm"]["menu_unit_price"].value;
      let d = document.forms["updateForm"]["menu_qty"].value;
      if (a == "") {
        alert("Name must be filled out");
        return false;
      }
      if (b == "") {
        alert("description must be filled out");
        return false;
      }
      if (c == "") {
        alert("unit price must be filled out");
        return false;
      }
      if (d == "") {
        alert("quantity must be filled out");
        return false;
      }



    }
  </script>
</head>

<body>


  <!-- <div class='row'>
<div class='image'>
<div id='zoom-In'>
<figure>
<img src='./images/popular/healthyredsmoothie.jpg'>
</figure>
</div>
</div>
</div> -->



  <div class="container-fluid">
    <h2 class="text-center">Welcome To KAAMA.lk</h2>
    <div class="content">
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
          <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
          </h3>

        </div>
      <?php endif ?>

      <!-- logged in user information -->



    </div>
    <div class="row">
      <div class="container">
        <?php if (isset($_SESSION['username'])) : ?>
          <center>
            <lable>Welcome <strong><?php echo $_SESSION['username']; ?></strong></lable>
          </center><br />
          <div style="margin-left: 80%;">
            <lable> <a href="index.php?logout='1'" style="color: white;" class="btn btn-success btn-sm">logout</a> </lable>
          </div><br /><br /><br>
        <?php endif ?>
        <div style="margin-left: 280px; margin-top: 50px;">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-info btn-sm">Add Menu To The System</a>&nbsp;
          <a href="malki_report.php" class="btn btn-danger btn-sm">Reports</a>
          <a style="margin-left: 750px;" href="Customer_view.php" class="btn btn-outline-dark btn-sm">Customer View</a><br /><br />
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>#</th>
                <th>Category Name</th>
                <th>Menu Name</th>
                <th>Menu Description</th>
                <th>Menu Unit Price</th>
                <th>Menu image</th>
                <th>Menu Quantity</th>
                <th style="width: 140px;">Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/drag.js"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });
    $(document).on('click', 'submitadd', function(e) {
      e.preventDefault();
      var category_name = $('#addCategory_nameField').val();
      var menu_name = $('#menu_nameField').val();
      var menu_description = $('#addMenu_descriptionField').val();
      var menu_unit_price = $('#addMenu_unit_priceField').val();
      var menu_qty = $('#addMenu_qtyField').val();
      var image = $('#addImageField').val();

      if (category_name != '' && menu_name != '' && menu_description != '' && menu_unit_price != '' && menu_qty != '' && image != '') {
        $.ajax({
          url: "malki_add_menu.php",
          type: "post",
          data: {
            category_name: category_name,
            menu_name: menu_name,
            menu_description: menu_description,
            menu_unit_price: menu_unit_price,
            menu_qty: menu_qty,
            image: image,
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#malkiAddMenuModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });

      } else {
        alert('Fill all the required fields');
      }
    });


    $(document).on('click', 'submitupdate', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var category_name = $('#category_nameField').val();
      var menu_name = $('#menu_nameField').val();
      var menu_description = $('#menu_descriptionField').val();
      var menu_unit_price = $('#menu_unit_priceField').val();
      var menu_qty = $('#menu_qtyField').val();
      var image = $('#imageField').val();

      // var trid = $('#trid').val();
      // var id = $('#id').val();
      if (category_name != '' && menu_name != '' && menu_description != '' && menu_unit_price != '' && menu_qty != '' && image != '') {
        $.ajax({
          url: "malki_update_menu.php",
          type: "post",
          data: {

            category_name: category_name,
            menu_name: menu_name,
            menu_description: menu_description,
            menu_unit_price: menu_unit_price,
            menu_qty: menu_qty,
            image: image,
            id: id
          },

          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              //   table.cell(parseInt(trid) - 1,0).data(id);
              //   table.cell(parseInt(trid) - 1,1).data(username);
              //   table.cell(parseInt(trid) - 1,2).data(email);
              //   table.cell(parseInt(trid) - 1,3).data(mobile);
              //   table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="#!" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, category_name, menu_name, menu_description, menu_unit_price, image, menu_qty, button]);
              $('#menuUpdate').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#menuUpdate').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#category_nameField').val(json.category_name);
          $('#menu_nameField').val(json.menu_name);
          $('#menu_descriptionField').val(json.menu_description);
          $('#menu_unit_priceField').val(json.menu_unit_price);
          $('#menu_qtyField').val(json.menu_qty);
          $('#imageField').val(json.image);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $('#example').on('click', '.viewBtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#menuView').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          var data = json.image;
          $image = data;
          console.log("data", $image);
          $('#category_nameField_a').val(json.category_name);
          $('#menu_nameField_a').val(json.menu_name);
          $('#menu_descriptionField_a').val(json.menu_description);
          $('#menu_unit_priceField_a').val(json.menu_unit_price);
          $('#menu_qtyField_a').val(json.menu_qty);
          $('#imageField_a').prop('src', path).val(json.image);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });


    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "malki_delete_menu.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    })
  </script>

  <!-- view display -->



  <div class="modal fade" id="menuView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: red;">VIEW ALL DETAILS OF THE MENU</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <th>
                CATEGORY NAME
              </th>
              <td>
                <input type="text" class="form-control" id="category_nameField_a" name="menu_name" disabled>
              </td>
            </tr>
            <tr>
              <th>
                MENU NAME
              </th>
              <td>
                <input type="text" class="form-control" id="menu_nameField_a" name="menu_name" disabled>
              </td>
            </tr>
            <tr>
              <th>
                MENU DESCRIPTION
              </th>
              <td>
                <textarea id="menu_descriptionField_a" rows="4" cols="27" disabled></textarea>
              </td>
            </tr>
            <tr>
              <th>
                UNIT PRICE
              </th>
              <td>
                <input type="text" class="form-control" id="menu_unit_priceField_a" name="menu_name" disabled>
              </td>
            </tr>
            <tr>
              <th>
                QUANTITY
              </th>
              <td>
                <input type="text" class="form-control" id="menu_qtyField_a" name="menu_name" disabled>
              </td>
            </tr>
          </table>

        </div>

      </div>
    </div>
  </div>

  <!-- update display -->


  <div class="modal fade" id="menuUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: red;">Update Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser" action="malki_update_menu.php" method="post" onsubmit="return validateUpdateForm()" name="updateForm">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">

            <div class="form-group col-md-5 mb-3">
              <label for="CategoryName">Category Name</label>
              <div class="col-md-9">
                <select name="category_name" id="category_nameField" class="form-control chosenSelect">
                  <?php include('inc/category.html'); ?>
                </select>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="addMenu_nameField" class="col-md-3 form-label">Menu Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="menu_nameField" name="menu_name">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="menu_descriptionField" class="col-md-3 form-label">Menu description</label>
              <div class="col-md-9">
                <textarea rows="4" class="form-control" id="menu_descriptionField" name="menu_description"></textarea>
              </div>
            </div>


            <div class="mb-3 row">
              <label for="addMenu_unit_priceField" class="col-md-3 form-label">Menu Unit Price</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="menu_unit_priceField" name="menu_unit_price">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMenu_qtyField" class="col-md-3 form-label">Menu Quantity</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="menu_qtyField" name="menu_qty">
              </div>
            </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="submitupdate">Submit</button>&nbsp;&nbsp;
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><br /><br />
        </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Add Menu Modal -->

  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: red;">Add Menu to the System</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="addUser" name="addMenu" action="malki_add_menu.php" method="post" onsubmit="return validateForm()">

            <div class="form-group col-md-5 mb-3">
              <label for="CategoryName">Category Name</label>
              <div class="col-md-9">
                <select name="category_name" class="form-control chosenSelect">
                  <?php include('inc/category.html'); ?>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMenu_nameField" class="col-md-3 form-label">Menu Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMenu_nameField" name="menu_name">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="menu_descriptionField" class="col-md-3 form-label">Menu description</label>
              <div class="col-md-9">
                <textarea rows="4" class="form-control" id="menu_descriptionField" name="menu_description"></textarea>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="addMenu_unit_priceField" class="col-md-3 form-label">Menu Unit Price</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="addMenu_unit_priceField" name="menu_unit_price">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMenu_qtyField" class="col-md-3 form-label">Menu Quantity</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="addMenu_qtyField" name="menu_qty">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMenu_qtyField" class="col-md-3 form-label">Add Photo here</label>
              <div class="col-md-9">
                <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                  <div id="drag_upload_file">
                    <p>Drop file here</p>
                    <p>or</p>
                    <p><input type="button" value="Select File" onclick="file_explorer();" /></p>
                    <input type="file" id="selectfile" name="addImage" />
                  </div>
                </div>
                <input type="hidden" name="uploaded_file" id="uploaded_file" />
                <div class="img-content"></div>

              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submitadd">Submit</button>&nbsp;&nbsp;
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>