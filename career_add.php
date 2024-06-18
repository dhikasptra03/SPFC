<?php

if (isset($_POST['save'])) {

  // retrieve data from the form
  $career_name = $_POST['career_name'];
  $desc = $_POST['desc'];

  // save process
  $sql = "INSERT INTO careers VALUES (Null, '$career_name', '$desc')";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=career");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Add Career Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Career name</label>
              <input type="text" class="form-control" name="career_name" maxlength="100" placeholder="Ex: Data Analyst" required>
            </div>
            <div class="form-group mb-3">
              <label for="">Description</label>
              <input type="text" class="form-control" name="desc" maxlength="200" required>
            </div>
            <input class="btn btn-success" type="submit" name="save" value="Save">
            <a class="btn btn-danger" href="?page=career">Cancel</a>

          </div>
        </div>
    </form>
  </div>
</div>