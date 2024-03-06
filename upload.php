<?php


session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    move_uploaded_file($_FILES['file']['tmp_name'], './font/' . $_FILES['file']['name']);

    $url = $_SERVER['SERVER_NAME'] . "?f=" . str_replace('.png', '',$_FILES['file']['name']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yassou title maker -- upload</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id='workDiv' class='upload'>
        <form action="" method='POST' enctype="multipart/form-data">
            <input type="file" accept=".png" id='inputFile' class='input' name='file'>
            <input type="submit" name="send" id="send" value='Upload' class='input'>
        </form>
        <?php
        if (isset($url)) {
            echo "<div id='link' class='input'>$url</div>";
        }
        ?>
        
    </div>
</body>

</html>