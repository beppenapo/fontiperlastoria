<?php
session_start();
if(isset($_SESSION['id_user'])){
  header("Location: index.php");
  exit;
}
?>
<!doctype html>
<html lang="it">
  <head>
    <?php require('inc/meta.php'); ?>
    <?php require('inc/css.php'); ?>
    <style media="screen">
      .mainScope{min-height:500px;}
      .flex-center{width:100%;height:300px;max-height:500px;flex-direction: column;}
    </style>
  </head>
  <body class="bg-light" id="top">
    <?php require('inc/header.php'); ?>
    <div class="maintitle" id="home">
      <div class="container">
        <div class="row">
          <div class="col text-center my-5">
            <h1 class="text-dark">ARCHIVIO FOTOGRAFICO</h1>
            <h6 class="text-dark">VITICOLTURA TERRAZZATA DELLA VALLE DI CEMBRA</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="mainScope">
      <div class="formDiv flex-center">
        <form class="bg-white border p-5 mt-5 rounded" name="loginForm">
          <div class="alert d-none output">
            <label class="m-0 outMsg d-block"></label>
            <label id="countdowntimer" class="d-block text-center"></label>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="" required>
          </div>
          <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" name="password" id="pwd" value="" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">login</button>
          </div>
        </form>
      </div>
    </div>
    <?php require('inc/footer.php'); ?>
    <?php require('inc/lib.php'); ?>
    <script src="js/login.js" charset="utf-8"></script>
  </body>
</html>
