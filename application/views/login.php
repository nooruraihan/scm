<?php $this->load->view('header'); ?>
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
					

                    
                    <button type="submit"  class="btn btn-success btn-lg btn-block">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <diV class="footer" style="height:200px">

    </div>
    <?php $this->load->view('footer'); ?>