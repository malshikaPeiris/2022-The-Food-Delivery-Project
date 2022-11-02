
<html>
 <head>
  <title>Export jQuery Datatables Data to Excel, CSV, PDF using PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
 <body>
  <div class="container box">
   <h3 align="center"> Report Management</h3>
   <br />
   <div>
   <a href="malki_index.php"  class="btn btn-danger btn-sm">Home page</a><br/><br/>
   </div>
   <div class="table-responsive">
    <table id="customer_data" class="table table-success table-striped">
     <thead>
      <tr>
                <th>id</th>
                <th>Category Name</th>
                <th>Menu Name</th>
                <th>Menu Description</th>
                <th>Menu Unit Price</th>
                <th>Menu Image</th>
                <th>Menu Quantity</th>
              
      </tr>
     </thead>
    </table>
   </div>
  </div>
  <br />
  <br />
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#customer_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"fetch_data.php",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv'
   ],
   "lengthMenu": [ [10, 25, 50,-1], [10, 25, 50, "All"] ]
  });
  
 });
 


</script>
