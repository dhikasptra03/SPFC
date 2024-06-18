<div class="card">
  <div class="card-header bg-dark text-white border-dark"><strong>Consultation Results</strong></div>
  <div class="card-body">
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr align="center">
          <th width="30px">No.</th>
          <th width="100px">Date</th>
          <th width="300px">Name</th>
          <th width="100px">NIM</th>
          <th width="400px">Faculty</th>
          <th width="100px"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $sql = "SELECT * FROM consultations ORDER BY input_date DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td align="center"><?php echo $row['input_date']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td align="center"><?php echo $row['nim']; ?></td>
            <td><?php echo $row['faculty']; ?></td>
            <td align="center">
              <a class="btn btn-dark" href="?page=admconsultation&action=detail&id=<?php echo $row['consult_id']; ?>">
                <i class="fas fa-list"></i>
              </a>
            </td>
          </tr>
        <?php
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>