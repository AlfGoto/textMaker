<?php

session_start();

if (!isset($_SESSION[$_POST['font']]['a'])) {
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
        file_put_contents('./tmp/image.png', base64_decode($_SESSION[$_POST['font']][$value]));
        $totalWidth += getimagesize('./tmp/image.png')[0] + $gap + $tempGap;
        $tempGap = 0;
    }
}

$currentX = 0;
if($gap == -1){
    $currentX++;
    $totalWidth++;
}

$result = imagecreatetruecolor($totalWidth, $_SESSION[$_POST['font']]['height']);
$transparent = imagecolorallocatealpha($result, 0, 0, 0, 127);
imagealphablending($result, false);
imagefilledrectangle($result, 0, 0, $totalWidth, $_SESSION[$_POST['font']]['height'], $transparent);
imagealphablending($result, true);
imagesavealpha($result, true);

foreach ($txtARR as $value) {
    if ($value == ' ') {
        $tempGap = $space;
    } else {
        file_put_contents('./tmp/image.png', base64_decode($_SESSION[$_POST['font']][$value]));
        $tmp = imagecreatefrompng('./tmp/image.png');
        imagecopy($result, $tmp, $currentX + $gap + $tempGap, 0, 0, 0, getimagesize('./tmp/image.png')[0], $_SESSION[$_POST['font']]['height']);
        $currentX += getimagesize('./tmp/image.png')[0] + $gap + $tempGap;
        $tempGap = 0;
    }
}
imagepng($result, './tmp/result.png');
$imageData = base64_encode(file_get_contents('./tmp/result.png'));


echo json_encode($imageData);

unlink('./tmp/result.png');
unlink('./tmp/image.png');
