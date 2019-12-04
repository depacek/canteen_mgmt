<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta support="Niush" domain=".tk" status="live">
  <title>My Canteen</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
</head>
<body>
  <div class="container">
    <br/>
    <h1>My Canteen</h1>
    <hr/>

    <?php
      if(isset($_GET['user']) && $_GET['user'] == 'off'){
    ?>
      <div class="alert alert-warning" role="alert">
        User Logged Out.
      </div>
    <?php } ?>

    <?php
      if(isset($_GET['login'])){
    ?>
      <div class="alert alert-danger" role="alert">
        Login Error !!
      </div>
    <?php } ?>

    <?php
      if(isset($_GET['register'])){
        if($_GET['register'] == 'success'){
    ?>
      <div class="alert alert-success" role="alert">
        Register Successful !! Login to Continue.
      </div>
    <?php
        }else{
    ?>
      <div class="alert alert-danger" role="alert">
        Registration Failed !!
      </div>
    <?php
        }
      }
    ?>

    <?php
      if(isset($_GET['email'])){
        if($_GET['email'] == 'taken'){
    ?>
      <div class="alert alert-danger" role="alert">
        Opps. Email already used !!!
      </div>
    <?php
        }
      }
    ?>

    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <h4>Login</h4>
            </div>

            <div class="card-body">
              <form id="login" action="logincheck.php" method="POST">
                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="text" class="form-control" placeholder="Email" id="email" name="email" required/>
                </div>

                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" placeholder="Password" id="password" name="password" required/>
                </div>

                <input class="btn btn-warning" type="submit" value="Login"/>
              </form>
            </div>

            <div class="card-footer">
              <a href="admin.php">Login as Admin ?</a>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <h4>Register as a new Customer:</h4>
            </div>

            <div class="card-body">
              <form id="register" action="registercheck.php" method="POST">
                <div class="form-group">
                  <label for="name">Name: </label>
                  <input type="text" class="form-control" placeholder="Full Name" id="name" name="name" required/>
                </div>

                <div class="form-group">
                  <label for="address">Address: </label>
                  <input type="text" class="form-control" placeholder="Address" id="address" name="address" required/>
                </div>

                <div class="form-group">
                  <label for="contact">Contact: </label>
                  <input type="text" class="form-control" placeholder="Contact No." id="contact" name="contact" required/>
                </div>
                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="text" class="form-control" placeholder="Email" id="email" name="email" required/>
                </div>
                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" placeholder="Password" id="password" name="password" required/>
                </div>

                <input class="btn btn-warning" type="submit" value="Register"/>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <br/>
  <div class="card-footer">
    <h4>&copy;Canteen </h4>
    <!-- Niush S. -->
  </div>
</body>
</html>
