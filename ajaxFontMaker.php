<?php

session_start();

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    exit;
}

move_uploaded_file($_FILES['file']['tmp_name'], './tmp/' . $_FILES['file']['name']);


$image = imagecreatefrompng('./tmp/' . $_FILES['file']['name']);
// $image = imagecreatefrompng('./tmp/wywy.png');
$height = imagesy($image);
$_SESSION['height'] = $height;
$width = imagesx($image);

$list = [];
for ($i = 0; $i < $width; $i++) {
    for ($y = 0; $y < $height; $y++) {
        $colorIndex = imagecolorat($image, $i, $y);
        $color = imagecolorsforindex($image, $colorIndex);
        $list[$i][$y] = $color;
    }
}
// echo json_encode($list);
imagedestroy($image);

$alphabet = [];
$alphabetString = '';

foreach ($list as $value) {
    $temp = '';
    foreach ($value as $i) {
        if ($i['red'] == 0 && $i['blue'] == 0 && $i['green'] == 0 && $i['alpha'] == 127) {
            $temp .= 't$';
        } elseif ($i['red'] == 255 && $i['blue'] == 255 && $i['green'] == 255 && $i['alpha'] == 127) {
            $temp .= 't$';
        } elseif ($i['alpha'] == 127) {
            $temp .= 't$';
        } else {
            $temp .= "r" . $i['red'] . "g" . $i['green'] . 'b' . $i['blue'] . 'a' . $i['alpha'] . "$";
        }
    }
    $temp = rtrim($temp, ('$'));
    if (str_contains($temp, 'r')) {
        $alphabetString .= "$temp||";
    } else {
        $alphabetString .= "trans||";
    }
}

$alphabetStringArr = explode('trans||', $alphabetString);
$currentLetter = 'a';
$temp = [];
foreach ($alphabetStringArr as $value) {
    $temp[$currentLetter] = $value;
    $currentLetter++;
}
$alphabetStringArr = $temp;

$alphabetArr = [];
foreach ($alphabetStringArr as &$value) {
    $temp = [];
    foreach (explode('||', rtrim(($value), '||')) as $v) {
        $t = [];
        $t = explode('$', $v);
        array_push($temp, $t);
    }
    array_push($alphabetArr, $temp);
}
// echo json_encode($alphabetArr);

$letter = 'a';
foreach ($alphabetArr as $value) {
    $letterx = count($value);
    $lettery = count($value[0]);

    $gd = imagecreatetruecolor($letterx, $lettery);
    $red = imagecolorallocate($gd, 255, 0, 0);
    $black = imagecolorallocate($gd, 0, 0, 0);
    imagecolortransparent($gd, $black);

    $x = -1;
    foreach ($value as $i) {
        $x++;
        $y = -1;
        foreach ($i as $j) {
            $y++;
            if ($j == 't') {
                $color = imagecolorallocatealpha($gd, 0, 0, 0, 0);
            } else {
                $a = intval(explode('a', $j)[1]);
                $b = intval(explode('b', $j)[1]);
                $g = intval(explode('g', $j)[1]);
                $r = intval(explode('r', $j)[1]);
                $color = imagecolorallocatealpha($gd, $r, $g, $b, $a);
            }
            imagesetpixel($gd, $x, $y, $color);
        }
    }
    imagepng($gd, "tmp/$letter.png");
    $imagedata = file_get_contents("tmp/$letter.png");
    $_SESSION[$letter] = base64_encode($imagedata);
    unlink("tmp/$letter.png");
    $letter++;
}

unlink('./tmp/' . $_FILES['file']['name']);
