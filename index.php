<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yassou title maker</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id='workDiv'>
        <div id="result"></div>
        <input type="text" id='inputText' placeholder='texte' class='input'>
        <input type="file" accept=".png" id='inputFile' class='input'>
        <div id="gapSpaceDiv">
            <div>
                <label for="inputSpace">Space</label>
                <input type="number" min='0' max='10' value='3' id='inputSpace' name='inputSpace' class='input'>
            </div>
            <div>
                <label for="inputGap">Gap</label>
                <input type="number" min='0' max='10' value='0' id='inputGap' name='inputGap' class='input'>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src='script.js'></script>
</body>

</html>