<?php
  require 'database.php';

  session_start();
  if(!isset($_SESSION['name']) && !isset($_SESSION['id']) || $_SESSION['admin']==0 ){
    header("Location:index.php?login=failed");
    die();
  }

  $id = isset($_GET['item']) && ! empty(trim($_GET['item'])) ? htmlspecialchars($_GET['item']):null;
  $select_query = "SELECT * FROM tbl_food WHERE food_id='{$id}'";
  $search_posts = $db->query($select_query);
  $search_result = $search_posts->fetch_assoc();

  $foodname = $search_result['foodname'];
  $categoryid = $search_result['categoryId'];
  $foodprice = $search_result['foodprice'];
  $foodimage = $search_result['foodimage'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta support="Niush" domain=".tk" status="live">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
      <a href="logout.php"><button class="btn btn-danger">Logout</button></a>
    </div>
  </div>
  <hr/>

  <div class="container">
    <div class="row">
      <div class="col-sm">
        <div class="card">
          <div class="card-header">
            <h2>Edit Food Item</h2>
          </div>
          <div class="card-body">
            <form id="add" action="editcheck.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?=$_GET['item']?>">
              <div class="form-group">
                <label for="foodname">Food Name:</label>
                <input type="text" class="form-control" name="foodname" id="foodname" value="<?=$foodname?>" required/>
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

                        if($search_result['category_id'] == $categoryid){
                          echo '" selected';
                        }else{
                          echo '"';
                        }
                      echo '>';

                        echo $search_result['categoryname'];
                      echo '</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="foodprice">Price:</label>
                <input type="number" class="form-control" name="foodprice" id="foodprice" value="<?=$foodprice?>" min="1" required/>
              </div>

              <div class="form-group">
                <label for="imageUpload">New Image (Old as Default):</label>
                <input type="file" class="btn" id="imageUpload" name="imageUpload" accept="image/*" size="25" />
              </div>

              <div class="form-group">
                <label>Old Food Image:</label>
                <img src="<?=$foodimage?>" style="width: 150px;"/>
              </div>
              <input class="btn btn-warning" type="submit" value="Edit It"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br/>
  <div class="card-footer">
    <h4>Canteen</h4>
  </div>
  </body>
  </html>
