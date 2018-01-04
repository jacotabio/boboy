<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    
    <link href="css/jquery.dataTables.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    

  </head>
  <body>
    <div class="container">
    <h1> CUTE SI EDBERT </h1>
    <table class="table table-striped table-bordered table-hover" id="mydata">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
      </tr>
      </thead>
      <tfoot>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
      </tfoot>
      <tbody>
      <?php
      for($x=0; $x<10; $x++){
        ?>
        <tr>
          <td>1</td>
          <td>Edbert Jason Estevez</td>
          <td>trebdenosaj@gmail.com</td>
          <td>09995780425</td>
          <td>Puntataytay Bacolod City</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Trisha Gayle Duron</td>
          <td>gayle@gmail.com</td>
          <td>09994558755</td>
          <td>Puntataytay Bacolod City</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Ricky Aldea</td>
          <td>ricku@gmail.com</td>
          <td>09485780425</td>
          <td>Bata Bacolod City</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Jaco Octabio</td>
          <td>jaco@gmail.com</td>
          <td>09857457854</td>
          <td>Taculing Bacolod City</td>
        </tr>
        <tr>
          <td>5</td>
          <td>John Brix Arrobang</td>
          <td>brix@gmail.com</td>
          <td>09154845654</td>
          <td>Lacson Bacolod City</td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table> 
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
      $('#mydata').dataTable();
    </script>
  </body>
</html>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
      $('#mydata').dataTable();
    </script>