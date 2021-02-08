<?php $this->load->view('header'); ?>
	
	<div class="row mt-5">
		<div class="col-md-12 text-center">
    <?php if(isset($userSession_data["user_name"])){
          ?>
          <div class="col-md-12 text-center mt-5">
			<h2>Welcome</h2>
		</div>
   <h2> <?php echo $userSession_data["user_name"]; ?></h2>
    <?php
    }
    ?>
		</div>
			
		</div>



</body>
</html>