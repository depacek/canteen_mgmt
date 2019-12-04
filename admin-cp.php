<?php
  require 'database.php';

  session_start();
  if(!isset($_SESSION['name']) && !isset($_SESSION['id']) || $_SESSION['admin']!=true ){
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
  <title>Admin Login</title>
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
      <h4></h4>
    </div>
    <div class="pull-right col-l">
      <a href="vieworderadmin.php" class="btn btn-warning">All Orders</a>
      <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
    </div>
  </div>
  <hr/>

  <?php
    if(isset($_GET['category'])){
      if($_GET['category'] == 'success'){
  ?>
    <div class="alert alert-success" role="alert">
      Category For Food Created !!
    </div>
  <?php
      }else{
  ?>
    <div class="alert alert-danger" role="alert">
      Category Creation Failed !!
    </div>
  <?php
      }
    }
  ?>

  <?php
    if(isset($_GET['food'])){
      if($_GET['food'] == 'success'){
  ?>
    <div class="alert alert-success" role="alert">
      New Food Added !!
    </div>
  <?php
      }else{
  ?>
    <div class="alert alert-danger" role="alert">
      Food was not added.
    </div>
  <?php
      }
    }
  ?>

  <?php
    if(isset($_GET['edit'])){
      if($_GET['edit'] == 'success'){
  ?>
    <div class="alert alert-success" role="alert">
      Food Info Edited.
    </div>
  <?php
      }else{
  ?>
    <div class="alert alert-danger" role="alert">
      Edit was not recorded.
    </div>
  <?php
      }
    }
  ?>

  <?php
    if(isset($_GET['delete'])){
      if($_GET['delete'] == 'success'){
  ?>
    <div class="alert alert-success" role="alert">
      Food Deleted Successfully.
    </div>
  <?php
      }else{
  ?>
    <div class="alert alert-danger" role="alert">
      Food Deletion failed.
    </div>
  <?php
      }
    }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm">
        <div class="card">
          <div class="card-header">
            <h2>Add New Food Category</h2>
          </div>
          <div class="card-body">
          <form id="add" action="categoryaddcheck.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="categoryname">Category Name:</label>
              <input type="text" class="form-control" name="categoryname" id="categoryname" required/>
            </div>

            <input class="btn btn-warning" type="submit" value="Add"/>
            <input class="btn btn-primary" type="reset" value="Reset"/>
          </form>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="card">
          <div class="card-header">
            <h2>Add New Food Item</h2>
          </div>
          <div class="card-body">
          <form id="add" action="foodaddcheck.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="foodname">Food Name:</label>
              <input type="text" class="form-control" name="foodname" id="foodname" required/>
            </div>
            <div class="form-group">
              <label for="categoryid">Food Category:</label>
              <select class="form-control" name="categoryid" id="categoryid" required/>
                <?php
                  $select_query = "SELECT * FROM tbl_category";
                  $search_posts = $db->query($select_query);

                  while($search_result = $search_posts->fetch_assoc()){
                    echo '<option value="';
                      echo $search_result['category_id'];
                    echo '">';
                      echo $search_result['categoryname'];
                    echo '</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="foodprice">Price:</label>
*              <input type="number" class="form-control" name="foodprice" id="foodprice" min="1" required/>
            </div>
            <div class="form-group">
              <label for="imageUpload">Image:</label>
              <input class="btn" type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*" size="25" />
            </div>
            <input type="submit" class="btn btn-warning" value="Add"/>
            <input type="reset" class="btn btn-primary" value="Reset"/>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

  <?php
    $select_query = "SELECT tbl_food.food_id, tbl_food.foodname, tbl_food.foodprice, tbl_food.foodimage, tbl_category.categoryname FROM tbl_food JOIN tbl_category WHERE tbl_food.categoryid = tbl_category.category_id ORDER BY categoryid";
    $search_posts = $db->query($select_query);
  ?>





  <br/>



  <div class="card-footer">
    <h2>Food List</h2>
  </div>

  <table class="table display" id="table1" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while($search_result = $search_posts->fetch_assoc()){
          echo '<tr>';
          echo '<td>';
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
            <a href="edit.php?item=<?=$search_result['food_id']?>"><button class="btn btn-primary">EDIT</button></a>
            <a onclick="return confirm('Delete This ?');" href="delete.php?item=<?=$search_result['food_id']?>"><button class="btn btn-warning">DELETE</button></a>

      <?php
          echo '</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>

  <br/>
  <div class="card-footer">
    <h4> Canteen</h4>
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
