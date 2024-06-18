<div class="card">
  <div class="card-header bg-dark text-white border-dark"><strong>Knowledge Base Data</strong></div>
  <div class="card-body">
    <a class="btn btn-dark mb-2" href="?page=base&action=add">Add</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="30px">No.</th>
          <th width="100px">Career Name</th>
          <th width="400px">Description</th>
          <th width="100px"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $sql = "SELECT knowledge_bases.base_id, knowledge_bases.career_id, 
                        careers.career_name, careers.description FROM knowledge_bases INNER JOIN careers
                        ON knowledge_bases.career_id=careers.career_id ORDER BY career_name ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['career_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td align="center">
              <a class="btn btn-dark" href="?page=base&action=detail&id=<?php echo $row['base_id']; ?>">
                <i class="fas fa-list"></i>
              </a>
              <a class="btn btn-warning" href="?page=base&action=update&id=<?php echo $row['base_id']; ?>">
                <i class="fas fa-edit"></i>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=base&action=delete&id=<?php echo $row['base_id']; ?>">
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