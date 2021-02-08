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
    <?php $this->load->view('footer'); ?>