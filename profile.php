    
    
    <?php
    session_start();
if(!isset($_SESSION["email"])){
    header("Location:login.php");
  }
    if (isset($_GET["id"])){
        $id = json_decode($_GET["id"]);
        $dir="data.txt";
        $datafile = fopen($dir, 'r');
        while (($line = fgets($datafile)) !== false) {
            if(str_starts_with($line, $id)){
            $userArray = explode(":", $line);
            break;
            };
        }
    }
        
    ?>
    <?php include('./layout/header.php') ?>
<section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="img_container" style="display: flex; align-items:center; justify-content:center">
                    <?php echo "<img src='./images/{$userArray[11]}' alt='profile_img' style='width: 400px; height: 400px; object-fit: cover'/>";?>
                </div>
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">About Me</h3>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>First Name</label>
                                        <p><?php echo $userArray[1]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Last Name</label>
                                        <p><?php echo $userArray[2]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Country</label>
                                        <p><?php echo $userArray[3]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Skills</label>
                                        <p><?php echo $userArray[4]?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                    <label>Address</label>
                                        <p><?php echo $userArray[5]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Username</label>
                                        <p><?php echo $userArray[6]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Department</label>
                                        <p><?php echo $userArray[7]?></p>
                                    </div>
                                    <div class="media">
                                    <label>Gender</label>
                                        <p><?php echo $userArray[8]?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
        </section>

    <?php include('./layout/footer.php') ?>
