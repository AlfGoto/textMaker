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
        <div id="inputTextDiv">
            <input type="text" id='inputText' class='input' placeholder='texte'>
            <button id='display' class='input'>Display</button>
        </div>
        <div id='inputFontDiv'>
            <input type="file" accept=".png" id='inputFile' class='input'>
            <button id='Send' class='input'>Send</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src='script.js'></script>
</body>

</html>