<?php
// retrieve id from parameter
$career_id = $_GET['id'];

// update process
if (isset($_POST['update'])) {

  // retrieve data from the form
  $career_name = $_POST['career_name'];
  $desc = $_POST['desc'];

  $sql = "UPDATE careers SET career_name='$career_name', description='$desc' WHERE career_id='$career_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=career");
  }
}

$sql = "SELECT * FROM careers WHERE career_id='$career_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Update Career Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Career Name</label>
              <input type="text" class="form-control" name="career_name" value="<?php echo $row['career_name'] ?>" maxlength="100" required>
            </div>
            <div class="form-group mb-3">
              <label for="">Description</label>
              <input type="text" class="form-control" name="desc" value="<?php echo $row['description'] ?>" maxlength="200" required>
            </div>
            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?page=career">Cancel</a>

          </div>
        </div>
    </form>
  </div>
</div>