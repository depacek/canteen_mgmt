<?php
  require 'database.php';
  session_start();

  $foodname=isset($_POST['foodname']) && !empty(trim($_POST['foodname'])) ? htmlspecialchars(trim($_POST['foodname'])):null;
  $categoryid=isset($_POST['categoryid']) && !empty(trim($_POST['categoryid'])) ? htmlspecialchars(trim($_POST['categoryid'])):null;
	$foodprice=isset($_POST['foodprice']) && !empty(trim($_POST['foodprice'])) ? htmlspecialchars(trim($_POST['foodprice'])):null;
  $id=isset($_POST['id']) && !empty(trim($_POST['id'])) ? htmlspecialchars(trim($_POST['id'])):null;

  $updated_by=$_SESSION['username'];
  $updated_date= date('Y-m-d H:i:s');

  /* NOTE: HANDLING IMAGE UPLOAD */
  if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] != 4){
    $date = new DateTime();

    $path = "uploads/";
    $path = $path . basename( $date->getTimestamp() . $_FILES['imageUpload']['name']);
    if(move_uploaded_file($_FILES['imageUpload']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['imageUpload']['name']).
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
	}
  /*******/

  if($foodname != null && $categoryid != null && $foodprice != null){
    if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] != 4){
      $update_query = "UPDATE tbl_food SET foodname='${foodname}',categoryid='${categoryid}',foodprice='${foodprice}',foodimage='${path}',updated_by='${updated_by}',updated_date='${updated_date}' WHERE food_id='${id}'";
    }else{
      $update_query = "UPDATE tbl_food SET foodname='${foodname}',categoryid='${categoryid}',foodprice='${foodprice}',updated_by='${updated_by}',updated_date='${updated_date}' WHERE food_id='${id}'";
    }

    $update_post = $db->query($update_query);
      if($db->affected_rows > 0){
        header("Location:admin-cp.php?edit=success");
      }else{
        header("Location:admin-cp.php?edit=failed");
      }
    }else{
      header("Location:admin-cp.php?edit=failed_empty");
      die();
    }
  $db->close();
?>
