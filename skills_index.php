<div class="card">
  <div class="card-header bg-dark text-white border-dark"><strong>Skills Data</strong></div>
  <div class="card-body">
    <a class="btn btn-dark mb-2" href="?page=skills&action=add">Add</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="80px">No.</th>
          <th width="700px">Skill Name</th>
          <th width="100px"></th>
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
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['skill_name']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=skills&action=update&id=<?php echo $row['skill_id']; ?>">
                <i class="fas fa-edit"></i>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=skills&action=delete&id=<?php echo $row['skill_id']; ?>">
                <i class="fas fa-window-close"></i>
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