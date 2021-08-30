<?php
	$fileDir = "../Images/ProfileImages/";
	$file = $fileDir . $this->profileInfo->picturePath;
	if (file_exists($file))
	{
	     $b64image = base64_encode(file_get_contents($file));
	     echo "<img id='profileimg'class='rounded img-fluid img-thumbnail pop'style='max-height: 244.500px;''  src = 'data:image/png;base64,$b64image'>";
	}
?>