<?php include("db.php"); ?>

<?php include('Includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MENSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" onclick="cerrar()" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        sleep(3);
        session_unset();
      }
      ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="saveTask.php" method="POST">
          <legend>Formulario</legend>
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Titulo" autofocus required>
          </div>
          <br>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Descripción"></textarea>
          </div>
          <input type="submit" name="saveTask" class="btn btn-success btn-block m-2" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <legend>Registros</legend>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['description']; ?></td>
              <td><?php echo $row['created_at']; ?></td>
              <td>
                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="deleteTask.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                  <i class="far fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('Includes/footer.php'); ?>
<script>
  function cerrar() {

    var x = document.querySelector('.alert');
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>