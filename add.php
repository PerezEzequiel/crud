<?php

require_once "./database.php";

$error = "ok";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
    $error = "ERROR, llene los campos";
  } else {
    $name = $_POST["name"];
    $phone_number = $_POST["phone_number"];
    $queryPrepare = $connection->prepare("INSERT INTO contacts(name,phone_number) VALUES (:name,:phone_number)");
    $queryPrepare->bindParam(":name", $_POST["name"]);
    $queryPrepare->bindParam(":phone_number", $_POST["phone_number"]);
    if ($queryPrepare->execute()) {
      header("Location: home.php");
    }
  }
}
require "./partials/header.php";

?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add New Contact</div>
        <div class="card-body">
          <?php if ($error != "ok") : ?>
            <p class="text-danger">Error en los campos</p>
          <?php endif ?>
          <form method="POST" action="add.php">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

              <div class="col-md-6">
                <input id="phone_number" type="tel" class="form-control" name="phone_number" autocomplete="phone_number" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php require "./partials/footer.php"; ?>

</html>
