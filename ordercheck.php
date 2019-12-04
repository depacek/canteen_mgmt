<?php
  require 'database.php';

  $food_id=isset($_POST['food_id']) && !empty(trim($_POST['food_id'])) ? htmlspecialchars(trim($_POST['food_id'])):null;
  $customer_id=isset($_POST['customer_id']) && !empty(trim($_POST['customer_id'])) ? htmlspecialchars(trim($_POST['customer_id'])):null;
  $quantity=isset($_POST['quantity']) && !empty(trim($_POST['quantity'])) ? trim($_POST['quantity']):null;
  $orderdate = date('Y-m-d H:i:s');

  //echo $name.$username.$password;

  if($quantity != null && $customer_id != null && $food_id != null){
    echo $insert_query = "INSERT INTO tbl_order (quantity,food_id,orderdate,customer_id) VALUES('${quantity}','${food_id}','${orderdate}','${customer_id}')";
    $insert_order = $db->query($insert_query);

    if($db->affected_rows > 0){
      header("Location:dashboard.php?order=success");
    }else{
      echo mysqli_error($db);
      die();
      header("Location:dashboard.php?order=failed");
      die();
    }
  }else{
    header("Location:dashboard.php?order=failed_empty");
    die();
  }
  $db->close();
?>
