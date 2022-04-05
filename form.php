<?php


$id='';
  if (isset($_GET["errors"])){
    $errors = json_decode($_GET["errors"]);
}


if (isset($_GET["olddata"])){
  $olddata = json_decode($_GET["olddata"]);
  var_dump($olddata);  
}

if (isset($_GET["id"]) and $_GET["id"] !== ''){
  $olddata = new stdClass();
  $arrayOfValues =[];
    $id = json_decode($_GET["id"]);
    $dir="data.txt";
    $datafile = fopen($dir, 'r');
    while (($line = fgets($datafile)) !== false) {
        if(str_starts_with($line, $id)){
            $arrayOfValues = explode(":", $line);
            break;
        };
}
    $olddata->fname = $arrayOfValues[1];
    $olddata->lname = $arrayOfValues[2];
    $olddata->country = $arrayOfValues[3];
    $olddata->skills = explode(",",$arrayOfValues[4]);
    $olddata->address = $arrayOfValues[5];
    $olddata->username = $arrayOfValues[6];
    $olddata->department = $arrayOfValues[7];
    $olddata->gender = $arrayOfValues[8];
    $olddata->password = $arrayOfValues[9];
    $olddata->email = $arrayOfValues[10];
    $olddata->photo = $arrayOfValues[11];
}
?>

<div class="my-6" style="max-width: 600px; margin:30px auto; padding: 12px">
<form action=<?php echo "done.php?id=$id";?> method="POST" enctype="multipart/form-data">
  <div class="mb-6">
    <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your first-name</label>
    <input value="<?php if(isset($olddata->fname)) {echo $olddata->fname;} ?>" name="fname" type="text" id="first-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
    <?php
      if(isset($errors->fname)){
        echo "<p style='color: red'> $errors->fname</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your last-name</label>
    <input value="<?php if(isset($olddata->lname)) {echo $olddata->lname;} ?>" name="lname" placeholder="last name" type="text" id="last-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
      if(isset($errors->lname)){
        echo "<p style='color: red'> $errors->lname</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Email</label>
    <input value="<?php if(isset($olddata->email)) {echo $olddata->email;} ?>" name="email" type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@mail.com">
    <?php
      if(isset($errors->email)){
        echo "<p style='color: red'> $errors->email</p>";
      }
    ?>
  </div>
  <div class="mb-6">
  <label for="address" class="form-label inline-block mb-2 text-gray-700"
      >address</label
    >
    <textarea
    name="address"
      class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      "
      id="address"
      rows="3"
      placeholder="Your message"
    ><?php if(isset($olddata->address)) {echo $olddata->address;} ?></textarea>
    <?php
      if(isset($errors->address)){
        echo "<p style='color: red'> $errors->address</p>";
      }
    ?>
  </div>
  <div class="mb-6">
  <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select your country</label>
    <select value="<?php if(isset($olddata->country)) {echo $olddata->country;} ?>" name="country" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="United States" <?php if(isset($olddata->country) && $olddata->country === "United States") {echo "selected";}?>>United States</option>
    <option value="Canada" <?php if(isset($olddata->country) && $olddata->country === "Canada") {echo "selected";}?>>Canada</option>
    <option value="France" <?php if(isset($olddata->country) && $olddata->country === "France") {echo "selected";}?>>France</option>
    <option value="Germany" <?php if(isset($olddata->country) && $olddata->country === "Germany") {echo "selected";}?>>Germany</option>
    </select>
    <?php
      if(isset($errors->country)){
        echo "<p style='color: red'> $errors->country</p>";
      }
    ?>
  </div>
  <div class="mb-6">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Gender</label>
  <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="gender" id="male" value="male" <?php if(isset($olddata->gender) and $olddata->gender  === "male"){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="male">
        Male
      </label>
    <div class="form-check">
      <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="gender" value="female" id="female" <?php if(isset($olddata->gender) and $olddata->gender  === "female"){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="female">
        Female
      </label>
  </div>
  <?php
      if(isset($errors->gender)){
        echo "<p style='color: red'> $errors->gender</p>";
      }
    ?>
  </div>
  
  <div class="mb-6">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Skills</label>
  <div>
    <div class="form-check">
      <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" name="skills[]" type="checkbox" value="php" id="php" <?php if(isset($olddata->skills) and in_array( "php",$olddata -> skills)){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="php">
        PHP
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" name="skills[]" type="checkbox" value="mariadb" id="mariadb" <?php if(isset($olddata->skills) and in_array( "mariadb",$olddata -> skills)){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="mariadb">
        MariaDB
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" name="skills[]" type="checkbox" value="mysql" id="mysql" <?php if(isset($olddata->skills) and in_array( "mysql",$olddata -> skills)){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="mysql">
        MySql
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" name="skills[]" type="checkbox" value="postgre" id="postgre" <?php if(isset($olddata->skills) and in_array( "postgre",$olddata -> skills)){echo 'checked';} ?>>
      <label class="form-check-label inline-block text-gray-800" for="postgre">
        Postgre
      </label>
    </div>
  </div>
  </div>
  <div class="mb-6">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your username</label>
    <input value="<?php if(isset($olddata->username)) {echo $olddata->username;} ?>" name="username" type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
    <?php
      if(isset($errors->username)){
        echo "<p style='color: red'> $errors->username</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
    <input value="<?php if(isset($olddata->password)) {echo $olddata->password;} ?>" name="password" type="password" placeholder="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
      if(isset($errors->password)){
        echo "<p style='color: red'> $errors->password</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your department</label>
    <input value="<?php if(isset($olddata->department)) {echo $olddata->department;} ?>" name="department" type="text" placeholder="department" id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
      if(isset($errors->department)){
        echo "<p style='color: red'> $errors->department</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Photo</label>
    <input value="<?php if(isset($olddata->photo)) {echo $olddata->photo;} ?>" name="photo" type="file" placeholder="photo" id="photo" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help">
    <?php
      if(isset($errors->photo)){
        echo "<p style='color: red'> $errors->photo</p>";
      }
    ?>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="sumbit">Submit</button>
</form>
</div>