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
  <title>Canteen Management System</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
</head>
<body>
  <br/>
  <div class="container">
  <h4>Welcome,<?=$_SESSION['name'];?></h4>

  <div class="row">
    <div class="col-sm">
      <h4>Canteen</h4>
    </div>
    <div class="pull-right col-l">
      <a href="vieworder.php" class="btn btn-warning">View Orders</a>
      <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
    </div>
  </div>
  <hr/>

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

  <?php
    $select_query = "SELECT tbl_food.food_id, tbl_food.foodname, tbl_food.foodprice, tbl_food.foodimage, tbl_category.categoryname FROM tbl_food JOIN tbl_category WHERE tbl_food.categoryid = tbl_category.category_id ORDER BY categoryid";
    $search_posts = $db->query($select_query);
  ?>
  <div class="card-footer">
    <h2>Food Menu</h2>
  </div>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Quantity</th>
        <th scope="col">Order</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($search_result = $search_posts->fetch_assoc()){
          echo '<form action="ordercheck.php" method="POST">';
          echo '<tr>';
          echo '<td>';
            echo '<input type="hidden" name="food_id" value="'. $search_result['food_id'] .'">';
            echo '<input type="hidden" name="customer_id" value="'. $_SESSION['id'] .'">';
            echo $search_result['foodname'];
          echo '</td>';

          echo '<td>';
            echo $search_result['categoryname'];
          echo '</td>';

          echo '<td>';
            echo $search_result['foodprice'];
          echo '</td>';

          echo '<td>';

          if($search_result['foodimage'] != null){

        ?>
            <img src="<?=$search_result['foodimage']?>" width="120px"/>
        <?php
          }else{
            echo 'NULL';
          }
          echo '</td>';

          echo '<td>';

          ?>

          <input type="number" name="quantity" value="1" min="1">
      <?php
          echo '</td>';

          echo '<td>';

          ?>
          <input class="btn btn-warning" onclick="return confirm('Place The Order ?');" type="submit" value="Order">
          </form>
      <?php
          echo '</td>';

          echo '</tr>';
        }
      ?>
    </tbody>
  </table>

  <br/>
  <div class="card-footer">
    <h4>Canteen</h4>
  </div>
</body>
</html>
