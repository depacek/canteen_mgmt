<?php
  require 'database.php';
  session_start();
  if(!isset($_SESSION['name']) && !isset($_SESSION['id']) && $_SESSION['admin'] ){
    header("Location:index.php?login=failed");
    die();
  }

  $id = isset($_GET['item']) && ! empty(trim($_GET['item'])) ? htmlspecialchars($_GET['item']):null;

  if($id != null){
    $delete_query = "DELETE FROM tbl_food WHERE food_id='${id}'";
    $delete_post = $db->query($delete_query);
    if($db->affected_rows > 0){
      header("Location:admin-cp.php?delete=success");
    }else{
      header("Location:admin-cp.php?delete=failed");
    }
  }else{
    header("Location:admin-cp.php?delete=failed_empty");
    die();
  }
  $db->close();
?>
