<?php
  require 'database.php';

  $name=isset($_POST['name']) && !empty(trim($_POST['name'])) ? (trim($_POST['name'])):null;
  $address=isset($_POST['address']) && !empty(trim($_POST['address'])) ? htmlspecialchars(trim($_POST['address'])):null;
  $contact=isset($_POST['contact']) && !empty(trim($_POST['contact'])) ? htmlspecialchars(trim($_POST['contact'])):null;
  $email=isset($_POST['email']) && !empty(trim($_POST['email'])) ? htmlspecialchars(trim($_POST['email'])):null;
  $password=isset($_POST['password']) && !empty(trim($_POST['password'])) ? md5(trim($_POST['password'])):null;

  //echo $name.$username.$password;

  if($password != null && $email != null && $name != null && $address != null && $contact != null){
    $select_query = "SELECT * FROM tbl_customer WHERE email='${email}'";
    $search_user = $db->query($select_query);
    $search_result = $search_user->fetch_assoc();

    if($db->affected_rows > 0){
      header("Location: index.php?register=taken&email=exist");
      die();
    }

    $insert_query = "INSERT INTO tbl_customer(name,email,address,contact,password) VALUES('${name}','${email}','${address}','${contact}','${password}')";
    $insert_user = $db->query($insert_query);

    if($db->affected_rows > 0){
      header("Location:index.php?register=success");
    }else{
      header("Location:index.php?register=failed");
      die();
    }
  }else{
    header("Location:index.php?register=failed_empty");
    die();
  }
  $db->close();
?>
