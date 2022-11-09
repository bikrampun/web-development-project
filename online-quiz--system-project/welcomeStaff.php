<?php
// Initialize the session
session_start();

if(isset($_SESSION['idLec'])){
  //check if data available in database or not
    if ($_SESSION['idLec']==0) {
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/index.php");
        //header('location:index.php');
    } else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Quiz System</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- icon in tab -->
  <link rel="icon" href="assets/img/nepal.png">
</head>
<body>
  <div class="intro">
    <h4>Welcome<p class="fname"><?php echo $_SESSION['name'];?></p></h4>
    
    <div><a href="logout.php" class="logout">Logout</a></div>
  </div>
  <div class="paragraph">
    <p>Add More Quiz Question for Student Intelligence</p>
  </div>
  <br>
  <div class="content">
    <a href="add.php" class="button">Add questions</a>
  </div>
  <footer class="footer" style= "top: 439px;">
        <div class="copyright">
            <p>&copy; Copyright <span id="year"></span>. All rights reserved</p>
        </div>
    </footer>
    <script type="text/javascript" src="assets/js/year.js"></script>
</body>
</html>


<?php 

    } //closing else 
}// closing main-if
else{
//if session is not started then redirecting...
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/index.php");
    //header('location:index.php');
}
?> 
