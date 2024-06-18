<?php
// retrieve id from parameter
$user_id = $_GET['id'];

// update process
if (isset($_POST['update'])) {

  // retrieve data from the form
  $role = $_POST['role'];

  $sql = "UPDATE users SET role='$role' WHERE user_id='$user_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
  }
}

$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Update User Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" readonly>
            </div>
            <!-- <div class="form-group mb-3">
              <label for="">Password</label>
              <input type="password" class="form-control" name="pass" value="" readonly>
            </div> -->
            <div class="form-group mb-3">
              <label for="">Role</label>
              <select class="form-control chosen" id="role" data-placeholder="Select role" name="role">
                    <?php
                    $roles = ["Dosen", "Admin", "Mahasiswa"];

                    // Loop through each role and only add it to the dropdown if it's not the current role
                    foreach ($roles as $roleOption) {
                      if ($roleOption != $row['role']) {
                        echo "<option value=\"$roleOption\">$roleOption</option>";
                      } else {
                        echo "<option value=\"$roleOption\" selected>$roleOption</option>";
                      }
                    }
                    ?>
                  </select>
            </div>
            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?page=users">Cancel</a>

          </div>
        </div>
    </form>
  </div>
</div>