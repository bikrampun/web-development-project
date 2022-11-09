<?php 
	include 'connect.php';
	session_start(); 

	if(isset($_SESSION['id'])){
		//check if data available in database or not
		  if ($_SESSION['id']==0) {
			  $host=$_SERVER['HTTP_HOST'];
			  $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			  header("location:http://$host$uri/main.php");
			  //header('location:main.php');
		  }
		  else
		  {
			//Set Question Number
			//n value comes from link 'question.php?n=.. '
			$number = $_GET['n'];
			//Query for the Question
			$query = "SELECT * FROM questions WHERE question_number = $number";

			// Get the question
			$result = mysqli_query($connection,$query);
			$question = mysqli_fetch_assoc($result); 

			//Get Choices
			$query = "SELECT * FROM options WHERE question_number = $number";
			$choices = mysqli_query($connection,$query);
			// Get Total questions
			$query = "SELECT * FROM questions";
			$total_questions = mysqli_num_rows(mysqli_query($connection,$query));
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
				<div class="questionNum">Question <?php echo $number; ?> of <?php echo $total_questions; ?> </div>
				<p class="question"><?php echo $question['question_text']; ?> </p>
				<form method="POST" action="process.php">
					<ul class="choices">
						<?php while($row=mysqli_fetch_assoc($choices)){ ?>
						<li><input type="radio" name="choice" value="<?php echo $row['id']; ?>"><?php echo " ".$row['coption']; ?></li>
						<?php } ?>
					</ul>
					<input type="hidden" name="number" value="<?php echo $number; ?>">
					<input type="submit" name="submit" value="Submit" class="submit">
					<a href="welcome.php" class="start" style="margin-left: 200px;">Home</a>
				</form>
			</div>
	</main>
	<footer class="footer" style="top: 294px;">
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