<?php
session_start();
include '../controller/upload_controller.php';
include '../view/dashboard.php';
include '../view/add_records.php';
include '../view/view_records.php';
include '../view/gallery.php';
include '../view/change_password.php';
include '../view/update_records.php';
include '../controller/databaseController.php';
include '../controller/qr_code_generator.php';
$my_upload = new file_upload();
$add_rec = new add_records();
$view_rec = new view_records();
$gal = new gallery();
$upd_rec = new update_records();
$db = new Database();
$qr = new qr_code();
$home = new Dashboard();
$change_pass = new change_password();
$message = array();
$error = array();
$_MIN_WIDTH = 500;
$_MIN_HEIGHT = 500;

if(isset($_SESSION['current_user'])){
	/**
	 * GET request section
	 * The following are list of listeners for GET requests to the dashboard controller.
	 * home - listener to the Home link click from the navigation bar.
	 * add - listener to the Add Records link click from the navigation bar.
	 * view - listener to the View Records link click from the navigation bar.
	 * edit - listener to the Update link click after the user has already navigated to the View Records page
	 * delete - listener to the Delete link click after the user has already navigated to the View Records page
	 * go - listener to the Go button click after a user has entered a search criteria on the View Records search space!
	 * change_password - listener to the Change Password link click from the navigation bar.
	 * logout - listener to the Log out link click from the navigation bar.
	 */
	if(isset($_GET['home'])){
		$home->displayDashBoard();
	}
	if(isset($_GET['add'])){
		$add_rec->display_add_records(null);
	}
	if(isset($_GET['view'])){
		$query = "SELECT * FROM artifacts WHERE status='Active'";
		$data = $db->getDataForUpdate($query);
		$view_rec->display_view_records($data, "Active");
	}
	if(isset($_GET['view_archieve'])){
		$query = "SELECT * FROM artifacts WHERE status='Archieved'";
		$data = $db->getDataForUpdate($query);
		$view_rec->display_view_records($data, "Archieved");
	}
	if(isset($_GET['gallery'])){
		$query = "SELECT * FROM artifacts WHERE status='Active'";
		$data = $db->getDataForUpdate($query);
		$gal->open_gallery($data);
	}
	if(isset($_GET['edit'])){
		$query = "SELECT * FROM artifacts WHERE artifact_id = ". $_GET['edit'];
		$data = $db->getDataForUpdate($query);
		$upd_rec->display_update_records($data, $message, $_GET['source']);
	}
	if(isset($_GET['delete'])){
		$delete_query = "UPDATE artifacts SET status = 'Archieved' WHERE artifact_id = ". $_GET['delete'];
		$status = $db->delete($delete_query);
		if($status){
			$query = "SELECT * FROM artifacts WHERE status = 'Active'";
			$data = $db->getDataForUpdate($query);
			$view_rec->display_view_records($data, $_GET['which']);
		}
	}
	if(isset($_GET['go'])){
		$query = "SELECT * FROM artifacts WHERE (name = '". $_GET["search"] ."' OR name LIKE '". $_GET["search"] . "%') AND status = '". $_GET['which'] ."'";
		echo $query;
		$data = $db->getDataForUpdate($query);
		$view_rec->display_view_records($data, $_GET['which']);
	}
	if(isset($_GET['change_password'])){
		$change_pass->display_change_password(null, null);
	}
	if(isset($_GET['logout'])){
		unset($_SESSION['current_user']);
		session_destroy();
		header("location:../view/index.php");
		//$login->displayLogin(null);
	}
	/**
	 * POST request section
	 * The following are list of listeners for POST requests to the dashboard controller.
	 * save - listener to the Save button click inside the Add Records page
	 * update - listener to the Update button click inside the Update Records page
	 */
	if(isset($_POST['save'])){
		$form_data = array();
		$postfix = mt_rand();
		$form_data["artifact_name"] = $_POST['artifact_name'];
		$form_data["desc"] = $_POST['description'];
		
		$my_upload->extensions = array(".png", ".gif", ".jpg", "jpeg");
		$my_upload->rename_file = true;
		$my_upload->upload_dir = "../upload/high/";
		$my_upload->the_temp_file = $_FILES['file']['tmp_name'];
		$my_upload->the_file = $_FILES['file']['name'];
		$my_upload->http_error = $_FILES['file']['error'];
		$my_upload->the_mime_type = $_FILES['file']['type'];
		$file_ext = explode(".", $my_upload->the_file);
		$my_upload->replace = "y"; 
		$my_upload->do_filename_check = "y"; //
		$new_name = $_POST["artifact_name"]. "_". $postfix;//(isset($_POST['name'])) ? $_POST['name'] : "";
		$my_upload->max_length_filename = 100; 
		echo "Add";
		$new_name = str_replace(" ","_",$new_name);
		if ($my_upload->upload($new_name)) { // new name is an additional filename information, use this to rename the uploaded file
			
			$high_full_path = $my_upload->upload_dir.$my_upload->file_copy;
			$dest = "../upload/low/";
			$low_full_path = compress_image($new_name.".".$file_ext[1] , $my_upload->the_mime_type, $dest.$new_name.".png", 3);
			$path = $qr->generate("/upload/low/".$new_name.".png", $new_name.".png");
			
			$insert_query = "INSERT INTO artifacts (name, high, low, description, status) VALUES ('". $form_data["artifact_name"] ."', '". $high_full_path ."', '". $low_full_path ."', '". $form_data["desc"] ."','Active')";
			echo $insert_query;
			$status = $db->add($insert_query);
			
			if($status){
				echo "Testup";
				$message["success"] = "Operation completed successfully";
				$message["qrcode_image"] = $path;
				$add_rec->display_add_records($message);
			} 
			//else {
			//	$message["error"] = "Something went wrong!";
			//	$message["success"] = "";
			//	$message["qrcode_image"] = $path;
			//	$add_rec->display_add_records($message);
			//}
	    } 
	}
	if(isset($_POST['update'])){
		$image_changed = 0;
		$form_data = array();
		$postfix = mt_rand();
		$id = $form_data["id"] = $_POST['id'];
		$form_data["artifact_name"] = $_POST['artifact_name'];
		$form_data["desc"] = $_POST['description'];
		$form_data["id"] = $_POST['id'];
		$my_upload->extensions = array(".png", ".gif", ".jpg", "jpeg");
		$my_upload->rename_file = true;
		$my_upload->upload_dir = "../upload/high/";
		$upd_rec = new update_records();
		if(isset($_FILES['file'])) {
			$my_upload->the_temp_file = $_FILES['file']['tmp_name'];
			$my_upload->the_file = $_FILES['file']['name'];
			$my_upload->http_error = $_FILES['file']['error'];
			$my_upload->the_mime_type = $_FILES['file']['type'];
			$file_ext = explode(".", $my_upload->the_file);
			$my_upload->replace = "y"; 
			$my_upload->do_filename_check = "y"; //
			$new_name = $_POST["artifact_name"]. "_". $postfix;//(isset($_POST['name'])) ? $_POST['name'] : "";
			$my_upload->max_length_filename = 100; 
			
			if ($my_upload->upload($new_name)) { // new name is an additional filename information, use this to rename the uploaded file
				
				$high_full_path = $my_upload->upload_dir.$my_upload->file_copy;
				$dest = "../upload/low/";
				$low_full_path = compress_image($new_name.".".$file_ext[1] , $my_upload->the_mime_type, $dest.$new_name.".png", 3);
				$path = $qr->generate("/upload/low/".$new_name.".png", $new_name.".png");
				
				$update_query = "UPDATE artifacts SET name = '". $form_data["artifact_name"] ."', high = '". $high_full_path ."', low = '". $low_full_path ."', description = '". $form_data["desc"] ."' WHERE artifact_id = ".$id;
				$status = $db->update($update_query);
				if($status){
					$message["success"] = "Update operation completed successfully";
					$message["qrcode_image"] = $path;
					$query = "SELECT * FROM artifacts WHERE artifact_id = ". $id;
					$upd_rec->display_update_records($db->getDataForUpdate($query), $message, $form_data["id"]);
				} else {
					$message["success"] = "";
					$message["error"] = "Sorry! Something went wrong with the update process, please try again!";
					$message["qrcode_image"] = "";
					$upd_rec->display_update_records($db->getDataForUpdate($query), $message, $form_data["id"]);
				}
		    } 
		} 
		if(count($_FILES['file']['error'])!=0){
			$update_query = "UPDATE artifacts SET name = '". $form_data["artifact_name"] ."', description = '". $form_data["desc"] ."' WHERE artifact_id = ".$id;
			
			$status = $db->update($update_query);
			if($status){
				$message["success"] = "Update operation completed successfully";
				$message["qrcode_image"] = "";
				$query = "SELECT * FROM artifacts WHERE artifact_id = ". $id;
				$upd_rec->display_update_records($db->getDataForUpdate($query), $message,$form_data["id"]);
			} else {
				$message["success"] = "";
				$message["error"] = "Sorry! Something went wrong with the update process, please try again!";
				$message["qrcode_image"] = "";
				$upd_rec->display_update_records($db->getDataForUpdate($query), $message,$form_data["id"]);
			}
		}
	}
	
	
	if(isset($_POST['change'])){
		$select_query = "SELECT * FROM admin WHERE email = '". $_SESSION['current_user'] ."' AND password = '". $_POST['password_old'] . "'";
		//echo $select_query;
		$row_count = $db->getRowCount($select_query);
		if($row_count > 0){
			$update_query = "UPDATE admin SET password = '". $_POST['password'] ."' WHERE email = '". $_SESSION['current_user'] ."'";
			$result = $db->update($update_query);
			if($result){
				$message["success"] = "Password changed successfully!";
				$change_pass->display_change_password($message, null);
			} else {
				$error['incorrect_pass'] = "";
				$error['update_error'] = "Something went wrong with the update process, please try again!";
				$change_pass->display_change_password(null, $error);
			}
		} else {
			$error['update_error'] = "";
			$error['incorrect_pass'] = "The old password you entered is not correct, please try again!";
			$change_pass->display_change_password(null, $error);
		}
		
	}
	
	
	
} else {
	header("location:../view/index.php");
}
/**
	 * Function section
	 * compress_image($name, $mime, $destination_url, $quality)
	 * The compress_image($name, $mime, $destination_url, $quality) function
	 * Compresses an image with the file name $name and mime $mime which is 
	 * uploaded to the ../upload/high/ directory and uploads a new image compressed
	 * according to the specified $quality factor to the destination url $destination_url
	 * 
	 */
function image_filter($im, $name){
	if($im && imagefilter($im, IMG_FILTER_NEGATE)){
		imagepng($im, '../upload/filter/effect_invert/'. $name);
	}
	if($im && imagefilter($im, IMG_FILTER_GRAYSCALE)){
		imagepng($im, '../upload/filter/effect_grayscale/'. $name);
	}
	if($im && imagefilter($im, IMG_FILTER_BRIGHTNESS, 20)){
		imagepng($im, '../upload/filter/effect_brightness/'. $name);
	}
	if($im && imagefilter($im, IMG_FILTER_CONTRAST, 20)){
		imagepng($im, '../upload/filter/effect_contrast/'. $name);
	}
	
		
	if($im && imagefilter($im, IMG_FILTER_COLORIZE, 255, 0, 0)){
		imagepng($im, '../upload/filter/effect_color_red/'. $name);
	}
	
	if($im && imagefilter($im, IMG_FILTER_COLORIZE, 0, 255, 0)){
		imagepng($im, '../upload/filter/effect_color_green/'. $name);
	}
	
	if($im && imagefilter($im, IMG_FILTER_COLORIZE, 0, 0, 255)){
		imagepng($im, '../upload/filter/effect_color_blue/'. $name);
	}
	
	
	
	//if($im && imagefilter($im, IMG_FILTER_EDGEDETECT, 20)){
	//	imagepng($im, '../upload/filter/effect_brightness/'. $name);
	//}
	
	if($im && imagefilter($im, IMG_FILTER_EMBOSS)){
		imagepng($im, '../upload/filter/effect_emboss/'. $name);
	}
	
	if($im && imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR)){
		imagepng($im, '../upload/filter/effect_gaussian_blue/'. $name);
	}
	
	//if($im && imagefilter($im, IMG_FILTER_SELECTIVE_BLUR, 20)){
	//	imagepng($im, '../upload/filter/effect_brightness/'. $name);
	//}

	if($im && imagefilter($im, IMG_FILTER_MEAN_REMOVAL, 20)){
		imagepng($im, '../upload/filter/effect_mean_remove/'. $name);
	}

	if($im && imagefilter($im, IMG_FILTER_SMOOTH, 1)){
		imagepng($im, '../upload/filter/effect_smooth/'. $name);
	}

	if($im && imagefilter($im, IMG_FILTER_PIXELATE, 3, TRUE)){
		imagepng($im, '../upload/filter/effect_brightness/'. $name);
	}
}
	 	 
function compress_image($name, $mime, $destination_url, $quality){
	$image = "";
	if($mime== 'image/jpeg')
		$image = imagecreatefromjpeg("../upload/high/". $name);
	else if($mime== 'image/gif')
		$image = imagecreatefromgif("../upload/high/". $name);
	else if($mime== 'image/png')
		$image = imagecreatefrompng("../upload/high/". $name);
	
	//imagejpeg($image, $destination_url, $quality);
	
	imagepng($image, $destination_url, $quality);
	image_filter($image, $name);
	//imagedestroy($image);
	return $destination_url;
}
function check_image_quality($url){
	list($width, $height, $type, $attr) = getimagesize($url);
	if($width<$_MIN_WIDTH || $height < $MIN_HEIGHT){
		return false;
	}
	return true;
}


?>