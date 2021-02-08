<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                <div class="col-md-7 m-auto">
                   
                    <h4 class="text-center"> SETUP YOUR ACCOUNT</h4>
                    
                    <form action="" method="post" id="registration" onsubmit="return registersubmit();">
                        <div class="signup" role="alert">
                        <div id="failsubmitreg" class="alert alert-danger " style="display: none"></div>
						            <div id="sucesssubmitreg" class="alert alert-success " style="display: none"></div>	
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="First Name" name="fname" value="<?php echo set_value('fname') ?>"  required=""> 
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="Last Name" name="lname" value="<?php echo set_value('lname') ?>"  required=""> 
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email Address" name="email" value="<?php echo set_value('email') ?>" required="" autocomplete="off"> 
                        </div>
						
												<div class="form-group">
                        <input type="password"  class="form-control" placeholder="Create Password" name="paswrd" autocomplete="off" value="<?php echo set_value('paswrd') ?>" autocomplete="off" required="">
                    </div>
	
						<div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confpaswrd" value="<?php echo set_value('confpaswrd') ?>" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label" >Gender</label>
                                        <div class="col-sm-4">
                                            <select name="gender" id="gender" class="form-control"  required>
                                                <option value="" >Select</option>
                                                <option value="Male" >Male</option>
                                                <option value="Female" >Female</option>
                                                <option value="Others" >Others</option>
                                            </select>
                                        </div>                                    
                                </div>
                                <div class="form-group">
                                <label for="birthday">Date Of Birth</label>
  <input type="date" id="birthday" name="birthday">
  <div>
                   	
                    <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script>
 	   function registersubmit() {


$.ajax({

    url: "<?php echo base_url('user/submitregister') ?>",
    method: "POST",
    data: $('#registration').serialize(),

//                            
    success: function (response) {
//                              alert(response);
//                                $('#failsubmit').show().html(response);


        if ($.trim(response) === 'success') {
            $('form').trigger('reset');
            $('#sucesssubmitreg').show().html('You are registered successfully.');
            setTimeout(function () {
                $('#sucesssubmitreg').hide(
window.location.replace("<?php echo base_url('user') ?>")
);
            }, 3000);
        } else if ($.trim(response) === 'fail') {
            $('#failsubmitreg').show().html('Something error please try again');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'notvalid') {
//                                    
            $('#failsubmitreg').show().html('Please validate all field');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'passnot') {
//                                    
            $('#failsubmitreg').show().html('Password does not match');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'emailalready') {
            $('#failsubmitreg').show().html('Email already exist');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        }
    }
});
return false;
}
</script>
</body>
</html>