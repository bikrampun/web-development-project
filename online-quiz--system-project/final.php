<?php 
    session_start();
	if(isset($_SESSION['score'])){
		if ($_SESSION['score']<0) {
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/main.php");
			//header('location:main.php');
		} else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz System</title>
	<!-- icon in tab -->
	<link rel="icon" href="assets/img/nepal.png">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="intro">
        <h4 style="margin-top: 24px;">Online Quiz System</h4>
        
        <div><a href="logout.php" class="logout">Logout</a></div>
    </div>
	<main>
			<div class="container">
				<h2>Your Result</h2>
				<p>Congratulation You have completed this test succesfully.</p>
				<p>Your <strong>Score</strong> is <?php echo $_SESSION['score'];?></p>
		        <?php unset($_SESSION['score']); ?>
				<a href="welcome.php" class="start" style="margin-left: 10px;">Home</a>
			</div>
	</main>
    <footer class="footer" style="top: 379px;">
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
    header("location:http://$host$uri/main.php");
    //header('location:main.php');
}
?> 
