<?php
  require 'database.php';

  session_start();
  if(!isset($_SESSION['email']) && !isset($_SESSION['id']) ){
    header("Location:index.php?login=failed");
    die();
  }

  if(isset($_SESSION['admin'])){
    header("Location:admin-cp.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta support="Niush" domain=".tk" status="live">
  <title>Orders</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
</head>
<body>
  <br/>
  <div class="container">
  <h4>Welcome, <?=$_SESSION['name'];?></h4>

  <div class="row">
    <div class="col-sm">
      <h4>User Dashboard</h4>
    </div>
    <div class="pull-right col-l">
      <a href="dashboard.php" class="btn btn-warning">Dashboard</a>
      <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
    </div>
  </div>
  <hr/>


<?php
   $select_query = "SELECT tbl_order.quantity, tbl_order.orderdate, tbl_order.status,tbl_food.foodname, tbl_food.foodprice, tbl_customer.name FROM tbl_order JOIN tbl_food ON tbl_food.food_id = tbl_order.food_id JOIN tbl_customer ON tbl_customer.customer_id = tbl_order.customer_id WHERE tbl_order.customer_id = " . $_SESSION['id'] . " ORDER BY tbl_order.status ASC";
  $search_orders = $db->query($select_query);
?>

<div class="card-footer">
  <h2>Orders List</h2>
</div>
<div class="view">
  <table class="table display" id="table1" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th scope="col">S.N</th>
        <th scope="col">Food Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Food Price</th>
        <th scope="col">Total Price</th>
        <th scope="col">Date</th>
        <th scope="col">status</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $i=1;
      while($search_result = $search_orders->fetch_assoc()){
        echo '<tr>';
        echo '<td>';
          echo $i++;
        echo '</td>';
         echo '<td>';
          echo $search_result['foodname'];
        echo '</td>';

        echo '<td>';
          echo $search_result['quantity'];
        echo '</td>';

        echo '<td>';
          echo $search_result['foodprice'];
        echo '</td>';

        echo '<td>';
          echo $search_result['quantity']*$search_result['foodprice'];
        echo '</td>';

        echo '<td>';
          echo $search_result['orderdate'];
        echo '</td>';
        echo '<td>';
        if ($search_result['status']==0) {
            echo "<span class='btn btn-warning'>processing</a>";
          }else{
            echo "<span class='btn btn-success'>Completed</a>";
          }
        echo '</td>';

        echo '</tr>';
      }
    ?>
  </tbody>
    <style>
      /* table tr td{
        border:2px solid black;
        text-align: center;
      } */
    </style>

  </table>
</div>

<br/>
<div class="card-footer">
  <h4>&copy; Canteen My</h4>
</div>
<script src="assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#table1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
  } );
</script>
</body>
</html>
