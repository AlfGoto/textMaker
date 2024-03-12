<?php

session_start();

if (!isset($_SESSION['a'])) {
    echo json_encode('font not defined');
    exit();
}

$space = $_POST['space'];
$gap = $_POST['gap'];


$txtARR = str_split($_POST['text']);
$lettersARR = [];
$totalWidth = 0;

$tempGap = 0;
foreach ($txtARR as $value) {
    if ($value == ' ') {
        $tempGap = $space;
    } else {
        file_put_contents('./tmp/image.png', base64_decode($_SESSION[$value]));
        $totalWidth += getimagesize('./tmp/image.png')[0] + $gap + $tempGap;
        $tempGap = 0;
    }
}

$currentX = 0;
if($gap == -1){
    $currentX++;
    $totalWidth++;
}
$result = imagecreatetruecolor($totalWidth, $_SESSION['height']);
$black = imagecolorallocate($result, 0, 0, 0);
imagecolortransparent($result, $black);

foreach ($txtARR as $value) {
    if ($value == ' ') {
        $tempGap = $space;
    } else {
        file_put_contents('./tmp/image.png', base64_decode($_SESSION[$value]));
        $tmp = imagecreatefrompng('./tmp/image.png');
        imagecopy($result, $tmp, $currentX + $gap + $tempGap, 0, 0, 0, getimagesize('./tmp/image.png')[0], $_SESSION['height']);
        $currentX += getimagesize('./tmp/image.png')[0] + $gap + $tempGap;
        $tempGap = 0;
    }
}
imagepng($result, './tmp/result.png');
$imageData = base64_encode(file_get_contents('./tmp/result.png'));


echo json_encode($imageData);

unlink('./tmp/result.png');
unlink('./tmp/image.png');
