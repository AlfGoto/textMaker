<?php

session_start();

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    exit;
}

move_uploaded_file($_FILES['file']['tmp_name'], './img/' . $_FILES['file']['name']);


/*

    $name = file_get_contents('../../img/nb.txt');
    $letter = 'a';

    for($i = 0; $i < $name; $i++){
        $letter++;
    }

    file_put_contents('../../img/nb.txt', $name + 1);
    $arr = explode('.', $_FILES['file']['name']);
    $name = $letter . "." . end($arr);
    move_uploaded_file($_FILES['file']['tmp_name'], '../../img/' . $name);
    echo '../img/' . $name;

    */