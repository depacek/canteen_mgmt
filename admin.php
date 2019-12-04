<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta support="Niush" domain=".tk" status="live">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
</head>
<body>
  <div class="container">
    <br/>
    <h1>Admin Login </h1>
    <hr/>

    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <h4>Admin Details</h4>
            </div>

            <div class="card-body">
              <form id="login" action="logincheckadmin.php" method="POST">
                <div class="form-group">
                  <label for="username">Username: </label>
                  <input type="text" class="form-control" id="username" name="username" required/>
                </div>

                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="password" name="password" required/>
                </div>

                <input type="submit" class="btn btn-warning" value="Login Admin"/>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <br/>
    <div class="card-footer">
      <h4>Canteen </h4>
    </div>
</body>
</html>
