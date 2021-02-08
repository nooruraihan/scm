<?php $this->load->view('header'); ?>
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
                            <input type="text" class="form-control" placeholder="Your Email Address" name="email" value="<?php echo set_value('email') ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{1,10}$"  required="" autocomplete="off"> 
                        </div>
						
												<div class="form-group">
                        <input type="password"  class="form-control" placeholder="Create Password" name="paswrd" minlength="6" autocomplete="off" value="<?php echo set_value('paswrd') ?>" autocomplete="off" required="">
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
  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Image<span style="color:red;" ></span></label>
                                    <div class="col-sm-6">
                                        <input type="file"  name="imageval[]" class="form-control imagevalidationone" required >
                                    </div>  
                                </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script>
 	   function registersubmit() {

        var formElem = $("#registration");
var formdata = new FormData(formElem[0]);
$.ajax({

    url: "<?php echo base_url('user/submitregister') ?>",
    method: "POST",
    data: formdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false

//                            
    success: function (response) {
//                              alert(response);
//                                $('#failsubmit').show().html(response);


        if ($.trim(response) === 'success') {
            $('form').trigger('reset');
            $('#sucesssubmitreg').show().html('You are registered successfully.');
            setTimeout(function () {
                $('#sucesssubmitreg').hide(
window.location.replace("<?php echo base_url('user/login') ?>")
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
$(document).ready(function () {
    $(".imagevalidationone").on('change', function () {
        var img = $('.imagevalidationone').val();
       
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {

        } else {
            alert('Your image was not .gif, .jpg, .png, .jpeg');
            $('.imagevalidationone').val(''); 
        }
    });
});

</script>
</body>
</html>