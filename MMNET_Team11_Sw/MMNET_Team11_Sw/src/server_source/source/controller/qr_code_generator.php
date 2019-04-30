<?php
include 'phpqrcode/qrlib.php';
/**
 * 
 */

class qr_code {
	function generate($argument, $file) {
		$path = '../qrcodeImages/'.$file;
		QRcode::png($argument, $path);
		return $path;
	}
}

?>