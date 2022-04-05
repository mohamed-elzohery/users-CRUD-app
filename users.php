<?php 
  session_start();
  if(!isset($_SESSION["email"])){
    header("Location:login.php");
  }

function populateTable(){
  $id=0;
  try{
    $data = "data.txt";
    $datafile = fopen($data, 'r');
    while (($line = fgets($datafile)) !== false) {
      $arrayOfValues = explode(":", $line);
      $id = $arrayOfValues[0];
      echo "<tr>";
      echo "<td class='px-6 py-4 text-left'><img style='width: 50px' src='./images/{$arrayOfValues[11]}' /></td>";
      for($i = 0 ; $i < 11 ; $i++ ){
        echo "<td scope='row' class='px-6 py-4'>{$arrayOfValues[$i]}</td>";
      };
      echo "<td class='px-6 py-4 text-left'>
      <a href='./profile.php?id=$id' class='font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1'>view</a>
      <a href='./index.php?id=$id' class='font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1'>Edit</a>
      <a href='./delete.php?id=$id' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>delete</a>
      </td>";
      echo "</tr>";
    }
      fclose( $datafile);
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

  
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('./layout/header.php') ?>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <th scope="col" class="px-6 py-3">
                    Photo
                </th>
            <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    first name
                </th>
                <th scope="col" class="px-6 py-3">
                    last name
                </th>
                <th scope="col" class="px-6 py-3">
                    country
                </th>
                <th scope="col" class="px-6 py-3">
                  skills
                </th>
                <th scope="col" class="px-6 py-3">
                  address
                </th>
                <th scope="col" class="px-6 py-3">
                 username
                </th>
                <th scope="col" class="px-6 py-3">
                  department
                </th>
                <th scope="col" class="px-6 py-3">
                  gender
                </th>
                <th scope="col" class="px-6 py-3">
                  password
                </th>
                <th scope="col" class="px-6 py-3">
                  email
                </th>
                <th scope="col" class="px-6 py-3">
                  actions
                </th>
            </tr>
        </thead>
        <tbody>
            <?php populateTable();?>
        </tbody>
    </table>
</div>
    <?php include('./layout/footer.php') ?>
</html>