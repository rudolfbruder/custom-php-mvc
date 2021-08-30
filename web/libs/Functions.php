<?php
function image_fix_orientation($filename) {
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $filename, 90);
    }   
}

function uploadImage($targetDir,$fileId)
{
    $target_dir = $targetDir;
    $file = $_FILES[$fileId];

    if (is_uploaded_file($_FILES[$fileId]["tmp_name"])) {
        
        $fileName = $_FILES[$fileId]["name"];
        $fileTmpName = $_FILES[$fileId]["tmp_name"];
        $fileSize = $_FILES[$fileId]["size"];
        $fileError = $_FILES[$fileId]["error"];
        $fileType = $_FILES[$fileId]["type"];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {

                    $fileNameNew = uniqid('',true). '.' .$fileActualExt;
                    $fileDestination = $target_dir . $fileNameNew;
                    image_fix_orientation($fileTmpName);
                    move_uploaded_file($fileTmpName, $fileDestination);
                    return $fileNameNew;
                }
            }
        }
    }
}


function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
?>