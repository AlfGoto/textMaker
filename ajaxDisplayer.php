<?php

session_start();

if (!file_exists('./img/z.png')) {
    echo 'font not defined';
    exit();
}



$txtARR = str_split($_POST['text']);
$lettersARR = [];
$height = file_get_contents('img/#height.txt');
$totalWidth = 0;

foreach ($txtARR as $value) {
    // $temp = [];
    // $temp['width'] = getimagesize('img/' . $value . '.png')[0];
    // $temp['height'] = $height;
    // $lettersARR[$value] = $temp;
    $totalWidth += getimagesize('img/' . $value . '.png')[0];
}

$result = imagecreatetruecolor($totalWidth, $height);
$red = imagecolorallocate($result, 255, 0, 0);
$black = imagecolorallocate($result, 0, 0, 0);
imagecolortransparent($result, $black);

$currentX = 0;

foreach ($txtARR as $value) {
    $tmp = imagecreatefrompng('img/' . $value . '.png');
    imagecopy($result, $tmp, $currentX, 0, 0, 0, getimagesize('img/' . $value . '.png')[0], $height);
    $currentX += getimagesize('img/' . $value . '.png')[0];
}
imagepng($result, 'img/result.png');



$imageData = base64_encode(file_get_contents('img/result.png'));


echo json_encode($imageData);
