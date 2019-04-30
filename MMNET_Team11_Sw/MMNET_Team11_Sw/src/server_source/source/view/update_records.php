<?php
session_start();
class update_records{
	public function display_update_records($content, $message, $source){

?>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- Bootstrap -->
    	<link href="../css/bootstrap.min.css" rel="stylesheet">
		<title>Add Records</title>
		<script>
			function printImage(image)
			{
		        var printWindow = window.open('', 'Print Window','height=400,width=600');
		        printWindow.document.write('<html><head><title>Print Window</title>');
		        printWindow.document.write('</head><body ><img src=\'');
		        printWindow.document.write(image.src);
		        printWindow.document.write('\' /></body></html>');
		        printWindow.document.close();
		        printWindow.print();
			}
			function myPrint(){
				var image = document.getElementById('image');
				if(image==null){
					alert("No QR-Code to be printed!")
				} else {
					printImage(image);
				}
			}
			function format(){
				var desc = document.getElementById('description');
				desc.value = trim(desc.value);
				
			}
		</script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Dashboard Management System</a>
			    </div>
			
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav navbar-left">
			      	<li><a href="../controller/dashboard_controller.php?home">Home</a></li>
			        <li><a href="../controller/dashboard_controller.php?add">Add Records</a></li>
			        <li>
			        <ul class="nav navbar-nav navbar-right">
				        <li><a class="dropdown-toggle" data-toggle="dropdown">View<b class="caret"></b> </a>
					      	<ul class="dropdown-menu">
					            <li><a href="../controller/dashboard_controller.php?view">Active Records</a></li>
					            <li class="divider"></li>
					            <li><a href="../controller/dashboard_controller.php?view_archieve">Archieved Records</a></li>
					        </ul>
					    </li>
				   </ul>
				   </li>
				   <li><a href="../controller/dashboard_controller.php?gallery">Gallery</a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
				        <li><a class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["name"]."'s"; ?> Account <b class="caret"></b> </a>
					      	<ul class="dropdown-menu">
					            <li><a href="../controller/dashboard_controller.php?change_password">Change Password</a></li>
					            <li class="divider"></li>
					            <li><a href="../controller/dashboard_controller.php?logout">Log out</a></li>
					        </ul>
					    </li>
				   </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</header>
		<br /><br />
		<div class="container">
			<div class="jumbotron">
				<div class="row">
					<form class="form-horizontal" role="form" action="../controller/dashboard_controller.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $content[0]["id"]; ?>" />
						<?php 
						if($message!=null && strcmp($message["success"], "")!=0){
						?>
								<div class="row">
									<div class="col-lg-offset-2 col-sm-10">
										<ul class="list-group">
											<li class="list-group-item list-group-item-success"><h5><?php echo $message["success"]; ?></h5></li>
										</ul>
									</div>
								</div>
						<?php
						}
						?>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
			    					<label for="artifact_name" class="col-sm-2 control-label">Artifact Name</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" id="artifact_name" placeholder="Please Enter Artifact name here!" name = "artifact_name" value="<?php echo $content[0]["name"]; ?>">
								    </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-offset-2 col-lg-5">
								<?php //$path = explode('multimedia', $content[0]['path']); ?>
								<img src="<?php echo $content[0]['path']; ?>" width="100" height = "100"/>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
			    					<label for="file" class="col-sm-2 control-label">Change Image</label>
								    <div class="col-sm-10">
								      <input type="file" id="file" name="file" class="form-control" accept="image/*">
								    </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
			    					<label for="description" class="col-sm-2 control-label">Description</label>
								    <div class="col-sm-10">
								    	<textarea class="form-control" rows="3" id="description" placeholder="Please Enter Artifact description here!" name="description"><?php echo $content[0]['desc']; ?></textarea>
								    </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
								    <div class="col-lg-offset-2 col-lg-4">
								      <button type="submit" class="btn btn-primary" id="update" name ="update">Update</button>
								      <a href="../controller/dashboard_controller.php?<?php echo $source; ?>" class="btn btn-default" id="update">Cancel</a>
								    </div>
								</div>
							</div>
						</div>
						<?php
						if($message==null || strcmp($message["qrcode_image"], "")==0){
						?>
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-offset-5 col-sm-7">
										<img src="../qrcodeImages/no_qr.png" alt="...">
									</div>
								</div>
							</div>
						<?php
						}
						else if(strcmp($message["qrcode_image"], "")!=0){
						?>
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-offset-5 col-sm-7">
										<img src="<?php echo $message["qrcode_image"]; ?>" alt="..." id="image">
									</div>
								</div>
							</div>
						<?php
						}
						?>
						<div class="row">
							<div class="col-lg-offset-5 col-sm-7">
								<a type="button" class="btn btn-info" id="print" onclick="myPrint()">
									Print QR-Code
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="../js/jquery.validate.js"></script>
    	<script src="../js/validation_artifacts.js"></script>
	</body>
</html>
<?php
}

}
?>