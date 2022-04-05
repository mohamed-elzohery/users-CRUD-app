<?php 
echo 'Hello';
    if(isset($_POST["sumbit"])){
        $errors = [];
        $dberrors = [];
        $oldData = [];
        
        function checkIfRequired($val){
            global $errors;
            global $oldData;
            if(empty($_POST[$val]) or (is_string($_POST[$val]) and trim($_POST[$val])=="")){
               $errors[$val] = "{$val} is required!"; 
            }else{
                $oldData[$val] = $_POST[$val];
            }
        };

        $isRequiredFields = ["email", "password"];

        foreach($isRequiredFields as $field){
            checkIfRequired($field);
        };

        if(count($errors) > 0){
            $errStr=json_encode($errors);
            $old = json_encode($oldData);
            var_dump($errStr);
            header("Location:login.php?errors={$errStr}&olddata={$old}");
            return;
        }
        if (isset($_POST["email"])){
            $dir="data.txt";
            $datafile = fopen($dir, 'r');
            while (($line = fgets($datafile)) !== false) {
                $userArray = explode(":", $line);
                $email = trim($_POST["email"]);
                var_dump($userArray[10]);
                if($email === $userArray[10]){
                $password = $userArray[9];
                var_dump($password);
                if($password === trim($_POST["password"])){
                    $id = $userArray[0];
                    echo "Started session";
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    header("Location:home.php");
                    break;
                }
                }else{
                    continue;
                };
            }
            $dberrors["email"] = "Invalid Email Or Password";
            $dberrors["password"] = "Invalid Email Or Password";
            $oldData["email"] = $_POST["email"];
            $oldData["password"] = $_POST["password"];
        }

        if(count($dberrors) > 0){
            $errStr=json_encode($dberrors);
            $old = json_encode($oldData);
            var_dump($errStr);
            header("Location:login.php?errors={$errStr}&olddata={$old}");
            return;
        }

    }
?>