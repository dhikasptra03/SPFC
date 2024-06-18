  <?php
  date_default_timezone_set("Asia/Jakarta");

  if (isset($_POST['process'])) {

    // retrieve data from the form
    $student_name = $_POST['student_name'];
    $student_nim = $_POST['student_nim'];
    $student_fac = $_POST['student_fac'];
    $tgl = date("Y/m/d");

    // consultation save process
    $sql = "INSERT INTO consultations VALUES (Null,'$tgl','$student_name','$student_nim','$student_fac')";
    mysqli_query($conn, $sql);

    // retrieved skill id
    $skill_id = $_POST['skill_id'];

    // process of retrieving consultation data
    $sql = "SELECT * FROM consultations ORDER BY consult_id DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $consult_id = $row['consult_id'];

    // process of saving consultation details
    $sum = count($skill_id);
    $i = 0;
    while ($i < $sum) {
      $skills_id = $skill_id[$i];
      $sql = "INSERT INTO consultation_details VALUES ($consult_id, '$skills_id')";
      mysqli_query($conn, $sql);
      $i++;
    }

    // retrieve data from the career table to check in the knowledge base
    $sql = "SELECT*FROM careers";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

      $career_id = $row['career_id'];
      $count_checked = 0;

      // check the number of skills in the knowledge base based on career
      $sql2 = "SELECT COUNT(career_id) AS skills_sum
                FROM knowledge_bases INNER JOIN knowledge_base_details
                ON knowledge_bases.base_id=knowledge_base_details.base_id
                WHERE career_id='$career_id'";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc();
      $skills_sum = $row2['skills_sum'];

      // look for skills in knowledge base
      $sql3 = "SELECT career_id, skill_id
                FROM knowledge_bases INNER JOIN knowledge_base_details
                ON knowledge_bases.base_id=knowledge_base_details.base_id
                WHERE career_id='$career_id'";
      $result3 = $conn->query($sql3);
      while ($row3 = $result3->fetch_assoc()) {

        $skills_id = $row3['skill_id'];

        // check consultation
        $sql4 = "SELECT skill_id FROM consultation_details
                  WHERE consult_id='$consult_id' AND skill_id='$skills_id'";
        $result4 = $conn->query($sql4);

        if ($result4->num_rows > 0) {
          $count_checked += 1;
        }
      }

      // calculate persentage
      if ($skills_sum > 0) {
        $chance = round(($count_checked / $skills_sum) * 100, 2);
      } else {
        $chance = 0;
      }

      // save career detail data
      if ($chance > 0) {
        $sql = "INSERT INTO career_details VALUES ('$consult_id','$career_id','$chance')";
        mysqli_query($conn, $sql);  
      }

      header("Location:?page=consultation&action=result&consult_id=$consult_id");
    }
  }
  ?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST" name="Form" onsubmit="return formValidation()">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-dark text-white border-dark"><strong>Career Consultation</strong></div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="">Name</label>
              <input type="text" class="form-control" name="student_name" maxlength="50" required>
            </div>

            <div class="form-group mb-3">
              <label for="">NIM</label>
              <input type="text" class="form-control" name="student_nim" maxlength="10" required>
            </div>

            <div class="form-group mb-3">
              <label for="">Faculty</label>
              <input type="text" class="form-control" name="student_fac" maxlength="50" required>
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

              <input class="btn btn-success" type="submit" name="process" value="Process">
            </div>
          </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function formValidation() {

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