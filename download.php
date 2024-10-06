<?php
 include 'db.php';
 if($_SERVER['REQUEST_METHOD']=="GET"){
  if(!isset($_GET['id'])){
      header('location:index.php');
  }
 $id= $_GET['id'];
 $sql = ("SELECT * FROM songs WHERE id ='$id'");
 $result= $conn->query($sql);
 $row= $result->fetch_assoc();
 $id=$row['id'];
 $name=$row['name'];
 $down = "UPDATE songs SET downloads = 1+downloads  WHERE id = $id";
 $download =$conn->query($down);
 // Execute the query using your database connection

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/bootstrap.bundle.min.js"></script>

</head>
<body>
    
    <body class="bg-dark-subtle">
    <?php include 'navbar.html' ?>
        <div class="container text-center card mt-1 p-2" id="container">
        <div><h1 class="display-6 text-center well well-lg"><?php echo $name ?></h1> 
     
         <input type="hidden" name="id" value="<?php echo $id; ?>">
            <img src="<?php echo $row['imagepath']?>" width="300" class="mx-auto d-block p-5"  alt="img">
            <p><a href="<?php echo './music/' . $row['songname'];?>" class="btn btn-success" download> download mp4</a></p>
            <p><a href="<?php echo './music/' . $row['songname'];?>" class="btn btn-success" id="play" playMusic>play song mp3</a></p>
            <p><a href="<?php echo './music/' . $row['songname'];?>" class="btn btn-success "> download mp3</a></p> 
            
    </div>
    <script src="jquery-3.7.1.min.js"></script>
    <script>
       let play = document.getElementById("play");
            function playMusic() {
             let audio = new Audio("drake_first_person_shooter_ft._j._cole_mp3_41022.mp3");
             audio.play()
          }
          play.addEventListener("click", playMusic);
    </script>
</body>
</html>