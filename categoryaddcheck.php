<?php
  require 'database.php';
  session_start();

  $categoryname=isset($_POST['categoryname']) && !empty(trim($_POST['categoryname'])) ? htmlspecialchars(trim($_POST['categoryname'])):null;
  $created_by=$_SESSION['username'];
  $updated_date= date('Y-m-d H:i:s');

  if($categoryname != null){
    $insert_query = "INSERT INTO tbl_category(categoryname,created_by,created_date) VALUES('${categoryname}','${created_by}','${created_date}')";
    $insert_post = $db->query($insert_query);
      if($db->affected_rows > 0){
        header("Location:admin-cp.php?category=success");
      }else{
        header("Location:admin-cp.php?category=failed");
      }
    }else{
      header("Location:admin-cp.php?category=failed_empty");
      die();
    }
  $db->close();
?>
