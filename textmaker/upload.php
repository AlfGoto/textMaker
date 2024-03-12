<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    move_uploaded_file($_FILES['file']['tmp_name'], './font/' . $_FILES['file']['name']);

    $path = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $arr = explode('/', $path);
    array_pop($arr);
    $path = implode('/', $arr);

    $url = $path . "/?f=" . str_replace('.png', '', $_FILES['file']['name']);
    //$url = $_SERVER['SERVER_NAME'] . "/" . str_replace('.png', '', $_FILES['file']['name']);
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yassou title maker -- upload</title>
    <link rel="icon" href="img/icone.ico">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div id='workDiv' class='upload'>
        <form action="" method='POST' enctype="multipart/form-data">
            <input type="file" accept=".png" id='inputFile' class='input' name='file'>
            <input type="submit" name="send" id="send" value='Upload' class='input'>
        </form>
        <?php
        if (isset($url)) {
            echo "<div id='link' class='input' onclick='navigator.clipboard.writeText(`$url`)'>$url</div>";
        }
        ?>

    </div>
    <div id="historique">
        <?php
        $path = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $arr = explode('/', $path);
        array_pop($arr);
        $path = implode('/', $arr);
        foreach (scandir('font') as $value) {
            if ($value == '.' || $value == '..') {
                continue;
            }
            $url =  $path . "/?f=" . str_replace('.png', '', $value);
            echo "<div><p onclick='navigator.clipboard.writeText(`$url`)'>$url</p><button class='buttonDel' del='$value'>Delete</button></div>";
        }
        ?>
    </div>

    <script>
        let buttons = document.querySelectorAll('.buttonDel')
        for (let i = 0; i < buttons.length; i++) {
            console.log(buttons[i])
            buttons[i].addEventListener('click', () => {
                $.ajax({
                    url: 'ajaxDelFile.php',
                    method: 'POST',
                    data: {
                        toDel: buttons[i].getAttribute('del')
                    }
                }).done(() => {
                location.reload()
            })
            })
        }
    </script>
</body>

</html>