<?php

if (isset($_POST['save'])) {

  // retrieve data from the form
  $username = $_POST['username'];
  $pass = md5($_POST['pass']);
  $role = $_POST['role'];

  // save process
  $sql = "INSERT INTO users VALUES (Null, '$username', '$pass', '$role')";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Add User Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username" maxlength="20" required>
            </div>
            <div class="form-group mb-3">
              <label for="">Password</label>
              <input type="password" class="form-control" name="pass" maxlength="10" required>
            </div>
            <div class="form-group mb-3">
              <label for="">Role</label>
              <select class="form-control chosen" data-placeholder="Select role" name="role">
                <option value=""></option>
                <option value="Dosen">Dosen</option>
                <option value="Admin">Admin</option>
                <option value="Mahasiswa">Mahasiswa</option>
              </select>
            </div>
            <input class="btn btn-success" type="submit" name="save" value="Save">
            <a class="btn btn-danger" href="?page=users">Cancel</a>
          </div>
        </div>
    </form>
  </div>
</div>