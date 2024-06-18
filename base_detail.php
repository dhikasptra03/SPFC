<!-- Display knowledge base data process -->
<?php
// retrieve id from parameter
$base_id = $_GET['id'];

$sql = "SELECT knowledge_bases.base_id, knowledge_bases.career_id,
                careers.career_name, careers.description
        FROM knowledge_bases INNER JOIN careers ON knowledge_bases.career_id=careers.career_id
        WHERE knowledge_bases.base_id='$base_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Knowledge Base Page Details</strong></div>
          <div class="card-body">

            <div class="form-group mb-3">
              <label for="">Career Name</label>
              <input type="text" class="form-control" value="<?php echo $row['career_name'] ?>" name="name" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="">Description</label>
              <input type="text" class="form-control" value="<?php echo $row['description'] ?>" name="desc" readonly>
            </div>

            <!-- Skills table -->
            <label for="">Career Skills :</label>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="40px">No.</th>
                  <th width="700px">Skill Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = "SELECT knowledge_base_details.base_id, 
                                knowledge_base_details.skill_id, skills.skill_name
                        FROM knowledge_base_details INNER JOIN skills 
                        ON knowledge_base_details.skill_id=skills.skill_id 
                        WHERE knowledge_base_details.base_id='$base_id'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $row['skill_name']; ?></td>
                  </tr>
                <?php
                }
                $conn->close();
                ?>
              </tbody>
            </table>

            <a class="btn btn-danger" href="?page=base">Back</a>
          </div>
        </div>
    </form>
  </div>
</div>