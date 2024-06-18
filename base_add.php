<?php

if (isset($_POST['save'])) {

  // retrieve data from the form
  $career_name = $_POST['career_name'];

  // validate career name
  $sql = "SELECT knowledge_bases.base_id, knowledge_bases.career_id, careers.career_name 
                  FROM knowledge_bases INNER JOIN careers
                  ON knowledge_bases.career_id=careers.career_id WHERE career_name='$career_name'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
?>
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>The data already exists</strong>
    </div>
<?php
  } else {
    // retrieve career data
    $sql = "SELECT * FROM careers WHERE career_name='$career_name'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $career_id = $row['career_id'];

    // knowledge bases saving process
    $sql = "INSERT INTO knowledge_bases VALUES (Null,'$career_id')";
    mysqli_query($conn, $sql);

    // retrieve skill id
    $skill_id = $_POST['skill_id'];

    // process of retrieving knowledge data
    $sql = "SELECT * FROM knowledge_bases ORDER BY base_id DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $base_id = $row['base_id'];

    // knowledge base details saving process
    $sum = count($skill_id);
    $i = 0;
    while ($i < $sum) {
      $skills_id = $skill_id[$i];
      $sql = "INSERT INTO knowledge_base_details VALUES ($base_id, '$skills_id')";
      mysqli_query($conn, $sql);
      $i++;
    }
    header("Location:?page=base");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST" name="Form" onsubmit="return formValidation()">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Add Knowledge Base Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Career name</label>
              <!-- retrieve data from another table -->
              <select class="form-control chosen" data-placeholder="Ex: Data Scientist" name="career_name">
                <option value=""></option>
                <?php
                $sql = "SELECT * FROM careers ORDER BY career_name ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <option value="<?php echo $row['career_name']; ?>"><?php echo $row['career_name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>

            <!-- Skills data table (to be revised) -->
            <div class="form-group mb-3">
              <label for="skills">Select the following skills:</label>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50px"></th>
                    <th width="50px">No.</th>
                    <th width="500px">Career Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sql = "SELECT*FROM skills ORDER BY skill_name ASC";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'skill_id[]'; ?>" value="<?php echo $row['skill_id']; ?>"></td>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $row['skill_name']; ?></td>
                    </tr>
                  <?php
                  }
                  $conn->close();
                  ?>
                </tbody>
              </table>

              <input class="btn btn-success" type="submit" name="save" value="Save">
              <a class="btn btn-danger" href="?page=base">Cancel</a>
            </div>
          </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function formValidation()
  {
    // career name validate
    var career_name =document.forms["Form"]["career_name"].value;

    if (career_name==="") {
      alert("Choose a career name.");
      return false;
    }

    // validate skills that have not been selected
    var checkbox = document.getElementsByName('<?php echo 'skill_id[]'; ?>');
    
    var isChecked = false;

    for (var i = 0; i < checkbox.length; i++) {
      if (checkbox[i].checked) {
        isChecked = true;
        break;
      }
    }

    // if nothing has been checked yet
    if (!isChecked) {
      alert('Choose at least one skills.');
      return false;
    }

    return true;
  }

</script>