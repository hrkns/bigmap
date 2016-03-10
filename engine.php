<?php
	//print_r($_POST);
	extract($_POST);
	$lim1 = count($rows);
	$lim2 = count($cols);
	$ancho = 500;
	$alto = 500;
	function complete($num, $lim){
		$num = strval($num);
		$lim = strval($lim);
		$n1 = strlen(strval($num));
		$n2 = strlen(strval($lim));
		while($n1++ < $n2){
			$num = "0".$num;
		}
		return $num;
	}
	function merge($filename_x, $filename_y, $filename_result) {
		// Get dimensions for specified images

		list($width_x, $height_x) = getimagesize($filename_x);
		list($width_y, $height_y) = getimagesize($filename_y);

		// Create new image with desired dimensions

		$image = imagecreatetruecolor($width_x + $width_y, $height_x);

		// Load images and then copy to destination image

		$image_x = imagecreatefrompng($filename_x);
		$image_y = imagecreatefrompng($filename_y);

		imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
		imagecopy($image, $image_y, $width_x, 0, 0, 0, $width_y, $height_y);

		// Save the resulting image to disk (as JPEG)

		imagepng($image, $filename_result);

		// Clean up

		imagedestroy($image);
		imagedestroy($image_x);
		imagedestroy($image_y);
	}

	function merge2($filename_x, $filename_y, $filename_result){
		// Get dimensions for specified images

		list($width_x, $height_x) = getimagesize($filename_x);
		list($width_y, $height_y) = getimagesize($filename_y);

		// Create new image with desired dimensions

		$image = imagecreatetruecolor($width_x, $height_x + $height_y);

		// Load images and then copy to destination image

		$image_x = imagecreatefrompng($filename_x);
		$image_y = imagecreatefrompng($filename_y);

		imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
		imagecopy($image, $image_y, 0, $height_x, 0, 0, $width_y, $height_y);

		// Save the resulting image to disk (as JPEG)

		imagepng($image, $filename_result);

		// Clean up

		imagedestroy($image);
		imagedestroy($image_x);
		imagedestroy($image_y);
	}

	foreach ($rows as $k1 => $row) {
		foreach ($cols as $k2 => $col) {
			copy("https://maps.googleapis.com/maps/api/staticmap?center=".$row.",".$col."&zoom=19&size=".$ancho."x".$alto."&maptype=".$maptype."&key=AIzaSyB7biho7IjCPS-tjPadgq3EJbP-BTEcZY4", "img/".complete($k1, $lim1)."_".complete($k2, $lim2).".png");
		}

		$last_img = "img/".complete($k1, $lim1)."_".complete("0", $lim2).".png";
		for($i = 1; $i < $lim2; $i++){
			merge($last_img, "img/".complete($k1, $lim1)."_".complete($i, $lim2).".png", "img/"."row_".complete($k1, $lim1).".png");
			$last_img = "img/"."row_".complete($k1, $lim1).".png";
		}
	}

	$last_row = "img/row_".complete(0, $lim1).".png";

	for($i = 1; $i < $lim1; $i++){
		merge2($last_row, "img/row_".complete($i, $lim1).".png", "map.png");
		$last_row = "map.png";
	}
?>