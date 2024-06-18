<!-- login process -->
<?php
session_start();
require "config.php";

if (isset($_POST["submit"])) {

  // retrieve data from the form
  $username = $_POST["username"];
  $pass = md5($_POST["pass"]);

  // check username and password
  $sql = "SELECT * FROM users where username='$username' and pass='$pass'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if ($result->num_rows > 0) {

    // successfull
    // create session
    $_SESSION['username'] = $row["username"];
    $_SESSION['role'] = $row["role"];
    $_SESSION['status'] = "y";

    header("Location:index.php");
  } else {
    // failed, alert message
    header("Location:?msg=n");
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LOGIN</title>

  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <!-- failed login validation -->
  <?php
  if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "n") {
  ?>
      <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login Failed.</strong>
      </div>
  <?php
    }
  }
  ?>

  <div class="container-fluid" style="margin-top:150px">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <form method="POST">
          <div class="card border-dark">
            <div class="card-header bg-dark text-light border-dark">
              <strong>LOGIN</strong>
            </div>
            <div class="card-body border">
              <div class="form-group mb-3">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="off" required>
              </div>
              <div class="form-group mb-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="pass" autocomplete="off" required>
              </div>
              <input type="submit" class="btn btn-primary" name="submit" value="Login">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JQuery -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- Boostrap Js -->
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>