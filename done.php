<?php 
session_start();
$errors = [];
$oldData = [];
$imgNameTmp = '';
$imgName = '';
$id=$_GET["id"];
function definegender($gender) {
    $name = $gender == "male" ? "MR" : "MRS";
    return $name;
 }

 function printSkills($skills){
    foreach($skills as $skill){
        echo $skill.'<br/>';
    }
 }

 function checkIfRequired($val){
     global $errors;
     global $oldData;
     if(empty($_POST[$val]) or (is_string($_POST[$val]) and trim($_POST[$val])=="")){
        $errors[$val] = "{$val} is required!"; 
     }else{
         $oldData[$val] = $_POST[$val];
     }
 };

 function getPointer(){
     try{
        $file="data.txt";
        $linecount = 0;
        $handle = fopen($file, "r");
        while(!feof($handle)){
          $line = fgets($handle);
          $linecount++;
        }
        fclose($handle);
        if($linecount < 2) {
            $linecount = 2;
            $lastId = 0;
        }else{
            $lastId = explode(':', file($file)[$linecount-2])[0];
        } ;
        $id = (int)$lastId + 1;
        return $id;

     }catch(Exception $e){
        echo $e->getMessage();
     }
 }

 function checkForUserId($userId){
        $id = json_decode($_GET["id"]);
        $dir="data.txt";
        $datafile = fopen($dir, 'r');
        while (($line = fgets($datafile)) !== false) {
            if(str_starts_with($line, $id)){
                return $line;
            };
            continue;
        }
        return false;
 }

 function writeIntoTable(){
    global $imgName;
    $isSavedFields = ["fname", "lname", "country", "skills", "address", "username","department",  "gender", "password", "email"];
     $id = getPointer();
     try{
        $file = "data.txt";
        $handle = fopen($file, "a");
        fwrite($handle, $id);
         foreach($isSavedFields as $field){
             if(is_array($_POST[$field])){
                fwrite($handle, ":".join(",", $_POST[$field]));
             }else{
                fwrite($handle, ":".$_POST[$field]);
             }
    }
    fwrite($handle, ":".$imgName);
    fwrite($handle, "\n");
     }catch(Exception $e){
         $e->getMessage();
     }
 }

 function validateEmailFilterVar($email) {
     global $errors;
     global $oldData;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email is not valid!"; 
    }
    else {
        $oldData["email"] = $_POST["email"];
    }
}

function validateEmailRegex($email) {
    global $errors;
    global $oldData;
    $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
    if(!preg_match($regex, $email)) {
        $errors["email"] = "Email is not valid!"; 
    }
    else {
        $oldData["email"] = $_POST["email"];
    }
}

function validatePhoto(){
    global $errors;
    global $imgNameTmp;
    global $imgName;
    if(isset($_FILES["photo"])){
        $imgName = $_FILES["photo"]["name"];
        $imgSize = $_FILES["photo"]["size"];
        $imgNameTmp = $_FILES["photo"]["tmp_name"];
        $ext = explode('.', $imgName);
        $imgExt = strtolower(end($ext));
        $extentions = ["jpg", "jpeg", "png"];//Only Allowed Extentions
        if(trim($imgName) == ""){
            $errors["photo"] = "photo is required!"; 
            return;
        }
        if(!in_array($imgExt, $extentions)){
            $errors["photo"] = "photo is not valid!"; 
            return;
        }
        if($imgSize > 2097152){
            $errors["photo"] = "photo should be less than 2MB."; 
            return;
        }
        $oldData["photo"] = $imgName; 
        
    }else{
        $errors["photo"] = "photo is required!"; 
    }
}

    if(isset($_POST['sumbit'])){
        //Validation first
        $isRequiredFields = ["fname", "lname", "country", "username", "skills", "address", "department", "password", "gender", "email"];
        validateEmailFilterVar($_POST["email"]);
        validateEmailRegex($_POST["email"]);
        
        foreach($isRequiredFields as $field){
            checkIfRequired($field);
        };

        validatePhoto();
        if(count($errors) > 0){
            $errStr=json_encode($errors);
            $old = json_encode($oldData);
            var_dump($errStr);
            header("Location:index.php?errors={$errStr}&olddata={$old}&id={$id}");
            return;
        }
        $imgName = uniqid().$imgName;
        move_uploaded_file($imgNameTmp,"./images/".$imgName);
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $gender = definegender($_POST['gender']);
        $gen = $_POST['gender'];
        $username = $_POST['username'];
        $skills = $_POST['skills'];
        $address = $_POST['address'];
        $dept = $_POST['department'];
        $country = $_POST['country'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
        if(isset($_GET["id"]) and $_GET["id"] !== ''){
            $id = $_GET["id"];
            $dir = "data.txt";
            $userStr = checkForUserId($id);
            if($userStr){
                $skils = join(',', $skills);
                $newStr = "$id:$firstName:$lastName:$country:$skils:$address:$username:$dept:$gen:$password:$email:$imgName";
                $contents = file_get_contents($dir);

                $contents = str_replace($userStr, "$newStr"."\n", $contents);
                file_put_contents($dir, $contents);
                header("Location:users.php");
                return;
            }else{
                echo 'User not found';
            }
        }else{
            writeIntoTable();
            echo "Thanks $gender $firstName $lastName"."<br/>";
            echo "Please review your information"."<br/>";
            echo "username: $username"."<br/>";
            echo "address: $address"."<br/>";
            echo "department: $dept"."<br/>";
            echo "Your skills:"."<br/>";
            echo printSkills($skills);
        }
        
        
    };

?>

