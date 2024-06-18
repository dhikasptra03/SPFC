<?php
session_start();
// database connection
include "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPFC</title>

  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- DataTables Css -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <!-- Font Awesome Css -->
  <link rel="stylesheet" href="assets/css/all.css">
  <!-- Chosen Css -->
  <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

  <!-- navbar -->
  <?php
  // Ambil halaman dari URL, jika tidak ada default ke 'index'
  $page = isset($_GET['page']) ? $_GET['page'] : 'index';
  ?>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo $page == 'index' ? 'active' : ''; ?>" href="index.php">Home</a>
        </li>

        <!-- set access rights -->
        <?php
        if ($_SESSION['role'] == "Dosen") {
        ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'users' ? 'active' : ''; ?>" href="?page=users">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'base' ? 'active' : ''; ?>" href="?page=base">Knowledge Base</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'admconsultation' ? 'active' : ''; ?>" href="?page=admconsultation">Consultation</a>
          </li>
        <?php

        } elseif ($_SESSION['role'] == "Admin") {
        ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'skills' ? 'active' : ''; ?>" href="?page=skills">Skills</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'career' ? 'active' : ''; ?>" href="?page=career">Career</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'base' ? 'active' : ''; ?>" href="?page=base">Knowledge Base</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'admconsultation' ? 'active' : ''; ?>" href="?page=admconsultation">Consultation</a>
          </li>
        <?php

        } else {
        ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $page == 'consultation' ? 'active' : ''; ?>" href="?page=consultation">Consultation</a>
          </li>
        <?php
        }
        ?>

        <li class="nav-item">
          <a class="nav-link <?php echo $page == 'logout' ? 'active' : ''; ?>" href="?page=logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- check login status -->
  <?php
  if ($_SESSION['status'] != "y") {
    header("Location:login.php");
  }
  ?>

  <!-- container -->
  <div class="container mt-3 mb-3">

    <!-- setting menu -->
    <?php

    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page == "") {
      include "welcome.php";
    } elseif ($page == "users") {
      if ($action == "") {
        include "users_index.php";
      } elseif ($action == "add") {
        include "users_add.php";
      } elseif ($action == "update") {
        include "users_update.php";
      } else {
        include "users_delete.php";
      }
    } elseif ($page == "skills") {
      if ($action == "") {
        include "skills_index.php";
      } elseif ($action == "add") {
        include "skills_add.php";
      } elseif ($action == "update") {
        include "skills_update.php";
      } else {
        include "skills_delete.php";
      }
    } elseif ($page == "career") {
      if ($action == "") {
        include "career_index.php";
      } elseif ($action == "add") {
        include "career_add.php";
      } elseif ($action == "update") {
        include "career_update.php";
      } else {
        include "career_delete.php";
      }
    } elseif ($page == "base") {
      if ($action == "") {
        include "base_index.php";
      } elseif ($action == "add") {
        include "base_add.php";
      } elseif ($action == "detail") {
        include "base_detail.php";
      } elseif ($action == "update") {
        include "base_update.php";
      } elseif ($action == "delete_skill") {
        include "base_delete_details.php";
      } else {
        include "base_delete.php";
      }
    } elseif ($page == "consultation") {
      if ($action == "") {
        include "consultation_index.php";
      } else {
        include "consultation_result.php";
      }
    } elseif ($page == "admconsultation") {
      if ($action == "") {
        include "admconsultation_index.php";
      } else {
        include "admconsultation_detail.php";
      }
    } else {
      include "logout.php";
    }
    ?>
  </div>

  <!-- JQuery -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- Boostrap Js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- datatables js -->
  <script src="assets/js/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <!-- Font Awesome js -->
  <script src="assets/js/all.js"></script>

  <!-- Chosen js -->
  <script src="assets/js/chosen.jquery.min.js"></script>
  <script>
    $(function() {
      $('.chosen').chosen();
    });
  </script>

  <!-- Include Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2({
        width: '100%' // Adjust the width of the dropdown
      });
    });
  </script>
</body>

</html>