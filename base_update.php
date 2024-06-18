<?php
// process of displaying career data based on a selected knowledge base 
// retrieve id from parameter
$base_id = $_GET['id'];

$sql = "SELECT knowledge_bases.base_id, knowledge_bases.career_id, careers.career_name
        FROM knowledge_bases INNER JOIN careers
        ON knowledge_bases.career_id=careers.career_id WHERE base_id='$base_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// update process
if (isset($_POST['update'])) {
  $skill_id = $_POST['skill_id'];

  // knowledge base details saving process
  if ($skill_id != Null) {
    $sum = count($skill_id);
    $i = 0;
    while ($i < $sum) {
      $skills_id = $skill_id[$i];
      $sql = "INSERT INTO knowledge_base_details VALUES ($base_id, '$skills_id')";
      mysqli_query($conn, $sql);
      $i++;
    }
  }
  header("Location:?page=base");
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Update Knowledge Base Data</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="career_name">Career Name</label>
              <input type="text" class="form-control" name="career_name" value="<?php echo $row['career_name']; ?>" readonly>
            </div>

            <!-- Skills data table (to be revised) -->
            <div class="form-group mb-3">
              <label for="skills">Select the following skills:</label>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50px"></th>
                    <th width="50px">No.</th>
                    <th width="700px">Career Name</th>
                    <th width="70px"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sql = "SELECT*FROM skills ORDER BY skill_name ASC";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {

                    $skill_id = $row['skill_id'];

                    // check knowledge base details table
                    $sql2 = "SELECT * FROM knowledge_base_details WHERE base_id='$base_id' AND skill_id='$skill_id'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                      // if found then display the data, checklist off, delete on

                  ?>
                      <tr>
                        <td align="center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['skill_name']; ?></td>
                        <td align="center">
                          <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=base&action=delete_skill&base_id=<?php echo $base_id ?>&skill_id=<?php echo $skill_id ?>">
                            <i class="fas fa-window-close"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                    } else {
                      // if not found, checklist on, delete off
                    ?>
                      <tr>
                        <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'skill_id[]'; ?>" value="<?php echo $row['skill_id']; ?>"></td>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['skill_name']; ?></td>
                        <td align="center">
                          <i class="fas fa-window-close"></i>
                        </td>
                      </tr>

                  <?php
                    }
                  }
                  $conn->close();
                  ?>
                </tbody>
              </table>

              <input class="btn btn-primary" type="submit" name="update" value="Update">
              <a class="btn btn-danger" href="?page=base">Cancel</a>
            </div>
          </div>
    </form>
  </div>
</div>