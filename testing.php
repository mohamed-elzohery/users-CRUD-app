<?php 
    $file="data.txt";
    $fff = file($file);
    // var_dump($fff);
    echo explode(":", $fff[0])[0] + 1;
?>