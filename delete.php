<?php 
    if (isset($_GET["id"])){
        $id = json_decode($_GET["id"]);
        $dir="data.txt";
        $datafile = fopen($dir, 'r');
        while (($line = fgets($datafile)) !== false) {
            if(str_starts_with($line, $id)){
                $contents = file_get_contents($dir);
                $contents = str_replace($line, '', $contents);
                file_put_contents($dir, $contents);
                break;
            };
        }
        header("Location:users.php");
    }
?>