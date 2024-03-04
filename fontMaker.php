<?php

session_start();

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    exit;
}

move_uploaded_file($_FILES['file']['tmp_name'], './img/' . $_FILES['file']['name']);



$image = imagecreatefrompng('./img/' . $_FILES['file']['name']);
$height = imagesy($image);
$width = imagesx($image);

$list = [];
for ($i = 0; $i < $width; $i++) {
    for ($y = 0; $y < $height; $y++) {
        $colorIndex = imagecolorat($image, $i, $y);
        $color = imagecolorsforindex($image, $colorIndex);
        $list[$i][$y] = $color;
    }
}
imagedestroy($image);








print_r($list);
