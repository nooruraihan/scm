<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
section.login {
    margin-top: 100px;
}
</style>
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
      <li class="nav-item">
          <a class="nav-link" href="http://localhost/scm/User/signup">Sign Up/</a>
        </li> <li class="nav-item">
          <a class="nav-link" href="http://localhost/scm/User/login">Sign In</a>
        </li>
      </ul>
    </div>
  </div>

</nav>
<section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-7 m-auto text-center login-form">
                    <h4> LOGIN</h4>
                <div id="failsubmit" class="alert alert-danger" style="display:none;">Invalid username or password</div>
                      <form name="loginfrm" method="post" id="loginform" onsubmit="return loginsubmit();">
                        <div class="form-group">
                             <input type="text" class="form-control" placeholder="Email Address" name="usr_name" required> 
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
					

                    <a href="#"> Forgot Password?</a>
                    <button type="submit"  class="btn btn-success btn-lg btn-block">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function loginsubmit() {
                        
                        $.ajax({

                            url: "<?php echo base_url('user/loginsubmit') ?>" ,
                            method: "POST",
                            data: $('#loginform').serialize(),
//                         
                            success: function (response) {
//                               alert(response);
                                if ($.trim(response) === 'success') {
                                    window.location.href = "<?php echo base_url('user')?>";
                                } else if ($.trim(response) === 'fail') {
                                     $('#failsubmit').show().html();
                                    setTimeout(function () {
                                        $('#failsubmit').hide();
                                    }, 3000);
                                }
                            }
                        });
                        return false;
                    }
    </script>