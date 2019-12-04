<?php
  require 'database.php';

  session_start();
  if(!isset($_SESSION['name']) && !isset($_SESSION['id']) || $_SESSION['admin']==0 ){
    header("Location:index.php?login=failed");
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
  <title>All Orders</title>
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
      <h4>Admin Dashboard</h4>
    </div>
    <div class="pull-right col-l">
      <a href="admin-cp.php" class="btn btn-success">Dashboard</a>
      <a href="logout.php"><button class="btn btn-danger">Logout</button></a>
    </div>
  </div>
  <hr/>


<?php
  $select_query = "SELECT tbl_order.order_id,tbl_order.quantity, tbl_order.order_id, tbl_order.orderdate,tbl_order.status, tbl_food.foodname, tbl_food.foodprice, tbl_customer.name FROM tbl_order JOIN tbl_food ON tbl_food.food_id = tbl_order.food_id JOIN tbl_customer ON tbl_customer.customer_id = tbl_order.customer_id where tbl_order.orderdate like '".date('Y-m-d')."%' ORDER BY tbl_order.status ASC";
  $search_orders = $db->query($select_query);
?>

<div class="card-footer">
  <h2>All Orders List</h2>
  <?php
    if(isset($_GET['order'])){
      if($_GET['order'] == 'success'){
  ?>
    <div class="alert alert-success" role="alert">
      Order Successfully Placed !!
    </div>
  <?php
      }else{
  ?>
    <div class="alert alert-danger" role="alert">
      Order Failed !!
    </div>
  <?php
      }
    }
  ?>
</div>
<div class="view">
  <table class="table display" id="table1" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Customer</th>
        <th scope="col">Food Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Food Price</th>
        <th scope="col">Total Price</th>
        <th scope="col">Status</th>
         <th scope="col">Action</th>
      </tr>
    </thead>

    <tbody>
    <?php
      while($search_result = $search_orders->fetch_assoc()){
        echo '<tr><td>';
          echo $search_result['orderdate'];
          echo '</td><td>';
          echo $search_result['name'];
          echo '</td><td>';
          echo $search_result['foodname'];
          echo '</td><td>';
          echo $search_result['quantity'];
          echo '</td><td>';
          echo $search_result['foodprice'];
          echo '</td><td>';
          echo $search_result['quantity']*$search_result['foodprice'];
           echo '</td><td>';
          if ($search_result['status']==0) {
            echo "<span class='btn btn-warning'>Processing</a>";
          }else{
            echo "<span class='btn btn-success'>Completed</a>";
          }
          echo '</td><td>';
          if ($search_result['status']==0) {
            echo "<a href='updateorder.php?order_id=".$search_result['order_id']."' class='btn btn-primary'>Done</a>";

          }else{
            echo "<a class='btn btn-primary'>Done</a>";
          }
        
        echo '</td></tr>';
      }
    ?>

  </tbody>
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
