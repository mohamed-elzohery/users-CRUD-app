<?php
  session_start();
if(!isset($_SESSION["email"])){
    header("Location:login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('./layout/header.php') ?>

    <section style="max-width: 600px; margin: 100px auto">
        <h1 style="text-align: center;font-size: 80px">HOME PAGE</h1>
        <p>WELCOME HOME!</p>
    </section>
    <?php include('./layout/footer.php') ?>
</html>
