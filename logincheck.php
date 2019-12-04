<?php
  require 'database.php';

  $email=isset($_POST['email']) && !empty(trim($_POST['email'])) ? htmlspecialchars(trim($_POST['email'])):null;
	$password=isset($_POST['password']) && !empty(trim($_POST['password'])) ? md5(trim($_POST['password'])):null;

  if($password !== null && $email !== null){
    $select_query = "SELECT * FROM tbl_customer WHERE email='${email}' AND password='${password}'";
    $search_user = $db->query($select_query);
    $search_result = $search_user->fetch_assoc();
    print_r($search_result);

    if($db->affected_rows > 0){
      $user_id = $search_result['customer_id'];
      $email = $search_result['email'];
      $name = $search_result['name'];
      $address = $search_result['address'];
      session_start();
      $_SESSION['id']=$user_id;
      $_SESSION['name']=$name;
      $_SESSION['email']=$email;
      $_SESSION['address'] = $address;

      header("Location: dashboard.php");
      die();
    }else{
      header("Location:index.php?login=failed");
      die();
    }
  }else{
    header("Location:index.php?login=failed_empty");
    die();
  }
  $db->close();
?>
