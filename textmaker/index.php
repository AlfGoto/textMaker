<?php

session_start();


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yassou title maker</title>
    <link rel="icon" href="img/icone.ico">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="img/okokok.png" alt="" id='imgLogo'>
    <div id='workDiv'>
        <div id="result">
            <img src="img/okokok.png" alt="le super logo de Yassou">
        </div>
        <input type="text" id='inputText' placeholder='text' class='input'>
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


