<?php $this->load->view('header'); ?>
<?php
$userSession_data=$this->session->userdata();
?>
<section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-7 m-auto">
                   
                    <h4 class="text-center"> USER PROFILE</h4>         
                    <?php if($userdetails!=''){?>
                        <div class="form-group">
                        <label for="FirstName">First Name:</label>
                            <input type="text"  class="form-control" placeholder="First Name" name="fname" value="<?php echo $userdetails->first_name; ?>" readonly  required=""> 
                        </div>
                        <div class="form-group">
                        <label for="lastName">Last Name:</label>
                            <input type="text"  class="form-control" placeholder="Last Name" name="lname" value="<?php echo $userdetails->last_name; ?>" readonly  required=""> 
                        </div>
						<div class="form-group">
                        <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Your Email Address" name="email" value="<?php echo $userdetails->email; ?>" readonly required="" autocomplete="off"> 
                        </div>
						
					    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label" >Gender</label>
                                <div class="col-sm-4">
                                    <select name="gender" id="gender" class="form-control" disabled="true" required>
                                        <option value="" >Select</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Male') {  echo"selected"; }?>>Male</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Female') {  echo"selected"; }?>>Female</option>
                                        <option value="Male" <?php if ($userdetails->gender == 'Others') {  echo"selected"; }?>>Others</option>
                                    </select>
                                </div>                                    
                        </div>
                        <div class="form-group">
                            <label for="birthday">Date Of Birth:</label>
                            <input type="date" id="birthday" value = "<?php echo $userdetails->dateofbirth; ?>" name="birthday" readonly>
                        <div>
                        <label for="image">Image:</label>
                        <img class="img-responsive" alt="" src="<?php echo base_url('images/users/') . $userdetails->image; ?>" style="height: 183px;width: 400px"/>
                      <?php }?>
                      <button type="submit" class="btn btn-success btn-lg btn-block mt-3" onclick="window.location.href='<?php echo base_url('user/editprofile/').$userSession_data['user_id'] ?>'">Edit Profile</button>
                 
                    </div>

                </div>
            </div>
        </div>
    </section>
<script>
 	   

</script>
</body>
</html>