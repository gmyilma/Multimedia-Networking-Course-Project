<?php
    /**
     * 
     */
    class new_password{
        public function display_new_password(){
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
        				<div class="panel-heading">Password recovery</div>
        				<div class="panel-body">
        					<br />
        					<form class="form-horizontal" role="form" action="#" method="post">
	        					<div class="row">
	        						<div class="col-lg-12">
	        							<div class="form-group">
					    					<label for="new_pass" class="col-sm-2 control-label">New Password</label>
										    <div class="col-sm-10">
										      <input type="password" class="form-control" id="new_pass" placeholder="Please Enter your new password here!" name = "new_pass">
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
										      <input type="password" class="form-control" id="new_pass_ag" placeholder="Please Enter your new password again here!" name = "new_pass_ag">
										    </div>
										</div>
	        						</div>
	        					</div>
	        					<br />
	        					<div class="row">
	        						<div class="col-lg-12">
	        							<div class="col-lg-offset-3">
	        								<button type="submit" class="btn btn-primary" name="change">Change Password</button>
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
        	</body>
        </html>
        <?php	
        }	
    }
    
?>