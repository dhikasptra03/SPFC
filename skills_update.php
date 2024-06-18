<?php
// retrieve id from parameter
$skill_id = $_GET['id'];

if (isset($_POST['update'])) {
  $skill_name = $_POST['skill_name'];

  // proses update
  $sql = "UPDATE skills SET skill_name='$skill_name' WHERE skill_id='$skill_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=skills");
  }
}

$sql = "SELECT * FROM skills WHERE skill_id='$skill_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Update Skill Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Skill Name</label>
              <input type="text" class="form-control" name="skill_name" value="<?php echo $row['skill_name'] ?>" maxlength="100" required>
            </div>

            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?page=skills">Cancel</a>

          </div>
        </div>
    </form>
  </div>
</div>