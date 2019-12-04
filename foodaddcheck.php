<?php
  require 'database.php';
  session_start();

  $foodname=isset($_POST['foodname']) && !empty(trim($_POST['foodname'])) ? htmlspecialchars(trim($_POST['foodname'])):null;
  $categoryid=isset($_POST['categoryid']) && !empty(trim($_POST['categoryid'])) ? htmlspecialchars(trim($_POST['categoryid'])):null;
	$foodprice=isset($_POST['foodprice']) && !empty(trim($_POST['foodprice'])) ? htmlspecialchars(trim($_POST['foodprice'])):null;

  $created_by=$_SESSION['username'];
  $date = new DateTime(date('Y-m-d H:i:s'));
  $created_date= $date->date;

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
    $insert_query = "INSERT INTO tbl_food(foodname,categoryid,foodprice,foodimage,created_by,created_date) VALUES('${foodname}','${categoryid}','${foodprice}','${path}','${created_by}','${created_date}')";
    $insert_post = $db->query($insert_query);
      if($db->affected_rows > 0){
        header("Location:admin-cp.php?food=success");
      }else{
        header("Location:admin-cp.php?food=failed");
      }
    }else{
      header("Location:admin-cp.php?food=failed_empty");
      die();
    }
  $db->close();
?>
