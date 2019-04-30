<?php
    /**
     * 
     */
    class change_password{
        public function display_change_password($content, $error){
        ?>
        <html>
        	<head>
        		<meta charset="utf-8">
	    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    		<meta name="viewport" content="width=device-width, initial-scale=1">
	    		<!-- Bootstrap -->
	    		<link href="../css/bootstrap.min.css" rel="stylesheet">
	    		<title>Account</title>
        	</head>
        	<body>
        		<div class="container">
        			<div class="panel panel-primary">
        				<div class="panel-heading">Account</div>
        				<div class="panel-body">
        					<form class="form-horizontal" role="form" action="../controller/dashboard_controller.php" method="post">
        						<?php
        						if($content!=null && strcmp($content["success"], "")!=0){
        						?>	
									<div class="row">
										<div class="col-lg-12 alert alert-success">
											<?php echo  $content["success"]; ?>
										</div>
									</div>
								<?php
        						}
        						?>
        						<div class="row">
        							<fieldset disabled>
		        						<div class="col-lg-12">
		        							<div class="form-group">
						    					<label for="email" class="col-sm-2 control-label">Email</label>
											    <div class="col-sm-10">
											      <input type="email" class="form-control"  id="email" name ="email" value="<?php echo $_SESSION['current_user']; ?>">
											    </div>
											</div>
		        						</div>
		        					</fieldset>
	        					</div>
	        					<div class="row">
	        						<div class="col-lg-12">
	        							<div class="form-group">
					    					<label for="old_pass" class="col-sm-2 control-label">Old Password</label>
										    <div class="col-sm-10">
										      <input type="password" class="form-control" id="password_old" placeholder="Please Enter your old password here!" name = "password_old" value="">
										      <?php if($error!=null && strcmp($error['incorrect_pass'],"") !=0){
										      ?>
										      	<p><?php echo $error['incorrect_pass']; ?></p>
										      <?php
										      }  
										      ?>
										    </div>
										</div>
	        						</div>
	        					</div>
	        					<br />
	        					<div class="row">
	        						<div class="col-lg-12">
	        							<div class="form-group">
					    					<label for="password" class="col-sm-2 control-label">New Password</label>
										    <div class="col-sm-10">
										      <input type="password" class="form-control" id="password" placeholder="Please Enter your new password here!" name = "password">
										    </div>
										</div>
	        						</div>
	        					</div>
	        					<br />
	        					<div class="row">
	        						<div class="col-lg-12">
	        							<div class="form-group">
					    					<label for="new_pass_ag" class="col-sm-2 control-label">Repeat Password</label>
										    <div class="col-sm-10">
										      <input type="password" class="form-control" id="password_rp" placeholder="Please Enter your new password again here!" name = "password_rp">
										    </div>
										</div>
	        						</div>
	        					</div>
	        					<br />
	        					
	        					<div class="row">
	        						<div class="col-sm-12">
	        							<div class="form-group">
		        							<div class="col-sm-offset-3 col-sm-9">
		        								<button type="submit" class="btn btn-primary" name="change">Change Password</button>
		        								<a href="../controller/dashboard_controller.php?home" class="btn btn-default">Cancel</a>
		        							</div>
	        							</div>
	        						</div>
	        					</div>
	        				</form>
        				</div>
        			</div>
        		</div>
        		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    		<!-- Include all compiled plugins (below), or include individual files as needed -->
	    		<script src="../js/bootstrap.min.js"></script>
	    		<script src="../jquery.validate.js"></script>
	    		<script src="../js/validation_fp.js"></script>
        	</body>
        </html>
        <?php	
        }	
    }
    
?>