<?php

// Initialize the session
session_start();

//connecting server
//include("connect.php");
require_once('connect.php');

if(isset($_SESSION['idLec'])){
	//check if data available in database or not
	  if ($_SESSION['idLec']==0) {
		  $host=$_SERVER['HTTP_HOST'];
		  $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		  header("location:http://$host$uri/welcomeStaff.php");
		  //header('location:welcomeStaff.php');
	  } 
	  else
	  {
		if(isset($_POST['submit'])){
			$question_number = $_POST['question_number'];
			$question_text = $_POST['question_text'];
			$correct_choice = $_POST['correct_choice'];
			// Choice Array
			$choice = array();
			$choice[1] = $_POST['choice1'];
			$choice[2] = $_POST['choice2'];
			$choice[3] = $_POST['choice3'];
			$choice[4] = $_POST['choice4'];

		// First Query for Questions Table

			$query = "INSERT INTO questions ( question_number, question_text)
							VALUES ('$question_number','$question_text')";

			//$result = mysqli_query($connection,$query);
			
			//Validate First Query
			if(mysqli_query($connection,$query)){
				foreach($choice as $option => $value){
					if($value != ""){
						if($correct_choice == $option){
							$is_correct = 1;
						}else{
							$is_correct = 0;
						}
						//Second Query for Options Table
						$query = "INSERT INTO options ( question_number,is_correct,coption)
									VALUES ('$question_number','$is_correct','$value')";

						//$insert_row = mysqli_query($connection,$query);
						// Validate Insertion of Choices

						if(mysqli_query($connection,$query)){
							continue;
						}else{
							die("2nd Query for Choices could not be executed" . $query);
							
						}

					}
				}
				$message = "Question has been added successfully";
			}
		}
				$query = "SELECT * FROM questions";
				$questions = mysqli_query($connection,$query);
				$total = mysqli_num_rows($questions);
				$next = $total+1;
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
        <h4 style="margin-top:24px;">Online Quiz System</h4>
        
        <div><a href="logout.php" class="logout">Logout</a></div>
    </div>
	<main style="top: 90px;">
			<div class="container">
				<h2>Add A Question</h2>
				<?php if(isset($message)){
					echo "<h4>" . $message . "</h4>";
				} ?>
								
				<form method="POST" action="">
						<p>
							<label>Question Number:</label>
							<input type="number" name="question_number" value="<?php echo $next;  ?>" readonly>
						</p>
						<p>
							<label>Question Text:</label>
							<input type="text" name="question_text" required>
						</p>
						<p>
							<label>Choice 1:</label>
							<input type="text" name="choice1" required>
						</p>
						<p>
							<label>Choice 2:</label>
							<input type="text" name="choice2" required>
						</p>
						<p>
							<label>Choice 3:</label>
							<input type="text" name="choice3">
						</p>
						<p>
							<label>Choice 4:</label>
							<input type="text" name="choice4">
						</p>
						<p>
							<label style="font-size: smaller;">Correct Option Number:</label>
							<input type="number" name="correct_choice" required>
						</p>
						<input type="submit" name="submit" value ="Submit" class="submit">
						<a href="welcomeStaff.php" class="start" style="margin-left: 270px;">Home</a>
				</form>
			</div>
	</main>
	<footer class="footer" style="top: 82px">
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
    header("location:http://$host$uri/welcomeStaff.php");
    //header('location:welcomeStaff.php');
}
?> 
