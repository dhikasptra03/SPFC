<?php

if (isset($_POST['save'])) {

  // retrieve data from the form
  $skill_name = $_POST['skill_name'];
  
  // save process
  $sql = "INSERT INTO skills VALUES (Null,'$skill_name')";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=skills");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Add Skill Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Skill Name</label>
              <input type="text" class="form-control" name="skill_name" maxlength="100" placeholder="Skill (ex: Project Management)" required>
            </div>
            <input class="btn btn-success" type="submit" name="save" value="Save">
            <a class="btn btn-danger" href="?page=skills">Cancel</a>
          </div>
        </div>
    </form>
  </div>
</div>