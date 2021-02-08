<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$userSession_data=$this->session->userdata();

?><!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/w3css/3/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<body>

<nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
   
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>

      </ul>
      <ul class="nav navbar-nav ml-auto">
      <?php if($userSession_data["user_id"] == ''){
          ?>

        <li class="nav-item">
          <a class="nav-link" href="http://localhost/scm/User/signup">Sign Up/</a>
        </li> <li class="nav-item">
          <a class="nav-link" href="http://localhost/scm/User/login">Sign In</a>
        </li>
        <?php
        }
        else{
        ?>
          </li> <li class="nav-item">
          <a class="nav-link" href=""><?php echo $userSession_data["user_name"]; ?></a>
        </li>
<?php
}
?>
      </ul>
    </div>
  </div>

</nav>