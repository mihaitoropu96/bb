<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?php echo \App\Config\Config::URLROOT; ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo \App\Config\Config::URLROOT; ?>/bootstrap/css/bootstrap.min.css">
  <script src="<?php echo \App\Config\Config::URLROOT; ?>/bootstrap/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function(){
          $("button").click(function(){
              $("p").hide();
          });
      });
  </script>


  <title><?php echo \App\Config\Config::URLROOT; ?></title>
</head>
<body>

<!--navbar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo \App\Config\Config::URLROOT;?>">X</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo \App\Config\Config::URLROOT; ?>/pages/about">About <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo \App\Config\Config::URLROOT; ?>/users/logout">Logout<span class="sr-only">(current)</span></a>
        </li>
      <?php else: ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo \App\Config\Config::URLROOT; ?>/users/login">Login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo \App\Config\Config::URLROOT; ?>/users/register">Register</a>
      </li>
      <?php endif; ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
