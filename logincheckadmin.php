<?php
  require 'database.php';

  $username=isset($_POST['username']) && !empty(trim($_POST['username'])) ? htmlspecialchars(trim($_POST['username'])):null;
	$password=isset($_POST['password']) && !empty(trim($_POST['password'])) ? trim($_POST['password']):null;

  if($password !== null && $username !== null){
    $select_query = "SELECT * FROM tbl_admin WHERE username='${username}' AND password='${password}'";
    $search_user = $db->query($select_query);
    $search_result = $search_user->fetch_assoc();

    if($db->affected_rows > 0){
      $user_id = $search_result['admin_id'];
      $username = $search_result['username'];
      $name = $search_result['name'];
      session_start();
      $_SESSION['id']=$user_id;
      $_SESSION['name']=$name;
      $_SESSION['username']=$username;
      $_SESSION['admin'] = true;

      header("Location: admin-cp.php");
      die();
    }else{
      header("Location:/admin.php?login=failed&via=admin");
      die();
    }
  }else{
    header("Location:/admin.php?login=failed_empty&via=admin");
    die();
  }
  $db->close();
?>
