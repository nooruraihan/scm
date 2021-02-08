<?php $this->load->view('header'); ?>
<?php
$userSession_data=$this->session->userdata();
?>
<section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-7 m-auto">
                   
                    <h4 class="text-center"> USER PROFILE</h4>   
                    <form action="" method="post" id="registration" onsubmit="return registersubmit();">
                        <div class="signup" role="alert">
                        <div id="failsubmitreg" class="alert alert-danger " style="display: none"></div>
						            <div id="sucesssubmitreg" class="alert alert-success " style="display: none"></div>	
                        <div class="form-group">      
                    <?php if($userdetails!=''){?>
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="First Name" name="fname" value="<?php echo $userdetails->first_name; ?>"  required=""> 
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="Last Name" name="lname" value="<?php echo $userdetails->last_name; ?>"  required=""> 
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email Address" name="email" value="<?php echo $userdetails->email; ?>" required="" autocomplete="off"> 
                        </div>
						
					    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label" >Gender</label>
                                <div class="col-sm-4">
                                    <select name="gender" id="gender" class="form-control"  required>
                                        <option value="" >Select</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Male') {  echo"selected"; }?>>Male</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Female') {  echo"selected"; }?>>Female</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Others') {  echo"selected"; }?>>Others</option>
                                    </select>
                                </div>                                    
                        </div>
                        <div class="form-group">
                            <label for="birthday">Date Of Birth</label>
                            <input type="date" id="birthday" value = "<?php echo $userdetails->dateofbirth; ?>" name="birthday">
                        <div>
                        <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Image<span style="color:red;" ></span></label>
                                    <div class="col-sm-6">
                                        <input type="file"  name="imageval[]" class="form-control imagevalidationone">
                                    </div>  
                                </div>
                           <?php }?>
                      <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script>
 	   
function registersubmit() 
{

    var formElem = $("#registration");
    var formdata = new FormData(formElem[0]);
    $.ajax({

    url: "<?php echo base_url('user/updateuser/').$userSession_data["user_id"] ?>",
    method: "POST",
    data: formdata, 
    contentType: false,
    cache: false, 
    processData: false,                  
    success: function (response) {
    if ($.trim(response) === 'success') {
        $('form').trigger('reset');
        $('#sucesssubmitreg').show().html('User profile updated successfully.');
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