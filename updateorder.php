<?php
  require 'database.php';
  session_start();

    echo $insert_query = "update tbl_order set status=1 where order_id=".$_GET['order_id'];
    $insert_post = $db->query($insert_query);
      if($db->affected_rows > 0){
        header("Location:vieworderadmin.php?order=success");
      }else{
        header("Location:vieworderadmin.php?order=failed");
      }
    
    
    
  $db->close();
?>
