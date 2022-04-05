<?php
  session_start();

if(isset($_SESSION["email"])){
    header("Location:home.php");
  }
?>
<?php 
  if (isset($_GET["errors"])){
    $errors = json_decode($_GET["errors"]);
}


if (isset($_GET["olddata"])){
  $olddata = json_decode($_GET["olddata"]);
  var_dump($olddata);  
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('./layout/header.php') ?>

    <section style="max-width: 600px; margin: 100px auto">
        <h1 style="text-align: center;font-size: 40px">Login</h1>
        <form method="POST" action="loginhandler.php">
  <div class="mb-6">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
    <input name="email" value="<?php if(isset($olddata->email)) {echo $olddata->email;} ?>" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
    <?php
      if(isset($errors->email)){
        echo "<p style='color: red'> $errors->email</p>";
      }
    ?>
  </div>
  <div class="mb-6">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
    <input name="password" value="<?php if(isset($olddata->pasword)) {echo $olddata->pasword;} ?>" placeholder="Password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
      if(isset($errors->password)){
        echo "<p style='color: red'> $errors->password</p>";
      }
    ?>
  </div>
  <input type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="sumbit" value="Sumbit"/>
</form>
    </section>
    <?php include('./layout/footer.php') ?>
</html>