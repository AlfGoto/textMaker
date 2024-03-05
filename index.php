<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextMaker</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div id='workDiv'>
        <div id="result"></div>
        <input type="text" id='inputText' class='input' placeholder='texte'>
        <input type="file" accept=".png" id='inputFile' class='input'>
        <div id="gapSpaceDiv">
            <div>
                <label for="inputSpace">Space</label>
                <input type="number" min='0' max='10' value='3' id='inputSpace' name='inputSpace'>
            </div>
            <div>
                <label for="inputGap">Gap</label>
                <input type="number" min='0' max='10' value='0' id='inputGap' name='inputGap'>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src='script.js'></script>
</body>

</html>