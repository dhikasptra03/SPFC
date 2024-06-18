<!-- process of display consultation results data -->
<?php
// retrieve id from parameter
$consult_id = $_GET['consult_id'];

$sql = "SELECT * FROM consultations WHERE consult_id='$consult_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Consultation Results</strong></div>
          <div class="card-body">

            <div class="form-group mb-3">
              <label for="">Name</label>
              <input type="text" class="form-control" value="<?php echo $row['name'] ?>" name="name" readonly>
            </div>

            <div class="form-group mb-3">
              <label for="">NIM</label>
              <input type="text" class="form-control" value="<?php echo $row['nim'] ?>" name="nim" readonly>
            </div>

            <div class="form-group mb-3">
              <label for="">Faculty</label>
              <input type="text" class="form-control" value="<?php echo $row['faculty'] ?>" name="faculty" readonly>
            </div>

            <!-- Skills table -->
            <label for="">Selected career skills :</label>
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
                $sql = "SELECT consultation_details.consult_id, consultation_details.skill_id, skills.skill_name
                        FROM consultation_details INNER JOIN skills 
                        ON consultation_details.skill_id=skills.skill_id 
                        WHERE consult_id='$consult_id'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $row['skill_name']; ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>

            <!-- Consultation result -->
            <label for="">Career consultation results :</label>
            <table class="table table-bordered">
              <thead>
                <tr align="center">
                  <th width="40px">No.</th>
                  <th width="200px">Career Name</th>
                  <th width="100px">Percentage</th>
                  <th width="700px">Description</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = "SELECT career_details.consult_id, career_details.career_id, careers.career_name,
                                careers.description, career_details.percentage
                        FROM career_details INNER JOIN careers 
                        ON career_details.career_id=careers.career_id WHERE consult_id='$consult_id'
                        ORDER BY percentage DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $row['career_name']; ?></td>
                    <td align="center"><?php echo $row['percentage'] . "%"; ?></td>
                    <td><?php echo $row['description']; ?></td>
                  </tr>
                <?php
                }
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
    </form>
  </div>
</div>