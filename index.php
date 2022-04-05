<?php

function checkForUserId($userId){
    $id = json_decode($_GET["id"]);
    $dir="data.txt";
    $datafile = fopen($dir, 'r');
    while (($line = fgets($datafile)) !== false) {
        if(explode(":", $line)[0] === $id){
            return true;
        };
    }
    return false;
  }

    session_start();
    if (isset($_GET["id"]) and $_GET["id"] !== ''){
        if(checkForUserId($_GET["id"])){
            header("Location:404.php");
        }
    }else{
        if(isset($_SESSION["email"])){
            header("Location:home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('./layout/header.php') ?>
    <?php include('./form.php') ?>
    <?php include('./layout/footer.php') ?>
</html>
